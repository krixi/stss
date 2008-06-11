<?php
require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

$response = "Invalid request";
if (isset($_REQUEST['value']) && isset($_REQUEST['type']) && isset($_REQUEST['id']) && $_SESSION['login'] && $_SESSION['admin']) {
	
	require $_SERVER['DOCUMENT_ROOT']."includes/db.inc";

	$db_handle = @ new mysqli($db_host, $db_user, $db_pass, 'users');
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: ".mysqli_connect_error(), E_USER_ERROR);
		echo $response;
		exit;
	}	
	
	$response = strip_tags($_REQUEST['value']);
	$response = addslashes($response);
	
	
	$sql_query = "UPDATE users.news SET ".$_REQUEST['type']."='".$response."', dateCreated=NOW()  WHERE news.id=".$_REQUEST['id']." LIMIT 1";
	
	if ($db_handle->query($sql_query)) {
		showMessage("Database updated.");
	} else {
		trigger_error("Database not updated!");
	}
	$db_handle->close();
}
$response .= $_SESSION['user'];
echo $response;

?>
