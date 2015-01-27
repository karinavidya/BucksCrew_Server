<?php
 
/*
 * Following code will get single user details
 * An account is identified by user id
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// start session
//session_start();
 
// check for get data
if (isset($_GET["userID"])) {
    $userID = $_GET['userID'];
 
    // get a user detail from accounts table
	$result = mysql_query("SELECT * FROM dbAccount WHERE userID='$userID'") or die(mysql_error());
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
			$response["user"] = array();
	        $user = array();
	        $user["userID"] = $row["userID"];
	        $user["password"] = $row["password"];
	        $user["accountEmailAddress"] = $row["accountEmailAddress"];
	        $user["privateName"] = $row["privateName"];
	        $user["publicName"] = $row["publicName"];
	        
	        //success
	        $response["success"] = 1;
 
            // push single account into final response array
	        array_push($response["user"], $user);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no account found
            $response["success"] = 0;
            $response["message"] = "No user found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no account found
        $response["success"] = 0;
        $response["message"] = "No user found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>