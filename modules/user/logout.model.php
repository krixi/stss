<?php
function authenticate () {
  return authNO();
}

function work() {
	$result = array();
	
	$result['oldID'] = session_id();
	
	if (isset($_SESSION['user'])) {
		$result['user'] = $_SESSION['user'];
	}
	
	session_destroy();
	
	session_start();
	session_regenerate_id();
	
	$result['newID'] = session_id();
	
	return $result;
}

?>