<?php

include BASE_PATH."/views/common.php";

function display($data) {
	showHeader(INDEX);
	if ($data['login'] == true) {
	
		printf("Welcome %s<br />\n", $data['user']);
		printf("You may also use your ID to log in: %s<br />\n", $data['userID']);
	} else {
		printf("Please log in.<br />\n");
	}
	showFooter();
}

?>