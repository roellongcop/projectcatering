<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;


class Venue extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('VenueModel', 'venue');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}

		$data['active_page'] = 'venues';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$venues = $this->venue->fetch();

		if (! empty($venues)) {
			foreach ($venues as &$ven) {
				$ven['image'] = json_decode($ven['image'], true);
			}
		}

		$data['venues'] = $venues;

		$this->load->view('dashboard/venues/index', $data);
	}

	public function create()
	{
		$data['active_page'] = 'venues';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->load->view('dashboard/venues/create', $data);
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('venue_image');

		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $post['name']);
		} 

		$save = $this->venue->create([
			'name' => $post['name'],
			'description' => $post['description'],
			'image' => json_encode($eventImage)
		]);

		$this->session->unset_userdata('venue_image');

		echo $save;
	}

	public function fetchSingle($id)
	{
		$result = $this->venue->fetch($id);

		if (! empty($result)) {
			$result[0]['image'] = json_decode($result[0]['image'], true);
		}

		echo json_encode($result[0]);
	}

	public function update($id)
	{
		$data = $this->input->post();
		$uploadedImage = $this->session->userdata('venue_image');
	
		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $data['name']);
			$data['image'] = json_encode($eventImage);
		} 
		
		$result = $this->venue->update($id, $data);

		$this->session->unset_userdata('venue_image');

		echo json_encode($result);
	}

	public function delete($id)
	{
		echo $this->venue->delete($id);
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
        $config['min_width']            = 600;
        $config['min_height']           = 450;

        $this->load->library('upload', $config);

       	if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	@$image = new ImageResize($upload_data['full_path']);
        	@$image->resize(600, 450);
			@$image->save($upload_data['full_path']);

       		$themeImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('venue_image', $themeImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors(); 
        }
	}

	private function moveImage($uploadedImage, $eventName) 
	{
		$eventName = strtolower($eventName);
		$eventName = str_replace(' ', '_', $eventName);

		$images_dir = "./venue_images/";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($eventName . '_' . time() . $uploadedImage['ext']);
		$image_name = str_replace('', '_', $image_name);

		$full_temp_path = $uploadedImage['full_path'];

		$transfer = rename($full_temp_path, "$images_dir/$image_name");

		if ($transfer)  {
			return [
				'current_path' => $images_dir.$image_name,
				'image_name' => $image_name
			];
		}
		else {
			return false;
		}

	}
}