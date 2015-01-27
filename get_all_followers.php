<?php

/*
 * Following code will list all the user that follows
 * a specific account
 */

// array for JSON response
$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();
 
// check for valid ID
if (isset($_GET['userID'])) {
    $subscriptionID = $_GET['userID'];
	
	// SELECT u.*, s.followerID FROM dbsubscription s, dbAccount u WHERE s.subscriptionID=u.userID and s.subscriptionID=2 
	$result = mysql_query("SELECT u.* FROM dbSubscription s, dbAccount u WHERE s.followerID=u.userID AND subscriptionID = '$subscriptionID'") or die(mysql_error("Database connect - unsuccessful"));
	
	$response["acc"] = array();
    
    if (mysql_num_rows($result) > 0) {	
		while ($row = mysql_fetch_array($result)) {
			$accArr = array();
			$accArr["userID"] = $row["userID"];
			$accArr["privateName"] = $row["privateName"];
			$accArr["publicName"] = $row["publicName"];
			$accArr["password"] = $row["password"];
			$accArr["accountEmailAddress"] = $row["accountEmailAddress"];
			$accArr["createTimestamp"] = $row["createTimestamp"];
			array_push($response["acc"], $accArr);
		}
		$response["success"] = 1;
	} else {
        $response["success"] = 0;
	    $response["message"] = "No user accounts found";
    }
} else {
    $response["success"] = 0;
	$response["message"] = "Invalid user";
}
echo json_encode($response);

?>