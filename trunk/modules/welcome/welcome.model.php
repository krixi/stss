
<?php


function authenticate () {
	return authNO();
}

function work() {

	$result = array();
	
	$result['login'] = false;
	if ($_SESSION['login'] == true) {
		$result['user'] = $_SESSION['user'];
		$result['userID'] = $_SESSION['userID'];
		$result['login'] = true;
	}

	return $result;
}

?>