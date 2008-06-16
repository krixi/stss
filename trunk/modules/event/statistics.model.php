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


	$sql = "SELECT * FROM event_cat_stats";
	$sql_result = $db_handle->query($sql);
	
	while ($row = $sql_result->fetch_array()){
		$result['stats'][] = $row;
	}


	return $result;
}


?>