<?php
session_start();
// var_dump($_POST);
// exit;
if (isset($_POST)) {
    $room_id = $_POST['room_id'];
    $status_id = $_POST['status_id'];
    $block = $_POST['block'];
    $room_number = $_POST['room_number'];
    $room_type = $_POST['room_type'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $des = $_POST['des'];
    $price_per_night = $_POST['price_per_night'];

    include('connect.php');
    $sql_room = "UPDATE `rooms` SET `room_name`='$block',`room_description`='$des',`room_number`='$room_number',`room_type`='$room_type',`price_per_night`='$price_per_night'
     WHERE rooms.room_id='$room_id'";
    $sql_status = "UPDATE `room_status` SET `data`='$date',`status`='$status' WHERE room_status.status_id='$status_id'";

    if ($conn->query($sql_room) === TRUE && $conn->query($sql_status) === TRUE) {
        echo "Room updated successfully";
        echo "<script>
        window.location.href = 'roomsDetails.php';
      </script>";
    }
}
