<?php

include BASE_PATH."/views/common.php";

function display($result) {
	showHeader(INDEX);
	echo 'welcome '.$_SESSION['user'];
	showFooter();
}

?>