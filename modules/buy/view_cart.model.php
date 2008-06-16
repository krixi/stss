<?php


function authenticate () {
	return authUser();
}

function work() {
	$result = array();
	
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