<?php
function authNO() {
	return true;
}

function authMoreUser() {
	//check if pwd_tmp is the same as in db
	$pwd_tmp = $_SESSION['pwd_tmp'];
	
	//TODO: really make sure user is authenticated - maybe by setting a temp. password and checking against db
	return authUser();
}

function authUser() {
	return $_SESSION['login'];
}

function authAdmin() {
	//TODO: make authAdmin a bit mor secure - check for ip=userIP or a set temporary pwd
	return ($_SESSION['login'] && $_SESSION['admin']);
}

/****************************
 * authenticateUser 
 *
 * verify the username and password combo from the database.
 * returns true if the user and password combo were
 ****************************/
function authenticateUser($loginName, $pass, &$setUserID, &$admin, &$setUserEmail) {
	
	if (!isset($loginName) || !isset($pass)) {
		return false;
	}
  
	$setUserID = '';
	$setUserEmail = '';
	$admin = '';
	
	$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		return false;
	}
	
	$digest = sha1($pass);
	  
	if (is_numeric($loginName)) {
		//look for userID in DB
		$selectUser = 'user.userID = ?';
	} else {
		//look for email in DB
		$selectUser = 'user.email = ?';
	}
    

	// Using SQL injection protection.
	$sql_query = "SELECT user.userID, user.email, user.role, pwd.pwdHash, pwd.salt
                      FROM user , pwd
                      WHERE user.userID = pwd.userID AND ".$selectUser;

	
	if ($stmt = $db_handle->prepare($sql_query)) {
		$stmt->bind_param('s', $loginName);
		$stmt->execute();
		$stmt->bind_result($userID, $userEmail, $isAdmin, $pwdHash, $salt);
		$stmt->fetch();
		
		//&& $pwdHash == sha1($pass.$salt)
		if ($userEmail != '' && $pwdHash == sha1($pass.$salt)) {
			$setUserID = $userID;
			$setUserEmail = $userEmail;
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
	return eregi("^[a-z0-9]{6}[a-z0-9]*$", $pass);
}

function verifyDate($date) {
	return eregi("^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{1,2}:[0-9]{2}$", $date);
}

/*
 * Generates a random salt of length 40
 */
function genSalt(){
   srand((double)microtime()*1000000);
  $random = rand();
  $salt = sha1($random);
  return($salt);
} 
?>

