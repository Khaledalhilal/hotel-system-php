<?php
require('../connect.php');
// var_dump($_POST);
// exit;
$response = array();
if ($_POST['id'] && $_POST['head']) {
    $head = $_POST['head'];
    $sql = "UPDATE `sliders` SET `head_text`='$head'";
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
