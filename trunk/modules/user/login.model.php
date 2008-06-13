<?php
function authenticate () {
  return authNO();
}

function work() {
	$result = array();
	
	$result['login'] = false;
	$result['errors'] = array();
	
	$loginName = $_POST['username'];
	$pass = $_POST['password'];


    if (!isset($_POST['username'])) {
		$result['errors'][] = USERNAME_INVALID;
	} else if (!verifyUser($_POST['username'])) {
		$result['errors'][] = USERNAME_INVALID;
	} 
	
	if (!isset($_POST['password'])) {
		$result['errors'][] = PASSWORD_INVALID;
	} else if (!verifyPassword($_POST['password'])) {
		$result['errors'][] = PASSWORD_INVALID;
	} 
	
	// Uses database connection to populate userID, admin status.
	if (authenticateUser($loginName, $pass, $_SESSION['userID'], $_SESSION['admin'], $_SESSION['user'] )) {
		$_SESSION['login'] = true;
		$result['login'] = true;
		$_SESSION['userIP'] = $_SERVER['REMOTE_ADDR'];
	} else {
		$result['errors'][] = USER_NOT_FOUND;
	}
	
	
	return $result;
}

?>