<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once APPPATH. 'libraries/phpexcel/Classes/PHPExcel.php';
include_once APPPATH . 'libraries/phpmailer/PHPMailer.php';
include_once APPPATH . 'libraries/phpmailer/Exception.php';
include_once APPPATH . 'libraries/phpmailer/SMTP.php';


class Reservations extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReservationModel', 'reservation');
		$this->load->model('PackageModel', 'package');
		$this->load->model('ItemsModel', 'item');
	}

	public function index()
	{
		
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'reservations';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->reservation->truncateNotifications();

		$data['pending'] = $this->decodeColumns($this->reservation->fetch(null, 'pending'));
		$data['rejected'] = $this->decodeColumns($this->reservation->fetch(null, 'rejected'));
		$confirmedReservations = $this->decodeColumns($this->reservation->fetch(null, 'confirmed'));

		$data['confirmed'] = $confirmedReservations;

		$pending = $this->reservation->fetch(null, 'pending');

		$tobeRejectedIds = $this->reservation->getPastFiveReservations($pending);

		if (! empty($tobeRejectedIds)) {
			$cancelReason = '5 day no down payment policy';
			$rejected = $this->reservation->massReject($tobeRejectedIds, [
				'status' => 'rejected',
				'reject_reason' => $cancelReason
			]);

			if ($rejected) {
				foreach ($tobeRejectedIds as $id) {
					$reservation = $this->reservation->fetch($id)[0];
					
					$emailBody = $this->confirmationEmail($reservation);
					$this->sendEmail($reservation['customer_email'], $emailBody);
					$message = 'Your reservation '. $reservation['reservation_code'] . ' is denied due to ' .$cancelReason;	
					$this->sendSMS($reservation['customer_contact'], $message);
					createLog('Declined Reservation '. $reservation['reservation_code'] . ' due to ' . $cancelReason, 1);
				}
			}
		}
		

		$data['res_for_today'] = NULL;
		$data['count_pending'] = $this->reservation->count('pending');
		$data['count_confirmed'] = $this->reservation->count('confirmed');
		$data['count_rejected'] = $this->reservation->count('rejected');

		$this->load->view('dashboard/reservations/index', $data);
	}

	public function getPendingReservations() 
	{
		$pending = $this->reservation->fetch(null, 'pending');

		$pending = $this->removeExpiredPending($pending);

		foreach ($pending as $key => &$val) {
			$val['name'] = empty($val['package_name']) ? 'Custom Package' : $val['package_name'];
			$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
			$val['status'] = ($val['cancelled_flag'] == 1) ? '<span>REQUESTED FOR CANCELLATION</span>': strtoupper($val['status']);
			$val['info_button'] = '<a href="'.base_url() . 'reservations/' . $val['id'].'" class="resInfo">more info</a>';
		}

		$pending = ['data' => $pending];

		echo json_encode($pending);
	}

	public function fetchNewReservations()
	{
		$res = $this->reservation->getNewReservations();

		echo json_encode($res);
	}

	public function generateReport($year, $filter, $month = null, $startDate = null, $endDate = null)
	{		
		$status = null;
		switch ($filter) {
			case 1:
				$status = null;
				break;
			case 2:
				$status = 'pending';
				break;
			case 3:
				$status = 'confirmed';
				break;
			case 4:
				$status = 'rejected';
				break;
			
			default:
				$status = null;
				break;
		}

		$reservations = $this->reservation->fetchForReport($year, $month, $startDate, $endDate, $status);

		if (! empty($reservations)) {
			foreach ($reservations as &$val) {

				$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
				$val['total_amount'] = 'PHP ' . number_format($val['total_amount'], 2);
				$val['date_of_reservation'] = date_format(date_create($val['date_of_reservation']), 'F j, Y');
				$val['name'] = (is_null($val['name'])) ? ' Custom Package' : $val['name'];		

			}
		}

		$totalRows = count($reservations);
		$filename = 'Reservations_Report.xls';

		if (! is_null($year) && is_null($month) && is_null($startDate)) {
			$filename = $year.'_Reservations_Report.xls';
		}

		if (! is_null($year) && ! is_null($month) && is_null($startDate)) {
			$dateObj   = DateTime::createFromFormat('!m', $month);
			$monthName = $dateObj->format('F');
			$filename = $monthName.'_'.$year.'_Reservations_Report.xls';
		}

		if (! is_null($year) && $month == 0 && ! is_null($startDate)) {
			$filename = 'Custom_Reservations_Report.xls';
		}

		$dateToday = (new DateTime())->format('F j, Y');

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator("Recto\'s Administrator")
							 ->setLastModifiedBy("Recto\'s Administrator")
							 ->setTitle("Recto\'s Reservations Report")
							 ->setSubject("Recto\'s Reservations Report");


		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'CUSTOMER NAME');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'CUSTOMER EMAIL');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'CUSTOMER CONTACT');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'DATE OF RESERVATION');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'DATE OF EVENT');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'PACKAGE');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'STATUS');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'REJECT REASON');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'RESERVATION AMOUNT');

		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

		    $sheet = $objPHPExcel->getActiveSheet();
		    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(true);
		    /** @var PHPExcel_Cell $cell */
		    foreach ($cellIterator as $cell) {
		        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    }
		}

		$objPHPExcel->getActiveSheet()
		    ->fromArray(
		        $reservations,  // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );

		$lastRow = 4 + $totalRows;
		$dateRow = $lastRow + 3;
		$prepRow = $dateRow + 1;


		$objPHPExcel->getActiveSheet()->setCellValue('I'.$lastRow, 'Total Number of Reservations: ' . $totalRows);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$dateRow, 'Reservations as of ' . $dateToday);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$dateRow, 'Prepared by Administrator');

        $objPHPExcel->getActiveSheet()->setTitle('Reservations Report');

        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		createLog('Reservations report generation', 1);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');		
	}

	public function removeExpiredPending($reservations) 
	{
		foreach ($reservations as $key => &$val) {
			$date = (new DateTime($val['date_of_event']))->format('Y-m-d');
			$now = (new DateTime())->format('Y-m-d');
		

			if ($date < $now) {
			    unset($reservations[$key]);
			}
		}

		return array_values($reservations);
	}

	public function getConfirmedReservations() 
	{
		$confirmed = $this->reservation->fetch(null, 'confirmed');

		foreach ($confirmed as $key => &$val) {
			$val['name'] = empty($val['package_name']) ? 'Custom Package' : $val['package_name'];
			$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
			$val['status'] = ($val['cancelled_flag'] == 1) ? '<span>REQUESTED FOR CANCELLATION</span>': strtoupper($val['status']);
			$val['info_button'] = '<a href="'.base_url() . 'reservations/' . $val['id'].'" class="resInfo">more info</a>';
		}

		$confirmed = ['data' => $confirmed];

		echo json_encode($confirmed);
	}

	public function getRejectedReservations() 
	{
		$rejected = $this->reservation->fetch(null, 'rejected');

		foreach ($rejected as $key => &$val) {
			$val['name'] = empty($val['package_name']) ? 'Custom Package' : $val['package_name'];
			$val['date_of_event'] = date_format(date_create($val['date_of_event']), 'F j, Y');
			$val['status'] = ($val['cancelled_flag'] == 1) ? 'CANCELLED' : strtoupper($val['status']);
			$val['info_button'] = '<a href="'.base_url() . 'reservations/' . $val['id'].'" class="resInfo">more info</a>';
		}
		
		$rejected = ['data' => $rejected];

		echo json_encode($rejected);
	}

	public function getReservationForToday(&$reservations)
	{
		$resForToday = [];

		$dateToday = (new DateTime())->format('Y-m-d');

		foreach ($reservations as $key => $reservation) {
			if ($reservation['date_of_event'] == $dateToday) {
				$resForToday = $reservation;
				unset($reservations[$key]);
			}
		}
		
		if (isset($resForToday['package_items'])) {
			$resForToday['package_items'] = json_decode($resForToday['package_items'], true);
		}
		
		return $resForToday;
	}

	public function decodeColumns($reservations)
	{
		if (! empty($reservations)) {
			foreach ($reservations as &$res) {
				if (isset($res['package_items'])) {
					$res['package_items'] = json_decode($res['package_items'], true);
				}
				if (isset($res['foods'])) {
					$res['foods'] = json_decode($res['foods'], true);
				}
				if (isset($res['valid_document'])) {
					$res['valid_document'] = json_decode($res['valid_document'], true);
				}
			}

			return $reservations;
		}
	}
	public function view($resId)
	{
		$data['active_page'] = 'reservations';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$reservations = $this->reservation->fetch($resId);

		if ($reservations[0]['cancelled_flag'] == 1) {
			$reservations[0]['cancellation_details'] = json_decode($reservations[0]['cancellation_details'], true); 
		}

		if ($reservations[0]['venue_id'] !== 0) {
			$reservations[0]['venue_image'] = json_decode($reservations[0]['venue_image'], true); 
		}

		$dateToday = (new DateTime())->format('Y-m-d');
		$eventDate = (new DateTime($reservations[0]['date_of_event']))->format('Y-m-d');

		$data['is_date_passed'] = $eventDate < $dateToday;

		$data['reservation'] = $this->decodeColumns($reservations)[0];

		$this->load->view('dashboard/reservations/view', $data);
	}


	public function confirmationEmail($reservation) 
	{
		$this->decodeColumns($reservation);

		$data['reservation'] = $reservation;

		return $this->load->view('dashboard/reservations/ce', $data, true);
	}

	public function sendEmail($email_address, $body) 
	{
		$try = 1;

		if ($try == 0) {
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		    $to = $email_address;
		    $subject = 'Recto\'s Catering Reservation';
			$message = $body;

			mail($to, $subject, $message, $headers);

			return true;
		} else {
			$mail = new PHPMailer(true);
			try {
			    $mail->isSMTP();
			    $mail->Host = 'smtp.gmail.com'; 
			    $mail->SMTPAuth = true; 
			    $mail->Username = 'project.grandcasiana@gmail.com'; 
			    $mail->Password = 'sampleCasiana'; 
			    $mail->SMTPSecure = 'tls';
			    $mail->Port = 587;       
			    $mail->SMTPOptions = array(
				    'ssl' => array(
				        'verify_peer' => false,
				        'verify_peer_name' => false,
				        'allow_self_signed' => true
				    )
				);
			    $mail->setFrom('project.grandcasiana@gmail.com', 'Recto\'s Catering');
			    $mail->addAddress($email_address, 'Recto\'s Catering');     // Add a recipient
			    $mail->addReplyTo('project.grandcasiana@gmail.com', 'Recto\'s Catering');

			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Recto\'s Catering Reservation';

			    $mail->Body    = $body;

			    $mail->send();
			    
			    return  true;

			} catch(Exception $e) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;	
			}
		}
	}

	public function sendSMS($contactNumber, $message)
	{
		$ch = curl_init();
		$parameters = array(
		    'apikey' => 'a1170d74b50eeb439a73dc54a6afc6e5', 
		    'number' => $contactNumber,
		    'message' => $message,
		);
		curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
		curl_setopt( $ch, CURLOPT_POST, 1 );

		//Send the parameters set above with the request
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$output = curl_exec( $ch );
		curl_close ($ch);

		//Show the server response
		return $output;
               
	}

	public function updateStatus($id)
	{
		$post = $this->input->post();

		$sameIds = [];

		if ($post['status'] == 'confirmed') {
			// fetch for reservation with the same date
			$reservation = $this->reservation->fetch($id)[0];
			$dateOfEvent = $reservation['date_of_event'];

			$sameDateReservations = $this->reservation->fetchByDate($dateOfEvent, $reservation['id']);

			foreach ($sameDateReservations as $val) {
				array_push($sameIds, $val['id']);
			}
		}

		if (! empty($sameIds)) {
			echo json_encode(['error' => 1, 'data' => $sameIds]);
		} else {

			$result = $this->reservation->update($id, $post);

			$reservation = $this->reservation->fetch($id)[0];

			if ($post['status'] == 'confirmed') {
				
				$items = json_decode($reservation['package_items'], true);

				$updateInventory = $this->updateItemsInventory($items);
				
				if ($result && $updateInventory) {

					$messageBody = 'Your reservation '. $reservation['reservation_code'] . ' is now confirmed. You can now go to the shop after recieving this message. Don\'t forget to bring your printed receipt. Thank you for choosing Recto\'s Catering Services.';
					$this->sendSMS($reservation['customer_contact'], $messageBody);
					$emailBody = $this->confirmationEmail($reservation);
					$this->sendEmail($reservation['customer_email'], $emailBody);
					createLog('Confirmed Reservation '. $reservation['reservation_code'], 1);

					echo json_encode($result);
				}
			} else {

				$messageBody = 'Your reservation '. $reservation['reservation_code'] . ' is denied due to ' . $post['reject_reason'];
				$this->sendSMS($reservation['customer_contact'], $messageBody);
				$emailBody = $this->confirmationEmail($reservation);
				$this->sendEmail($reservation['customer_email'], $emailBody);
				createLog('Declined Reservation '. $reservation['reservation_code'] . ' due to ' . $post['reject_reason'], 1);

				echo json_encode($result);
			}
			
		}

	}

	public function updateItemsInventory(array $items)
	{
		$ids = array_column($items, 'id');
		$itemsInventory = $this->item->getItemsInventory($ids);

		$updateData = [];

		foreach ($itemsInventory as $key => $val) {
			foreach ($items as $item) {
				if ($val['id'] == $item['id']) {
					$updateData[] = [
						'id' => $val['id'],
						'quantity' => $val['quantity'] - $item['quantity']
					];
					$myQty = $val['quantity'] - $item['quantity'];
					createLog('Updated item inventory of ' . $val['item_name'] . ' from ( ' .$val['quantity']. ' ) to ' . $myQty, 1);
				}
			}
		}

		$result = $this->item->updateItemsInventory($updateData);

		return $result;
	}

	public function rejectReservations()
	{
		$post = $this->input->post();
		$sameIds = explode(', ', $post['ids']);
		$cancelReason = $post['cancel_reason'];

		$saveConfirmed = $this->reservation->update($post['res_id'], ['status' => 'confirmed']); //save as confirmed
		$reservation = $this->reservation->fetch($post['res_id'])[0];
		$emailBody = $this->confirmationEmail($reservation);

		$confirmEmail = $this->sendEmail($reservation['customer_email'], $emailBody);

		$messageBody = 'Your reservation '. $reservation['reservation_code'] . ' is denied due to ' .$cancelReason;	
		$confirmEmail = $this->sendSMS($reservation['customer_contact'], $messageBody);
		$emailBody = $this->confirmationEmail($reservation);
		$this->sendEmail($reservation['customer_email'], $emailBody);
		createLog('Declined Reservation '. $reservation['reservation_code'] . ' due to ' . $cancelReason, 1);

		if ($saveConfirmed && $confirmEmail) {
			$reject = $this->reservation->massReject($sameIds, [
				'status' => 'rejected',
				'reject_reason' => $cancelReason
			]);

			if ($reject) {

				foreach ($sameIds as $id) {
					$reservation = $this->reservation->fetch($id)[0];
					
					$emailBody = $this->confirmationEmail($reservation);
					$this->sendEmail($reservation['customer_email'], $emailBody);
					$message = 'Your reservation '. $reservation['reservation_code'] . ' is denied due to ' .$cancelReason;	
					$this->sendSMS($reservation['customer_contact'], $message);
					createLog('Declined Reservation '. $reservation['reservation_code'] . ' due to ' . $cancelReason, 1);
				}

				echo 1;
			}
		} else {
			echo 0;
		}

	}

	public function subtractAvailability()
	{
		$post = $this->input->post();

		$resId = $post['reservation_id'];
		$dateOfEvent = $post['date_of_event'];
		$availabilityData = [];

		$items = $this->item->fetch();

		$reservationItems = $this->reservation->fetch($resId);
		$reservationItems = json_decode($reservationItems[0]['package_items'], true);

		foreach ($reservationItems as $item) {

			foreach ($items as $inventory) {

				if ($item['id'] == $inventory['id']) {
					$availabilityData[] = [
						'item_id' => $item['id'],
						'date' => $dateOfEvent,
						'inventory' => $inventory['quantity'],
						'available' => $inventory['quantity'] - $item['quantity'],
						'reserved' => $item['quantity'],
						'is_completed' => 0
					];		
				}
			}
		}

		$result = $this->reservation->createAvailability($availabilityData);
		$update = $this->reservation->update($resId, ['status' => 'on-going']);

		if ($result != false && $update != false) {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function markAsComplete()
	{
		$date = $this->input->post('date');
		$resId = $this->input->post('reservation_id');

		$res = $this->reservation->getReservationById($resId);

		$completeRes = $this->reservation->update($resId, ['event_completed' => 1]);

		if ($completeRes) {
			
			$result = $this->item->markAsComplete($date);

			createLog('Completed reservation ' .$res[0]['reservation_code'], 1);

			echo $result;
		}
	}

	public function cancelReservation($id)
	{
		$post = $this->input->post();
		$res = $this->reservation->getReservationById($id);

		$result = $this->reservation->update($id, [
			'cancelled_flag' => 1, 
			'cancellation_details' => json_encode([
				'reason' => $post['cancel_reason'],
				'date' => (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d'),
				'cancelled_by' => $post['cancelled_by']
			])
		]);

		createLog('Cancelled reservation ' .$res[0]['reservation_code'], 1);

		echo $result;
	}
}