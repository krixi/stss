<?php

include BASE_PATH."/views/common.php";

function display($data) {
	showHeader(INDEX);
	if ($data['login'] == true) {

		printf("Welcome %s, user id: %s<br />\n", $data['user'], $data['userID']);
	} else {
		printf("Please log in.<br />\n");
	}
	showFooter();
}

?>