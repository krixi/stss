<?php

include BASE_PATH."/views/common.php";

function display($data) {
/*
	
	// Need to restart the session because it was just destroyed
	initSession();
	beginHeader();
	printf("<meta http-equiv=\"REFRESH\" content=\"2;URL=index.php\">\n");
	endHeader(LOGOUT);
	if (is_array($data)) {
		if (isset($data['user'])) {
			printf("Goodbye %s!<br />\n", $data['user']);
		}	
	} else {
		printf("ERROR: Data is not an array!");
	}
	
	//printf("Old Session ID:%s<br />\n", $data['oldID']);
	//printf("New Session ID:%s<br />\n", $data['newID']);
	
	showFooter();
*/

header("Location: index.php");
}

?>