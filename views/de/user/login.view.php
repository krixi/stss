<?php

function display($data) {
	
	
	if (is_array($data) && isset($data['login'])) {
		
		if ($data['login'] == true) {
			header("Location: index.php");
			exit;
		} else { // login == false, check for errors
			showHeader(LOGIN);		
			if (isset($data['errors'])) {
				foreach ($data['errors'] as $error) {
					printf("<span class=\"error\">%s</span>\n", getString($error));
				}
			}
			showFooter();
		}
	} else {
		trigger_error("Data not an array: login.view");
		header("Location: index.php");
	}
}

?>