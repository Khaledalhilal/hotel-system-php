 <?php
    include('connect.php');
    // var_dump($_POST);exit;
    $id = $_POST['room_id'];
    // var_dump($id);exit;
    $sql = "DELETE FROM `rooms` WHERE room_id=$id";
    if ($conn->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Room Deleted successfully'
            );
        }
         else {
        $response = array(
            'status' => 'error',
            'message' => "You can't delete this Room"
        );
    }
    // var_dump($response);exit;
    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
    ?>