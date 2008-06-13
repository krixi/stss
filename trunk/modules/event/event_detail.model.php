<?php


function authenticate () {
  return authNO();
  }

function work() {
  $result = array();
  
  $eventID = $_GET['eventID'];
 
  
  $db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}

  $query = 'SELECT *, (availableseats.amount - availableseats.sold) AS available FROM events, availableseats 
                WHERE events.eventID = availableseats.eventID AND events.eventID = '.$eventID;

  $sql_result = $db_handle->query($query);
    
  while($row = $sql_result->fetch_array()) {
    $result[] = $row;
  }

  $sql_result->close();
  
  return $result;
}


?>