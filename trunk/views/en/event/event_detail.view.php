<?php
function display($result) {
	showHeader(EVENTS);
	
	if ($result['queryOK']) {
		
		if (isset($result['data'])) {
			printf("<h1>%s</h1>\n", $result['data'][0]['name']);
			printf("<h2>Time and Date: %s</h2>\n", $result['data'][0]['date']);
			printf("Available Seats:<br />\n"); 
			printf("<ul>\n");
			printf("<form action=\"index.php?module=buy&action=add_ticket&eventID=%s\" method=\"post\">\n", $result['data'][0]['eventID']);
			foreach ($result['data'] as $row) {
				printf("<li>Category: %s - %s Seats, %s available - Price: %s &euro;\n",
					$row['category'], $row['amount'], $row['available'], $row['price']);
				printf("<select name=\"%s\" id=\"%s\">\n", $row['category'], $row['category']);
				for ($i=0; $i<=$row['available']; $i++) {
					printf("<option value=\"%s\">%s</option>\n", $i, $i);
				}
				printf("</select>\n</li>\n");
				printf("<input type=\"hidden\" name=\"%s_price\" id=\"%s_price\" value=\"%s\"/>\n", $row['category'], $row['category'], $row['price']);
			}
			printf("</ul>");
			printf("<input class=\"submit\" type=\"submit\" value=\"Add to cart\" /><br />\n");
			printf("</form><br />\n");
			
			printf("Description: <br />\n");
			if ($row['description']=='') {
				printf("Sorry, no further Information available");
			}
			else {
				printf("%s\n",$row['description']);
			}
			
			printf("<br />");
			printf("<a href=\"index.php?module=buy&action=buy_tickets&eventID=%s\">Buy Tickets</a>\n", $row['eventID']);
		} else {
			printf("<span class=\"error\">No data available for this event!</span>\n");
		}
		
	}
	
	if (isset($result['errors'])) {
		foreach ($result['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}
	showFooter();
}

?>