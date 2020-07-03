<?php

/**
* 
*/
class Details extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReservationModel', 'reservation');
		$this->load->model('ContentModel', 'content');
	}

	public function index($reservation_code, $modifyFlag)
	{
		$data['active_page'] = 'details';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);
		$reservationData = $this->reservation->getReservationByCode($reservation_code);

		$res = $reservationData[0];	

		if (! is_null($res['cancelled_flag']) && ! is_null($res['cancellation_details'])) {
			$res['status'] = 'pending - requested for cancellation';
		}

		$res['package_items'] = json_decode($res['package_items'], true);
		$res['foods'] = json_decode($res['foods'], true);

		$data['reservation'] = $res;
		$data['terms'] = $this->content->fetchTerms();
		$data['modify_flag'] = $modifyFlag;

		$dateToday = (new DateTime())->format('Y-m-d');
		$eventDate = (new DateTime($res['date_of_event']))->format('Y-m-d');

		$data['is_date_passed'] = $eventDate < $dateToday;

		$this->load->view('site/details', $data);
	}
}