<?php

class PrepareReservation extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PackageModel', 'package');	
	}


	public function index($packageId = null, $date = null)
	{
		if (is_null($packageId)) {

			$packageSelected['items']  = $this->session->userdata('selected_items');
			$packageSelected['foods']  = $this->session->userdata('selected_foods');
			$packageSelected['theme_id']  = $this->session->userdata('theme_id');
			$packageSelected['theme_desc']  = $this->session->userdata('theme_desc');
			$packageSelected['price'] = $this->session->userdata('price');
			$packageSelected['item_total'] = $this->session->userdata('item_total');
			$packageSelected['food_total'] = $this->session->userdata('food_total');
			$packageSelected['theme_total'] = $this->session->userdata('theme_total');
			$packageSelected['date'] = $this->session->userdata('custom_event_date');
			$packageSelected['is_customized'] = true;

		} else {

			$packageSelected = $this->package->fetch($packageId)[0];
			$packageSelected['items'] = json_decode($packageSelected['items'], true);
			$packageSelected['date'] = $date;
			$packageSelected['theme_desc']  = null;
			$packageSelected['is_customized'] = false;
		}
		
		$this->session->set_userdata('reservation_package', $packageSelected);

		redirect('/reservation');
	}
}