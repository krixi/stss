<?php
function authenticate () {
  return authNO();
}

function work() {
	$result = array();
	
	$user = '';
	$pass = '';
	
	$loginName = $_POST['username'];
  $pass = $_POST['password'];

/*  
  if (!isset($_POST['username'])) {
		$result['userErr'] = INVALID_USERNAME;
	} else if (!verifyUser($_POST['username'])) {
		$result['userErr'] = INVALID_USERNAME;
	} else {
		$user = $_POST['username'];
		$result['user'] = $user; // store for view.
	}
	
	if (!isset($_POST['password'])) {
		$result['passErr'] = INVALID_PASS;
	} else if (!verifyPassword($_POST['password'])) {
		$result['passErr'] = INVALID_PASS;
	} else {
		$pass = $_POST['password'];
	}
*/
	
	// Uses database connection to populate userID, admin status.
	if (authenticateUser($loginName, $pass, $_SESSION['userID'], $_SESSION['admin'], $_SESSION['user'] )) {
		$_SESSION['login'] = true;
	}
	
	return $result;
}

?>