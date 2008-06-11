<?php
require $_SERVER['DOCUMENT_ROOT']."includes/common.php";

if (isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {

	if ($_POST['password1'] <> $_POST['password2']) {
		errRedirect("/join.php", "Passwords do not match!");
	}
	
	if ($_POST['password1'] == '') {
		errRedirect("/join.php", "Cannot have a blank password!");
	}
	
	if ($_POST['username'] == '') {
		errRedirect("/join.php", "Cannot have a blank username!");
	}
	
	$user = $_POST['username'];
	if (!verifyUser($user)) {
		errRedirect("/join.php", "Invalid User Name!");
	}
	
	if (!verifyPassword($_POST['password1'])) {
		errRedirect("/join.php", "Invalid Password!");
	}
	
	require $_SERVER['DOCUMENT_ROOT']."includes/db.inc";
	$db_handle = @ new mysqli($db_host, $db_user, $db_pass, 'users');
	
	if (mysqli_connect_errno()) {	
		trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
		errRedirect("/join.php");
	}
	
	$digest = sha1($_POST['password1']);
	$user = strip_tags($user);
	$user = addslashes($user);
	
	// Using SQL injection protection.
	$sql_query = "SELECT * FROM users.accounts WHERE username = ?";
	
	if ($stmt = $db_handle->prepare($sql_query)) {
		$stmt->bind_param('s', $user);
		$stmt->execute();
		$stmt->store_result();
		$stmt->fetch();
		
		if ($stmt->num_rows == 0) {
			
			// if name does not exist in database, add user.
			$sql_query = "INSERT INTO users.accounts (username, password) VALUES ( ?, ?)";
			
			if ($stmt2 = $db_handle->prepare($sql_query)) {
				$stmt2->bind_param('ss', $user, $digest);
				$stmt2->execute();
				$stmt2->store_result();
				$stmt2->fetch();
				
				$stmt2->close();
				
				login($_POST['username'], $_SERVER["REMOTE_ADDR"]);
			} else {
				trigger_error("Invalid INSERT query.", E_USER_ERROR);
			}
		} else {
			errRedirect("/join.php", "Username already exists in database.");
		}
		$stmt->close();
	} else {
		trigger_error("Invalid SELECT query.", E_USER_ERROR);
	}
	$db_handle->close();
	header("Location: /index.php");
} else {
	errRedirect("/join.php", "Please fill in all fields");
}
?>
