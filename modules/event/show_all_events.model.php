<?php


function authenticate () {
	return authAdmin();
}

/*
 * returns a array of all events ever (not only upcoming)
 */
function work() {
	$result = array();


	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}

	$sql = 'SELECT * FROM event_stats';

	$sql_result = $db_handle->query($sql);

	while($row = $sql_result->fetch_array()) {
		$result[] = $row;
	}

	$sql_result->close();

	return $result;
}


?>