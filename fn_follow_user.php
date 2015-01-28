<?php
 
/*
 * Following code will add the login user as a follower to
 * the user currently selected
 */
 
// array for JSON response
$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();
//include("get_curr_session.php");

// check for get data
if (isset($_GET["publicName"])) {
    $subscriptionName = $_GET['publicName'];
	$getSubsID = mysql_query("SELECT * from dbAccount WHERE publicName = '$subscriptionName'");
	$row = mysql_fetch_array($getSubsID);
    $subscriptionID = $row["userID"];	
	
	$followerName = $_SESSION['login_username'];
	$getFollID = mysql_query("SELECT * from dbAccount WHERE privateName = '$followerName'");
	$row = mysql_fetch_array($getFollID);
    $followerID = $row["userID"];	
			
	if ($followerID > 0) {
		$result = mysql_query("INSERT INTO dbSubscription (subscriptionID, followerID) VALUES('$subscriptionID', '$followerID')");
		
		// check if row inserted or not
		if ($result) {
			// successfully inserted into database
			$response["success"] = 1;
			$response["message"] = "Subscription successful.";
		} else {
			// failed to insert row
			$response["success"] = 0;
			$response["message"] = "Oops! An error occurred.";
		}
	} else {
		// failed to insert row
		$response["success"] = 0;
		$response["message"] = "Oops! An error occurred.";
	} 
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Invalid user";
} 
echo json_encode($response);

?>