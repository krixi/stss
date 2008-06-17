<?php

function display($data) {
	showHeader(VIEW_CART);
	
	//output here page content generated out of results storend
	//in array $data
	if (isset($data['error'])) {
		printf("<span class=\"error\">%s</span>\n", getString($data['error']));
	} 
	
	if (count($data['cart']) > 0) {
		printf("<form method=\"post\" action=\"index.php?module=buy&action=view_cart&modify=true\">\n");
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr id=\"heading\">\n");
		printf("<th>Veranstaltung</th>\n");
		printf("<th>Sitzplatzkategorie</th>\n");
		printf("<th>Preis</th>\n");
		printf("<th>Anzahl</th>\n");
		printf("<th>&nbsp</th>\n");
		printf("</tr>\n");
		$total_price = 0;
		foreach ($data['cart'] as $ticket) {
			printf("<tr>\n");
			printf("<td>\n");
			printf("<a href=\"index.php?module=event&action=event_detail&eventID=%s\">%s</a>\n", $ticket['eventID'], $ticket['name']);
			printf("</td>\n");
			printf("<td>\n");
			printf("%s\n", $ticket['category']);
			printf("</td>\n");
			printf("<td>\n");
			printf("%s &euro;\n", $ticket['price']);
			printf("</td>\n");
			printf("<td>\n");
			printf("%s of %s\n", $ticket['number'], $ticket['available']);
			printf("</td>\n");
			printf("<td>\n");
			printf("<input class=\"textinput\" type=\"text\" name=\"%s_%s\" size=\"7\" /><br />\n",
				$ticket['eventID'], $ticket['category']);
			printf("</td>\n");
			printf("</tr>\n");
			$total_price += ($ticket['number'] * $ticket['price']);
		}
		printf("<tr>\n");
		printf("<td colspan=\"2\">\n");
		printf("<span class=\"total\">Gesamt: %s &euro;</span>\n", $total_price);
		printf("</td>\n");
		printf("<td colspan=\"2\">\n");
		printf("<a href=\"index.php?module=buy&action=select_payment\" title=\"Checkout\" class=\"button\">Checkout</a>\n");
		printf("</td>\n");
		printf("<td>\n");
		printf("<input id=\"cart_button\" class=\"submit\" type=\"submit\" value=\"Update\" />\n");
		printf("</form>\n");
		printf("</td>\n");
		printf("</tr>\n");
		printf("</table>\n");
	} else {
		printf("<table class=\"db_display\" id=\"cart\">\n");
		printf("<tr>\n");
		printf("<td><h2>Der Einkaufswagen ist leer.</h2></td>\n");
		printf("</tr>\n");
		printf("</table>\n");
	}
	
	showFooter();
}

?>
