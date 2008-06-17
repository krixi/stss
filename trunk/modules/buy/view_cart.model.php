<?php


function authenticate () {
	return authUser();
}

function work() {
	$result = array();
	
	if (isset($_GET['modify'])) {
		for ($i=0; $i<count($_SESSION['cart']); $i++) {
			$field_name = $_SESSION['cart'][$i]['eventID']."_".$_SESSION['cart'][$i]['category'];
			if (isset($_POST[$field_name]) && is_numeric($_POST[$field_name])) {
				if ($_POST[$field_name] > 0) {
					if ($_POST[$field_name] <= $_SESSION['cart'][$i]['available']) {
						$_SESSION['cart'][$i]['number'] = $_POST[$field_name];
					} else {
						$result['error'] = SEATS_INVALID;
					}
				} else {
					unset($_SESSION['cart'][$i]);
				}
			}
		}
		$_SESSION['cart'] = array_values($_SESSION['cart']);
	}
	
	if (is_array($_SESSION['cart'])) {
		foreach ($_SESSION['cart'] as $ticket) {
			$result[] = $ticket;
		}
	} else {
		$result['error'] = CART_EMPTY;
	}
	
	return $result;
}


?>