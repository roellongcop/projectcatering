<?php

class BuildPackage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EventModel', 'event');
        $this->load->model('PackageModel', 'package');
        $this->load->model('FoodModel', 'food');
        $this->load->model('ItemsModel', 'item');
        $this->load->model('ThemeModel', 'theme');
	}

	public function index($eventId)
	{
		$data['active_page'] = 'build';
		$data['custom_page'] = 1;
        $data['header'] = $this->load->view('site/header', $data, true);
        $data['footer'] = $this->load->view('site/footer', '', true);

        $foods = $this->food->fetch();

        if (! empty($this->session->userdata('selected_foods'))) {
        	$selectedFoods = json_decode($this->session->userdata('selected_foods'), true);

        	foreach ($foods as $key => &$val) {
        		foreach ($selectedFoods as $selKey => &$sel) {
        			if ($val['id'] == $sel['id']) {
        				$sel['image'] = base_url() . json_decode($val['image'], true)['current_path'];
        				unset($foods[$key]);
        			}
        		}
        	}

        	$data['selected_foods'] = $selectedFoods;
        	$data['total_amount'] = $this->session->userdata('package_total');
        	$data['food_total'] =  $this->session->userdata('food_total');
        	// $data['item_total'] =  $this->session->userdata('item_total');
        	$data['theme_total'] =  $this->session->userdata('theme_total');
        }

        $themes = $this->theme->fetch();
        $items = $this->item->fetch();

        if (! empty($themes)) {
        	foreach ($themes as &$val) {
        		$val['image'] = json_decode($val['image'], true);
        	}
        }

        if (! empty($foods)) {
        	foreach ($foods as &$food) {
        		$food['image'] = json_decode($food['image'], true);
        	}
        }

        if (! empty($items)) {
        	foreach ($items as &$item) {
        		$item['image'] = json_decode($item['image'], true);
        	}
        }

        $data['themes'] = $themes;
        $data['foods'] = $foods;
        $data['categories'] = $this->item->fetchCategories();
        $data['food_categories'] = $this->food->fetchCategories();
        $data['items'] = $items;

        // $categorizedItems = $this->groupItemByCategory($items);        
        $this->load->view('site/build', $data);
	}

	public function buildGetItemsByCat($catId)
	{
        $catId = trim($catId);
		$result = $this->item->fetchItemByCatId($catId);

		if (! empty($result)) {
			foreach ($result as &$res) {
				$res['image'] = json_decode($res['image'], true);
			}
 		}

 		$data['items'] = $result;

 		echo $this->load->view('site/items', $data, true);

	}

    public function buildGetFoodByCat($catId)
    {
        $result = $this->food->fetchFoodByCatId($catId);

        if (! empty($result)) {
            foreach ($result as &$res) {
                $res['image'] = json_decode($res['image'], true);
            }
        }

        $data['foods'] = $result;

        echo $this->load->view('site/foods', $data, true);

    }

	public function groupItemByCategory($items)
	{
		$categories = $this->item->fetchCategories();

		$finalItems = [];

		foreach ($items as $key => $val) {
			foreach ($categories as $catKey => $cat) {
				if ($cat['name'] == $val['category']) {
					$finalItems[$cat['name']][] = $val;
				}
			}
		}

		return $finalItems;
	}
}