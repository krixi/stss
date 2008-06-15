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
	//authenticate user first
	$userID = $_SESSION['userID'];
	//	$purchases = $_SESSION['cart'];

	$purchases = array(array('eventID' => '1', 'category' => 'premium',
						 'price' => 20, 'number' => 3));
	// Expecting an array named 'cart' filled with single purchases as eventid, category,
	// price and number of tickets in the session



	//Connect to database
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		if (DEBUG) {
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return false;
		}
		else {
			//TODO:Display user error without detailed information and nicer layout
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return false;
		}
	}





	foreach ($purchases AS $purchase) {
		$eventID = $purchase['eventID'];
		$category = $purchase['category'];
		$number = $purchase['number'];
		$status = 'new_try';

		//check if there are enough available tickets in this category and if not inform user
		//TODO: continue here
		
		
		//Get the highest available chairnumber
		//make sure there are no purchases added in the meantime
		$db_handle->query("LOCK TABLES purchases WRITE");
		$sql_query_maxSeat = 'SELECT MAX(seatID) FROM `purchases` WHERE eventID = '.(int)($eventID);
		$sql_result = $db_handle->query($sql_query_maxSeat)->fetch_array();
		$HighestSeatID = $sql_result[0];

		
		//Now we have the highest $seatID for this event - lets insert the datasets
		for ($i=1; $i<=$number; $i++){
			$newSeat = $HighestSeatID + $i;

			$sql_insert_query = "INSERT INTO purchases (eventID, userID, seatID, category, purchaseDate, status)
										VALUES ($eventID, $userID, $newSeat, '$category', NOW(), '$status')";
			$db_handle->query($sql_insert_query);
			if (DEBUG) echo "SQL_insert: $sql_insert_query<br>";
				

		}
		
		$db_handle->query("UNLOCK TABLES");





	}


	$db_handle->close();

	return $result;
}


?>