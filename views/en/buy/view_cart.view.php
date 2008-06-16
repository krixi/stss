<?php

function display($data) {
	showHeader(INDEX);
	
	//output here page content generated out of results storend
	//in array $data
	if (isset($data['error'])) {
		printf("<span class=\"error\">%s</span>\n", getString($data['error']));
	} else {
	
		if (count($data) > 0) {
			printf("<table class=\"cart\" id=\"cart\">\n");
			printf("<tr>\n");
			printf("<th>Event Name</th>\n");
			printf("<th>Category</th>\n");
			printf("<th>Price</th>\n");
			printf("</tr>\n");
			$cart_size = 0;
			foreach ($data as $ticket) {
				$cart_size++;
				printf("<tr>\n");
				printf("<td>\n");
				printf("%s\n", $ticket['name']);
				printf("</td>\n");
				printf("<td>\n");
				printf("%s\n", $ticket['category']);
				printf("</td>\n");
				printf("<td>\n");
				printf("%s &euro;\n", $ticket['price']);
				printf("</td>\n");
				printf("</tr>\n");
			}
			printf("</table>\n");
		
			printf("<a href=\"index.php?module=buy&action=buy_tickets\" title=\"Checkout\" class=\"button\">Checkout</a>\n");
			
		} else {
			printf("<tr><td colspan=\"3\"><span class=\"error\">%s</span></td></tr>\n", getString(CART_EMPTY));
		}
	}
	
	showFooter();
}

?>
