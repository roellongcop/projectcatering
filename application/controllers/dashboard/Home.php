<?php

/**
* 
*/
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ReportsModel', 'report');
		$this->load->model('ReservationModel', 'reservation');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'home';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['total_packages'] = $this->report->countPackages();
		$data['total_reservations'] = $this->report->countReservations();
		$data['total_items'] = $this->report->countItems();

		$nextWeekEvents = $this->reservation->selectNextWeekEvents();
		$data['count_next_week_events'] = count($nextWeekEvents);
		$data['next_week_events'] = $nextWeekEvents;

		$eventToday = $this->reservation->getEventToday();

		$todayEvent = [];

		if (! empty($eventToday)) 
		{
			$todayEvent = json_decode($eventToday[0]['package_items'], true);
			$eventToday[0]['package_items'] = $todayEvent;
		}

		$data['event_today'] = empty($eventToday) ? null : $eventToday[0];

		$this->load->view('dashboard/home', $data);
	}

	public function login()
	{
		$this->load->view('dashboard/login');
	}

	public function logout()
	{
		createLog('Admin Logout', 1);
		$this->session->unset_userdata('user');

		redirect('dashboard/login');
	}

	public function checkLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$login = $this->report->checkLogin($username, $password);
		
		if (! empty($login)) 
		{ // successful login
			$this->session->set_userdata('user', $login[0]);
			createLog('Admin Login', 1);
			echo json_encode(['status' => 'success']);
		} 
		else 
		{
			createLog('Invalid Login Attempt', 1);
			echo json_encode(['status' => 'failed']);
		}
	}

	public function getMonthlyReservations($year, $month) 
	{
		$data = $this->report->getMonthlyReservations($year, $month);

		$months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

		$withData = [];
		$blankData = [];

		for ($x = 1; $x <= count($months); $x++) {
			$key = array_search($x, array_column($data, 'month'));

			if ($key === false) {
				array_push($blankData, [
					'month' => $x,
					'res_count' => 0
				]);
			} else {
				array_push($withData, [
					'month' => $data[$key]['month'],
					'res_count' => $data[$key]['res_count']
				]);
			}
		}

		$data = array_merge($withData, $blankData);

		usort($data, function($a, $b) {
		    return $a['month'] - $b['month'];
		});
		
		echo json_encode($data);
	}

	public function getMonthlySales($year, $month) 
	{
		$data = $this->report->getMonthlySales($year, $month);

		$months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

		$withData = [];
		$blankData = [];

		for ($x = 1; $x <= count($months); $x++) {
			$key = array_search($x, array_column($data, 'month'));

			if ($key === false) {
				array_push($blankData, [
					'month' => $x,
					'total' => 0
				]);
			} else {
				array_push($withData, [
					'month' => $data[$key]['month'],
					'total' => $data[$key]['total']
				]);
			}
		}

		$data = array_merge($withData, $blankData);

		usort($data, function($a, $b) {
		    return $a['month'] - $b['month'];
		});
		
		echo json_encode($data);
	}
}