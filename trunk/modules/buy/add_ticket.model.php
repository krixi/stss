<?php


function authenticate () {
	//implement your own or call either
	return authUser();
	//or
	//authUser();
	//defined in Framework
}

/*
 * Adds Tickets to the cart
 */
function work() {
	$result = array();
	
	$result['numAdded'] = 0;
	if (isset($_GET['eventID'])) {
		$eventID = $_GET['eventID'];
		$normal_index = -1;
		$premium_index = -1;
		
		for ($i=0; $i<count($_SESSION['cart']); $i++) {
			if (($_SESSION['cart'][$i]['eventID'] == $eventID) && ($_SESSION['cart'][$i]['category'] == "normal")) {
				$normal_index = $i;
			}
			if (($_SESSION['cart'][$i]['eventID'] == $eventID) && ($_SESSION['cart'][$i]['category'] == "premium")) {
				$premium_index = $i;
			}
		}
		
		if (isset($_POST['normal']) && is_numeric($_POST['normal']) && $_POST['normal'] > 0) {
			if ($normal_index >= 0) {
				$sum = $_SESSION['cart'][$normal_index]['number'] + $_POST['normal'];
				if ($sum <= $_POST['normal_available']) {
					$_SESSION['cart'][$normal_index]['number'] += $_POST['normal'];
				} else {
					$result['error'] = NOT_ENOUGH_SEATS;
				}
			} else {
				$_SESSION['cart'][] = array('category' => "normal", 
											'price' => $_POST['normal_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName'],
											'number' => $_POST['normal'],
											'available' => $_POST['normal_available']);
			}
			$result['numAdded'] += $_POST['normal'];

		}
		
		if (isset($_POST['premium']) && is_numeric($_POST['premium']) && $_POST['premium'] > 0) {
			if ($premium_index >= 0) {
				$sum = $_SESSION['cart'][$normal_index]['number'] + $_POST['premium'];
				if ($sum <= $_POST['premium_available']) {
					$_SESSION['cart'][$premium_index]['number'] += $_POST['premium'];
				} else {
					$result['error'] = NOT_ENOUGH_SEATS;
				}
			} else {
				$_SESSION['cart'][] = array('category' => "premium", 
											'price' => $_POST['premium_price'], 
											'eventID' => $_GET['eventID'], 
											'name' => $_POST['eventName'],
											'number' => $_POST['premium'],
											'available' => $_POST['premium_available']);
			}
			$result['numAdded']+= $_POST['premium'];
		}
	} else {
		$result['error'] = MISSING_EVENTID;
	}
	
	return $result;
}


?>