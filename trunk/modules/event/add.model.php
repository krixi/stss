<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	//authUser();
	//defined in Framework
	return authAdmin();
}

function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results
	
	$result['added'] = false;
	
	if (isset($_POST['name']) && 
		isset($_POST['date']) &&
		isset($_POST['description']) && 
		isset($_POST['normal']) && 
		isset($_POST['normal_price']) && 
		isset($_POST['premium']) &&
		isset($_POST['premium_price'])) {
		
		$result['errors'] = array();
		$result['verified'] = true;
		
		$name = strip_tags($_POST['name']);
		$date = strip_tags($_POST['date']);
		$description = strip_tags($_POST['description']);
		$normal = strip_tags($_POST['normal']);
		$normal_price = strip_tags($_POST['normal_price']);
		$premium = strip_tags($_POST['premium']);
		$premium_price = strip_tags($_POST['premium_price']);
		
		if (!is_numeric($normal) || !is_numeric($premium)) {
			$result['verified'] = false;
			$result['errors'][] = SEATS_INVALID;
		}
		
		if (!is_numeric($normal_price) || !is_numeric($premium_price)) {
			$result['verified'] = false;
			$result['errors'][] = PRICE_INVALID;
		}
		
		if (!verifyDate($date)) {
			$result['verified'] = false;
			$result['errors'][] = DATE_INVALID;
		}
		
		// Don't add bad data to database.
		if (!$result['verified']) {
			return $result;
			//TODO: isn't there a die necessary here?
		}
		
		// establish connection
		$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
		if (mysqli_connect_errno()) {	
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return $result;
		}
		
		//TODO: What if you enter the same event twice? Should we give a specific error message?
		// Put the name, date and description in the events table
		$sql_addEvent = "INSERT INTO events ( name, date, description )
					VALUES ( '".$name."', '".$date."', '".$description."');";
		
		if ($db_handle->query($sql_addEvent)) {
			if ($db_handle->affected_rows == 1) {
				$sql_getEventId = "SELECT eventID FROM events WHERE events.date = '".$date."' AND events.name = '".$name."';";
				
				if ($sql_result = $db_handle->query($sql_getEventId)) {
					if ($sql_result->num_rows == 1) {
						$row = $sql_result->fetch_array(MYSQLI_ASSOC);
						$eventId = 
						
						$sql_addSeats = "INSERT INTO seats (eventID, category, price, amount) 
							VALUES ('".$row['eventID']."', 'normal', '".$normal_price."', '".$normal."'), 
								('".$row['eventID']."', 'premium', '".$premium_price."', '".$premium."');";
						
						if ($db_handle->query($sql_addSeats)) {
							$result['added'] = true;
						}
					}
				}
			}
		}
		
		if (!$result['added']) {
			$result['errors'][] = QUERY_INVALID;
		} 
	}
	return $result;
}


?>