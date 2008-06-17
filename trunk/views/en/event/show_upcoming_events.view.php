<?php

function display($result) {
	showHeader(EVENTS);
	
	if (isset($result['error'])) {
		printf("<span class=\"error\">%s</span>\n", getString($result['error']));
	}

	if (isset($result['db_results'])) {
		print "<h1>Upcoming Events</h1>\n";

		print "<table class=\"db_display\">\n";
		print "<tr>\n";
		print "<th>Date</th>\n";
		print "<th>Event</th>\n";
		print "<th>Seats</th>\n";
		print "<th>Available</th>\n";
		print "</tr>\n\n";
		
		$alt1 = "class=\"event_alt1\"";
		$alt2 = "class=\"event_alt2\"";
		$row_count = 0;
		foreach ($result['db_results'] as $row) {
			$this_row = ($row_count % 2 == 0) ? $alt1 : $alt2; 
			$row_count++;
			
			printf("<tr %s>\n", $this_row);
			print "  <td> {$row['datef']} </td>\n";
			print "  <td> {$row['name']} </td>\n";
			print "  <td> {$row['amount']} </td>\n";
			print "  <td> {$row['available']} </td>\n";
			print '  <td> <a class="button" href = "index.php?module=event&action=event_detail&eventID='.$row['eventID']."\">details</a>\n";
			print "</tr>\n\n";
		}
	
		print "</table>\n\n";
	
	
		if (authAdmin()) {
			printf("<a class=\"button\" href=\"index.php?module=event&action=show_all_events\">Show All</a>\n");
			printf("<a class=\"button\" href=\"index.php?module=event&action=add\">Add New</a>\n");
		}
	}

	showFooter();

}
?>