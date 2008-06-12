<?php


function getString($desiredString) {
	switch ($_SESSION['lang']) {
	case GERMAN:
		return getGermanString($desiredString);
	break;
	case ENGLISH: // fall through to default to english.
	default:
		return getEnglishString($desiredString);
	break;
	}
}


function getEnglishString($desiredString) {
	// see config.php for list of all defined strings.
	switch($desiredString) {
	case INDEX:
		return "Index";
	break;
	case LOGIN:
		return "Login";
	break;
	case JOIN:
		return "Join";
	break;
	case ADMIN:
		return "Admin";
	break;
	case USERNAME:
		return "Username";
	break;
	case PASSWORD:
		return "Password";
	break;
	case LOGOUT:
		return "Logout";
	break;
	default:
		return "IMPLEMENT ME";
	break;
	}
}

function getGermanString($desiredString) {
	// see config.php for list of all defined strings.
	/*switch($desiredString) {
	case INDEX:
		return "Index";
	break;
	case LOGIN:
		return "Login";
	break;
	case JOIN:
		return "Join";
	break;
	default:
		return "Invalid Desired String";
	break;
	}*/
	return "Guten Tag";
}

?>