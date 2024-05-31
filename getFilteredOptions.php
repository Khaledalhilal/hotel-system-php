<?php
// Include your database connection file
include('connect.php');

// Check if the 'value' parameter is set
if (isset($_POST['value'])) {
    $selectedValue = $_POST['value'];
// var_dump($selectedValue);exit;
    // Perform your database query to get filtered options
    // Replace 'your_table_name' with the actual table name
    $query = "SELECT room_id, room_number, room_name FROM rooms WHERE room_name = '$selectedValue'";
    $result = $conn->query($query);
    // var_dump($result);
    // exit;
    // Fetch the results into an associative array
    $options = array();
    while ($row = $result->fetch_assoc()) {
            // var_dump($options[$row['room_id']]);
            // exit;
        $options[$row['room_id']] = $row['room_number'];
    }

    // Close the database connection
    $conn->close();

    // Return the JSON-encoded options
    header('Content-Type: application/json');
    echo json_encode($options);
} else {
    // Handle the case where 'value' parameter is not set
    header('HTTP/1.1 400 Bad Request');
    echo 'Bad Request: Missing parameter';
}
