<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	return authUser();
	//defined in Framework
}

function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results

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

	//TODO: injection protection
	$userID = $_SESSION['userID'];

	//get all purchases of this user and name to the events etc.
	$sql = 'SELECT * FROM purchases NATURAL JOIN events 
			WHERE userID = '.$userID.' ORDER BY purchaseDate DESC;';
	$sql_result = $db_handle->query($sql);

	while ($row = $sql_result->fetch_array()){
		$result['purchase_history'][] = $row;
	}



	return $result;
}


?>