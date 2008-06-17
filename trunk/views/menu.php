<?php
/*************
Included from common.php, function: endHeader

$currentPage is the input parameter to that function,
it contains the string to be used as the page title
*************/

switch($_SESSION['lang']) {
	case GERMAN:
		// show the english link if it's currently german
		printf("<a class=\"lang\" href=\"index.php?lang=en\"><img src=\"views/images/en.png\" alt=\"EN\" title=\"English\"></a>\n");
	break;
	case ENGLISH: // fall through, default to english
	default:
		printf("<a class=\"lang\" href=\"index.php?lang=de\"><img src=\"views/images/de.png\" alt=\"DE\" title=\"Deutsch\"></a>\n");
	break;
	
}

$currentText = " id=\"current\"";

printf("<ul>\n");

if ($_SESSION['admin'] == true && $_SESSION['login'] == true) {
	printf("<li%s><a href=\"index.php?module=user&action=admin\" title=\"%s\">%s</a></li>\n", 
		($page == ADMIN) ? $currentText : '', getString(ADMIN), getString(ADMIN));
} // END if admin

printf("<li%s><a href=\"index.php\" title=\"%s\">%s</a></li>\n", 
	($page == INDEX) ? $currentText : '', getString(INDEX), getString(INDEX));

printf("<li%s><a href=\"index.php?module=event&action=show_upcoming_events\" title=\"%s\">%s</a></li>\n", 
	($page == EVENTS) ? $currentText : '', getString(EVENTS), getString(EVENTS));

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
	if (!authAdmin()) {
		printf("<li%s><a href=\"index.php?module=buy&action=view_cart\" title=\"%s\">%s</a></li>", 
			($page == VIEW_CART) ? $currentText : '', getString(VIEW_CART), getString(VIEW_CART));
		printf("<li%s><a href=\"index.php?module=user&action=purchase_history\" title=\"%s\">%s</a></li>", 
			($page == PURCHASES) ? $currentText : '', getString(PURCHASES), getString(PURCHASES));
	}
	printf("<li%s><a href=\"index.php?module=user&action=logout\" title=\"%s\">%s</a></li>", 
		($page == LOGOUT) ? $currentText : '', getString(LOGOUT), getString(LOGOUT));
} // end "if logged in" statement



printf("</ul>\n");
?>