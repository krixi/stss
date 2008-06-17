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
	$status = 'reserved'; //by default if not payed by credit card
	$payment = 'banktransfer'; //default payment method

	//Find out if payment is through credit-card or other method
	if (isset($_POST['cardholder'])
	&& isset($_POST['number'])
	&& isset($_POST['type'])) {
		
		require_once('includes/CreditCard.php');
		
		//TODO: validate properly
		//$creditCardValid = Validate_Finance_CreditCard::number($_POST['number'], $_POST['type']);	
		$creditCardValid = true;
		
		if($creditCardValid) {
			$status = 'paid';
			$payment = 'creditCard';
			$creditCardHolder = $_POST['cardholder'];
			$creditCardNumber = $_POST['number'];
			$creditCardType = $_POST['type'];
		}
		else {
			$result['errors'][] = CREDITCARD_INVALID;
			return $result;
		}
	}

	// Expecting an array named 'cart' filled with single purchases as eventid, name, category,
	// price and number of tickets in the session
	$purchases = $_SESSION['cart'];
	//clear shoppingcart
	$_SESSION['cart'] = array();
	$oldCart = array();


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

	
	$totalPayment = 0; //use this as credit-card payment

	foreach ($purchases AS $purchase) {
		//counter sql-injection - userID is already checked (through auth)
		$userID = $db_handle->real_escape_string($_SESSION['userID']);
		$eventID = $db_handle->real_escape_string($purchase['eventID']);
		$category = $db_handle->real_escape_string($purchase['category']);
		$number = $db_handle->real_escape_string($purchase['number']);


		//check if event and required category really exists
		$sql_query_check_user = "SELECT * FROM seats
		WHERE eventID = $eventID AND category = '$category'";
		$sql_result = $db_handle->query($sql_query_check_user)->fetch_array();

		if (!$sql_result) {
			$result['errors'][] = DB_ERROR;
			return $result;
		}


		//check if there are enough available tickets in this category and if not inform user
		$sql_query_seats = "SELECT available, price FROM availableseats
		WHERE eventID = $eventID AND category = '$category'";

		$sql_result = $db_handle->query($sql_query_seats)->fetch_array();
		$availableSeats = $sql_result[0];
		$categoryPrice = $sql_result[1];

		if ($number > $availableSeats){
			$purchase['status'] = 'not_enough_seats';
			$oldCart[] = $purchase;
			$result['errors'][] = NOT_ENOUGH_SEATS;
			$result['errors'][] = $purchase;

		}
		else {


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
				
			//get current datetime from server
			$datetime = date("Y-m-d H:i:s");

			//Now that we have the highest $seatID for this event - lets insert the datasets
			for ($i=1; $i<=$number; $i++){
				$newSeat = $highestSeatID + $i;

				$sql_insert_query = "INSERT INTO purchases (eventID, userID, seatID, category, purchaseDate, status)
				VALUES ($eventID, $userID, $newSeat, '$category', '$datetime', '$status')";
				$db_handle->query($sql_insert_query);

				$purchase['seats'][] = $newSeat;
				
				$totalPayment += $categoryPrice;


				if (DEBUG) echo "SQL_insert: $sql_insert_query<br>";

			}

			$purchase['status'] = $status;
			$oldCart[]=$purchase;

			$db_handle->query("UNLOCK TABLES");

		}



	}


	$db_handle->close();
	
	
	/*
	 * CREDIT CARD PAYMENT
	 * Connect here to a payment Portal and charge the user
	 */
	$totalPayment; //the total amount to charge
	$creditCardHolder; //Cardholder
	$creditCardNumber; //credit card number
	$creditCardType; //credit card type
	$creditCardValid; //credit card validity check by PAIR-package
	//END CREDIT CARD PAYMENT

	$result['totalPayment'] = $totalPayment;
	$result['payment'] = $payment;
	$result['oldCart'] = $oldCart;

	return $result;
}
?>