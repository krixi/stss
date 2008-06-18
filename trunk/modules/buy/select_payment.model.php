<?php


function authenticate () {
	//implement your own or call either
	//authNO();
	//or
	//authUser();
	//defined in Framework
	return authUser();
}
/*
 * Does not do much at the time
 */
function work() {
	$result = array();

	//Here we could get the supported payment methods
	//for instance only allow banktransfer a week ahead of event etc.

	return $result;
}


?>