<?php

// Begin the session on every page
session_start();


// Turn error reporting on.
require $_SERVER['DOCUMENT_ROOT']."includes/errors.php";
error_reporting(E_ALL);
//set_error_handler("handleErrors");

// get required functionality
require $_SERVER['DOCUMENT_ROOT']."includes/authenticate.php";

// validate current session, update latest activity timestamp.
if (!sessionAuthenticate()) {
	errRedirect("/phpscripts/logout.php");
}

/********************
login

sets the session login variable to true, and
records the user's name and IP address from 
which they logged in from. 
********************/
function login($user, $address) {
	$_SESSION['login'] = true;
	$_SESSION['user'] = $user;
	$_SESSION['userIP'] = $address;
	$_SESSION['lastActivity'] = time();
}


/********************
showMessage: String

Stores a notification to be displayed to the user
the next time the header is displayed.
********************/
function showMessage($string) {
	if (isset($_SESSION['message']))  {
		$_SESSION['message'] .= $string."<br />\n";
	} else {
		$_SESSION['message'] = $string."<br />\n";
	}
}

/********************
beginHeader

Shows the doctype, beginning html and head tags, the default meta tag, 
and links in the default CSS page.
********************/
function beginHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="/javascripts/prototype.js"></script>
<script type="text/javascript" src="/javascripts/scriptaculous.js"></script>
<?php
printf("\n");
} // end of function beginHeader

/********************
endHeader

Ends the "head" html tag, contains
the body and div tags. Includes the header
script and menu script to display the data for
the header and the links for the menu respectively.
********************/
function endHeader($currentPage)
{
?>
<title>CS480 Project<?php if (!empty($currentPage)) echo " - {$currentPage}"; ?></title>
</head>
<body>
<div class="main-container">
<div class="header">
<?php 
include $_SERVER['DOCUMENT_ROOT']."/html/header.html"; 
printf("\n");
?>
</div> <!-- end header -->
<div class="menu">
<?php 
include $_SERVER['DOCUMENT_ROOT']."/includes/menu.php";
printf("\n");
?>
</div> <!-- end menu -->
<br style="clear: left" /> 
<div class="content-container">
<?php
// If the timeout expired, echo that as the first bit of content.
$message = '';
if (isset($_SESSION['errMessage'])) {
	$message = $_SESSION['errMessage'];
	unset($_SESSION['errMessage']);
}
printf("<div id=\"error_txt\" class=\"error\">%s</div>\n", $message);

$message = '';
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}
printf("<div id=\"message_txt\" class=\"message\">%s</div>\n", $message);
printf("\n");
}// end of function endHeader



/********************
showHeader

This function will display all default header,
including metadata, title, head, body, css and div tags.
It has been broken out into smaller functions if 
finer granularity is required, say to add custom meta tags
or link in alternate CSS documents
********************/
function showHeader($currentPage = "Index")
{
beginHeader();
endHeader($currentPage);
} // end of function showHeader



/********************
showFooter

this function closes the remaining open HTML tags.
it includes the footerscript to display the footer information.
********************/
function showFooter()
{
?>
</div> <!-- end content-container -->
</div> <!-- end main container -->
<div class="footer">
<?php 
include $_SERVER['DOCUMENT_ROOT']."/html/footer.html";
printf("\n");
?>
</div> <!-- end footer -->
</body>
</html>
<?php
} // end of function showFooter
?>
