<?php
// var_dump($_POST);exit;
include('connect.php');
$response = array();
$id = $_POST['deleteImage_id'];
$sql = "DELETE FROM `sliders` WHERE sliders.id='$id'";
if ($conn->query($sql) === TRUE) {
    $response = array(
        'status' => 'success'

    );
} else {
    $response = array(
        'status' => 'error'

    );
}
header('Content-Type: application/json');
echo json_encode($response);
