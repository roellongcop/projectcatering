<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;


class Events extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$events = $this->event->fetch();
		$data['events'] = $this->decodeImages($events);


		$this->load->view('dashboard/events/index', $data);
	}

	public function view($id)
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$events = $this->event->fetch($id);

		if (! empty($events)) {
			$events[0]['image'] = json_decode($events[0]['image'], true);
		}

		$data['event'] = $events[0];

		$this->load->view('dashboard/events/view', $data);
	}


	public function create()
	{
		$data['active_page'] = 'events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->load->view('dashboard/events/create', $data);
	}

	public function decodeImages($records)
	{
		foreach ($records as &$record) {
			$record['image'] = json_decode($record['image'], true);
		}

		return $records;
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
        $config['min_width']            = 1920;
        $config['min_height']           = 1200;

        $this->load->library('upload', $config);

       	if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	@$image = new ImageResize($upload_data['full_path']);
        	@$image->resize(1920, 1200);
			@$image->save($upload_data['full_path']);

       		$themeImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('event_image', $themeImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors(); 
        }
	}

	public function update($id)
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('event_image');
	
		$data = [
			'name' => $post['name'],
			'description' => $post['description'],
		];

		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $post['name']);
			$data['image'] = json_encode($eventImage);
		} 

		$save = $this->event->update($id, $data);

		$this->session->unset_userdata('event_image');


		echo $save;
	}

	// soft delete only
	public function delete($id)
	{
		$post = $this->input->post();

		$result = $this->event->update($id, $post);

		echo $result;
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('event_image');

		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $post['name']);
		} 

		$save = $this->event->create([
			'name' => $post['name'],
			'description' => $post['description'],
			'image' => json_encode($eventImage)
		]);

		$this->session->unset_userdata('event_image');

		echo $save;
	}

	private function moveImage($uploadedImage, $eventName) 
	{
		$eventName = strtolower($eventName);
		$eventName = str_replace(' ', '_', $eventName);

		$images_dir = "./event_images/$eventName/";
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