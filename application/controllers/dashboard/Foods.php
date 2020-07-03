<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;

class Foods extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('FoodModel', 'food');
		$this->load->model('EventModel', 'event');
		$this->load->model('PackageModel', 'package');
	}

	public function index()
	{
		$data['active_page'] = 'foods';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['foods'] = $this->food->fetch();
		$data['categories'] = $this->food->fetchCategories();

		$this->load->view('dashboard/foods/index', $data);
	}

	public function createCategory()
	{
		$name = $this->input->post('food_category');

		echo $this->food->insertFoodCategory(['category' => $name]);
	}

	public function deleteFoodCategory($id)
	{
		echo $this->food->deleteFoodCategory($id);
	}

	public function create()
	{
		$data['active_page'] = 'foods';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$data['events'] = $this->event->fetch();
		$data['categories'] = $this->food->fetchCategories();

		$this->load->view('dashboard/foods/create', $data);
	}

	public function getFoods()
	{
		$foods = $this->food->fetch();
		
		foreach ($foods as $key => &$val) {

			$image = json_decode($val['image'], true);
			$currentPath = base_url() . $image['current_path'];

			$button = ' <span class="delete btnInactiveFood" data-id="'.$val['id'].'"><i class="fa fa-trash"></i> ARCHIVE </span>';

			$val['price'] = 'PHP ' . number_format($val['price'], 2);
			$val['info_button'] = '<span class="info updateFoodBtn" data-id="'.$val['id'].'"> <i class="fa fa-pencil" aria-hidden="true"></i> UPDATE </span>&nbsp;' . $button;
		}

		$foods = ['data' => $foods];

		echo json_encode($foods);
	}

	public function update($id)
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('food_image');
	
		$data = [
			'name' => $post['name'],
			'description' => $post['description'],
			'price'	=> $post['price']
		];

		if (! empty($uploadedImage)) {
			$eventImage = $this->moveImage($uploadedImage, $post['name']);
			$data['image'] = json_encode($eventImage);
		} 

		$save = $this->food->update($id, $data);

		$this->session->unset_userdata('food_image');


		echo $save;
	}

	public function view($id)
	{
		$data['active_page'] = 'foods';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$food = $this->food->fetch($id);

		if (! empty($food)) {
			$food[0]['image'] = json_decode($food[0]['image'], true);
		}

		$data['food'] = $food[0];

		$this->load->view('dashboard/foods/view', $data);
	}

	//delete talaga
	public function changeStatus($id)
	{
		$superFood = $this->food->fetch($id);
		$packages = $this->package->fetch();

		foreach ($packages as $key => $val) {
			$decodedFoods = json_decode($val['foods'], true);
			$ids = array_column($decodedFoods, 'id');

			$needle = in_array($superFood[0]['id'], $ids);
		}

		if ($needle === true) {
			echo json_encode(['success' => 0, 'error_message' => 'Food is in one the packages. Remove first before deleting.']);
		} else {
			$result = $this->food->deleteFood($id);

			if ($result) {
				echo json_encode(['success' => 1]);	
			} else {
				echo json_encode(['success' => 0, 'error_message' => 'An error occured. Please try again.']);
			}
		}
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {

        	$upload_data = $this->upload->data();

        	@$image = new ImageResize($upload_data['full_path']);
       		@$image->resize(300, 200);
			@$image->save($upload_data['full_path']);

       		$themeImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('food_image', $themeImage);

       		echo 1;

        } else {
        	echo $this->upload->display_errors();
        }
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('food_image');

		if (! empty($uploadedImage)) {
			$foodImage = $this->moveImage($uploadedImage, $post['name']);
		}

		$result = $this->food->create([
			'category_id' => $post['category'],
			'name' => $post['name'],
			'description' => $post['description'],
			'price' => $post['price'],
			'image' => json_encode($foodImage)
		]);

		echo $result;

	}

	private function moveImage($uploadedImage, $name) 
	{
		$name = strtolower($name);
		$name = str_replace(' ', '_', $name);

		$images_dir = "./food_images/$name/";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($name . '_' . time() . $uploadedImage['ext']);
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