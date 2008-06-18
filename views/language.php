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
			return "Welcome";
			break;
		case EVENTS:
			return "Events";
			break;
		case LOGIN:
			return "Login";
			break;
		case JOIN:
			return "Signup";
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
		case NAME_INVALID:
			return "Please specify a Event Name";
			break;
		default:
			return "IMPLEMENT ME: ".$desiredString;
			break;
	}
}

function getGermanString($desiredString) {
	// see config.php for list of all defined strings.
	switch($desiredString) {
		case INDEX:
			return "Willkommen";
			break;
		case EVENTS:
			return "Veranstaltungen";
			break;
		case LOGIN:
			return "Login";
			break;
		case JOIN:
			return "Registrieren";
			break;
		case ADMIN:
			return "Admin";
			break;
		case USERNAME:
			return "Benutzername";
			break;
		case PASSWORD:
			return "Password";
			break;
		case LOGOUT:
			return "Ausloggen";
			break;
		case PURCHASES:
			return "Einkäufe";
			break;
		case USERNAME_INVALID:
			return "Ungültige Email-Adresse.";
			break;
		case PASSWORD_INVALID:
			return "Ungültiges Password.";
			break;
		case PASSWORD_MISMATCH:
			return "Passwörter stimmen nicht überein.";
			break;
		case PASSWORD_BLANK:
			return "Passwort darf nicht leer sein.";
			break;
		case USERNAME_BLANK:
			return "Email darf nicht leer sein.";
			break;
		case FIRSTNAME_BLANK:
			return "Vorname darf nicht leer sein.";
			break;
		case LASTNAME_BLANK:
			return "Nachname darf nicht leer sein.";
			break;
		case USER_EXISTS:
			return "Email-Adresse existiert bereits.";
			break;
		case QUERY_INVALID:
			return "Ungültige Anfrage!";
			break;
		case USER_NOT_FOUND:
			return "Benutzername/Passwort Kombination nicht registriert.";
			break;
		case SEATS_INVALID:
			return "Bitte geben Sie eine gültige Anzahl Sitze an.";
			break;
		case PRICE_INVALID:
			return "Bitte geben Sie einen gültigen Preis an.";
			break;
		case DATE_INVALID:
			return "Bitte geben Sie ein gültiges Datum an.";
			break;
		case FILE_NOT_FOUND:
			return "Datei(en) nicht gefunden";
			break;
		case NO_ACCESS:
			return "Sie haben nicht die notwendigen Zugriffsrechte!";
			break;
		case DB_ERROR:
			return "Ein Datenbankfehler ist aufgetreten! Bitte informieren Sie den Systemadministrator";
			break;
		case NOT_ENOUGH_SEATS:
			return "Es sind leider nichtmehr genügen Sitze verfügbar.";
			break;
		case CART_EMPTY:
			return "Der Einkaufswagen ist leer.";
			break;
		case VIEW_CART:
			return "Einkaufswagen";
			break;
		case MISSING_EVENTID:
			return "Bitte geben Sie eine Event-ID an!";
			break;
		case CREDITCARD_INVALID:
			return "Ihre Kreditkartendaten sind nicht gültig!";
			break;
		case NAME_INVALID:
			return "Bitte geben Sie einen Eventnamen an!";
			break;
		default:
			return "IMPLEMENTIERE MICH: ".$desiredString;
			break;
	}
}

?>