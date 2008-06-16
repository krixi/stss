<?php


function authenticate () {
	return authNO();
}

function work() {
	$result = array();

	//TODO: counter sql injection
	$eventID = $_GET['eventID'];

	$result['queryOK'] = false;
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



	$query = 'SELECT * FROM event_cat_stats WHERE eventID = '.$eventID;

	if ($sql_result = $db_handle->query($query)) {
		while($row = $sql_result->fetch_array()) {
			$result['data'][] = $row;
		}
		$sql_result->close();
		$result['queryOK'] = true;
	} else {
		$result['errors'][] = QUERY_INVALID;
	}

	if (authAdmin()){
				
		$admin_query = 'SELECT * FROM purchases NATURAL JOIN user WHERE eventID = '.$eventID;
		
		if ($sql_result = $db_handle->query($admin_query)) {
			while($row = $sql_result->fetch_array()) {
				$result['event_detail_admin'][] = $row;
			}
			$sql_result->close();
			$result['queryAdminOK'] = true;
		} else {
			$result['errors'][] = QUERY_INVALID;
		}
	}

	$db_handle->close();

	return $result;
}


?>