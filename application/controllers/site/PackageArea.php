<?php

class PackageArea extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PackageModel', 'package');
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		$data['active_page'] = 'packages_area';
        $data['header'] = $this->load->view('site/header', $data, true);
        $data['footer'] = $this->load->view('site/footer', '', true);

        $packages = $this->package->fetch();
        $events = $this->event->fetch();

        $grouped = [];
        if (! empty($packages) && (! empty($events))) {
        	foreach ($events as $eventKey => $event) {
        		foreach ($packages as $pKey => $package) {
        			if ($event['id'] == $package['event_id']) {
        				$package['image'] = json_decode($package['image'], true);
        				$grouped[$event['name']]['packages'][] = $package;			
        			}
	        	}
        	}
        }

        foreach ($events as $eKey => $val) {
        	foreach ($grouped as $key => &$gr) {
        		if (strtolower($val['name']) === strtolower($key)) {
        			$grouped[$key]['event_details'] = [
        				'event_image' => json_decode($val['image'], true),
        				'event_name' => $val['name'],
        				'description' => $val['description'],
        				'event_id' => $val['id']
        			];
        		}
	        }	
        }

        $data['event_packages'] = $grouped;

        $this->load->view('site/packages_area', $data);
	}
}