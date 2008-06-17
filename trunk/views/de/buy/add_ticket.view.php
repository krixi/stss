<?php
function display($data) {
	showHeader(EVENTS);
	
	if (isset($data['error'])) {
		printf("<span class=\"error\">%s</span>\n", getString($data['error']));
	}
	
	//output here page content generated out of results storend
	//in array $data
	printf("%s Tickets wurden dem Einkaufswagen hinzugefügt und sind für Sie reserviert<br />\n<br />\n", $data['numAdded']);
	
	echo "Bitte vergessen Sie nicht ihren Einkauf auszuchecken:\t
	<a class=\"button\" href=\"index.php?module=buy&action=view_cart\">checkout<a><br>\n";
	
	showFooter();
}

?>
