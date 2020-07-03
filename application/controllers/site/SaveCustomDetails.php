<?php 


class SaveCustomDetails extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$post = $this->input->post();

		$this->session->set_userdata('selected_items', $post['items']);
		$this->session->set_userdata('selected_foods', $post['foods']);
		$this->session->set_userdata('theme_id', $post['theme_id']);
		$this->session->set_userdata('theme_desc', $post['theme_desc']);
		$this->session->set_userdata('price', $post['package_total']);
		$this->session->set_userdata('item_total', $post['item_total']);
		$this->session->set_userdata('food_total', $post['food_total']);
		$this->session->set_userdata('theme_total', $post['theme_total']);
		$this->session->set_userdata('custom_event_date', $post['date']);


		echo 1;
	}
}