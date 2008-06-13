<?php

include BASE_PATH."/views/common.php";

function display($data) {
	showHeader(JOIN);
	//output here page content generated out of results storend
	//in array $data
	if ($data['added'] == true) {
		printf("Welcome %s %s.<br />\n", $data['f_name'], $data['l_name']);
		printf("You may now log in using the email you specified: %s<br />\n", $data['email']);
		printf("or your generated user ID: %s<br />\n", $data['userID']);
	} else {
		// If they attempted to join, display any error messages
		if (isset($data['errors'])) {
			foreach ($data['errors'] as $error) {
				printf("<span class=\"error\">%s</span>\n", getString($error));
			}
		}
?>
<!--<script type="text/javascript" src="<?php echo BASE_PATH; ?>/views/javascripts/verify.js" ></script>
<script type="text/javascript" src="<?php echo BASE_PATH; ?>/views/javascripts/ajax_verify.js"> </script>-->
<form id="input_form" action="index.php?module=user&action=join" method="post" name="joinForm" onsubmit="return verifyForm(document.joinForm);">
<table>
<tr>
<td>
<span class="display_txt">First Name:</span>
</td>
<td>
<input class="textinput" id="f_name" name="f_name" type="text" 
size="30" onkeyup="ajax_verify(this);" <?php if (isset($data['f_name'])) printf("value=\"%s\"", $data['f_name']);?> />
</td>
<td>
<span class="error" id="f_nameDisplay"></span>
</td>
</tr>
<tr>
<td>
<span class="display_txt">Last Name:</span>
</td>
<td>
<input class="textinput" id="l_name" name="l_name" type="text" 
size="30" onkeyup="ajax_verify(this);" <?php if (isset($data['l_name'])) printf("value=\"%s\"", $data['l_name']);?> />
</td>
<td>
<span class="error" id="l_nameDisplay"></span>
</td>
</tr>
<tr>
<td>
<span class="display_txt">Email:</span>
</td>
<td>
<input class="textinput" id="email" name="email" type="text" 
size="30" onkeyup="ajax_verify(this);" <?php if (isset($data['email'])) printf("value=\"%s\"", $data['email']);?> />
</td>
<td>
<span class="error" id="emailDisplay"></span>
</td>
</tr>
<tr>
<td>
<span class="display_txt">Password:</span>
</td>
<td>
<input class="textinput" id="password1" name="password1" type="password" size="30" onkeyup="ajax_verify(this);" />
</td>
<td>
<span class="error" id="password1Display"></span>
</td>
</tr>
<tr>
<td>
<span class="display_txt">Verify Password:</span>
</td>
<td>
<input class="textinput" id="password2" name="password2" type="password" size="30" onkeyup="ajax_verify(this);" />
</td>
<td>
<span class="error" id="password2Display"></span>
</td>
</tr>
<tr>
<td colspan="2">
<input id="submit" class="submit" name="submit" type="submit" value="Submit" />
<input id="reset" class="submit" name="reset" type="reset" value="Reset" />
</td>
</tr>
</table>
<script type="text/javascript">
	document.joinForm.email.isMandatory = true;
	document.joinForm.f_name.isMandatory = true;
	document.joinForm.l_name.isMandatory = true;
	document.joinForm.password1.isMandatory = true;
	document.joinForm.password2.isMandatory = true;
	document.joinForm.email.isEmail = true;
	document.joinForm.email.description = "E-Mail address";
	document.joinForm.f_name.description = "First Name";
	document.joinForm.l_name.description = "Last Name";
	document.joinForm.password1.description = "Password";
	document.joinForm.password2.description = "Verify Password";
</script>
</form>
<?php
	}
	showFooter();
}
?>