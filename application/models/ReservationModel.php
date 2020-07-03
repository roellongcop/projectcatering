<?php

class ReservationModel extends CI_Model 
{

	public function create(array $data)
	{
		// TODO validate missing params
		$insert = $this->db->insert('t_reservations', $data);

		if ($insert) {

			$resId = $this->db->insert_id();
			$code = $this->generateCode($resId);

			$this->db->where('id', $resId);

			$result = $this->db->update('t_reservations', ['reservation_code' => $code]);
			// create notif entry
			$this->createNotifEntry($resId, $code);

			if ($result) {
				return $code;
			} else {
				throw new Exception("Failed saving reservation");
			}

		} else {
			throw new Exception("Failed saving reservation");
		}
	}

	public function createNotifEntry($id, $reservation_code)
	{
		return $this->db->insert('t_notifications', [
			'reservation_code' => $reservation_code,
			'date_time' => (new DateTime())->format('Y-m-d h:i:s'),
			'reservation_id' => $id
		]);
	}

	public function getNewReservations()
	{
		$current = (new DateTime())->format('Y-m-d h:i:s');
		$fiveMinutes = new DateTime();
		$fiveMinutes->modify('+1 minutes');
		$fiveMins = $fiveMinutes->format('Y-m-d h:i:s');

		$sql = 'SELECT * from t_notifications WHERE date_time BETWEEN DATE_SUB(? , INTERVAL 5 MINUTE) AND ?';

		$query = $this->db->query($sql, [$current, $current]);
		
		return $query->result_array();		
	}

	public function truncateNotifications()
	{
		return $this->db->truncate('t_notifications');
	}

	public function getCodeByEmail($email, $code) 
	{
		$this->db->where('email_address', $email);
		$this->db->where('code', $code);

		$query = $this->db->get('t_temporary_code');

		return $query->result_array()[0];
	}

	public function removeCode($email, $code) 
	{
		$this->db->where('email_address', $email);
		$this->db->where('code', $code);

		return $this->db->delete('t_temporary_code');
	}

	public function insertCode(array $data) 
	{
		return $this->db->insert('t_temporary_code', $data);
	}

	public function getUpComingReservations() 
	{
		$dateToday = (new DateTime())->format('Y-m-d');
		$week = (new DateTime())->modify('+1 week')->format('Y-m-d');

		$this->db->where('date_of_event >', $dateToday);
		$this->db->where('date_of_event <=', $week);

		$query = $this->db->get('t_reservations');

		return $query->result_array();
	}

	public function update($id, array $data)
	{
		$this->db->where('id', $id);
		
		return $this->db->update('t_reservations', $data);
	}

	public function getReservationById($id)
	{
		$this->db->where('id', $id);
		
		$query = $this->db->get('t_reservations');

		return $query->result_array();
	}

	public function fetchByDate($date, $currentId)
	{
		$this->db->where('date_of_event', $date);
		$this->db->where('status', 'pending');
		$this->db->where('id !=', $currentId);

		$query = $this->db->get('t_reservations');

		return $query->result_array();
	}

	public function massReject(array $ids, array $data)
	{
		$this->db->where_in('id', $ids);

		return $this->db->update('t_reservations', $data);
	}

	public function find($code, $email)
	{
		$sql = 'SELECT r.*, p.name as package_name, t.name as theme_name, v.name as venue_name, v.image as venue_image, v.description as venue_desc from 	t_reservations as r 
				LEFT JOIN t_packages as p ON r.package_id = p.id
				LEFT JOIN t_themes as t ON r.theme_id = t.id
				LEFT JOIN t_venues as v ON r.venue_id = v.id 
				WHERE r.reservation_code = ? AND r.customer_email = ?';

		$query = $this->db->query($sql, [$code, $email]);


		return $query->result_array();
	}

