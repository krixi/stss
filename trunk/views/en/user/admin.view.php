<?php

function display($data) {
	showHeader(ADMIN);

	//output here page content generated out of results storend
	//in array $data
	// show admin menu
	printf("<ul>\n");
		printf("<li><a href=\"index.php?module=event&action=add\">Add new event</a></li>\n");
		printf("<li><a href=\"index.php?module=event&action=statistics\">Show event statistics</a></li>\n");
	printf("</ul>\n");



	showFooter();
}

?>

