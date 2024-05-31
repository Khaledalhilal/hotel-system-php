<script src="js/sweetAlert.js"></script>
<?php
require('common/header.php');
if ($_POST) {
    // var_dump($_POST);
    // exit;
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $price = $_POST['price'];
    $payStatus = $_POST['payStatus'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
   

    require('connect.php');
    $sql = "INSERT INTO `reservation`(`user_id`, `room_id`, `total_price`, `payment_status`, `start_date`, `end_date`) 
    VALUES ('$user_id','$room_id','$price','$payStatus','$startDate','$endDate')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>
         window.location.href = 'ReservationDetails.php';
         </script>";
    }
    $conn->close();
}
