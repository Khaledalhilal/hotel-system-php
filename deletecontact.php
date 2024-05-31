<?php
    include('connect.php');
    // var_dump($_POST);exit;
    $id = $_POST['contact_id'];
    // var_dump($id);exit;
    $sql = "DELETE FROM `contact` WHERE contact_id=$id";
    if ($conn->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'contact Deleted successfully'
            );
        }
         else {
        $response = array(
            'status' => 'error',
            'message' => "You can't delete this contact"
        );
    }
    // var_dump($response);exit;
    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
    ?>