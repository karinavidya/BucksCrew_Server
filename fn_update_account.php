<?php
 
/*
 * Following code will update a user account information
 * A user account is identified by user id (userID)
 */
 
// array for JSON response
$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();
 
// check for valid ID
if (isset($_POST['userID'])) {
    $accUserID = $_POST['userID'];
	$result = mysql_query("SELECT * FROM dbAccount WHERE userID = '$accUserID'") or die(mysql_error("Database connect - unsuccessful"));
	
	if (mysql_num_rows($result) == 1) {
	
		// check if public Name is adjusted
		if (isset($_POST['publicName'])) {
			$accPublicName = $_POST['publicName'];
			// mysql update row with matched userID
			$result = mysql_query("UPDATE dbAccount SET publicName = '$accPublicName' WHERE userID = $accUserID");
		 
			// check if row inserted or not
			if ($result) {
				// successfully updated
				$response["success"] = 1;
				$response["message"] = "User account successfully updated.";
			} else {
				$response["success"] = 0;
				$response["message"] = "Update failed. Please try again.";
			}
		} 

		// check if email address is adjusted		
		if (isset($_POST['accountEmailAddress'])) {
			$accEmailAddress = $_POST['accountEmailAddress'];
			// mysql update row with matched userID
			$result = mysql_query("UPDATE dbAccount SET accountEmailAddress = '$accEmailAddress' WHERE userID = $accUserID");
		 
			// check if row inserted or not
			if ($result) {
				// successfully updated
				$response["success"] = 1;
				$response["message"] = "User account successfully updated.";
			} else {
				$response["success"] = 0;
				$response["message"] = "Update failed. Please try again.";
			}
		} 

		// check if password is adjusted		
		if (isset($_POST['password'])) {
			$accPassword = $_POST['password'];
			// mysql update row with matched userID
			$result = mysql_query("UPDATE dbAccount SET password = '$accPassword' WHERE userID = $accUserID");
		 
			// check if row inserted or not
			if ($result) {
				// successfully updated
				$response["success"] = 1;
				$response["message"] = "User account successfully updated.";
			} else {
				$response["success"] = 0;
				$response["message"] = "Update failed. Please try again.";
			}
		} 
		
		if (!isset($_POST['publicName']) && !isset($_POST['password']) && !isset($_POST['accountEmailAddress']))  {
			// required field is missing
			$response["success"] = 0;
			$response["message"] = "Required field(s) is missing";
		}
	} else {
		// wrong userID
	    $response["success"] = 0;
        $response["message"] = "Invalid user";
	}
} else {
    // wrong account
    $response["success"] = 0;
    $response["message"] = "No users found";
}

// echoing JSON response
echo json_encode($response);

?>