<?php

function display($data) {
	showHeader(PURCHASES);

	//output here page content generated out of results storend
	//in array $data




	if(!isset($data['purchase_history'])){
		echo "<h2>You have not yet made any purchases</h2>\n";
	}
	else
	{
		echo "<h2>Previously purchased tickets</h2>\n";
		echo "<table>

	<tr>
		<th>Event&nbsp;name</th>
		<th>Seat&nbsp;category</th>
		<th>Seat&nbsp;number</th>
		<th>Event&nbsp;date</th>
		<th>Purchase&nbsp;date</th>	
	</tr>";

		foreach ($data['purchase_history'] AS $row) {
			echo "<tr>\n";
			echo "	<td> {$row['name']} </td>\n";
			echo "	<td> {$row['category']} </td>\n";
			echo "	<td> {$row['seatID']} </td>\n";
			echo "	<td> {$row['date']} </td>\n";
			echo "	<td> {$row['purchaseDate']} </td>\n";
			echo "</tr>\n\n";
		}

		echo "</table>";
	} //end else !isset(purchase_history)

	showFooter();
}

?>
