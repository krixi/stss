<?php

require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

// redirect them if they're not logged in, or not an admin.
if ($_SESSION['login'] == false) {
	errRedirect("/index.php", "You are not logged in.");
}
if ($_SESSION['admin'] == false) {
	errRedirect("/index.php", "You do not have administrator privileges.");
}

//$_SESSION['message'] = "Click to edit";

// Output HTML
beginHeader();
printf("<link href=\"css/news.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />\n");
/*printf("<script type=\"text/javascript\" src=\"/javascripts/news.js\"></script>\n");*/
endHeader("Admin");

// set the variable first so E_ALL doesn't complain
if (!isset($_REQUEST['req'])) {
	$_REQUEST['req'] = '';
}

switch($_REQUEST['req']){
	case "modify":
		printf("<h1>Censor the news</h1>\n");
		include $_SERVER['DOCUMENT_ROOT'].'includes/news.php';
		//modify stuff
	break;
	
	case "add":
		//add
		include $_SERVER['DOCUMENT_ROOT'].'html/addnews.html';
	break;
	
	default:
		include $_SERVER['DOCUMENT_ROOT'].'html/adminmenu.html';
	break;
	
}
showFooter();
?>
