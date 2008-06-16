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
		if (isset($_POST['normal']) && is_numeric($_POST['normal']) && $_POST['normal']>0) {

				$_SESSION['cart'][] = array('category' => "normal", 
											'price' => $_POST['normal_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName'],
											'number' => $_POST['normal']);
				$result['numAdded'] += $_POST['normal'];

		}
		
		if (isset($_POST['premium']) && is_numeric($_POST['premium']) && $_POST['premium']>0) {

				$_SESSION['cart'][] = array('category' => "premium", 
											'price' => $_POST['premium_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName'],
											'number' => $_POST['premium']);
				$result['numAdded']+= $_POST['premium'];

		}
	} else {
		$result['error'] = MISSING_EVENTID;
	}
	
	return $result;
}


?>