<?php
session_start();
$email = $_SESSION["clientEmail"];
// var_dump($_POST);exit;
require('connect.php');
$email = mysqli_real_escape_string($conn, $email);
$sql = "SELECT user_id FROM `users` WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // var_dump($user);
    // exit;

    $user_id = $user['user_id'];
    if ($_POST) {
        // var_dump($_POST);exit;
        $response = array();
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $room_id = isset($post['room_id']) ? $post['room_id'] : 95;
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
