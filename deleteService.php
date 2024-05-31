 <?php
    include('connect.php');
    $id = $_POST['service_id'];
    $sql = "DELETE FROM `services` WHERE service_id=$id";
    if ($conn->query($sql) === TRUE) {
        $response = array(
            'status' => 'success',
            'message' => 'Service Deleted successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => "You can't delete this Service"
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
    ?>