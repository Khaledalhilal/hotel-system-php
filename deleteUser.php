 
<?php
include('connect.php');
$user_id = $_GET['user_id'];

$sql = "DELETE FROM `users` WHERE users.user_id = '$user_id'";
header('Content-Type: application/json');

$response = array();

if ($conn->query($sql) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'user name deleted successfully'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error deleting user: ' . $conn->error
    );
}

// header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>