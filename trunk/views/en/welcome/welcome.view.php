<?php

include BASE_PATH."/views/common.php";

function display($result) {
	showHeader(INDEX);
	echo 'welcome';
	echo $result['isAdmin'];
	showFooter();
}

?>