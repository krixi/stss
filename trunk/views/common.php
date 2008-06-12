<?php
include "language.php";

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
<link href="views/css/default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="views/javascripts/lib/prototype.js"></script>
<script type="text/javascript" src="views/javascripts/lib/scriptaculous.js"></script>
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
function endHeader($page) {
?>
<title>CS480 Project - <?php echo getString($page); ?></title>
</head>
<body>
<div class="main-container">
<div class="header">
<?php 
include $_SESSION['lang']."/header.html"; 
printf("\n");
?>
</div> <!-- end header -->
<div class="menu">
<?php 
include "menu.php";
printf("\n");
?>
</div> <!-- end menu -->
<br style="clear: left" /> 
<div class="content-container">
<?php
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
include $_SESSION['lang']."/footer.html";
printf("\n");
?>
</div> <!-- end footer -->
</body>
</html>
<?php
} // end of function showFooter
?>
