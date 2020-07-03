<?php

class CustomizedPackage extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ItemsModel', 'item');
	}

	public function index($date)
	{
		$data['active_page'] = 'custom';
		$data['header'] = $this->load->view('site/header', $data, true);
		$data['footer'] = $this->load->view('site/footer', '', true);

		$categories = $this->item->fetchCategories();
		$itemsSession = (! is_null($this->session->userdata('selected_items'))) ? $this->session->userdata('selected_items') : null;

		$items = $this->item->fetch();
		$data['cart_items'] = false;
		$data['cart_total'] = 0;
		if (! empty($itemsSession)) {
			
			$data['cart_items'] = $this->computeTotalPerItem($itemsSession);
			$data['cart_count'] = count($itemsSession);
			$data['cart_total'] = $this->session->userdata('items_total');

			$currentTotal = $this->session->userdata('items_total');

		}

		$data['categories'] = $categories;

		$this->session->set_userdata('custom_package_date', $date);
		
		$this->load->view('site/custom_package', $data);
	}

	public function getItemsByCategory($id)
	{
		$result = $this->item->fetchItemByCatId($id);

		$data['item'] = $result;
		
		echo $this->load->view('site/custom/custom_items', $data, true);
	}

	public function clearCart() 
	{
		$this->session->unset_userdata('selected_items');
		$this->session->unset_userdata('items_total');
	}

	public function computeTotalPerItem($items)
	{
		$total = 0;

		foreach ($items as &$item) {
			$item['sub_total'] = $item['quantity'] * $item['price'];
			$total += $item['sub_total'];
		}

		$this->session->set_userdata('items_total', $total);

		return $items;
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

	public function buildItems()
	{
		$post = $this->input->post();

		$selectedItems = (is_null($this->session->userdata('selected_items'))) ? [] : $this->session->userdata('selected_items');

		if (! empty($selectedItems)) {

			$withDuplicate = $this->withDuplicate($post, $selectedItems);

			if ($withDuplicate == true) { 
				echo json_encode(['success' => 0, 'msg' => 'This item is already in the cart.']);
			} else {
				array_push($selectedItems, $post);
				$this->session->set_userdata('selected_items', $selectedItems);

				echo json_encode(['success' => 1, 'msg' => 'Item successfully added']);
			}
		} else {
			array_push($selectedItems, $post);
			$this->session->set_userdata('selected_items', $selectedItems);
			echo json_encode(['success' => 1, 'msg' => 'Item successfully added']);
		}
	}

	public function withDuplicate($newItem, $selectedItems)
	{
		$val = array_search($newItem['item_id'], $selectedItems);
		$match = false;

		foreach ($selectedItems as $key => $val) {
			if ($val['item_id'] === $newItem['item_id']) {
				$match = true;
			}
		}

		return $match;
	}

	public function removeItem($removeId)
	{
		$items = $this->session->userdata('selected_items');

		foreach ($items as $key => $item) {
			if ($item['item_id'] == $removeId) {
				unset($items[$key]);
			}
		}
		array_values($items);

		// update session
		$this->session->set_userdata('selected_items', $items);
		
		echo json_encode(['success' => 1, 'msg' => 'Item successfully removed']);
	}
}