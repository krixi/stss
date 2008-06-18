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
		<th>Ammount</th>
		<th>Price</th>
		<th>Status</th>
		<th>Total</th>
	</tr>";

		$total_sum = 0;

		foreach ($data['oldCart'] AS $purchase) {
			$sum = $purchase['number']*$purchase['price'];
			$total_sum += $sum;

			echo "<tr>\n";
			echo "	<td> {$purchase['name']} </td>\n";
			echo "	<td> {$purchase['category']} </td>\n";
			echo "	<td> {$purchase['number']} </td>\n";
			echo "	<td> {$purchase['price']}€ </td>\n";
			echo "	<td> {$purchase['status']} </td>\n";
			echo "	<td> {$sum}€ </td>\n";
			echo "</tr>\n\n";

			if(isset($purchase['seats'])){
				foreach ($purchase['seats'] AS $seat) {
					echo "<tr>\n";
					echo"<td></td>\n";
					echo"<td>Seat Number</td>\n";
					printf("<td>%04d</td>\n",$seat);
					echo"</tr>\n\n";
				}
			}
		}

		echo "</table>\n";

		echo "<br>\n<br>\n
		Total sum of your purchase is: $total_sum €<br>\n";

		if ($data['payment'] == 'banktransfer') {
			echo "<br>\nPlease pay in advance per bank-transfer<br>\n<br>\n";
			echo "To: STSS<br>\nBankaccount #:"
			."5334323<br>\nBLZ: 80010030<br>\nDeusche Bank<br>\n";
		}
		elseif ($data['payment'] == 'creditCard') {
			echo "<br>\nThank you for paying by credit card.<br>\n";
		}

		//Create pdf-document
		require "includes/EZPDF/class.ezpdf.php";

		$doc =& new Cezpdf();
		$table= array();

		$total_sum = 0;

		//prepare an array to display as table
		foreach($data['oldCart'] AS $row) {
			$sum = $row['number']*$row['price'];
			$total_sum += $sum;
			$table[] = array("Name " => $row['name'],
						"Seat category " => $row['category'],
						"Price (€) " => $row['price'].'€',
						"Number " => $row['number'],
						"Status " => $row['status'],
						"total row (€) " => $sum.'€');

			if(isset($row['seats'])){
				foreach ($row['seats'] AS $seat) {

					$table_seats[] = array("Name " => $row['name'],
						"Seat category " => $row['category'],
						"Seat Number " => $seat);
				}
			}
		}


		$doc->selectFont('includes/EZPDF/fonts/Helvetica.afm');

		$doc->ezImage('views/images/heading.jpg');
		
		$doc->ezText("Purchased tickets:\n", 20);
		$doc->ezTable($table);

		$doc->ezText("\nYour seats:\n", 20);
		$doc->ezTable($table_seats);
		
		$doc->ezText("\nTotal SUM: $total_sum €\n", 15);

		if ($data['payment'] == 'banktransfer') {
			$doc->ezText("Please pay per Banktransfer:\nTo: STSS\nBankaccount #: 5334323\nBLZ: 80010030\nDeusche Bank", 10);

		}
		elseif ($data['payment'] == 'creditCard') {
			$doc->ezText("Thankyou for Paying by Credit Card", 10);
		}


		$pdfcode = $doc->output();

		$dir = './pdf_files';

		//save the file
		if (!file_exists($dir)){
			mkdir ($dir,0777);
		}

		$fname = $dir.'/'.date("Ymd-His").'_USER_'.$_SESSION['userID'].'.pdf';

		$fp = fopen($fname,'w');
		fwrite($fp,$pdfcode);
		fclose($fp);


		echo '<br>\nBill as <a href="'.$fname.'" target="_blank">PDF</a>';
		//	echo '
		//<SCRIPT LANGUAGE="JavaScript"><!--
		//function go_now ()   { window.location.href = "'.$fname.'"; }
		////--></SCRIPT>
		//
		//<!--<body onLoad="go_now()"; >-->
		//<a href="'.$fname.'" target="_blank">click here</a> if you are not re-directed.
		//
		//';

	}


	showFooter();
}

?>
