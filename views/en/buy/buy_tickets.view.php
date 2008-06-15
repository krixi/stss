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

	if (isset($data['oldCart'])) {
		echo "<ul>\n";
		foreach ($data['oldCart'] AS $purchase) {
			//TODO: nicer table output with event-name price, total cost etc.
			echo "<li>{$purchase['eventID']} | {$purchase['category']} | {$purchase['number']} | {$purchase['status']}</li>\n";
		}
		echo "</ul>\n";
	}
	showFooter();
}

?>