	public function fetch($reservationId = null, $status = null)
	{
		$sql = 'SELECT r.*, p.name as package_name, t.name as theme_name, v.name as venue_name, v.image as venue_image, v.description as venue_desc from t_reservations as r 
				LEFT JOIN t_packages as p ON r.package_id = p.id
				LEFT JOIN t_themes as t ON r.theme_id = t.id
				LEFT JOIN t_venues as v ON r.venue_id = v.id ';
		$params = [];
		$where = '';

		if (! is_null($status)) {
			$where .= ' WHERE r.status = ? ';
			array_push($params, $status);
		}

		if (! is_null($reservationId)) {
			$where .= ' WHERE r.id = ? ';
			array_push($params, $reservationId);
		}

		$sql .= $where;
		$sql .= ' ORDER BY r.date_of_reservation DESC';

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function fetchForReport($year, $month = null, $startDate = null, $endDate = null, $status = null)
	{
		$sql = 'SELECT r.customer_name, r.customer_email, r.customer_contact, r.date_of_reservation, r.date_of_event,
				p.name, r.status, r.reject_reason, r.total_amount
				from t_reservations as r LEFT JOIN t_packages as p ON 
				r.package_id = p.id WHERE YEAR(r.date_of_event) = ? ';
		$params = [$year];
		$where = '';

		if ($month !== '0' && ! is_null($month)) {
			$where .= ' AND MONTH(r.date_of_event) = ? ';
			array_push($params, $month);
		}

		if (! is_null($startDate) && ! is_null($endDate)) {
			$sql .= ' AND r.date_of_event BETWEEN ? AND ?';
			array_push($params, $startDate);
			array_push($params, $endDate);
		}

		if (! is_null($status)) {
			$where .= ' AND r.status = ? ';
			array_push($params, $status);
		}

		$sql .= $where;
		$sql .= ' ORDER BY r.date_of_event, status ASC';

		$query = $this->db->query($sql, $params);

		return $query->result_array();
	}

	public function getReservationByCode($resCode)	
	{
		$sql = 'SELECT r.*, p.name from t_reservations as r LEFT JOIN t_packages as p ON 
				r.package_id = p.id WHERE reservation_code = ?';

		$query = $this->db->query($sql, [$resCode]);

		return $query->result_array();
	}

	public function getReservedDates()
	{
		$this->db->where('status', 'confirmed');
		$this->db->select('date_of_event');
		$this->db->from('t_reservations');

		$query = $this->db->get();

		return $query->result_array();
	}

	public function createAvailability(array $data)
	{
		return $this->db->insert_batch('t_availability', $data);
	}

	private function generateCode($reservationId)
	{
		$code_length = 10;
		$reservationIdLength = strlen($reservationId);

		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $code_length - $reservationIdLength; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString . $reservationId;
	}


	public function count($status) 
	{	
		$this->db->where('status', $status);
		$this->db->from('t_reservations');

		return $this->db->count_all_results();
	}

	public function selectNextWeekEvents()
	{
		$date = (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d');


		$sql = 'SELECT r.*, p.name as package from t_reservations r 
				JOIN t_packages p ON r.package_id = p.id
				WHERE status = ? AND date_of_event > ? AND date_of_event <= ? + INTERVAL 7 DAY ORDER BY date_of_event ASC';

		$query = $this->db->query($sql, ['confirmed', $date, $date]);

		return $query->result_array();
	}

	public function getEventToday()
	{
		$date = (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d');


		$sql = 'SELECT r.*, p.name as package from t_reservations as r LEFT JOIN t_packages as p ON 
				r.package_id = p.id WHERE date_of_event = ? AND status = ?';

		$query = $this->db->query($sql, [$date, 'confirmed']);

		return $query->result_array();
	}

	public function getPastFiveReservations(array $pending)
	{
		$idsToBeRejected = [];

		if (! empty($pending)) {
			foreach ($pending as $pend) {
				$dateOfRes = new DateTime($pend['date_of_reservation']);
				$dateToday = new DateTime();

				$interval = $dateToday->diff($dateOfRes);
				$inter = $interval->format('%d');

				if ($inter >= 5) {
					array_push($idsToBeRejected, $pend['id']);
				}
			}
		}

		return $idsToBeRejected;
 	}

	public function setCancelled($id, $data)
	{
		$this->db->where('id', $id);

		return $this->db->update('t_reservations', $data);
	}
}