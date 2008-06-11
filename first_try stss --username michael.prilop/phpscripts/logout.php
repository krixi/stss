<?php

// Begin the session on every page
session_start();

$errorMessage = '';
$message = '';

if (isset($_SESSION['errMessage'])) {
	$errorMessage = $_SESSION['errMessage'];
}
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
}

// End the session.
session_destroy();


// start a new session to maintain the error message.
session_start();
session_regenerate_id();

if ($errorMessage != '') {
	 $_SESSION['errMessage'] = $errorMessage;
}

if ($message != '') {
	 $_SESSION['message'] = $message;
}

header("Location: /index.php");
?>