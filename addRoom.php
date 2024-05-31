<?php
if ($_POST) {
    // var_dump($file);
    // exit;
    $roomNb = $_POST['roomNb'];
    $floor = $_POST['floor'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $des = $_POST['des'];

    require('connect.php');
    if ($_FILES["my_work"]) {
        $errors = array();

        $image_name = $_FILES['my_work']['name'];
        $image_type = $_FILES['my_work']['type'];
        $image_tmp_name = $_FILES['my_work']['tmp_name'];
        $image_size = $_FILES['my_work']['size'];
        $image_error = $_FILES['my_work']['error'];
        $allowed_extensions = array(
            'jpg', 'gif', 'png', 'jpeg'
        );

        $image_extension_array = explode('.', $image_name);
        $image_extension = strtolower(end($image_extension_array));

        $target_file = "hotel/image/rooms/" . $image_name;
        // var_dump($target_file);
        // exit;
        if ($image_error == 4) {
            $errors[] = "<div>No file uploaded Yet</div>";
        } else {

            if ($image_size > 10000000) {
                $errors[] = "<div>File Can't be more than 10,000,000 bytes (10000 KB)</div>";
            }

            if (!in_array(
                $image_extension,
                $allowed_extensions
            )) {
                $errors[] = "<div>File is not valid</div>";
            }
        }

        if (empty($errors)) {
            if (file_exists($target_file)) {

                $count = 0;
                $file_name_without_extension = pathinfo($image_name, PATHINFO_FILENAME);
                $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);

                while (file_exists("hotel/image/rooms/" . $image_name)) {
                    $count++;
                    $image_name = $file_name_without_extension . "-" . $count . "." . $file_extension;
                    $target_file = "hotel/image/rooms/" . $image_name;
                }
            }

            $result = move_uploaded_file($_FILES['my_work']['tmp_name'], $target_file);
            // var_dump($result);exit;
            // room_description
            if ($result) {
                $sql = "INSERT INTO `rooms`(`room_name`, `room_image`, `room_number`, `room_type`, `price_per_night`,`room_description`) VALUES
                        ('$floor','$image_name','$roomNb','$type','$price', '$des')";
                if ($conn->query($sql) === TRUE) {
                    $room_id = $conn->insert_id;
                    $sql_status = "INSERT INTO `room_status`( `room_id`, `data`, `status`)
                                    VALUES ('$room_id','$date','$status')";
                    if ($conn->query($sql_status)) {
                        $response = array(
                            'status' => 'success',
                            'message' => 'Room added successfully'
                        );
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => "Try again"
                        );
                    }
                }
            } else {
                echo "Image Can't be uploaded";
            }
        } else {
            foreach ($errors as $error) {
                echo  $error;
            }
        }
    }

    
    header('Content-Type: application/json');
    echo json_encode($response);
    $conn->close();
}
