<?php
function display($data) {
	showHeader(EVENTS);
	
	if (isset($data['error'])) {
		printf("<span class=\"error\">%s</span>\n", getString($data['error']));
	}
	
	//output here page content generated out of results storend
	//in array $data
	printf("Added %s tickets to shopping cart.<br />\n<br />\n", $data['numAdded']);
	
	echo "To secure your seats don't forget to check out your shopping cart:\t
	<a class=\"button\" href=\"index.php?module=buy&action=view_cart\">checkout<a><br>\n";
	
	showFooter();
}

?>
