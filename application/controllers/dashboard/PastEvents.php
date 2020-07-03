<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;


class PastEvents extends CI_Controller
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
		$data['active_page'] = 'past-events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$pastEvents = $this->event->fetchPastEvents();
		$featured = [];


		if (! empty($pastEvents)) {
			foreach ($pastEvents as $key => &$val) {
				if ($val['is_featured'] == 1) {
					array_push($featured, $pastEvents[$key]);
					unset($pastEvents[$key]);
				}
			}		
		}


		$final = array_values(array_merge($featured, $pastEvents));
		
		$data['past_events'] = $this->decodeImages($final);

		$this->load->view('dashboard/past_events/index', $data);
	}

	public function create()
	{
		$data['active_page'] = 'past-events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->load->view('dashboard/past_events/create', $data);
	}

	public function view($id)
	{
		$data['active_page'] = 'past-events';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$past = $this->event->fetchPastEvents($id);

		if (! empty($past)) {
			$past[0]['image'] = json_decode($past[0]['image'], true);
		}

		$data['past_event'] = $past[0];

		$this->load->view('dashboard/past_events/view', $data);
	}

	public function decodeImages($records)
	{
		foreach ($records as &$record) {
			$record['image'] = json_decode($record['image'], true);
		}

		return $records;
	}

	public function uploadUpdate()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['min_width']            = 600;
        $config['min_height']           = 450;

        $this->load->library('upload', $config);

       	if (! $this->upload->do_upload('file')) {

       		echo json_encode(['error' => 1, 'error_message' => $this->upload->display_errors()]);
       	} 
       	else {

       		$upload_data = $this->upload->data();
       		       		
       		$image = new ImageResize($upload_data['full_path']);
       		$image->resize(600, 450);
			$image->save($upload_data['full_path']);

       		$eventImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('past_image_update', $eventImage);

       		echo json_encode(['error' => 0, 'image_name' => $upload_data['file_name']]);
       	}
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 1000;
        $config['min_width']            = 600;
        $config['min_height']           = 450;

        $this->load->library('upload', $config);

       	if (! $this->upload->do_upload('file')) {

       		echo json_encode(['error' => 1, 'error_message' => $this->upload->display_errors()]);
       	} 
       	else {

       		$upload_data = $this->upload->data();
       		       		
       		$image = new ImageResize($upload_data['full_path']);
       		$image->resize(600, 450);
			$image->save($upload_data['full_path']);

       		$eventImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('past_event_image', $eventImage);

       		echo json_encode(['error' => 0, 'image_name' => $upload_data['file_name']]);
       	}
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('past_event_image');

		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $post['title']);
		} else {
			throw new Exception("Image not found", 1);
		}

		$save = $this->event->savePastEvent([
			'title' => $post['title'],
			'description' => $post['description'],
			'image' => json_encode($eventImage),
			'additional_desc' => $post['additional_desc'],
			'is_featured' => $post['is_featured']
		]);

		$this->session->unset_userdata('past_event_image');

		$this->session->set_flashdata('create_past_event', 'Successfully created new record '. $post['title']);

		redirect(site_url('/past-events'));
	}

	public function update($id)
	{
		$post = $this->input->post();

		$uploadedImage = $this->session->userdata('past_image_update');

		$data = [
			'title' => $post['title'],
			'description' => $post['description'],
			'additional_desc' => $post['additional_desc']
		];

		if (! empty($uploadedImage)) {
			$pastImage = $this->moveImage($uploadedImage, $post['title']);	
			$data['image'] = json_encode($pastImage);
		}

		$save = $this->event->updatePastEvent($data, $id);

		$this->session->unset_userdata('past_image_update');

		$this->session->set_flashdata('update_past_event', 'Successfully update '. $post['title']);
 
		echo $save;

	}

	public function updateFeatured()
	{
		$post = $this->input->post();

		$count = $this->event->countFeaturedEvents();

		if ($post['is_featured'] == 1) {
			if ($count >= 3) {
				echo json_encode(['success' => 0, 'error_message' => 'The limit for featured events is 3']);
			} else {
				$this->event->updatePastEvent(['is_featured' => $post['is_featured']], $post['id']);
				echo json_encode(['success' => 1]);
			}
		} else {
			$this->event->updatePastEvent(['is_featured' => 0], $post['id']);
			echo json_encode(['success' => 1]);
		}
		
	}

	private function moveImage($uploadedImage, $eventName) 
	{
		$eventName = strtolower($eventName);
		$eventName = str_replace(' ', '_', $eventName);

		$images_dir = "./past_event_images/$eventName/";
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