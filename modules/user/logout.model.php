<?php
function authenticate () {
  return authNO();
}

/*
 * logs out user, destroys session and reinitiates session with new id
 */
function work() {
	$result = array();
	
	$result['lang'] = $_SESSION['lang'];
	$result['oldID'] = session_id();
	
	if (isset($_SESSION['user'])) {
		$result['user'] = $_SESSION['user'];
	}
	
	
	session_destroy();
	
	session_start();
	session_regenerate_id();
	
	$_SESSION['lang'] = $result['lang'];
	$result['newID'] = session_id();
	
	return $result;
}

?>