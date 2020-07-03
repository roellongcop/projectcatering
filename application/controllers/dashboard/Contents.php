<?php

class Contents extends CI_Controller
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

		$data['active_page'] = 'contents';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$terms = $this->content->fetchTerms();
		$about = $this->content->getAbout();

		$data['terms'] = $terms;
		$data['about'] = ! empty($about) ? $about[0] : [];

		$this->load->view('dashboard/contents/index', $data);
	}

	public function saveAbout()
	{
		$about = $this->content->getAbout();
		if (empty($about)) {
			$result = $this->content->createAbout($this->input->post());
		} else {
			$result = $this->content->updateAbout($about[0]['id'], $this->input->post());
		}
		

		echo $result;
	}

	public function saveTerm()
	{
		$result = $this->content->createTerm($this->input->post());

		echo $result;
	}

	public function updateTerm($id)
	{
		$result = $this->content->updateTerm($id, $this->input->post());

		echo $result;
	}

	public function deleteTerm($id)
	{
		echo $this->content->deleteTerm($id);
	}

	public function getSingleTerm($id)
	{
		$result = $this->content->fetchTerms($id);

		echo json_encode($result[0]);
	}
}