<?php

class ReportsModel extends CI_Model
{
	
	public function countPackages() 
	{
		$this->db->where('is_available', 1);
		$this->db->from('t_packages');
		
		return $this->db->count_all_results();
	}

	public function countReservations() 
	{	
		$this->db->from('t_reservations');

		return $this->db->count_all_results();
	}

	public function countItems() 
	{
		$this->db->from('t_items');
		return $this->db->count_all_results();
	}

	public function getMonthlyReservations($year, $month) 
	{
		$sql = 'SELECT MONTH(date_of_event) as month, count(id) as res_count FROM t_reservations WHERE YEAR(date_of_event) = ? GROUP BY MONTH(date_of_event)';

		$query = $this->db->query($sql, [$year]);
		
		return $query->result_array();
	}

	public function getMonthlySales($year, $month) 
	{
		$sql = 'SELECT MONTH(date_of_event) as month, SUM(total_amount) as total FROM t_reservations WHERE YEAR(date_of_event) = ? AND status = ? AND event_completed = ? GROUP BY MONTH(date_of_event)';

		$query = $this->db->query($sql, [$year, 'confirmed', 1]);
		
		return $query->result_array();
	}

	public function checkLogin($username, $password)
	{
		$sql = 'SELECT id, username, full_name, is_active from t_admins where username = ? AND password = ?';
		$query = $this->db->query($sql, [$username, md5($password)]);

		return $query->result_array();
	}
}