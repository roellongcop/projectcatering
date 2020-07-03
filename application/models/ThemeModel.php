<?php

class ThemeModel extends CI_Model
{
	
	public function create(array $data)
	{
		createLog('Create new theme '. $data['name'], 1);
		return $this->db->insert('t_themes', $data);
	}

	public function fetch($id = null)
	{
		if (! is_null($id)) {
			$this->db->where('id', $id);
		}
		$this->db->where('is_available', 1);

		$query = $this->db->get('t_themes');

		return $query->result_array();
	}

	public function fetchByEvent($eventId)
	{
		$query = $this->db->get('t_themes');

		return $query->result_array();
	}

	public function update($id, $data)
	{
		createLog('Updated theme '. $data['name'], 1);
		$this->db->where('id', $id);
		
		return $this->db->update('t_themes', $data);
	}
}