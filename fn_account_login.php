<?php
 
/*
 * Following code will verify login details of an account
 * Username and password is required for authentication
 * and the username will be returned for valid login credentials
 */

$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();

if (isset($_POST['privateName']) && isset($_POST['password'])) {
    $accPrivName = mysql_real_escape_string($_POST['privateName']);
    $accPasswd = mysql_real_escape_string($_POST['password']);
	
    $result = mysql_query("SELECT * from dbAccount WHERE privateName='$accPrivName' and password='$accPasswd'") or die(mysql_error("Database connect - unsuccessful"));

    if (!empty($result)) {

        if (mysql_num_rows($result) == 1) {

		    $row = mysql_fetch_array($result);
            
            $response["user"] = array();
			$userArr = array();
			$userArr["userID"] = $row["userID"];
			$userArr["password"] = $row["password"];
			$userArr["accountEmailAddress"] = $row["accountEmailAddress"];
			$userArr["privateName"] = $row["privateName"];
			$userArr["publicName"] = $row["publicName"];
			
			// push single account into final response array
			array_push($response["user"], $userArr);
			
	        $response["success"] = 1;
            $response["message"] = "Login successful.";
	
	        // push session into final response array
		    $_SESSION['login_username'] = $accPrivName;
	        $response["session"] = $_SESSION['login_username'];
		} else {
		    // failed to login
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred. Please check your username and password again.";
			
			$_SESSION['login_username'] = "";
	        $response["session"] = $_SESSION['login_username'];
		}
    } else {
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred. Please check your username and password again.";

	    $_SESSION['login_username'] = "";
	    $response["session"] = $_SESSION['login_username'];
    }
} else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

	$_SESSION['login_username'] = "";
	$response["session"] = $_SESSION['login_username'];
}
echo json_encode($response);
?>
