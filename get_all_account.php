<?php

/*
 * Following code will list all the user accounts
 */

$response = array();

// include db connect class
include 'mysql_connect.php';
	
session_start();

$result = mysql_query("SELECT * FROM dbAccount") or die(mysql_error("Database connect - unsuccessful"));
$response["acc"] = array();

if (mysql_num_rows($result) > 0) {	
    while ($row = mysql_fetch_array($result)) {
        //$privateName = $row["privateName"];
        //$publicName = $row["publicName"];
        // push single account into final response array
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
} 
else {
    $response["success"] = 0;
	$response["message"] = "No user accounts found";
}
echo json_encode($response);

?>
	