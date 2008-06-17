<?php

function display($result) {
	showHeader(EVENTS);

	print "<h1>All Events</h1>";

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
	foreach ($result as $row) {
		$this_row = ($row_count % 2 == 0) ? $alt1 : $alt2; 
		$row_count++;
		
		printf("<tr %s>\n", $this_row);
		print "  <td> {$row['date']} </td>\n";
		print "  <td> {$row['name']} </td>\n";
		print "  <td> {$row['amount']} </td>\n";
		print "  <td> {$row['available']} </td>\n";
		print '  <td> <a class="button" href = "index.php?module=event&action=event_detail&eventID='.$row['eventID']."\">details</a>\n";
		print "</tr>\n\n";
	}

	print "</table>\n\n";

	printf("<a class=\"button\" href=\"index.php?module=event&action=show_upcoming_events\">Show Upcoming</a>\n");


	// print "Eventlisting as pdf";
	showFooter();

	/*
	 require BASE_PATH.'/includes/ezpdf/class.ezpdf.php';
	 $pdf =& new Cezpdf();
	 $pdf->ezTable($result);
	 $pdf->ezStream();
	 */
}






?>