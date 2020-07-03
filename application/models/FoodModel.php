<?php

class FoodModel extends CI_Model
{
	
	public function create(array $data)
	{
		createLog('Create new food '. $data['name'], 1);
		return $this->db->insert('t_foods', $data);
	}

	public function fetchCategories()
	{
		$query = $this->db->get('food_category');

		return $query->result_array();
	}

	public function fetchFoodByCatId($catId)
	{
		$this->db->where('category_id', $catId);
		$this->db->where('is_available', 1);

		$query = $this->db->get('t_foods');

		return $query->result_array();
	}

	public function insertFoodCategory(array $data)
	{
		createLog('Create new food category '. $data['category'], 1);
		return $this->db->insert('food_category', $data);
	}

	public function deleteFood($id)
	{
		$foodname = $this->getFoodName($id);

		createLog('Delete food '. $foodname[0]['name'], 1);
		$this->db->where('id', $id);

		return $this->db->delete('t_foods');
	}

	private function getFoodName($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('t_foods');

		return $query->result_array();
	}

	private function getFoodCategory($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('food_category');

		return $query->result_array();
	}

	public function deleteFoodCategory($id)
	{
		$foodcat = $this->getFoodCategory($id);
		createLog('Delete food category '. $foodcat[0]['category'], 1);
		$this->db->where('id', $id);

		return $this->db->delete('food_category');
	}

	public function fetch($id = null)
	{
		$sql = 'SELECT f.*, c.category FROM t_foods f JOIN food_category c ON f.category_id = c.id 
				WHERE f.is_available = ? ';
		$params = [1];

		if (! is_null($id)) {
			$sql.= 'AND f.id = ?';
			array_push($params, $id);
		}

		$sql .= ' ORDER BY c.category ASC';

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function update($id, $data)
	{
		createLog('Updated food '. $data['name'], 1);
		$this->db->where('id', $id);
		
		return $this->db->update('t_foods', $data);
	}
}