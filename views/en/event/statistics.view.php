<?php


function display($data) {
	showHeader(ADMIN);
	
	if (isset($data['errors'])) {
		foreach($data['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}

	//Statistics for all Events
	printf("<h1>Statistics overall</h1>\n");
	printf("<table id=\"stats_total\" class=\"db_display\">\n");
	printf("<tr>\n");
	printf("<th>Total&nbsp;seats</th>\n");
	printf("<th>Sold</th>\n");
	printf("<th>Available</th>\n");
	printf("<th>Sold&nbsp;%%</th>\n");
	printf("<th>Available&nbsp;%%</th>\n");
	printf("<th>Revenue&nbsp;total</th>\n");		
	printf("</tr>\n");
	printf("<tr>\n");
	printf("	<td> %d </td>\n", $data['stats_total']['amount']);
	printf("	<td> %d </td>\n", $data['stats_total']['sold']);
	printf("	<td> %d </td>\n", $data['stats_total']['available']);
	printf("	<td>%d%%</td>\n", $data['stats_total']['perc_sold']);
	printf("	<td>%d%%</td>\n", $data['stats_total']['perc_unsold']);
	printf("	<td> %d &euro;</td>\n", $data['stats_total']['revenue']);
	printf("</tr>\n\n");
	printf("</table><br />\n");
	
	//Event statistics by Event
	//Output Table with Event Statistics the detailed Version
	printf("<h1>Statistics by Event</h1>\n");
	printf("<table id=\"event_detail_admin\" class=\"db_display\">\n");

	printf("<tr>\n");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=id%s\">ID</th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=name%s\">Name</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=date%s\">Date</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=total%s\">Total&nbsp;seats</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=sold%s\">Sold</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=available%s\">Available</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=perc_sold%s\">Sold&nbsp;%%</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=perc_unsold%s\">Available&nbsp;%%</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=revenue%s\">Revenue&nbsp;total</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");		
	printf("</tr>\n");

	$alt1 = "class=\"event_alt1\"";
	$alt2 = "class=\"event_alt2\"";
	$row_count = 0;
	foreach ($data['stats_by_event'] AS $row) {
		$this_row = ($row_count%2 == 0) ? $alt1 : $alt2;
		$row_count++;
		printf("<tr %s>\n", $this_row);
		printf("	<td> %s </td>\n", $row['eventID']);
		printf("	<td> %s </td>\n", $row['name']);
		printf("	<td> %s </td>\n", $row['date']);
		printf("	<td> %s </td>\n", $row['amount']);
		printf("	<td> %s </td>\n", $row['sold']);
		printf("	<td> %s </td>\n", $row['available']);
		printf("	<td>%d%%</td>\n", $row['perc_sold']);
		printf("	<td>%d%%</td>\n", $row['perc_unsold']);
		printf("	<td> %s &euro;</td>\n", $row['total_rev']);
		printf("</tr>\n\n");
	}

	printf("</table><br />\n");


	//Output Table with Event Statistics the detailed Version
	printf("<h1>Statistics by event and seat category</h1>\n");
	printf("<table class=\"db_display\" id=\"event_detail_admin\">\n");
	printf("<tr>\n");
	printf("<th>ID</th>\n");
	printf("<th>Name</th>\n");
	printf("<th>Date</th>\n");
	printf("<th>Category</th>\n");
	printf("<th>Price</th>\n");
	printf("<th>Amount</th>\n");
	printf("<th>Sold</th>\n");
	printf("<th>Available</th>\n");
	printf("<th>Unsold</th>\n");
	printf("<th>Sold</th>\n");
	printf("<th>Revenue</th>\n");		
	printf("</tr>\n");

	foreach ($data['stats_by_event_category'] AS $row) {
		$this_row = ($row['eventID']%2 == 0) ? $alt1 : $alt2;
		
		printf("<tr %s>\n", $this_row);
		printf("	<td> %s </td>\n", $row['eventID']);
		printf("	<td> %s </td>\n", $row['name']);
		printf("	<td> %s </td>\n", $row['date']);
		printf("	<td> %s </td>\n", $row['category']);
		printf("	<td> %s&euro;</td>\n", $row['price']);
		printf("	<td> {$row['amount']} </td>\n");
		printf("	<td> {$row['sold']} </td>\n");
		printf("	<td> {$row['available']} </td>\n");
		printf("	<td>%d%%</td>", $row['perc_unsold']);
		printf("	<td>%d%%</td>", $row['perc_sold']);
		printf("	<td> {$row['revenue']}€ </td>\n");
		printf("</tr>\n\n");
	}

	printf("</table>");





	showFooter();
}

?>
