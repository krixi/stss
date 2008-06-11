<?php
require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

beginHeader();
printf("<link href=\"css/news.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />\n");
/*printf("<script type=\"text/javascript\" src=\"/javascripts/news.js\"></script>\n");*/
endHeader("Index");

if ($_SESSION['login'] == true) {
	printf("<h1>Welcome {$_SESSION['user']}</h1>\n");
} else {
	printf("<h1>Please log in!</h1>\n");
}

///////////////////////////////////
// check the news from the database.
///////////////////////////////////
include $_SERVER['DOCUMENT_ROOT']."includes/news.php";

showFooter();
?>
