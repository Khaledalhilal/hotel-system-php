<?php
if ($_POST) {
    $response=array();
    // var_dump($_POST);exit;
    $name = $_POST['name'];
    $room_id = $_POST['room_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    require('connect.php');
    $sql = "INSERT INTO `services`(`room_id`,`service_name`, `service_description`, `service_price`) VALUES 
    ('$room_id','$name','$description','$price')";
    if ($conn->query($sql)) {
        $response = array(
            'status' => 'success',
            'message' => 'Service added successfully'
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
