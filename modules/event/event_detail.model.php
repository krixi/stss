<?php


function authenticate () {
	return authNO();
}

function work() {
	$result = array();
	
	$eventID = $_GET['eventID'];
	
	$result['queryOK'] = false;
	$result['errors'] = array();
	
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {	
		$result['errors'][] = CONNECTION_FAILED;
		return $result;
	}
	
	$query = 'SELECT *, (availableseats.amount - availableseats.sold) AS available FROM events, availableseats
	WHERE events.eventID = availableseats.eventID AND events.eventID = '.$eventID;
	
	if ($sql_result = $db_handle->query($query)) {
		while($row = $sql_result->fetch_array()) {
			$result['data'][] = $row;
		}
		$sql_result->close();
		$result['queryOK'] = true;
	} else {
		$result['errors'][] = QUERY_INVALID;
	}
	$db_handle->close();
	
	return $result;
}


?>