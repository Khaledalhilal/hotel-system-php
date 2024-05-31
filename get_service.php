<?php
require("connect.php");
// var_dump($_POST);
// exit;

$id = $_POST['service_id'];
$sql = "SELECT *, users.user_id, users.userName, services.service_id, services.service_name, services.service_description, services.service_price FROM `service_booking` INNER JOIN services ON service_booking.service_id = services.service_id INNER JOIN users ON service_booking.user_id = users.user_id WHERE services.service_id='$id'";
$result = $conn->query($sql);
$service = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['service_id'])) {
    echo json_encode($service);
    
} else {
    echo json_encode(['error' => 'Invalid request']);
}
