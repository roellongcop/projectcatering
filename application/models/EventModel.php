<?php

/**
* 
*/
class EventModel extends CI_Model
{
	public function create(array $data)
	{
		createLog('Create new event '. $data['name'], 1);
		return $this->db->insert('t_events', $data);
	}

	public function update($id, $data)
	{
		// createLog('Updated event '. $data['name'], 1);
		$this->db->where('id', $id);

		return $this->db->update('t_events', $data);
	}

	public function fetch($eventId = null)
	{
		if (! is_null($eventId)) {
			$this->db->where('id', $eventId);
		}

		$this->db->where('is_deleted <>', 1);

		$query = $this->db->get('t_events');

		return $query->result_array();
	}

	public function fetchAllPastEvents() 
	{
		$query = $this->db->get('t_past_events');

		return $query->result_array();		
	}

	public function getEventName($eventId)
	{
		$this->db->where('id', $eventId);
		$this->db->select('name')->from('t_events');
		$query = $this->db->get();
		return $query->result_array()[0]['name'];
	}

	public function savePastEvent(array $data) 
	{
		createLog('Create new past event record. '. $data['title'], 1);
		return $this->db->insert('t_past_events', $data);
	}

	public function fetchPastEvents($id = null) 
	{
		if (! is_null($id)) {
			$this->db->where('id', $id);
		}

		$query = $this->db->get('t_past_events');

		return $query->result_array();
	}


	public function fetchFeaturedEvents($id = null) 
	{
		if (! is_null($id)) {
			$this->db->where('id', $id);
		}

		$this->db->where('is_featured', 1);
		$this->db->limit(3);
		
		$query = $this->db->get('t_past_events');

		return $query->result_array();
	}

	public function countFeaturedEvents()
	{
		$this->db->where('is_featured', 1);
		$this->db->from('t_past_events');
		
		return $this->db->count_all_results();
	}

	public function updatePastEvent(array $data, $id)
	{
		createLog('Updated past event record. '. $data['title'], 1);
		$this->db->where('id', $id);

		return $this->db->update('t_past_events', $data);
	}
}