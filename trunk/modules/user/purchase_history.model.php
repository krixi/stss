<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	return authUser();
	//defined in Framework
}

/*
 * returns all purchases to a given userID ($_SESSION variable)
 */
function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results

	
	$result['errors'] = array();
	
	//Connect to database
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		if (DEBUG) {
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return false;
		}
		else {
			$result['errors'] = array();
			$result['errors'][] = DB_ERROR;
			return $result;
		}
	}

	$userID = $db_handle->real_escape_string($_SESSION['userID']);

	//get all purchases of this user and name to the events etc.
	$sql = "SELECT *, date_format(date, '%b %e, %Y at %k:%i') AS datef, 
		date_format(purchaseDate, '%b %e, %Y at %k:%i') AS purchaseDatef
		FROM purchases NATURAL JOIN events
		WHERE userID = ".$userID." ORDER BY purchaseDate DESC;";
	if ($sql_result = $db_handle->query($sql)) {
		while ($row = $sql_result->fetch_array()){
			$result['purchase_history'][] = $row;
		}
	} else {
		$result['errors'][] = QUERY_INVALID;
	}

	$db_handle->close();

	return $result;
}


?>