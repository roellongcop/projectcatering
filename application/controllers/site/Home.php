<?php

class Home extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReservationModel', 'reservation');	
		$this->load->model('PackageModel', 'package');
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		$data['active_page'] = 'home';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);

		$packages = $this->package->fetch();
		$events = $this->event->fetch();
		
		foreach ($events as &$event) {
			$event['image'] = json_decode($event['image'], true);
		}
		
		$this->decodeColumns($packages);

		$pastEvents = $this->event->fetchFeaturedEvents();

		if (! empty($pastEvents)) {
			foreach ($pastEvents as &$ev) {
				$ev['image'] = json_decode($ev['image'], true);
			}
		}

		$data['packages'] = $this->groupPackages($packages, $events);
		$data['events'] = $events;
		$data['up_coming_res'] = $this->reservation->getUpComingReservations();
		$data['past_events'] = $pastEvents;

		$this->load->view('site/home', $data);
	}

	public function getPackagesByEventId($eventId) 
	{
		$result = $this->package->fetchByEventId($eventId);

		$this->decodeColumns($result);
		$data['packages'] = $result;

		echo $this->load->view('site/packages/packages_view', $data, true);
	}

	public function decodeColumns(&$records)
	{
		foreach ($records as &$record) {
			$record['items'] = json_decode($record['items'], true);
			$record['image'] = json_decode($record['image'], true);
			$record['price'] = number_format($record['price'], 2);
		}
	}


	public function getPackageById($id) 
	{
		$result = $this->package->fetch($id);
		
		if (! empty($result)) {
			$result[0]['items'] = json_decode($result[0]['items'], true);
			$result[0]['image'] = json_decode($result[0]['image'], true);
			$result[0]['price'] = number_format($result[0]['price'], 2);

			$data['package'] = $result[0];
			
			echo $this->load->view('site/packages/package_modal', $data, true);

		}
	}		

	public function groupPackages($packages, $events)
	{
		$groupedPackages = [];

		foreach ($packages as $package) {

			foreach ($events as $event) {

				if ($event['id'] == $package['event_id']) {
					$groupedPackages[$event['name']][] = $package;
				}
			}
		}

		return $groupedPackages;

	}

	public function getReservedDates()
	{
		$reservedDates = $this->reservation->getReservedDates();

		// doing this because pickadate.js is 0 indexed
		foreach ($reservedDates as &$date) {
			$dateTime = new DateTime($date['date_of_event']);
			$date['date_of_event'] = $dateTime->modify('- 1month')->format('Y,n,j');
		}

		echo json_encode($this->formatReservedDates($reservedDates));
	}

	private function formatReservedDates($dates)
	{
		$unavailable_dates = [];

		foreach ($dates as $date) {
			array_push($unavailable_dates, $date['date_of_event']);
		}

		return $unavailable_dates;
	}

	public function showPastEventModal($id)
	{
		$past = $this->event->fetchPastEvents($id);

		if (! empty($past)) {
			$past[0]['image'] = json_decode($past[0]['image'], true);
		}

		$data['event'] = $past[0];

		echo $this->load->view('site/past_event', $data, true);
	}
}