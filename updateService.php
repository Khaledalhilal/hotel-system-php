<?php
if ($_POST) {
    $response = array();
    // var_dump($_POST);exit;
    $service_id = $_POST['service_id'];
    $room_id = $_POST['room_Id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    require('connect.php');
    $sql = "UPDATE `services` SET `service_name`='$name', `room_id`='$room_id', `service_description`='$description',
    `service_price`='$price' WHERE service_id='$service_id'";
    if ($conn->query($sql)) {
        $response = array(
            'status' => 'success',
            'message' => 'Service Updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => "Try again"
        );
    }


    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
}
