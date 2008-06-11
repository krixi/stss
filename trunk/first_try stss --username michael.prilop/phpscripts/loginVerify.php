<?php
require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

if (authenticateUser($_POST['username'], $_POST['password'])) {
	login($_POST['username'], $_SERVER['REMOTE_ADDR']);
	header("Location: /index.php");
	exit;
} else {
	errRedirect("/index.php", "Invalid username or password!");
}

?>
