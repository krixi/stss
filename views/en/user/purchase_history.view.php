<?php

function display($data) {
	showHeader(PURCHASES);

	//output here page content generated out of results storend
	//in array $data
	
	if (isset($data['errors'])) {
		foreach ($data['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}





	if(!isset($data['purchase_history'])){
		echo "<h2>You have not yet made any purchases</h2>\n";
	}
	else
	{
		echo "<h1>Previously purchased tickets</h1>\n";
		echo "<table class=\"db_display\">

	<tr>
		<th>Event&nbsp;name</th>
		<th>Seat&nbsp;category</th>
		<th>Seat&nbsp;number</th>
		<th>Event&nbsp;date</th>
		<th>Purchase&nbsp;date</th>	
	</tr>";

		$alt1 = "class=\"event_alt1\"";
		$alt2 = "class=\"event_alt2\"";
		$row_count = 0;
		foreach ($data['purchase_history'] AS $row) {
			$this_row = ($row_count % 2 == 0) ? $alt1 : $alt2; 
			$row_count++;
			
			printf("<tr %s>\n", $this_row);
			echo "	<td> {$row['name']} </td>\n";
			echo "	<td> {$row['category']} </td>\n";
			echo "	<td> {$row['seatID']} </td>\n";
			echo "	<td> {$row['datef']} </td>\n";
			echo "	<td> {$row['purchaseDatef']} </td>\n";
			echo "</tr>\n\n";
		}

		echo "</table>";
	} //end else !isset(purchase_history)

	showFooter();
}

?>
