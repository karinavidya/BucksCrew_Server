<?php

/*
 * Following code will logout an account
 */

$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();

if(session_destroy())
{
    $response["session"] = "";
} else {
    $response["session"] = $_SESSION['login_username'];
}
echo json_encode($response);

?>