<?php


function display($data) {
	showHeader(ADMIN);


	//Event statistics by Event
	//Output Table with Event Statistics the detailed Version
	echo "<h2>Statistics by Event</h2>\n";
	echo "<table>

	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Date</th>
		<th>Amount&nbsp;total</th>
		<th>Sold</th>
		<th>Available</th>
		<th>%&nbsp;unsold</th>
		<th>%&nbsp;sold</th>
		<th>revenue&nbsp;total</th>		
	</tr>";

	foreach ($data['stats_by_event'] AS $row) {
		if ($row['eventID']%2) {
			echo "<tr bgcolor=\"lightgray\">\n";
		}
		else {
			echo "<tr>\n";
		}
		echo "	<td> {$row['eventID']} </td>\n";
		echo "	<td> {$row['name']} </td>\n";
		echo "	<td> {$row['date']} </td>\n";
		echo "	<td> {$row['amount']} </td>\n";
		echo "	<td> {$row['sold']} </td>\n";
		echo "	<td> {$row['available']} </td>\n";
		printf('	<td>%d%%</td>', $row['perc_unsold']);
		printf('	<td>%d%%</td>', $row['perc_sold']);
		echo "	<td> {$row['total_rev']}€ </td>\n";
		echo "</tr>\n\n";
	}

	echo "</table>";


	//Output Table with Event Statistics the detailed Version
	echo "<h2>Statistics by event and seat category</h2>\n";
	echo "<table>

	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Date</th>
		<th>Category</th>
		<th>Price</th>
		<th>Amount</th>
		<th>Sold</th>
		<th>Available</th>
		<th>%&nbsp;unsold</th>
		<th>%&nbsp;sold</th>
		<th>revenue</th>		
	</tr>";

	foreach ($data['stats_by_event_category'] AS $row) {
		if ($row['eventID']%2) {
			echo "<tr bgcolor=\"lightgray\">\n";
		}
		else {
			echo "<tr>\n";
		}
		echo "	<td> {$row['eventID']} </td>\n";
		echo "	<td> {$row['name']} </td>\n";
		echo "	<td> {$row['date']} </td>\n";
		echo "	<td> {$row['category']} </td>\n";
		echo "	<td> {$row['price']}€ </td>\n";
		echo "	<td> {$row['amount']} </td>\n";
		echo "	<td> {$row['sold']} </td>\n";
		echo "	<td> {$row['available']} </td>\n";
		printf('	<td>%d%%</td>', $row['perc_unsold']);
		printf('	<td>%d%%</td>', $row['perc_sold']);
		echo "	<td> {$row['revenue']}€ </td>\n";
		echo "</tr>\n\n";
	}

	echo "</table>";





	showFooter();
}

?>
