<?php


session_start();

require_once('config.php');
require_once('includes/auth.php');

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


/*
 * Initialize session variables to be freely used by included pages without generating notices.
 * Defined here so it may be used by logout.model
 * 
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

// initialize file paths to be used for requested action
$actionFile = BASE_PATH.'/modules/'.$module.'/'.$action.'.model.php';
//select View based on action and language settings
$viewFile = BASE_PATH.'/views/'.$_SESSION['lang'].'/'.$module.'/'.$action.'.view.php';
   
//including model and view functions
if (file_exists($actionFile)) {
	include($actionFile);
	
	if (file_exists($viewFile)) {
		include($viewFile);
		
		//check if authenticated
		if (authenticate()) {
		
			//let the model do the work
			$result = work();
			
			//display the results
			display($result);
		
		} else {
			die("You do not have access to the requested page!");
		}
	} else {
		die("Could not find: $viewFile");
	}
} else {
	die("Could not find: $actionFile");        
}
?>
