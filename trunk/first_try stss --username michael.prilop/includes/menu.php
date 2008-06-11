	<?php
/*************
Included from common.php, function: endHeader

$currentPage is the input parameter to that function,
it contains the string to be used as the page title
*************/
?>

<ul>
<li <?php if ($currentPage == 'Index') echo "id=\"current\""; ?>><a href="index.php" title="Home">Home</a></li>
<li <?php if ($currentPage == 'View Tickets') echo "id=\"current\""; ?>><a href="viewTickets.php" title="View Tickets">View Tickets</a></li>
<?php
if ($_SESSION['admin'] == true && $_SESSION['login'] == true) {
?>
<li <?php if ($currentPage == 'Admin') echo "id=\"current\""; ?>><a href="admin.php" title="Admin">Admin</a></li>
<?php
} // END if admin
?>
<?php
if ($_SESSION['login'] == false) {
?>
<!--<li <?php if ($currentPage == 'Login') echo "id=\"current\""; ?>><a href="login.php" title="Login">Login</a></li>-->
<li <?php if ($currentPage == 'New User') echo "id=\"current\""; ?>><a href="join.php" title="Register">Join</a></li>
<li><a href="#" onclick="new Effect.toggle('login_form','appear'); return false;">Login</a></li>
<?php
include $_SERVER['DOCUMENT_ROOT'].'html/loginform.html';
?>
<?php
} else { // login == true
?>
<li <?php if ($currentPage == 'Logout') echo "id=\"current\""; ?>><a href="/phpscripts/logout.php" title="Logout">Logout</a></li>
<?php
/*
if ($_SESSION['admin'] == true) {
	include $_SERVER['DOCUMENT_ROOT']."html/ajax_menu.html";
}
*/
} // end "if logged in" statement
?>
</ul>
