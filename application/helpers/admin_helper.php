<?php

function createLog($action, $adminId = null) {

	$ci =& get_instance();

	$result = $ci->db->insert('t_logs', 
		[
			'action' => $action, 
			'admin_id' => $adminId, 
			'date_time' => (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d h:i:s')
		]);

	return $result;
}