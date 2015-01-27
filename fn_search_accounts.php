<?php
 
/*
 * Following code will get single user details
 * An account is identified by user (public) name
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// start session
session_start();
 
// check for post data
if (isset($_POST["publicName"])) {
    $publicName = $_POST['publicName'];
 
    // get a user detail from accounts table
	$result = mysql_query("SELECT * FROM dbAccount WHERE publicName like '%$publicName%'") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // user accounts node
    $response["acc"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $acc = array();
        $acc["userID"] = $row["userID"];
        $acc["password"] = $row["password"];
        $acc["accountEmailAddress"] = $row["accountEmailAddress"];
        $acc["privateName"] = $row["privateName"];
        $acc["publicName"] = $row["publicName"];
		$acc["createTimestamp"] = $row["createTimestamp"];
 
        // push single account into final response array
        array_push($response["acc"], $acc);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No user accounts found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>