<?php

/*
 * Following code will create a new account
 */

$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();

if (isset($_POST['privateName']) && isset($_POST['publicName']) && isset($_POST['password']) && isset($_POST['accountEmailAddress'])) {
    $accPrivName = $_POST['privateName'];
    $accPublName = $_POST['publicName'];
    $accPasswd = $_POST['password'];
	$acctEmail = $_POST['accountEmailAddress'];
	
    $result = mysql_query("SELECT * from dbAccount WHERE privateName = '$accPrivName'") or die(mysql_error("Database connect - unsuccessful"));

    if (mysql_num_rows($result) > 0) {
	    // user record exists
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "User already exists.";
    } else {
        $result = mysql_query("INSERT INTO dbAccount(privateName, publicName, password, accountEmailAddress) VALUES('$accPrivName', '$accPublName', '$accPasswd', '$acctEmail')") or die(mysql_error("Database connect - unsuccessful"));
        if ($result) {	
                $response["success"] = 1;
                $response["message"] = "Account successfully created.";
        } else {
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
        }    
	}
} else {
    $response["success"] = 0;
	$response["message"] = "Required field(s) is missing";
}
echo json_encode($response);

?>