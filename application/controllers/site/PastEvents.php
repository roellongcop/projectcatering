<?php

class PastEvents extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		$data['active_page'] = 'past_events';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);

		$pastEvents = $this->event->fetchAllPastEvents();

		if (! empty($pastEvents)) {
			foreach ($pastEvents as &$ev) {
				$ev['image'] = json_decode($ev['image'], true);
			}
		}

		$data['past_events'] = $pastEvents;
		
		$this->load->view('site/show_past_events', $data);
	}
}