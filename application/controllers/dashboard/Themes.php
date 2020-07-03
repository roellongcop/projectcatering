<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;

class Themes extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ThemeModel', 'theme');
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		$data['active_page'] = 'themes';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['themes'] = $this->theme->fetch();

		$this->load->view('dashboard/themes/index', $data);
	}

	public function create()
	{
		$data['active_page'] = 'themes';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->load->view('dashboard/themes/create', $data);
	}

	public function update($id)
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('theme_image');
	
		$data = [
			'name' => $post['theme_name'],
			'description' => $post['description'],
			'price' => $post['price'],
		];

		if (! empty($uploadedImage)) {
			$themeImage = $this->moveImage($uploadedImage, $post['theme_name']);
			$data['image'] = json_encode($themeImage);
		} 

		$save = $this->theme->update($id, $data);

		$this->session->unset_userdata('theme_image');


		echo $save;
	}

	public function getThemes()
	{
		$themes = $this->theme->fetch();

		foreach ($themes as $key => &$val) {

			$image = json_decode($val['image'], true);
			$currentPath = base_url() . $image['current_path'];

			$button = ' <span class="delete btnInactiveTheme" data-id="'.$val['id'].'"><i class="fa fa-trash"></i> ARCHIVE </span>';
			$val['info_button'] = '<span class="info updateThemeBtn" data-id="'.$val['id'].'"> <i class="fa fa-pencil" aria-hidden="true"></i> UPDATE</span>&nbsp;' . $button;
		}

		$themes = ['data' => $themes];

		echo json_encode($themes);
	}

	public function changeStatus($id)
	{
		$post = $this->input->post();

		$result = $this->theme->update($id, $post);

		echo $result;	
	}

	public function view($id)
	{
		$data['active_page'] = 'themes';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['events'] = $this->event->fetch();

		$theme = $this->theme->fetch($id);

		if (! empty($theme)) {
			$theme[0]['image'] = json_decode($theme[0]['image'], true);
		}

		$data['theme'] = $theme[0];

		$this->load->view('dashboard/themes/view', $data);
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	$image = new ImageResize($upload_data['full_path']);
       		$image->resize(600, 480);
			$image->save($upload_data['full_path']);

       		$themeImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('theme_image', $themeImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors();
        }
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('theme_image');

		if (! empty($uploadedImage)) {
			$themeImage = $this->moveImage($uploadedImage, $post['theme_name']);
		}

		$result = $this->theme->create([
			'name' => $post['theme_name'],
			'description' => $post['theme_desc'],
			'price' => $post['theme_price'],
			'image' => json_encode($themeImage)
		]);

		echo $result;

	}

	private function moveImage($uploadedImage, $themeName) 
	{
		$themeName = strtolower($themeName);
		$themeName = str_replace(' ', '_', $themeName);

		$images_dir = "./theme_images/$themeName/";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($themeName . '_' . time() . $uploadedImage['ext']);
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