<?php

function display($data) {
	showHeader(VIEW_CART);
	
	//output here page content generated out of results storend
	//in array $data	
?>
<h2>Please choose method of payment</h2>
<form action="index.php?module=buy&action=buy_tickets" method="post">
<input type="submit" class="submit" value="Vorauskasse" /> 
</form><br>
<div><a class="button" href="#" onClick="Effect.toggle('cc_menu', 'slide'); return false;">Kreditkarte</a></div>
<div>
<div id="cc_menu" style="display: none">
<form action="index.php?module=buy&action=buy_tickets" method="post">
<table class="db_display">
<tr>
<td>
Kreditkarteninhaber: <input type="text" class="textinput" name="cardholder"/>
</td>
</tr>
<tr>
<td>
Kreditkartennummer: <input type="text" class="textinput" name="number"/>
</td>
</tr>
<tr>
<td>
Type: <input type="text" class="textinput" name="type"/>
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
