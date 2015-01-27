<?php

/*
 * Following code will delete a user account from table
 * A user account is identified by account id (user)
 */
 
$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();
 
// check for required fields
if (isset($_POST['userID'])) {
    $accUserID = $_POST['userID'];
 
    // mysql update row with matched userID
    $result = mysql_query("DELETE FROM dbAccount WHERE userID = $accUserID");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Account successfully deleted";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no user account found
        $response["success"] = 0;
        $response["message"] = "No user account found";
 
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