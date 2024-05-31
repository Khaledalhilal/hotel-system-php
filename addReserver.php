<?php
session_start();
$email = $_SESSION["clientEmail"];
require('connect.php');
$email = mysqli_real_escape_string($conn, $email);
$sql = "SELECT user_id FROM `users` WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $user_id = $user['user_id'];
    if ($_POST) {
        $response = array();
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $room_id = $_POST['room_id'];
        $gender = $_POST['gender'];
        $nbrChildren = $_POST['nbrChildren'];
        $sql = "INSERT INTO `reservation`( `user_id`, `room_id`, `numberOfChildrens`, `gender`, `check_in`, `chack_out`)
                 VALUES ('$user_id','$room_id','$nbrChildren','$gender','$checkIn','$checkOut')";
        if ($conn->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Thank You for booking'
            );
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
