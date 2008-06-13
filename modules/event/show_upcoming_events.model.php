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
  
     
  $sql = 'SELECT events.eventID, events.name, events.date, '
          . ' SUM( seats.amount ) AS amount_total, '
          . ' (availableseats.amount - availableseats.sold ) AS available'
          . ' FROM events, seats, availableseats'
          . ' WHERE events.eventID = availableseats.eventID '
          . ' AND seats.eventID = events.eventID'
          . ' AND seats.category = availableseats.category'
          . ' AND events.date > NOW( )'
          . ' GROUP BY events.eventID';

  $sql_result = $db_handle->query($sql);
    
  while($row = $sql_result->fetch_array()) {
       $result[] = $row;
  }

  $sql_result->close();
  
  return $result;
}


?>