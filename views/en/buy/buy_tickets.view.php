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

		echo "<h1>Purchased Tickets</h1>";

		echo "<table class=\"db_display\" id=\"bought\">

	<tr>
		<th>Event&nbsp;name</th>
		<th>Seat&nbsp;category</th>
		<th>Price&nbsp;(&euro;)</th>
		<th>Number</th>
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
			echo "	<td> {$purchase['price']} </td>\n";
			echo "	<td> {$purchase['number']} </td>\n";
			echo "	<td> {$purchase['status']} </td>\n";
			echo "	<td> {$sum}&nbsp;&euro; </td>\n";
			echo "</tr>\n\n";
		}

		echo "</table>\n";

		echo "<br>\n<br>\n
		Total sum of your purchase is: $total_sum&nbsp;&euro;<br>\n";
		echo "Please pay in advance per bank-transfer or pay during the event<br>\n<br>\n";

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
						"Price (€) " => $row['price'],
						"Number " => $row['number'],
						"Status " => $row['status'],
						"total row (€) " => $sum);
		}


		$doc->selectFont('includes/EZPDF/fonts/Helvetica.afm');

		$doc->ezImage('views/images/heading.jpg');
		$doc->ezText("Purchased Tickets:\n", 20);

		$doc->ezTable($table);

		$doc->ezText("\nTotal SUM: $total_sum €\n", 15);
		$doc->ezText("Please pay per Banktransfer:\nTo: STSS\nBankaccount #: 5334323\nBLZ: 80010030\nDeusche Bank", 10);


		//$doc->addText('Hello World!', 50);

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


		echo 'Bill as <a href="'.$fname.'" target="_blank">PDF</a>';
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
