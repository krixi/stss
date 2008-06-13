<?php


function authenticate () {
  //implement your own or call either
	return authNO();
  //or
  //authUser();
  //defined in Framework
}

function work() {
	$result = array();
	
	$result['added'] = false;
	
	if (isset($_POST['l_name']) && isset($_POST['f_name']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['email'])) {
		// assume true, and then turn to false if an error occurs.
		$result['verified'] = true;
		$result['errors'] = array();
		
		if ($_POST['password1'] <> $_POST['password2']) {
			$result['verified'] = false;
			$result['errors'][] = PASSWORD_MISMATCH;
		}
		
		if ($_POST['password1'] == '') {
			$result['verified'] = false;	
			$result['errors'][] = PASSWORD_BLANK;
		}
		
		if ($_POST['email'] == '') {
			$result['verified'] = false;	
			$result['errors'][] = USERNAME_BLANK;
		}
		
		if ($_POST['f_name'] == '') {
			$result['verified'] = false;	
			$result['errors'][] = FIRSTNAME_BLANK;
		} else {
			$result['f_name'] = $_POST['f_name'];
		}
		
		if ($_POST['l_name'] == '') {
			$result['verified'] = false;	
			$result['errors'][] = LASTNAME_BLANK;
		} else {
			$result['l_name'] = $_POST['l_name'];
		}
		
		$email = $_POST['email'];
		if (!verifyEmail($email)) {
			$result['verified'] = false;	
			$result['errors'][] = USERNAME_INVALID;
		} else {
			$result['email'] = $email;
		}
		
		if (!verifyPassword($_POST['password1'])) {
			$result['verified'] = false;	
			$result['errors'][] = PASSWORD_INVALID;
		}
		
		$db_handle = @ new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		if (mysqli_connect_errno()) {	
			trigger_error("Connection failed: " . mysqli_connect_error(), E_USER_ERROR);
			return $result; // stop execution.
		}
		
		// If anything was invalid, return and display the errors.
		if (!$result['verified']) {
			return $result;
		}
		
		$digest = sha1($_POST['password1']);
			
		$sql_query = "SELECT * FROM User WHERE email = '".$email."'";
		if ($check_result = $db_handle->query($sql_query)) {
		
			if ($check_result->num_rows == 0) {
				
				$sql_adduser = "INSERT INTO User (email, firstname, lastname, role, lastlogin) VALUES ('".
					$email."', '".$_POST['f_name']."', '".$_POST['l_name']."', '0', NOW( ));";
				
				if ($add_user_result = $db_handle->query($sql_adduser)) {
				
					if ($db_handle->affected_rows == 1) {
						
						$sql_query = "SELECT userID FROM User WHERE email = '".$email."'";
						
						if ($get_id_result = $db_handle->query($sql_query)) {
							
							if ($get_id_result->num_rows == 1) {
								$row = $get_id_result->fetch_array(MYSQLI_ASSOC);
								
								$result['userID'] = $row['userID'];
								
								$sql_addpass = "INSERT INTO pwd (userID, pwdHash) VALUES ('".$row['userID']."', '".$digest."');";
								
								if ($add_pass_result = $db_handle->query($sql_addpass)) {
									if ($db_handle->affected_rows == 1) {
										
										// Database entry was successful.
										$result['added'] = true;
									}
								}
							}
						}
					}
				}
			} else {
				$result['verified'] = false;	
				$result['errors'][] = USER_EXISTS;
			}
		}
		
		// If it didn't reach the part that sets added to true, then don't redirect to the index in the display
		if (!$result['added']) {
			$result['errors'][] = QUERY_INVALID;
		}
		$db_handle->close();
	}
	
	return $result;
}
?>