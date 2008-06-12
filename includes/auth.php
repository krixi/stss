<?php
function authNO() {
	return true;
}

/****************************
 * authenticateUser 
 *
 * verify the username and password combo from the database.
 * returns true if the user and password combo were
 ****************************/
function authenticateUser($user, $pass, &$userID, &$admin) {
	
	if (!isset($user) || !isset($pass)) {
		return false;
	}
	
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, 'users');
	
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
			$userID = $id;
			if ($isAdmin == '1') {
				$admin = true;
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

