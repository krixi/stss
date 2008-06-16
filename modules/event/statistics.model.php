<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	//authUser();
	return authAdmin();
	//defined in Framework
}

function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results
	$result['stats'] = array();

	//Connect to database
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		if (DEBUG) {
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return false;
		}
		else {
			$result['errors'][] = DB_ERROR;
			return $result;
		}
	}


	//get detailed statistics
	$sql = "SELECT * FROM event_cat_stats";
	$sql_result = $db_handle->query($sql);

	while ($row = $sql_result->fetch_array()){
		$result['stats_by_event_category'][] = $row;
	}

	//get statistics by event
	$sql = "SELECT * FROM event_stats";
	$sql_result = $db_handle->query($sql);

	while ($row = $sql_result->fetch_array()){
		$result['stats_by_event'][] = $row;
	}

	//get statistics for all events

$sql = 'SELECT SUM(amount) AS amount, SUM(sold) AS sold, SUM(available) as available,
		 SUM(total_rev) AS revenue, ((SUM(sold) / SUM(amount))*100) AS per_sold, 
		 ((SUM(available) / SUM(amount))*100) AS perc_unsold FROM `event_stats` ';

	$sql_result = $db_handle->query($sql)->fetch_array();
	$result['stats_total'] = $sql_result;


	return $result;
}


?>