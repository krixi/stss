<?php


function display($data) {
	showHeader(ADMIN);

	//Output Table with Event Statistics
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

	foreach ($data['stats'] AS $row) {
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
