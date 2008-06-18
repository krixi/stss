<?php
function display($result) {
	showHeader(EVENTS);
	
	if ($result['queryOK']) {
		if (isset($result['event_detail'])) {
			printf("<h1>%s</h1>\n", $result['event_name']);
			printf("<h2>Zeit und Datum: %s</h2>\n", $result['date']);
			printf("<h3>Verfügbare Sitzplätze:</h3>\n"); 
			//printf("<ul>\n");
			
			// if user, show form to add tickets to cart
			if (authUser() && !authAdmin()) {
				printf("<form action=\"index.php?module=buy&action=add_ticket&eventID=%s\" method=\"post\">\n", $result['eventID']);
				printf("<input type=\"hidden\" name=\"eventName\" id=\"eventName\" value=\"%s\" />\n", $result['event_name']);
			}
			
			printf("<table class=\"db_display\">\n");
			printf("<tr>\n");
			printf("<th>Sitzplatzkategorie</th>\n");
			printf("<th>Sitze</th>\n");
			printf("<th>Verfügbar</th>\n");
			printf("<th>Preis</th>\n");
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
				printf("<input class=\"submit\" type=\"submit\" value=\"Zum Einkaufwagen hinzufügen\" /><br />\n");
				printf("</form><br />\n");
			}
			
			if (!authUser()) {
				printf("<p>Bitte <a class=\"button\" onclick=\"new Effect.toggle('login_form','appear'); return false;\">%s</a> um tickets zu kaufen</p>\n",
					getString(LOGIN));
			}
			
			printf("<h3>Beschreibung: </h3>\n");
			if (!isset($result['description'])) {
				printf("Leider keine weiteren Informationen verfügbar");
			}
			else {
				printf("<p class=\"event_detail\">%s</p>\n",$row['description']);
			}
			
			printf("<br />");
		} else {
			printf("<span class=\"error\">Keine Daten verfügbar für diese Veranstaltung!</span>\n");
		}
		
	}
	
	if (isset($result['event_detail_admin'])) {
		printf("<h3>Veranstaltungsteilnehmer</h3>");
		printf("<table id=\"event_detail_admin\" class=\"db_display\">\n");
		printf("<tr>\n");
		printf("<th>Name</th>\n");
		printf("<th>Email</th>\n");
		printf("<th>Sitzplatzkategorie</th>\n");
		printf("<th>Sitzplatznummer</th>\n");
		printf("<th>Zahlungsstatus</th>\n");
		printf("<th>Einkaufsdatum</th>\n");
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
		
		printf("<a class=\"button\" href=\"index.php?module=event&action=statistics\">weitere Statistiken zu den Veranstaltungen</a><br />");
	}
	
	if (isset($result['errors'])) {
		foreach ($result['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}
	showFooter();
}

?>