<?php

class UserModel extends CI_Model 
{
	
	public function create(array $data)
	{
		$result = $this->db->insert('t_users', $data);

		if (! empty($result)) {
			return $this->db->insert_id();
		} else {
			throw new Exception("Unable to create account", 1);
		}
	}

	public function fetch($userId = null, $fields = '*')
	{
		if (! is_null($userId)) {
			$this->db->where('id', $userId);
			$this->db->select($fields);
			$this->db->from('t_users');

			$query = $this->db->get();

			return $query->result_array()[0];
		}
	}

	public function checkLogin($username, $password)
	{
		$sql = 'SELECT id, full_name, contact_no, email_address, username, address from t_users where username = ? AND password = ?';
		$query = $this->db->query($sql, [$username, md5($password)]);

		return $query->result_array();
	}

	public function checkAdminLogin($username, $password) 
	{
		
	}
}