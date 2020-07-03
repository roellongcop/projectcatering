<?php

class PackageModel extends CI_Model 
{

	public function create(array $data)
	{
		createLog('Create new package '. $data['name'], 1);
		return $this->db->insert('t_packages', $data);
	}

	public function fetch($id = null)
	{
		$sql = 'SELECT p.*, e.name as event_name FROM t_packages as p
				JOIN t_events as e ON p.event_id = e.id
				WHERE p.is_available = ? ';

		$params = [1];

		if (! is_null($id)) {
			$sql .= ' AND p.id = ? ';
			array_push($params, $id);
		}

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function fetchWithTheme($id)
	{
		$sql = 'SELECT p.*, t.name as theme, t.description as theme_desc, t.image as theme_image FROM 
				t_packages as p JOIN t_themes as t ON p.theme_id = t.id 
				WHERE p.is_available = ? AND p.id = ?';

		$query = $this->db->query($sql, [1, $id]);

		return $query->result_array();
	}

	public function fetchByEventId($eventId)
	{
		$this->db->where('event_id', $eventId);
		$this->db->where('is_available', 1);
		$query = $this->db->get('t_packages');

		return $query->result_array();
	}

	public function update($id, array $data)
	{
		createLog('Updated package '. $data['name'], 1);
		$this->db->where('id', $id);
		return $this->db->update('t_packages', $data);
	}

	public function getPackageById($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('t_packages');

		return $query->result_array();
	}

	public function delete($id)
	{
		$pack = $this->getPackageById($id);
		createLog('Deleted package '. $pack[0]['name'], 1);
		$this->db->where('id', $id);

		return $this->db->update('t_packages', ['is_available' => 0]);
	}
}