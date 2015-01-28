<?php
 
/*
 * Following code will get single user details
 * An account is identified by user public name
 */
 
$response = array();

// include db connect class
include 'mysql_connect.php';
	
session_start();

$result = mysql_query("SELECT * FROM dbAccount") or die(mysql_error("Database connect - unsuccessful"));
 
// check for get data
if (isset($_GET["publicName"])) {
    $publicName = $_GET['publicName'];
 
    // get a user detail from accounts table
	$result = mysql_query("SELECT * FROM dbAccount WHERE publicName='$publicName'") or die(mysql_error("Database connect - unsuccessful"));
	$response["acc"] = array();
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result)) {
                $accArr = array();
                $accArr["userID"] = $row["userID"];
                $accArr["privateName"] = $row["privateName"];
                $accArr["publicName"] = $row["publicName"];
                $accArr["password"] = $row["password"];
                $accArr["accountEmailAddress"] = $row["accountEmailAddress"];
                $accArr["createTimestamp"] = $row["createTimestamp"];
				
				// push single account into final response array
                array_push($response["acc"], $accArr);
		    }
    			
	        //success
	        $response["success"] = 1;
        } else {
            // no account found
            $response["success"] = 0;
            $response["message"] = "No user found";
        }
    } else {
        // no account found
        $response["success"] = 0;
        $response["message"] = "No user found";
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Invalid Name";
}
echo json_encode($response);
	
?>