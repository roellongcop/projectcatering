<?php

class MyReservation extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReservationModel', 'reservation');
	}

	public function index()
	{
		$data['active_page'] = 'res';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);	

		$this->load->view('site/my_reservation', $data);
	}

	public function findReservation()
	{
		$code = $this->input->post('reservation_code');
		$email = $this->input->post('email');

		$code = trim($code);
		$email = trim($email);

		$result = $this->reservation->find($code, $email);

		if (empty($result)) {
			echo json_encode(['success' => false, 'data' => null]);
		} else {
			echo json_encode(['success' => true, 'data' => $result[0]['reservation_code']]);
		}

	}

	public function setAsCancelled($id)
	{
		$post = $this->input->post();
		$data = [
			'cancelled_flag' => $post['cancelled_flag'], 
			'cancellation_details' => json_encode([
				'reason' => $post['cancel_reason'],
				'date' => (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d'),
				'cancelled_by' => 'client'
			])
		];

		$result = $this->reservation->setCancelled($id, $data);

		echo $result;
	}


}