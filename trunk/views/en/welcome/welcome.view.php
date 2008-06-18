<?php

function display($data) {
	showHeader(INDEX);
	if ($data['login'] == true) {
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr>\n");
		printf("<td><h2>Welcome %s</h2></td>\n", $data['user']);
		printf("</tr>\n");
		printf("<tr>\n");
		printf("<td>Please continue to browse our events and buy tickets. Your user ID is: %s</td>\n", $data['userID']);
		printf("</tr>\n");
		printf("</table>\n");
		
		//printf("Welcome %s,<br>\nuser id: %s<br />\n", $data['user'], $data['userID']);
	} else {
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr>\n");
		printf("<td><h2>Welcome</h2></td>\n");
		printf("</tr>\n");
		printf("<tr>\n");
		printf("<td>Please login or signup to buy tickets to our Events</td>\n");
		printf("</tr>\n");
		printf("</table>\n");
	}
	showFooter();
}

?>