<?php


function authenticate () {
	return authUser();
}

function work() {
	$result = array();
	
	// Check to see if they are attempting to modify the contents of the cart.
	if (isset($_GET['modify'])) {
		
		// loop through the contents of the cart, at each index:
		for ($i=0; $i<count($_SESSION['cart']); $i++) {
			
			// Check to see if a $_POST variable with a name that looks like eventID_category,
			// example: 5_normal 	if one is found, and the value it contains is numeric:
			$field_name = $_SESSION['cart'][$i]['eventID']."_".$_SESSION['cart'][$i]['category'];
			if (isset($_POST[$field_name]) && is_numeric($_POST[$field_name])) {
				
				// If the user entered 0, remove it from cart.
				if ($_POST[$field_name] > 0) {
					// check that it's within the last known available amount
					if ($_POST[$field_name] <= $_SESSION['cart'][$i]['available']) {
						$_SESSION['cart'][$i]['number'] = $_POST[$field_name];
					} else {
						$result['error'] = NOT_ENOUGH_SEATS;
					}
				} else {
					unset($_SESSION['cart'][$i]);
				}
			}
		}
		
		// Update array indexes to be 0 based.
		$_SESSION['cart'] = array_values($_SESSION['cart']);
	}
	
	$result['cart'] = array();
	
	if (is_array($_SESSION['cart'])) {
		foreach ($_SESSION['cart'] as $ticket) {
			$result['cart'][] = $ticket;
		}
	} else {
		$result['error'] = CART_EMPTY;
	}
	
	return $result;
}


?>