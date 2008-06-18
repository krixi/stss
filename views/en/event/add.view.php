<?php

function display($data) {
	showHeader(ADMIN);
	if ($data['added'] == true)  {
		printf("<h2>New event submitted</h2>\n");
	} else {
		// Display any possible error messages
		if (isset($data['errors'])) {
			foreach ($data['errors'] as $error) {
				printf("<span class=\"error\">%s</span>\n", getString($error));
			}
		}
?>
<h1>Add new event</h1>
<form action="index.php?module=event&action=add" method="post" >
<table class="add_event">
<tr>
<td colspan="2">
<span class="display_txt">Event name</span>
</td>
<td colspan="2">
<input class="textinput" name="name" id="name" type="text" size="50" />
</td>
</tr>
<tr>
<td>
<span class="display_txt">Occurrs:</span>
</td>
<td colspan="3">
<!-- 
<input class="textinput" name="date" id="date" type="text" size="30" 
value="0000-00-00 00:00" onfocus="if (this.value == '0000-00-00 00:00') this.value = '';" onblur="if (this.value == '') this.value = '0000-00-00 00:00';"/>
-->
<select name="month">
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
</select>
<select name="date">
<?php
for($i=1; $i<=31; $i++) {
	printf("<option>%02d</option>\n", $i);	
}
?>
</select>
<select name="year">
<?php
for($i=2008; $i<=2050; $i++) {
	printf("<option>%s</option>\n", $i);	
}
?>
</select>

time:
<select name="time">
<option>00:00</option>
<option>00:30</option>
<option>01:00</option>
<option>01:30</option>
<option>02:00</option>
<option>02:30</option>
<option>03:00</option>
<option>03:30</option>
<option>04:00</option>
<option>04:30</option>
<option>05:00</option>
<option>05:30</option>
<option>06:00</option>
<option>06:30</option>
<option>07:00</option>
<option>07:30</option>
<option>08:00</option>
<option>08:30</option>
<option>09:00</option>
<option>09:30</option>
<option>10:00</option>
<option>10:30</option>
<option>11:00</option>
<option>11:30</option>
<option>12:00</option>
<option>12:30</option>
<option>13:00</option>
<option>13:30</option>
<option>14:00</option>
<option>14:30</option>
<option>15:00</option>
<option>15:30</option>
<option>16:00</option>
<option>16:30</option>
<option>17:00</option>
<option>17:30</option>
<option>18:00</option>
<option>18:30</option>
<option>19:00</option>
<option>19:30</option>
<option>20:00</option>
<option>20:30</option>
<option>21:00</option>
<option>21:30</option>
<option>22:00</option>
<option>22:30</option>
<option>23:00</option>
<option>23:30</option>
</select>
</td>
</tr>
<tr>
<td colspan="1">
<span class="display_txt">Description</span>
</td>
<td colspan="3">
<textarea class="textinput" name="description" id="description" cols="50" rows="8"></textarea>
</td>
</tr>
<tr>
<td>
<span class="display_txt"># Normal seats</span>
</td>
<td>
<input class="textinput" name="normal" id="normal" type="text" size="25" value="<?php echo DEFAULT_NORMAL;?>" />
</td>
<td>
<span class="display_txt">Price &euro;</span>
</td>
<td>
<input class="textinput" name="normal_price" id="normal_price" type="text" size="25" value="<?php echo DEFAULT_NORMAL_PRICE;?>"/>
</td>
</tr>
<tr>
<td>
<span class="display_txt"># Premium seats</span>
</td>
<td>
<input class="textinput" name="premium" id="premium" type="text" size="25" value="<?php echo DEFAULT_PREMIUM;?>"/>
</td>
<td>
<span class="display_txt">Price &euro;</span>
</td>
<td>
<input class="textinput" name="premium_price" id="premium_price" type="text" size="25" value="<?php echo DEFAULT_PREMIUM_PRICE;?>"/>
</td>
</tr>
</table>
<input class="submit" name="reset" id="reset" type="reset" />
<input class="submit" name="submit" id="submit" type="submit" value="Add"/>
</form>
<?php	
	}
	showFooter();
}






?>