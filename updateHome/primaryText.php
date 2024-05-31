<?php
require('../connect.php');
// var_dump($_POST);
// exit;
$response = array();
if ($_POST['id'] && $_POST['primary']) {
    $primary = $_POST['primary'];
    $sql = "UPDATE `sliders` SET `primary_text`='$primary'";
    if ($conn->query($sql) === TRUE) {
        $response = array(
            'status' => 'success'
        );
    } else {
        $response = array(
            'status' => 'error'

        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
