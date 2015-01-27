<?php

/*
 * Following code will create a new account
 */

$response = array();

// include db connect class
include 'mysql_connect.php';

session_start();

// check if there are any current sessions
$check_sess = $_SESSION['login_username'];
$session = mysql_query("SELECT privateName FROM dbAccount WHERE privateName = '$check_sess'");
$row = mysql_fetch_array($session);
$login_session = $row["privateName"];

if(!isset($login_session)) {
    $response["session"] = "";
	//$response["redirect_page"] = "fn_account_login.php";
} else {
    $response["session"] = $_SESSION['login_username'];
}
echo json_encode($response);

?>