<?php

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel', 'user');
	}

	public function create() // registration page
	{
		$data['active_page'] = 'registration';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);		

		$this->load->view('site/registration', $data);
	}

	public function store()
	{
		$post = $this->input->post();

		$result = $this->user->create([
			'full_name' => $post['full_name'],
			'contact_no' => $post['contact_no'],
			'email_address' => $post['email_address'],
			'address' => $post['address'],
			'username' => $post['register_username'],
			'full_name' => $post['full_name'],
			'password' => md5($post['register_password'])
		]);

		// returned user_id
		if ($result) {

			$userRecord = $this->user->fetch($result, 'id, full_name, contact_no, email_address, username, address');
			$this->session->set_userdata('user', $userRecord);

			echo json_encode(['success' => true, 'message' => $userRecord]);
			
		} else {
			echo json_encode(['success' => false, 'message' => 'Error occured']);
		}
	}

	public function processLogin()
	{
		$post = $this->input->post();

		$result = $this->user->checkLogin($post['username'], $post['password']);

		if (empty($result)) { // failed
			echo json_encode(['success' => false, 'message' => 'Invalid user/password']);
		} else {
			$this->session->set_userdata('user', $result[0]);
			echo json_encode(['success' => true, 'message' => $result[0]]);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');

		redirect('/catering/home');
	}

}