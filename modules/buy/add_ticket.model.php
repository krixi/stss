<?php


function authenticate () {
	//implement your own or call either
	return authUser();
	//or
	//authUser();
	//defined in Framework
}

function work() {
	$result = array();
	
	$result['numAdded'] = 0;
	if (isset($_GET['eventID'])) {
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}
		$eventID = $_GET['eventID'];
		if (isset($_POST['normal']) && is_numeric($_POST['normal'])) {
			$_SESSION['cart'][] = new Ticket("normal", $_POST['normal_price'], $_POST['normal']);
			$result['numAdded']++;
		}
		
		if (isset($_POST['premium']) && is_numeric($_POST['premium'])) {
			$_SESSION['cart'][] = new Ticket("premium", $_POST['premium_price'], $_POST['premium']);
			$result['numAdded']++;
		}
	}
	
	
	/*
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}

  	$sql_getTotal = 'SELECT * FROM events, seats WHERE events.eventID = seats.eventID AND events.eventID = '.$eventID;
	
	if ($sql_result = $db_handle->query($sql_getTotal)) {
	
	
	}
	
	$db_handle->close();
	*/
	return $result;
}


?>