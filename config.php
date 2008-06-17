<?php
/**
* config.php
*
* configure all global constants here only
*
* @author Michael Prilop
*/
// Set to true for debugging
define("DEBUG", true);


// Timeout in minutes
define("USER_TIMEOUT", 5);



// Default module/action if none specified
define("DEFAULT_MODULE", "welcome");
define("DEFAULT_ACTION", "welcome");



// AVAILABLE LANGUAGES 
// - also corresponds to directoy in which language files are stored.
define("ENGLISH", "en");
define("GERMAN", "de");
/**
* LANGUAGE_DEFAULT
*
* Define default language
*
* @author Michael Prilop
* @global string LANGUAGE_DEFAULT default language
*/
define('LANGUAGE_DEFAULT', ENGLISH);


/**
* BASE_PATH
*
* Dynamically figure out where in the filesystem we are located.
*
* @author Michael Prilop
* @global string BASE_PATH Absolute path to our framework
*/
//just in case its a windows system
$base_path = str_replace('\\','/',dirname(__FILE__));
define('BASE_PATH',$base_path);


// Database connection info.
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "admin");
define("DB_NAME", "stss");

// Defaults for adding a new event
define("DEFAULT_NORMAL", 5);
define("DEFAULT_PREMIUM", 5);
define("DEFAULT_NORMAL_PRICE", 10);
define("DEFAULT_PREMIUM_PRICE", 20);


// Constants to represent strings which need displaying in multiple languages,
// Used when calling getString() in language.php and showHeader/endHeader from common.php
define("INDEX", 1);
define("LOGIN", 2);
define("JOIN", 3);
define("ADMIN", 4);
define("USERNAME", 5);
define("PASSWORD", 6);
define("LOGOUT", 7);
define("EVENTS", 18);
define("VIEW_CART", 27);
define("PURCHASES", 29);

// Define error message strings
define("USERNAME_INVALID", 8);
define("PASSWORD_INVALID", 9);
define("PASSWORD_MISMATCH", 10);
define("PASSWORD_BLANK", 11);
define("USERNAME_BLANK", 12);
define("USER_EXISTS", 13);
define("QUERY_INVALID", 14);
define("FIRSTNAME_BLANK", 15);
define("LASTNAME_BLANK", 16);
define("USER_NOT_FOUND", 17);
define("SEATS_INVALID", 19);
define("PRICE_INVALID", 20);
define("DATE_INVALID", 21);
define("FILE_NOT_FOUND", 22);
define("NO_ACCESS", 23);
define("DB_ERROR", 24);
define("NOT_ENOUGH_SEATS", 25);
define("CART_EMPTY", 26);
define("MISSING_EVENTID", 28);
?>
