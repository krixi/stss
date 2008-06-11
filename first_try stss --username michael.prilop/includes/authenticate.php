<?php

// Timeout in minutes
define("USER_TIMEOUT", 5);

// Function to prevent session hijacking
function sessionAuthenticate() {

	if (isset($_SESSION['login'])) {
		if ($_SESSION['login'] == false) {
			$_SESSION['admin'] = false;
			return true;
		} 
		// Else, login == true:
		
		// Check they are still the same user as before.
		if (!isset($_SESSION['user'])) {
			trigger_error("You do not have a recorded username.", E_USER_ERROR);
			return false;
		}
		
		if (!isset($_SESSION['userIP'])) {
			trigger_error("You do not have a recorded IP address.", E_USER_ERROR);
			return false;
		}
		
		if ($_SESSION['userIP'] != $_SERVER["REMOTE_ADDR"]) {
			trigger_error("Error: YourIP has changed since you logged in. Old: "
				.$_SESSION['userIP'].", new: ".$_SERVER['REMOTE_ADDR']."<br />\n", E_USER_ERROR);
			return false;
		}
		
		// check for timeout
		// must multiply number of minutes by 60 because time() returns seconds.
		if ((time() - $_SESSION['lastActivity']) > (USER_TIMEOUT * 60)) {
			// timer expired
			trigger_error("You have been logged out due to ". USER_TIMEOUT ." minutes of inactivity.");
			return false;
		} 
		
		// timer still valid
		$_SESSION['lastActivity'] = time();
		
		return true;
	} else { 
		$_SESSION['login'] = false;
		$_SESSION['admin'] = false;
		return true;
	}
}

/****************************
 * authenticateUser 
 *
 * verify the username and password combo from the database.
 * returns true if the user and password combo were
 ****************************/
function authenticateUser($user, $pass) {
	
	if (!isset($user) || !isset($pass)) {
		return false;
	}
	
	require $_SERVER['DOCUMENT_ROOT']."/includes/db.inc";
	
	$db_handle = @ new mysqli($db_host, $db_user, $db_pass, 'users');
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}
	
	$digest = sha1($pass);
		
	// Using SQL injection protection.
	$sql_query = "SELECT admin, id FROM users.accounts WHERE username = ? AND password = ?";
	
	if ($stmt = $db_handle->prepare($sql_query)) {
		$stmt->bind_param('ss', $user, $digest);
		$stmt->execute();
		$stmt->bind_result($isAdmin, $id);
		$stmt->fetch();
		
		if ($id != '') {
			$_SESSION['userID'] = $id;
			if ($isAdmin == '1') {
				$_SESSION['admin'] = true;
				showMessage("Admin Access Granted");
			}
		} else {
			return false;
		}
		
		$stmt->free_result();
		$stmt->close();
	} else {
		trigger_error("Invalid query.");
		return false;
	}
	$db_handle->close();
	return true;
}


/****************************
function: verify username

uses regular expressions to verify the user's input.
returns true if the string matched and false if not.
****************************/
function verifyUser($username) {
	return eregi("^[a-z0-9]+(_?[a-z0-9]+)*$", $username);
}

/****************************
function: verify email

uses regular expressions to verify the user's input.
returns true if the string matched and false if not.
****************************/
function verifyEmail($email) {
//TODO: add underscores, etc...
	return eregi("^[a-z0-9]+(\.[a-z0-9]+)*@[a-z0-9]+(\.[a-z0-9]+)+$", $email);
}

function verifyPassword($pass) {
	return eregi("^[a-z0-9]{4}[a-z0-9]*$", $pass);
}
?>