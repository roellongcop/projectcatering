<?php

//test
class AdminLogs extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ContentModel', 'content');
	}


	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}

		$data['active_page'] = 'logs';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);


		$this->load->view('dashboard/contents/logs', $data);
	}

	public function getLogs()
	{
		$logs = $this->content->getLogs();

		foreach ($logs as $key => &$val) {
			$val['date_time'] = (new DateTime($val['date_time'], new DateTimeZone('Asia/Manila')))->format('F j, Y (h:i A)');
		}

		$logs = ['data' => $logs];

		echo json_encode($logs);
	}


}