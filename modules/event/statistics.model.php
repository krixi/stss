<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	//authUser();
	return authAdmin();
	//defined in Framework
}

/*
 * returns the statistics overall, event, event-category
 * orders statistics of event by selected column
 */
function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results
	$result['stats'] = array();
	
	$result['errors'] = array();

	
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
	if ($sql_result = $db_handle->query($sql)) {
		while ($row = $sql_result->fetch_array()){
			$result['stats_by_event_category'][] = $row;
		}
	} else {
		$result['errors'][] = QUERY_INVALID;
	}
	
	
	$event_order = '';
	if (isset($_GET['order'])) {
		switch($_GET['order']) {
			case 'revenue':
			$event_order = " ORDER BY total_rev";
			break;
			case 'id':
			$event_order = " ORDER BY eventID";
			break;
			case 'perc_unsold':
			$event_order = " ORDER BY perc_unsold";
			break;	
			case 'perc_sold':
			$event_order = " ORDER BY perc_sold";
			break;	
			case 'total_rev':
			$event_order = " ORDER BY total_rev";
			break;	
			case 'available':
			$event_order = " ORDER BY available";
			break;	
			case 'sold':
			$event_order = " ORDER BY sold";
			break;	
			case 'total':
			$event_order = " ORDER BY amount";
			break;	
			case 'date':
			$event_order = " ORDER BY date";
			break;	
			case 'name':
			$event_order = " ORDER BY name";
			break;
			default: break;
		}
	}
	
	//don't need injection protection, all variables are strings set by php - not user
	$inverse_order = (isset($_GET['dir'])) ? " DESC" : "";
	//get statistics by event
	$sql = "SELECT * FROM event_stats".$event_order.$inverse_order;
	if ($sql_result = $db_handle->query($sql)) {

		while ($row = $sql_result->fetch_array()){
			$result['stats_by_event'][] = $row;
		}
	} else {
		if (DEBUG) {
			trigger_error($sql);
		}
		$result['errors'][] = QUERY_INVALID;
	}
	//get statistics for all events
	$sql = 'SELECT SUM(amount) AS amount, SUM(sold) AS sold, SUM(available) as available,
		 SUM(total_rev) AS revenue, ((SUM(sold) / SUM(amount))*100) AS perc_sold, 
		 ((SUM(available) / SUM(amount))*100) AS perc_unsold FROM `event_stats` ';

	if ($sql_result = $db_handle->query($sql)) {
		$result['stats_total'] = $sql_result->fetch_array();
	} else {
		$result['errors'][] = QUERY_INVALID;
	}
	
	$db_handle->close();

	return $result;
}


?>