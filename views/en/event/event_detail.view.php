<?php
function display($result) {
	showHeader(EVENTS);
	
	if ($result['queryOK']) {
		if (isset($result['event_detail'])) {
			printf("<h1>%s</h1>\n", $result['event_name']);
			printf("<h2>Time and Date: %s</h2>\n", $result['date']);
			printf("<h3>Available Seats:</h3>\n"); 
			//printf("<ul>\n");
			
			// if user, show form to add tickets to cart
			if (authUser() && !authAdmin()) {
				printf("<form action=\"index.php?module=buy&action=add_ticket&eventID=%s\" method=\"post\">\n", $result['eventID']);
				printf("<input type=\"hidden\" name=\"eventName\" id=\"eventName\" value=\"%s\" />\n", $result['event_name']);
			}
			
			printf("<table class=\"db_display\">\n");
			printf("<tr>\n");
			printf("<th>Category</th>\n");
			printf("<th>Seats</th>\n");
			printf("<th>Available</th>\n");
			printf("<th>Price</th>\n");
			printf("</tr>\n");
			foreach ($result['event_detail'] as $row) {
				printf("<tr>\n");
				printf("<td>\n");
				printf("%s\n", $row['category']);
				printf("</td>\n");
				printf("<td>\n");
				printf("%s\n", $row['amount']);
				printf("</td>\n");
				printf("<td>\n");
				printf("%s\n", $row['available']);
				printf("</td>\n");
				printf("<td>\n");
				printf("%s &euro;\n", $row['price']);
				printf("</td>\n");

				// allow users to add tickets to cart
				if (authUser() && !authAdmin()) {
					printf("<td>\n");
					printf("<select name=\"%s\" id=\"%s\">\n", $row['category'], $row['category']);
					for ($i=0; $i<=$row['available']; $i++) {
						printf("<option value=\"%s\">%s</option>\n", $i, $i);
					}
					printf("</select>\n</li>\n");
					printf("<input type=\"hidden\" name=\"%s_price\" id=\"%s_price\" value=\"%s\"/>\n", 
						$row['category'], $row['category'], $row['price']);
					printf("<input type=\"hidden\" name=\"%s_available\" id=\"%s_available\" value=\"%s\"/>\n", 
						$row['category'], $row['category'], $row['available']);
					printf("</td>\n");
				}
				printf("</tr>\n");
			}
			printf("</table>");

			// finish form for users
			if (authUser() && !authAdmin()) {
				printf("<input class=\"submit\" type=\"submit\" value=\"Add to cart\" /><br />\n");
				printf("</form><br />\n");
			}
			
			printf("<h3>Description: </h3>\n");
			if (!isset($result['description'])) {
				printf("Sorry, no further Information available");
			}
			else {
				printf("<p class=\"event_detail\">%s</p>\n",$row['description']);
			}
			
			printf("<br />");
		} else {
			printf("<span class=\"error\">No data available for this event!</span>\n");
		}
		
	}
	
	if (isset($result['event_detail_admin'])) {
		printf("<h3>Event Participants</h3>");
		printf("<table id=\"event_detail_admin\" class=\"db_display\">\n");
		printf("<tr>\n");
		printf("<th>Name</th>\n");
		printf("<th>Email</th>\n");
		printf("<th>Category</th>\n");
		printf("<th>Seat&nbsp;Number</th>\n");
		printf("<th>Payment&nbsp;Status</th>\n");
		printf("<th>Purchase&nbsp;date</th>\n");
		printf("</tr>\n");	
		
		$alt1 = "class=\"event_alt1\"";
		$alt2 = "class=\"event_alt2\"";
		$row_count = 0;
		foreach ($result['event_detail_admin'] AS $row) {
			$this_row = ($row_count%2 == 0) ? $alt1 : $alt2;
			$row_count++;
			
			printf("<tr %s>\n", $this_row);
			printf("<td> %s, %s </td>\n", $row['lastname'], $row['firstname']);
			printf("<td> %s </td>\n", $row['email']);
			printf("<td> %s </td>\n", $row['category']);
			printf("<td> %s </td>\n", $row['seatID']);
			printf("<td> %s </td>\n", $row['status']);
			printf("<td> %s </td>\n", $row['purchaseDate']);
			printf("</tr>\n");
		}
		printf("</table>\n");
		
		printf("<a class=\"button\" href=\"index.php?module=event&action=statistics\">more Statistics on events</a><br />");
	}
	
	if (isset($result['errors'])) {
		foreach ($result['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}
	showFooter();
}

?>