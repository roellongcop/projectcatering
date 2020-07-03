<?php

class ItemsModel extends CI_Model
{


	public function fetchCategories()
	{
		$query = $this->db->get('t_item_categories');

		return $query->result_array();
	}

	public function create(array $data)
	{
		createLog('Create new item '. $data['item_name'], 1);
		return $this->db->insert('t_items', $data);
	}

	public function fetchItemByCatId($catId)
	{
		$this->db->where('category_id', $catId);

		$query = $this->db->get('t_items');

		return $query->result_array();
	}


	public function fetch($itemId = null)
	{
		$sql = 'SELECT item.id as id, item.item_name as name, item.price, item.quantity, item.category_id, item.image as image, cat.name as category FROM t_items as item,
				t_item_categories as cat WHERE item.category_id = cat.id';
		$params = [];

		if (! is_null($itemId)) {
			$sql .= ' AND item.id = ?';
			array_push($params, $itemId);
		}

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function getForReport()
	{
		$sql = 'SELECT cat.name as category, item.item_name as name, item.price, item.quantity, 
				item.date_modified FROM t_items as item,
				t_item_categories as cat WHERE item.category_id = cat.id
				ORDER BY category ASC';

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getItemsInventory(array $ids)
	{
		$this->db->where_in('id', $ids);

		$query = $this->db->get('t_items');

		return $query->result_array();
	}

	public function updateItemsInventory(array $data)
	{
		return $this->db->update_batch('t_items', $data, 'id');
	}

	public function update($id, array $data)
	{
		createLog('Updated item '. $data['item_name'], 1);
		$this->db->where('id', $id);
		return $this->db->update('t_items', $data);
	}

	public function getItemsAvailability($dateToday)
	{	
		$sql = 'SELECT a.*, i.item_name FROM t_availability as a, t_items as i
				WHERE a.item_id = i.id AND date = ? AND is_completed != ?';

		$query = $this->db->query($sql, [$dateToday, 1]);

		return $query->result_array();
	}

	public function markAsComplete($availabilityDate)
	{
		$this->db->where('date', $availabilityDate);

		$result = $this->db->update('t_availability', ['is_completed' => 1]);

		return $result;
	}

	public function delete($id) 
	{	
		$itemname = $this->getItemById($id);
		createLog('Deleted item '. $itemname[0]['item_name'], 1);
		$this->db->where('id', $id);
		return $this->db->delete('t_items');
	}

	private function getItemById($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('t_items');

		return $query->result_array();
	}

	private function getItemCategory($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('t_item_categories');

		return $query->result_array();
	}

	public function createCategory(array $data)
	{
		createLog('Create new item category '. $data['name'], 1);
		return $this->db->insert('t_item_categories', $data);
	}

	public function deleteCategory($id)
	{
		$itemcat = $this->getItemCategory($id);
		createLog('Deleted item category '. $itemcat[0]['name'], 1);
		$this->db->where('id', $id);
		return $this->db->delete('t_item_categories');
	}

}