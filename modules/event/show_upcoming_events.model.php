<?php

function authenticate () {
	return authNO();
}

/*
 * returns an array of all upcoming events
 * (all events after current mysql-servertime)
 */
function work() {
	$result = array();
	
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	
	if (mysqli_connect_errno()) {
		if (DEBUG) {
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR); 	
		}
		
		$result['error'] = DB_ERROR;
		return $result;
	}

	 
	$sql = "SELECT *, date_format(event_stats.date, '%b %e, %Y at %k:%i') as datef FROM event_stats 
		WHERE NOW() < event_stats.date ORDER BY event_stats.date";

	if ($sql_result = $db_handle->query($sql)) {
		$result['db_results'] = array();
		while($row = $sql_result->fetch_array()) {
			$result['db_results'][] = $row;
		}
		$sql_result->close();
	} else {
		$result['error'] = QUERY_INVALID;
		return $result;
	}
	
	$db_handle->close();
	return $result;
}


?>