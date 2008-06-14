<?php


session_start();

require_once('config.php');
require_once('includes/auth.php');
require_once('views/common.php');
require_once('includes/ticket.class.php');


/*
 * Initialize session variables to be freely used by included pages without generating notices.
 * Defined here so it may be used by logout.model
 */
function initSession() {
	$_SESSION['login'] = false;
	$_SESSION['admin'] = false;
	$_SESSION['lang'] = LANGUAGE_DEFAULT;
}
  
//Initialize session if not done so already
if (!isset($_SESSION['login'])) {
	initSession();
}

if (isset($_GET['module'])) {
	$module = $_GET['module'];
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	} else {
		$action = DEFAULT_ACTION;
	}
} else {
	$module = DEFAULT_MODULE;
	$action = DEFAULT_ACTION;
}

// initialize file paths to be used for requested action
$actionFile = BASE_PATH.'/modules/'.$module.'/'.$action.'.model.php';
//select View based on action and language settings
$viewFile = BASE_PATH.'/views/'.$_SESSION['lang'].'/'.$module.'/'.$action.'.view.php';

// assume true, set to false if encounter error
$verified = true;
$errors = array();

//including model and view functions
if (file_exists($actionFile)) {
	include($actionFile);
} else {
	$verified = false;
	$errors[] = FILE_NOT_FOUND;
	
}
	
	
if (file_exists($viewFile)) {
	include($viewFile);
} else {
	$verified = false;
	$errors[] = FILE_NOT_FOUND;
}
	

if ($verified) {
	//check if authenticated, included from model
	if (authenticate()) {
		
		//let the model do the work
		$result = work();
		
		//display the results with the view
		display($result);
	} else {
		$verified = false;
		$errors [] = NO_ACCESS;
	}
}

// Display the error messages to the user
if (!$verified) {
	showHeader(INDEX);
	foreach ($errors as $msg) {
		printf("<span class=\"error\">%s%s</span>\n", getString($msg), ($msg == FILE_NOT_FOUND) ? ": ".$module.", ".$action : "");
	}
	showFooter();
}
?>
