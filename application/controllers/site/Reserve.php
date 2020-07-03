<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use \Eventviva\ImageResize;

include_once APPPATH. 'libraries/ImageResize.php';
include_once APPPATH . 'libraries/phpmailer/PHPMailer.php';
include_once APPPATH . 'libraries/phpmailer/Exception.php';
include_once APPPATH . 'libraries/phpmailer/SMTP.php';

class Reserve extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReservationModel', 'reservation');
		$this->load->model('ItemsModel', 'item');
		$this->load->model('FoodModel', 'food');
		$this->load->model('ThemeModel', 'theme');
		$this->load->model('VenueModel', 'venue');
		$this->load->model('ContentModel', 'content');
	}

	public function index()
	{
		$data['active_page'] = 'reserve';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);

		$package = $this->session->userdata('reservation_package');

		if (empty($package)) {
			redirect('/home');
		}

		if (! is_array($package['foods'])) {
			$package['foods'] = json_decode($package['foods'], true);
		}

		if (! is_array($package['items'])) {
			$package['items'] = json_decode($package['items'], true);
		}

		$theme = $this->theme->fetch($package['theme_id']);
		if (! empty($theme)) {
			$theme[0]['image'] = json_decode($theme[0]['image'], true); 
		}

		$venues = $this->venue->fetch();
		if (! empty($venues)) {
			foreach ($venues as &$ven) {
				$ven['image'] = json_decode($ven['image'], true);
			}
		}

		$package['theme'] = empty($theme) ? $package['theme_desc'] : $theme[0];

		$data['package'] = $package;
		$data['venues'] = $venues;
		$data['terms'] = $this->content->fetchTerms();
		$data['user'] = $this->session->userdata('user');

		$this->load->view('site/reserve', $data);
	}

	public function getSingleVenue($id)
	{
		$result = $this->venue->fetch($id);

		if (! empty($result)) {
			$result[0]['image'] = json_decode($result[0]['image'], true);
		}

		echo json_encode($result[0]);
	}

	public function verifyCode() 
	{
		$post = $this->input->post();

		$record = $this->reservation->getCodeByEmail($post['email_address'], $post['code']);

		if (empty($record)) {
			echo json_encode(['success' => false, 'message' => 'Invalid code entered.']);
		} else {
			echo json_encode(['success' => true]);
		}
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	@$image = new ImageResize($upload_data['full_path']);
			@$image->save($upload_data['full_path']);

       		$resImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('reservation_image', $resImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors();
        }
	}

	public function process()
	{
		$post = $this->input->post();

		$reservation_package = $this->session->userdata('reservation_package');

		$isCustomized = $reservation_package['is_customized'];

		if (empty($reservation_package) && $post) {
			redirect('/home');
		}

		if (is_array($reservation_package['items'])) {
			$reservation_package['items'] = json_encode($reservation_package['items']);
		}

		if (is_array($reservation_package['foods'])) {
			$reservation_package['foods'] = json_encode($reservation_package['foods']);
		}

		$uploadedImage = $this->session->userdata('reservation_image');
		$resImage = [];

		if (! empty($uploadedImage)) {
			$resImage = $this->moveImage($uploadedImage, $post['full_name']);
		}

		$result = $this->reservation->create([
			'customer_name' => $post['full_name'],
			'customer_email' => $post['email_address'],
			'customer_contact' => $post['contact_no'],
			'customer_address' => $post['address'],
			'date_of_event' => $reservation_package['date'],
			'package_id' => ($isCustomized) ? null : $reservation_package['id'],
			'package_items' => $reservation_package['items'],
			'foods'	=> $reservation_package['foods'],
			'theme_id' => $reservation_package['theme_id'],
			'theme_desc' => $reservation_package['theme_desc'],
			'total_amount' => $reservation_package['price'],
			'valid_document' => json_encode($resImage),
			'status' => 'pending',
			'venue_id' => ($post['venue_id'] !== 0) ? $post['venue_id'] : null,
			'custom_venue' => (! empty($post['venue_desc'])) ? $post['venue_desc'] : null,
			'event_time' => $post['event_time']
		]);	

		createLog('New Reservation ' . $post['full_name'] . ' ( ' . date_format(date_create($reservation_package['date']), 'F j, Y') . ' )');

		if (! empty($result)) {
			// reservation is successful
			$this->session->unset_userdata('reservation_package');
			$this->session->unset_userdata('selected_items');
			$this->session->unset_userdata('items_total');
			$this->session->unset_userdata('custom_package_date');
			$this->session->unset_userdata('reservation_image');

			$this->reservation->removeCode($post['email_address'], $post['code']);
			echo json_encode($result);
		} else {
			$this->session->set_flashdata('failed_reservation', 'There was some error encoutered while saving your reservation. Please try again.');
			echo 1;
		}

	}

	private function moveImage($uploadedImage, $resName) 
	{
		$resName = strtolower($resName);
		$resName = str_replace(' ', '_', $resName);

		$images_dir = "./valid_documents/";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($resName . '_' . time() . $uploadedImage['ext']);
		$image_name = str_replace('', '_', $image_name);

		$full_temp_path = $uploadedImage['full_path'];

		$transfer = rename($full_temp_path, "$images_dir/$image_name");

		if ($transfer)  {
			return [
				'current_path' => $images_dir.$image_name,
				'image_name' => $image_name
			];
		}
		else {
			return false;
		}

	}

	public function generateRandomString() 
	{
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 5; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function getItemImage($id)
	{
		$result = $this->item->fetch($id);

		if (! empty($result)) {
			$result[0]['image'] = json_decode($result[0]['image'], true);
		}

		echo json_encode($result[0]['image']['current_path']);
	}

	public function getFoodImage($id)
	{
		$result = $this->food->fetch($id);

		if (! empty($result)) {
			$result[0]['image'] = json_decode($result[0]['image'], true);
		}

		echo json_encode($result[0]['image']['current_path']);
	}

	public function sendCode() 
	{
		$email_address = $this->input->post('email');
		$name = $this->input->post('fullname');

		$code = $this->generateRandomString();

		$try = 1;

		if ($try == 1) {
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		    $to = $email_address;
		    $subject = 'Recto\'s Catering Confirmation Code';

		    $message = 'Your confirmation code for Recto\'s transansaction is: <br><br>';
			$message .= '<b style="color:#e67e22; font-size:24px;">' .  $code . ' </b>';

			mail($to, $subject, $message, $headers);

			$this->reservation->insertCode([
		    	'email_address' => $email_address,
		    	'code'			=> $code,
		    	'date_sent'		=> date('Y-m-d h:i:s'),
		    ]);

			echo 1;
		} else {
			$mail = new PHPMailer(true);
			try {
				// gmail - project.grandcasiana@gmail.com
				// gmail pass = sampleCasiana
				// $mail->SMTPDebug = 2;       
			    $mail->isSMTP();                // Set mailer to use SMTP
			    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			    $mail->SMTPAuth = true;                               // Enable SMTP authentication
			    $mail->Username = 'project.grandcasiana@gmail.com';                 // SMTP username
			    $mail->Password = 'sampleCasiana';                           // SMTP password
			    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			    $mail->Port = 587;       
			    $mail->SMTPOptions = array(
				    'ssl' => array(
				        'verify_peer' => false,
				        'verify_peer_name' => false,
				        'allow_self_signed' => true
				    )
				);
			    $mail->setFrom('project.grandcasiana@gmail.com', 'Recto\'s Catering');
			    $mail->addAddress($email_address, $name);     // Add a recipient
			    $mail->addReplyTo('project.grandcasiana@gmail.com', 'Grand Casiana');

			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = 'Recto\'s Catering Confirmation Code';

			    $body = 'Your confirmation code for Recto\'s transansaction is: <br><br>';
			    $body .= '<b style="color:#e67e22; font-size:24px;">' .  $code . ' </b>';

			    $mail->Body    = $body;

			    $mail->send();

			    $this->reservation->insertCode([
			    	'email_address' => $email_address,
			    	'code'			=> $code,
			    	'date_sent'		=> date('Y-m-d h:i:s')
			    ]);
			    
			    echo 1;

			} catch(Exception $e) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;	
			}
		}
		
	}
    
}