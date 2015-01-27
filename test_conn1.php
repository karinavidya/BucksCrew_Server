<?php
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['text_test'])) {
 
    $text_test = mysql_real_escape_string($_POST['text_test']);
	
    $response["success"] = 1;
	$response["message"] = $text_test;

	// echoing JSON response
	echo json_encode($response);
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "No data";
 
    // echoing JSON response
    echo json_encode($response);
}
?>