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
  case EVENTS:
		return "Events";
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
	case PURCHASES:
		return "Purchases";
	break;
	case USERNAME_INVALID:
		return "Invalid Email";
	break;
	case PASSWORD_INVALID:
		return "Invalid Password";
	break;
	case PASSWORD_MISMATCH:
		return "Passwords do not match.";
	break;
	case PASSWORD_BLANK:
		return "Cannot have a blank password.";
	break;
	case USERNAME_BLANK:
		return "Cannot have a blank Email.";
	break;
	case FIRSTNAME_BLANK:
		return "Cannot have a blank First Name.";
	break;
	case LASTNAME_BLANK:
		return "Cannot have a blank Last Name.";
	break;
	case USER_EXISTS:
		return "Email already exists in database.";
	break;
	case QUERY_INVALID:
		return "Invalid query!";
	break;
	case USER_NOT_FOUND:
		return "Username/password combination not found in database.";
	break;
	case SEATS_INVALID:
		return "Please enter a valid number of seats.";
	break;
	case PRICE_INVALID:
		return "Please enter a valid price.";
	break;
	case DATE_INVALID:
		return "Please enter a valid date.";
	break;
	case FILE_NOT_FOUND:
		return "File(s) not found";
	break;
	case NO_ACCESS:
		return "You do not have the required access level!";
	break;
	case DB_ERROR:
		return "A Database ERROR occured. Please contact Systemadministrator.";
	break;
	case NOT_ENOUGH_SEATS:
		return "There are not enough Seats to fullfil your purchase.";
	break;
	case CART_EMPTY:
		return "Your cart is empty.";
	break;
	case VIEW_CART:
		return "View Cart";
	break;
	case MISSING_EVENTID:
		return "Please specify an Event ID!";
	break;
	case CREDITCARD_INVALID:
		return "Your Credit Card Information is not valid!";
	break;
	default:
		return "IMPLEMENT ME: ".$desiredString;
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