<?php

class About extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ContentModel', 'content');
	}

	public function index()
	{
		$data['active_page'] = 'about';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);

		$about = $this->content->getAbout();

		$data['about'] = ! empty($about) ? $about[0] : [];
		
		$this->load->view('site/about', $data);
	}
}