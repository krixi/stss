<?php


function display($data) {
	showHeader(ADMIN);
	
	if (isset($data['errors'])) {
		foreach($data['errors'] as $error) {
			printf("<span class=\"error\">%s</span>\n", getString($error));
		}
	}

	//Statistics for all Events
	printf("<h1>Gesamtstatistik</h1>\n");
	printf("<table id=\"stats_total\" class=\"db_display\">\n");
	printf("<tr>\n");
	printf("<th>Gesamtanzahl Sitzplätze</th>\n");
	printf("<th>Verkauft</th>\n");
	printf("<th>Verfügbar</th>\n");
	printf("<th>%%&nbsp;Verkauft</th>\n");
	printf("<th>%%&nbsp;Verfügbar</th>\n");
	printf("<th>Gesamteinkünfte</th>\n");		
	printf("</tr>\n");
	printf("<tr>\n");
	printf("	<td> %d </td>\n", $data['stats_total']['amount']);
	printf("	<td> %d </td>\n", $data['stats_total']['sold']);
	printf("	<td> %d </td>\n", $data['stats_total']['available']);
	printf("	<td>%d%%</td>\n", $data['stats_total']['perc_sold']);
	printf("	<td>%d%%</td>\n", $data['stats_total']['perc_unsold']);
	printf("	<td> %d &euro;</td>\n", $data['stats_total']['revenue']);
	printf("</tr>\n\n");
	printf("</table><br />\n");
	
	//Event statistics by Event
	//Output Table with Event Statistics the detailed Version
	printf("<h1>Statistik per Veranstaltung</h1>\n");
	printf("<table id=\"event_detail_admin\" class=\"db_display\">\n");

	printf("<tr>\n");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=id%s\">ID</th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=name%s\">Name</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=date%s\">Datum</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=total%s\">Sitzplätze</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=sold%s\">Verkauft</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=available%s\">Verfügbar</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=perc_sold%s\">Verkauft&nbsp;%%</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=perc_unsold%s\">Verfügbar&nbsp;%%</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");
	printf("<th><a href=\"index.php?module=event&action=statistics&order=revenue%s\">Einkünfte</a></th>\n",
		(isset($_GET['dir'])) ? "" : "&dir=desc");		
	printf("</tr>\n");

	$alt1 = "class=\"event_alt1\"";
	$alt2 = "class=\"event_alt2\"";
	$row_count = 0;
	foreach ($data['stats_by_event'] AS $row) {
		$this_row = ($row_count%2 == 0) ? $alt1 : $alt2;
		$row_count++;
		printf("<tr %s>\n", $this_row);
		printf("	<td> %s </td>\n", $row['eventID']);
		printf("	<td> %s </td>\n", $row['name']);
		printf("	<td> %s </td>\n", $row['date']);
		printf("	<td> %s </td>\n", $row['amount']);
		printf("	<td> %s </td>\n", $row['sold']);
		printf("	<td> %s </td>\n", $row['available']);
		printf("	<td>%d%%</td>\n", $row['perc_sold']);
		printf("	<td>%d%%</td>\n", $row['perc_unsold']);
		printf("	<td> %s &euro;</td>\n", $row['total_rev']);
		printf("</tr>\n\n");
	}

	printf("</table><br />\n");


	//Output Table with Event Statistics the detailed Version
	printf("<h1>Statistik für Events und Sitzplatzkategorien</h1>\n");
	printf("<table class=\"db_display\" id=\"event_detail_admin\">\n");
	printf("<tr>\n");
	printf("<th>ID</th>\n");
	printf("<th>Name</th>\n");
	printf("<th>Datum</th>\n");
	printf("<th>Sitzplatzkategorie</th>\n");
	printf("<th>Preis</th>\n");
	printf("<th>Anzahl</th>\n");
	printf("<th>Verkauft</th>\n");
	printf("<th>Verfügbar</th>\n");
	printf("<th>Nicht&nbsp;Verkauft</th>\n");
	printf("<th>Verkauft</th>\n");
	printf("<th>Einkünfte</th>\n");		
	printf("</tr>\n");

	foreach ($data['stats_by_event_category'] AS $row) {
		$this_row = ($row['eventID']%2 == 0) ? $alt1 : $alt2;
		
		printf("<tr %s>\n", $this_row);
		printf("	<td> %s </td>\n", $row['eventID']);
		printf("	<td> %s </td>\n", $row['name']);
		printf("	<td> %s </td>\n", $row['date']);
		printf("	<td> %s </td>\n", $row['category']);
		printf("	<td> %s&euro;</td>\n", $row['price']);
		printf("	<td> {$row['amount']} </td>\n");
		printf("	<td> {$row['sold']} </td>\n");
		printf("	<td> {$row['available']} </td>\n");
		printf("	<td>%d%%</td>", $row['perc_unsold']);
		printf("	<td>%d%%</td>", $row['perc_sold']);
		printf("	<td> {$row['revenue']}€ </td>\n");
		printf("</tr>\n\n");
	}

	printf("</table>");





	showFooter();
}

?>
