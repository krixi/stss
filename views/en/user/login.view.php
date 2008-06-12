<?php

include BASE_PATH."/views/common.php";

function display($data) {
	
	$userErr = false;
	$passErr = false;
	
	beginHeader();
	if (is_array($data)) {
		if (isset($data['userErr'])) {
			$userErr = true;
		}
		
		if (isset($data['passErr'])) {
			$passErr = true;
		}
		
		if (!$userErr && !$passErr) {
			printf("<meta http-equiv=\"REFRESH\" content=\"2;URL=index.php\">\n");
			endHeader(LOGIN);
			printf("Welcome %s\n", $data['user']);
		} else {
			printf("<meta http-equiv=\"REFRESH\" content=\"2;URL=index.php\">\n");
			endHeader(LOGIN);
			if ($userErr) {
				printf("<span class=\"error\">%s</span>\n", getString($data['userErr']));
			}
			if ($passErr) {
				printf("<span class=\"error\">%s</span>\n", getString($data['passErr']));
			}
		}
	} else {
		endHeader(LOGIN);
		printf("ERROR: Data is not an array!");
	}
	
	
	showFooter();
}

?>