<?php

function display($data) {
	showHeader(INDEX);
	if ($data['login'] == true) {

		printf("Willkommen %s,<br>\n Benutzernummer: %s<br />\n", $data['user'], $data['userID']);
	} else {
		printf("Bitte einloggen.<br />\n");
	}
	showFooter();
}

?>