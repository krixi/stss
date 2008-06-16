<?php

function display($data) {
	showHeader(EVENTS);

	//output here page content generated out of results storend
	//in array $data
	if (isset($data['errors'])) {
		foreach ($data['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}

	if (count($data['oldCart'])>0) {

		echo "<h2>Purchased Tickets</h2>";

		echo "<table>

	<tr>
		<th>Event&nbsp;name</th>
		<th>Seat&nbsp;category</th>
		<th>Number&nbsp;of&nbsp;tickets</th>
	</tr>";

		foreach ($data['oldCart'] AS $purchase) {

			echo "<tr>\n";
			echo "	<td> {$purchase['name']} </td>\n";
			echo "	<td> {$purchase['category']} </td>\n";
			echo "	<td> {$purchase['number']} </td>\n";
			echo "</tr>\n\n";
		}

		echo "</table>\n";
	}

	showFooter();
}

?>
