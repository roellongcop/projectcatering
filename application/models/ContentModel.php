<?php

class ContentModel extends CI_Model
{
	
	public function createAbout(array $data)
	{
		createLog('Create about page', 1);
		return $this->db->insert('t_about', $data);
	}

	public function updateAbout($id, $data)
	{
		createLog('Updated about page', 1);
		$this->db->where('id', $id);

		return $this->db->update('t_about', $data);
	}

	public function getAbout()
	{
		$query = $this->db->get('t_about');

		return $query->result_array();
	}

	public function createTerm(array $data)
	{
		createLog('Created terms of reservation', 1);
		return $this->db->insert('t_terms', $data);
	}

	public function updateTerm($id, $data)
	{
		createLog('Updated terms of reservation', 1);
		$this->db->where('id', $id);

		return $this->db->update('t_terms', $data);
	}

	public function deleteTerm($id)
	{
		createLog('Deleted terms of reservation', 1);
		$this->db->where('id', $id);
		
		return $this->db->delete('t_terms');
	}

	public function fetchTerms($id = null)
	{
		if (! is_null($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db->get('t_terms');

		return $query->result_array();
	}

	public function getLogs()
	{
		$sql = 'SELECT log.*, a.full_name as admin FROM t_logs as log LEFT JOIN t_admins as a ON log.admin_id = a.id ORDER by log.id DESC';

		$query = $this->db->query($sql);

		return $query->result_array();
	}
}