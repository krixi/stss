<?php

function display($result) {
  showHeader(EVENTS);

  echo '<h1>All Events</h1>';
  
  print "<table>\n";
  print "<tr>\n";
  print "<th>Date</th>\n";
  print "<th>Event</th>\n";
  print "<th>Seats</th>\n";
  print "<th>Available</th>\n";
  print "</tr>\n\n";

  foreach ($result as $row) {
    print "<tr>\n";
    print "  <td> {$row['date']} </td>\n";
    print "  <td> {$row['name']} </td>\n";
    print "  <td> {$row['amount_total']} </td>\n";
    print "  <td> {$row['available']} </td>\n";
    print '  <td> <a href = "index.php?module=event&action=event_detail&eventID='.$row['eventID']."\">details</a>\n";
    print "</tr>\n\n";
  }
  
  print "</table>\n\n";
  
    printf("<a href=\"index.php?module=event&action=show_upcoming_events\">Show Upcoming</a>\n");
  
  
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