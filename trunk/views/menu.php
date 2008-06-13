<?php
/*************
Included from common.php, function: endHeader

$currentPage is the input parameter to that function,
it contains the string to be used as the page title
*************/

$currentText = " id=\"current\"";

printf("<ul>\n");

printf("<li%s><a href=\"index.php\" title=\"%s\">%s</a></li>\n", ($page == INDEX) ? $currentText : '', getString(INDEX), getString(INDEX));

printf("<li%s><a href=\"index.php?module=event&action=show_upcoming_events\" title=\"%s\">%s</a></li>\n", ($page == EVENTS) ? $currentText : '', getString(EVENTS), getString(EVENTS));

if ($_SESSION['admin'] == true && $_SESSION['login'] == true) {
	printf("<li%s><a href=\"index.php\" title=\"%s\">%s</a></li>\n", ($page == ADMIN) ? $currentText : '', getString(ADMIN), getString(ADMIN));
} // END if admin


if ($_SESSION['login'] == false) {
	printf("<li%s><a href=\"index.php?module=user&action=join\" title=\"%s\">%s</a></li>\n", 
		($page == JOIN) ? $currentText : '', getString(JOIN), getString(JOIN));
	printf("<li%s><a onclick=\"new Effect.toggle('login_form','appear'); return false;\" title=\"%s\">%s</a></li>\n",
		($page == LOGIN) ? $currentText : '', getString(LOGIN), getString(LOGIN));
?>
<div id="login_form" style="display:none;">
<div>
<form id="input_form" action="index.php?module=user&action=login" method="post" name="login">

<input class="textinput" id="username" name="username" type="text" value="<?php echo getString(USERNAME); ?>"
onblur="if (this.value == '') this.value = '<?php echo getString(USERNAME); ?>';"
onfocus="if (this.value == '<?php echo getString(USERNAME); ?>') this.value = '';"/>

<input class="textinput" id="password" name="password" type="password" value="<?php echo getString(PASSWORD); ?>"
onblur="if (this.value == '') this.value = '<?php echo getString(PASSWORD); ?>';"
onfocus="if (this.value == '<?php echo getString(PASSWORD); ?>') this.value = '';"/>

<input class="submit" name="submit" type="submit" value="submit" />
</form>
</div>
</div>
<?php
} else { // login == true
	printf("<li%s><a href=\"index.php?module=user&action=logout\" title=\"%s\">%s</a></li>", 
		($page == LOGOUT) ? $currentText : '', getString(LOGOUT), getString(LOGOUT));
} // end "if logged in" statement



printf("</ul>\n");
?>