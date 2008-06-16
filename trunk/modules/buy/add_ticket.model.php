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
		$eventID = $_GET['eventID'];
		if (isset($_POST['normal']) && is_numeric($_POST['normal'])) {
			for ($i=0; $i<$_POST['normal']; $i++) {
				$_SESSION['cart'][] = array('category' => "normal", 
											'price' => $_POST['normal_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName']);
				$result['numAdded']++;
			}
		}
		
		if (isset($_POST['premium']) && is_numeric($_POST['premium'])) {
			for ($i=0; $i<$_POST['premium']; $i++) {
				$_SESSION['cart'][] = array('category' => "premium", 
											'price' => $_POST['premium_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName']);
				$result['numAdded']++;
			}
		}
	} else {
		$result['error'] = MISSING_EVENTID;
	}
	
	return $result;
}


?>