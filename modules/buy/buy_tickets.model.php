<?php


function authenticate () {
	//implement your own or call either
	return authMoreUser();
	//or
	//authUser();
	//defined in Framework
}

function work() {
	$result = array();

	$userID = mysql_real_escape_string($_SESSION['userID']);

	// Expecting an array named 'cart' filled with single purchases as eventid, name, category,
	// price and number of tickets in the session
	//	$purchases = $_SESSION['cart'];
	//clear shoppingcart
	$_SESSION['cart'] = '';
	$oldCart = array();

	$purchases = array(array('eventID' => '1', 'category' => 'premium',
						 'price' => 20, 'number' => 3));


	//Connect to database
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (mysqli_connect_errno()) {
		if (DEBUG) {
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return false;
		}
		else {
			$result['errors'][] = DB_ERROR;
			return $result;
		}
	}





	foreach ($purchases AS $purchase) {
		//counter sql-injection - userID is already checked (through auth)
		$eventID = mysql_real_escape_string($purchase['eventID']);
		$category = mysql_real_escape_string($purchase['category']);
		$number = mysql_real_escape_string($purchase['number']);
		$status = 'pending';


		//check if event and required category really exists
		$sql_query_check_user = "SELECT * FROM seats
		WHERE eventID = $eventID AND category = '$category'";
		$sql_result = $db_handle->query($sql_query_check_user)->fetch_array();

		//TODO:nicer method to see if result is empty?
		if (!$sql_result) {
			//TODO: >>possible attack - write to logfile all details
			$result['errors'][] = DB_ERROR;
			return $result;
		}


		//check if there are enough available tickets in this category and if not inform user
		$sql_query_seats = "SELECT available FROM event_cat_stats
		WHERE eventID = $eventID AND category = '$category'";

		$sql_result = $db_handle->query($sql_query_seats)->fetch_array();
		$availableSeats = $sql_result[0];

		if ($number > $availableSeats){
			$purchase['status'] = 'not_enough_seats';
			$oldCart[] = $purchase;
			$result['errors'][] = NOT_ENOUGH_SEATS;
			$result['errors'][] = $purchase;
			$result['oldCart'] = $oldCart;
			return $result;
		}


		//Get the highest available SeatID and lock tables to
		//make sure there are no purchases added in the meantime = changed highest seatID
		$db_handle->query("LOCK TABLES purchases WRITE");
		$sql_query_maxSeat = 'SELECT MAX(seatID) FROM `purchases` WHERE eventID = '.$eventID;
		$sql_result = $db_handle->query($sql_query_maxSeat)->fetch_array();
		if ($sql_result) {
			$highestSeatID = $sql_result[0];
		}
		else {
			$highestSeatID = 1;
		}


		//Now that we have the highest $seatID for this event - lets insert the datasets
		for ($i=1; $i<=$number; $i++){
			$newSeat = $highestSeatID + $i;

			$sql_insert_query = "INSERT INTO purchases (eventID, userID, seatID, category, purchaseDate, status)
			VALUES ($eventID, $userID, $newSeat, '$category', NOW(), '$status')";
			$db_handle->query($sql_insert_query);
				
			if (DEBUG) echo "SQL_insert: $sql_insert_query<br>";
				
			$purchase['status'] = 'bought';
			$oldCart[]=$purchase;


		}

		$db_handle->query("UNLOCK TABLES");





	}


	$db_handle->close();
	
	$result['oldCart'] = $oldCart;

	return $result;
}


?>