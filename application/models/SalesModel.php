<?php

class SalesModel extends CI_Model
{
	public function fetch($year, $month = null) 
	{
		$sql = 'SELECT r.*, p.name as package_name FROM t_reservations r 
				LEFT JOIN t_packages as p ON r.package_id = p.id
				WHERE YEAR(r.date_of_event) = ? AND r.status = ? AND r.event_completed = ?';

		$params = [$year, 'confirmed', 1];

		if (! is_null($month)) {
			$sql .= ' AND MONTH(r.date_of_event) = ? ';
			array_push($params, $month);
		}

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function getForRecords($year, $month = null, $startDate = null, $endDate = null)
	{
		$sql = 'SELECT r.reservation_code, r.customer_name, r.date_of_event, r.customer_contact, 
				r.date_of_reservation, p.name as package_name, r.total_amount FROM t_reservations r 
				LEFT JOIN t_packages as p ON r.package_id = p.id
				WHERE YEAR(r.date_of_event) = ? AND r.status = ? AND 
				r.event_completed = ?';

		$params = [$year, 'confirmed', 1];

		if ($month !== '0' && ! is_null($month)) {
			$sql .= ' AND MONTH(r.date_of_event) = ? ';
			array_push($params, $month);
		}

		if (! is_null($startDate) && ! is_null($endDate)) {
			$sql .= ' AND r.date_of_event BETWEEN ? AND ?';
			array_push($params, $startDate);
			array_push($params, $endDate);
		}

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}
}