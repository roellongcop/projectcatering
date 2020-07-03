<?php

class VenueModel extends CI_Model
{
	
	public function create($data)
	{
		createLog('Create new venue '. $data['name'], 1);
		return $this->db->insert('t_venues', $data);
	}

	public function fetch($id = null)
	{

		if (! is_null($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db->get('t_venues');

		return $query->result_array();
	}

	public function update($id, array $data)
	{
		createLog('Updated venue '. $data['name'], 1);
		$this->db->where('id', $id);

		return $this->db->update('t_venues', $data);
	}

	private function getVenueById($id)
	{
		$this->db->where('id', $id);

		$query = $this->db->get('t_venues');

		return $query->result_array();
	}

	public function delete($id)
	{
		$ven = $this->getVenueById($id);
		createLog('Deleted venue '. $ven[0]['name'], 1);
		$this->db->where('id', $id);

		return $this->db->delete('t_venues');
	}
}