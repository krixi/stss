<?php

/********************
handleErrors

Custom error handler for the entire php site. Logs
********************/

define("LOG_DIR", "log");
define("LOG_EXTENSION", ".txt");

function handleErrors($number, $string, $file, $line, $context) {
	switch ($number) {
		case E_WARNING:
			error_log(date("r")."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/warning".LOG_EXTENSION);
			error_log($string."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/warning".LOG_EXTENSION);
			error_log("File: ".$file."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/warning".LOG_EXTENSION);
			error_log("Line: ".$line."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/warning".LOG_EXTENSION);
		break;
		case E_ERROR:
			error_log(date("r")."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/err".LOG_EXTENSION);
			error_log($string."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/err".LOG_EXTENSION);
			error_log("File: ".$file."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/err".LOG_EXTENSION);
			error_log("Line: ".$line."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/err".LOG_EXTENSION);
		break;
		case E_USER_ERROR:
			error_log(date("r")."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/user_err".LOG_EXTENSION);
			error_log($string . "\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/user_err".LOG_EXTENSION);
			error_log("User: ".$_SESSION['user']."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/user_err".LOG_EXTENSION);
			error_log("UserIP: ".$_SESSION['userIP']."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/user_err".LOG_EXTENSION);
			error_log("is Admin: ".$_SESSION['admin']."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/user_err".LOG_EXTENSION);
			$_SESSION['errMessage'] .= "Sorry, an internal error occurred.<br />\n";
			break;
		case E_USER_WARNING:
		case E_USER_NOTICE:
			$_SESSION['errMessage'] .= $string."<br />\n";
			break;
		break;
		default:
			error_log(date("r")."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/other_err".LOG_EXTENSION);
			error_log($string."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/other_err".LOG_EXTENSION);
			error_log("File: ".$file."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/other_err".LOG_EXTENSION);
			error_log("Line: ".$line."\n", 3, $_SERVER["DOCUMENT_ROOT"].LOG_DIR."/other_err".LOG_EXTENSION);
		break;
	}
}


/********************
errRedirect

Requires a location to redirect to, and optionally an
error message.
********************/
function errRedirect($location, $errorMessage = '') {
	if ($errorMessage != '') {
		trigger_error($errorMessage);
	}
	
	header("Location: ".$location);
	exit;
}
?>