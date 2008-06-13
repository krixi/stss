<?php


function authenticate () {
  return authNO();
  }

function work() {
  $result = array();

  
  $db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}
  
  //selects all events and sums up available seats
  $sql  = 'SELECT events.eventID, events.name, events.date, SUM(seats.amount) AS amount_total '
        . ' FROM events, seats WHERE events.eventID = seats.eventID'
        . ' GROUP BY events.eventID';

  $sql_result = $db_handle->query($sql);
    
  while($row = $sql_result->fetch_array()) {
    //$result[] = array("eventID" => $row['eventID'], "name" => $row['name'], "Date" => $row['date']);
    $result[] = $row;
  }

  $sql_result->close();
  
  return $result;
}


?>