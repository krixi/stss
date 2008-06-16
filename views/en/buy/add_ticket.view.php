<?php
function display($data) {
	showHeader(EVENTS);
	
	//output here page content generated out of results storend
	//in array $data
	printf("Added %s tickets to shopping cart.<br />\n", $data['numAdded']);
	
	//TODO: continue shopping or checkout tickets
	
	showFooter();
}

?>
