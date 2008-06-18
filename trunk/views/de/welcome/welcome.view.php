<?php

function display($data) {
	showHeader(INDEX);
	if ($data['login'] == true) {
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr>\n");
		printf("<td><h2>Wilkommen %s</h2></td>\n", $data['user']);
		printf("</tr>\n");
		printf("<tr>\n");
		printf("<td>Mehr Informationen zu unseren Veranstaltungen finden Sie unter Veranstaltungen. Dort können Sie ebenfalls Tickets kaufen. Ihre Benutzernummer ist: %s</td>\n", $data['userID']);
		printf("</tr>\n");
		printf("</table>\n");
		
		//printf("Welcome %s,<br>\nuser id: %s<br />\n", $data['user'], $data['userID']);
	} else {
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr>\n");
		printf("<td><h2>Willkommen</h2></td>\n");
		printf("</tr>\n");
		printf("<tr>\n");
		printf("<td>Bitte einloggen oder registrieren Sie sich um tickets kaufen zu können.</td>\n");
		printf("</tr>\n");
		printf("</table>\n");
	}
	showFooter();
}

?>