
<?php
session_start();
$response = array();
require('connect.php');
if (isset($_POST)) {
    $footer_id = $_POST['footer_id'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    // var_dump($phone_number);
    // exit;

    $sql = "UPDATE `footer` SET `address`='$address',`email`='$email',
    `phone_number`=$phone_number WHERE footer_id='$footer_id'";
    if ($conn->query($sql) === TRUE) {
        $response = array(
            'status' => 'success',
            'message' => 'Footer updated successfully'
        );
    }
}
header('Content-Type: application/json');
echo json_encode($response);
