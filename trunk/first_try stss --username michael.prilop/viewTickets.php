<?php
require "includes/common.php";

beginHeader();
?>
<script src="/scriptaculous/lib/prototype.js" type="text/javascript"></script>
<script src="/scriptaculous/src/scriptaculous.js" type="text/javascript"></script>
<?php
endHeader("View Tickets");
?>
<h1 id="eip">Implement me</h1>
<script type="text/javascript">
	new Ajax.InPlaceEditor($('eip'), 'javascript:saveText("eip")', {
		ajaxOptions: {method: 'get'}
	});
</script>
<div class="hiddenedit">
<form action="" >
<input type="text" name="asdf" value="FAKE FIELD" />
</form>
</div>
<?php
showFooter();
?>