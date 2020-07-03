<?php

include_once APPPATH. 'libraries/ImageResize.php';

use \Eventviva\ImageResize;


class Packages extends CI_Controller 
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('EventModel', 'event');
		$this->load->model('ItemsModel', 'item');
		$this->load->model('FoodModel', 'food');
		$this->load->model('ThemeModel', 'theme');
		$this->load->model('PackageModel', 'package');
	}

	public function index()
	{
		if (empty($this->session->userdata('user'))) {
			redirect('/dashboard/login');
		}
		$data['active_page'] = 'packages';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$packages = $this->package->fetch();
		$data['packages'] = $this->decodeJSONColumns($packages);

		$this->load->view('dashboard/packages/index', $data);
	}

	public function getPackages() 
	{
		$packages = $this->package->fetch();
		$packages = $this->decodeJSONColumns($packages);

		foreach ($packages as $key => &$val) {
			$val['price'] = 'PHP ' . number_format($val['price'], 2);
			$val['info_button'] = '<span class="packageMoreInfo info" data-id="'.$val['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i> UPDATE </span> &nbsp;<span class="delete btnDeletePackage" data-id="'.$val['id'].'"> <i class="fa fa-trash" aria-hidden="true"></i> ARCHIVE</span>';
		}
		
		$packages = ['data' => $packages];

		echo json_encode($packages);
	}

	public function view($packageId)
	{
		$data['active_page'] = 'packages';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);
		$this->session->unset_userdata('package_image');

		$packages = $this->package->fetch($packageId);
		$package = $this->decodeJSONColumns($packages)[0];
		$themesByEvent = $this->theme->fetch();

		$items = $this->item->fetch();

		$categories = $this->item->fetchCategories();
		$items = $this->groupItems($items, $categories);

		$package_items = $this->groupPackageItems($package['items'], $categories);

		foreach ($items as $key => &$item) {
			foreach ($item as $key1 => $val) {
				foreach ($package_items as $key => $packageItem) {
					foreach ($packageItem as $key2 => $pack) {
						if ($val['id'] == $pack['id']) {
							$package_items[$key][$key2]['maxqty'] = $val['quantity'];
							unset($items[$key][$key1]);
						}
					}
				}
			}
		}

		$package['items'] = $package_items;

		$foods = $this->food->fetch();
		$packageFoods = [];

		foreach ($foods as $keyfood => $food) {
			foreach ($package['foods'] as $packFoodKey => &$packFood) {
				if ($food['id'] == $packFood['id']) {
					unset($foods[$packFoodKey]);
				}
			}
		}

		$data['events'] = $this->event->fetch();
		$data['package'] = $package;
		$data['items'] = $items;
		$data['foods'] = $foods;
		$data['themes'] = $themesByEvent;

		$this->load->view('dashboard/packages/view', $data);
	}

	public function getEventName($eventId)
	{
		return $this->event->getEventName($eventId);
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 3000;
        $config['min_width']            = 650;
        $config['min_height']           = 500;

        $this->load->library('upload', $config);

       	if (! $this->upload->do_upload('file')) {

       		echo $this->upload->display_errors();
       	} 
       	else {

       		$upload_data = $this->upload->data();
       		       		
       		@$image = new ImageResize($upload_data['full_path']);
       		@$image->resize(650, 480);
			@$image->save($upload_data['full_path']);

       		$packageImage = [
       			'file_name' => $upload_data['file_name'],
       			'full_path' => $upload_data['full_path'],
       			'ext'		=> $upload_data['file_ext'],
       			'raw_name' 	=> $upload_data['raw_name']
       		];

       		$this->session->set_userdata('package_image', $packageImage);

       		echo 1;
       	}
	}

	private function moveImage($uploadedImage, $packageName) 
	{
		$packageName = strtolower($packageName);
		$packageName = str_replace(' ', '_', $packageName);

		$images_dir = "./package_img/";
		$uploads_dir = './uploads/';
		
		if (!is_dir($images_dir)) {
			mkdir($images_dir, 0777, TRUE);
		}

		$image_name = strtolower($packageName . '_' . time() . $uploadedImage['ext']);
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

	public function decodeJSONColumns($records)
	{
		foreach ($records as &$record) {
			$record['items'] = json_decode($record['items'], true);
			$record['foods'] = json_decode($record['foods'], true);
			$record['event_type'] = $this->getEventName($record['event_id']);
			$record['image'] = json_decode($record['image'], true);
		}

		return $records;
	}

	public function create()
	{
		$data['active_page'] = 'packages';
		$data['admin_header'] = $this->load->view('dashboard/admin_header', $data, true);
		$data['admin_footer'] = $this->load->view('dashboard/admin_footer', '', true);

		$this->session->unset_userdata('package_image');

		$data['events'] = $this->event->fetch();

		$data['foods'] = $this->food->fetch();
		$items = $this->item->fetch();

		$categories = $this->item->fetchCategories();

		$data['themes'] = $result = $this->theme->fetch();
		$data['items'] = $this->groupItems($items, $categories);
		
		$this->load->view('dashboard/packages/create', $data);
	}

	public function fetchThemesByEvent($eventId)
	{
		$result = $this->theme->fetchByEvent($eventId);

		echo json_encode($result);
	}

	public function groupItems($items, $categories)
	{
		$groupedItems = [];

		foreach ($items as $item) {

			foreach ($categories as $cat) {

				if ($cat['id'] == $item['category_id']) {
					$groupedItems[$cat['name']][] = $item;
				}
			}
		}

		return $groupedItems;
	}

	public function groupPackageItems($items, $categories)
	{
		$groupedItems = [];

		foreach ($items as $item) {

			foreach ($categories as $cat) {

				if ($cat['name'] == $item['category']) {
					$groupedItems[$cat['name']][] = $item;
				}
			}
		}

		return $groupedItems;
	}

	public function store()
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('package_image');

		if (! empty($uploadedImage)) {
			$packageImage = $this->moveImage($uploadedImage, $post['package_name']);
		}

		$result = $this->package->create([
			'event_id' 		=> $post['event_id'],
			'name' 			=> $post['package_name'],
			'pax'			=> $post['pax'],
			'staff_needed'	=> $post['staff_needed'],
			'description' 	=> $post['description'],
			'items' 		=> $post['items'],
			'foods'			=> $post['foods'],
			'price' 		=> $post['price'],
			'theme_id'		=> $post['theme_id'],
			'image'			=> json_encode($packageImage),
			'is_available' 	=> 1
		]);

		echo $result;
	}

	public function update($id)
	{
		$post = $this->input->post();
		$uploadedImage = $this->session->userdata('package_image');
	
		if (! empty($uploadedImage)) {
			$packageImage = $this->moveImage($uploadedImage, $post['name']);
			$post['image'] = json_encode($packageImage);
		} 

		$save = $this->package->update($id, $post);

		$this->session->unset_userdata('package_image');

		echo $save;
	}

	public function delete($packageId)
	{
		$result = $this->package->delete($packageId);

		echo $result;
	}
}