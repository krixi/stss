<?php
require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

if (isset($_REQUEST['title']) && isset($_REQUEST['content'])) {
	
	if ($_REQUEST['title'] == '') {
		errRedirect("/admin.php", "Please enter a title.");
	}
	
	if ($_REQUEST['content'] == '') {
		errRedirect("/admin.php", "Please enter content.");
	}
	
	require $_SERVER['DOCUMENT_ROOT']."includes/db.inc";
	
	$db_handle = @ new mysqli($db_host, $db_user, $db_pass, 'users');
	
	if (mysqli_connect_errno()) {
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		errRedirect("/admin.php");
	}
	
	$title = strip_tags($_REQUEST['title']);
	$title = addslashes($title);
	
	$content = strip_tags($_REQUEST['content']);
	$content = addslashes($content);
	
	if (!$db_handle->query("LOCK TABLES news WRITE")) {
		errRedirect("/admin.php", "Lock query failed");
	}
	
	$sql_query = "INSERT INTO news (title, content, dateCreated, creatorId) VALUES ('{$title}', '{$content}', NOW() , '".$_SESSION['userID']."')";
	
	if ($db_handle->query($sql_query)) {
		showMessage("Added new article");
	} else {
		trigger_error("Insert query failed", E_USER_WARNING);
	}
	
	if (!$db_handle->query("UNLOCK TABLES")) {
		errRedirect("/admin.php", "Unlock query failed");
	}
	
	$db_handle->close();
	
	header("Location: /index.php");
} else {
	errRedirect("/admin.php", "Please fill in all form fields.");
}
?>