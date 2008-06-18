<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	//authUser();
	//defined in Framework
	return authAdmin();
}

/*
 * Adds a new Event to the Database
 */
function work() {
	$result = array();
	//Do your work and
	//return $result = array();
	//with the results
	
	$result['added'] = false;
	
	if (isset($_POST['name']) &&
		isset($_POST['month']) && 
		isset($_POST['date']) &&
		isset($_POST['year']) &&
		isset($_POST['time']) &&
		isset($_POST['description']) && 
		isset($_POST['normal']) && 
		isset($_POST['normal_price']) && 
		isset($_POST['premium']) &&
		isset($_POST['premium_price'])) {
		
		$result['errors'] = array();
		$result['verified'] = true;
		
		//validating the input
		$name = strip_tags($_POST['name']);
		$name = addslashes($name);
		$description = strip_tags($_POST['description']);
		$description = addslashes($description);
		$normal = strip_tags($_POST['normal']);
		$normal_price = strip_tags($_POST['normal_price']);
		$premium = strip_tags($_POST['premium']);
		$premium_price = strip_tags($_POST['premium_price']);
		
		$date_time = $_POST['year']."-".$_POST['month']."-".$_POST['date']." ".$_POST['time'];
		
		if (!strlen($name)) {
			$result['verified'] = false;
			$result['errors'][] = NAME_INVALID;
		}
		
		if (!($normal>=0) || !($premium>=0)) {
			$result['verified'] = false;
			$result['errors'][] = SEATS_INVALID;
		}
		
		if (!($normal_price>=0) || !($premium_price>=0)) {
			$result['verified'] = false;
			$result['errors'][] = PRICE_INVALID;
		}
		
		if (!verifyDate($date_time)) {
			$result['verified'] = false;
			$result['errors'][] = DATE_INVALID;
		}
		
		// Don't add bad data to database.
		if (!$result['verified']) {
			return $result;
		}
		
		// establish connection
		$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
		if (mysqli_connect_errno()) {	
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return $result;
		}
		
		//using sql-injection protection
		$date_time = $db_handle->real_escape_string($date_time);
		$name = $db_handle->real_escape_string($name);
		$normal_price = $db_handle->real_escape_string($normal_price);
		$premium_price = $db_handle->real_escape_string($premium_price);
		$normal = $db_handle->real_escape_string($normal);
		$premium = $db_handle->real_escape_string($premium);

		$sql_addEvent = "INSERT INTO events ( name, date, description )
					VALUES ( '".$name."', '".$date_time."', '".$description."');";
		
		if ($db_handle->query($sql_addEvent)) {
			if ($db_handle->affected_rows == 1) {
				$sql_getEventId = "SELECT eventID FROM events WHERE events.date = '".$date_time."' AND events.name = '".$name."';";
				
				if ($sql_result = $db_handle->query($sql_getEventId)) {
					if ($sql_result->num_rows == 1) {
						$row = $sql_result->fetch_array(MYSQLI_ASSOC);
						
						
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
			if (DEBUG) {
				echo $sql_addEvent."<br>";
				echo $sql_getEventId."<br>";
				echo $sql_addSeats."<br>";
			}
			$result['errors'][] = QUERY_INVALID;
		} 
		
		$db_handle->close();
	}
	return $result;
}



?>