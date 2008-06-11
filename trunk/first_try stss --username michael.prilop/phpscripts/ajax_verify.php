<?php

// include field validation methods
include $_SERVER['DOCUMENT_ROOT']."includes/authenticate.php";

define("VALID", "<img src=\"/images/check.gif\" />");
define("INVALID", "<img src=\"/images/x.gif\" />");

$response = INVALID;

if (isset($_REQUEST['entered']) && $_REQUEST['entered'] != '') {
	if (isset($_REQUEST['field']) && $_REQUEST['field'] != '') {
		switch($_REQUEST['field']) {
		case 'email':
			if (verifyEmail($_REQUEST['entered'])) {			
				$response = VALID;
			}
		break;
		case 'username':
			if (verifyUser($_REQUEST['entered'])) {
				$response = VALID;
			}
		break;
		case 'password':
		case 'password1':
		case 'password2':
			if (verifyPassword($_REQUEST['entered'])) {
				$response = VALID;
			}
		break;
		default:
			$response = VALID;
		break;
		}
	}
}

echo $response;
?>