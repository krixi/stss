<?php

function display($data) {
	showHeader(VIEW_CART);
	
	//output here page content generated out of results storend
	//in array $data	
?>
<h2>Please choose method of payment</h2>
<form action="index.php?module=buy&action=buy_tickets" method="post">
<input type="submit" class="submit" value="Vorrauskasse" /> 
</form><br>
<div><a class="button" href="#" onClick="Effect.toggle('cc_menu', 'slide'); return false;">Kreditkarte</a></div>
<div>
<div id="cc_menu" style="display: none">
<form action="index.php?module=buy&action=buy_tickets" method="post">
<table class="db_display">
<tr>
<td>
Cardholder: <input type="text" class="textinput" name="Karteninhaber"/>
</td>
</tr>
<tr>
<td>
Number: <input type="text" class="textinput" name="Kartennummer"/>
</td>
</tr>
<tr>
<td>
Card type: <input type="text" class="textinput" name="Typ"/>
</td>
</tr>
<tr>
<td>
<input type="submit" class="submit" value="Submit"/>
</td>
</tr>
</table> 
</form>
<!--  <a onClick="new Effect.SlideUp('cc_menu'); return false;">Hide</a>-->
</div>
</div>
<?php	
	showFooter();
}

?>
