<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo " <script> window.location.href='signin.php';</script>;";
}
include('connect.php');


if (isset($_FILES["my_work"])) {
    $errors = array();
    $response = array();
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
    $target_file = "hotel/image/banner/" . $image_name;
    if ($image_error == 4) {
        $errors[] = "<div>No file uploaded Yet</div>";
    } else {
        if ($image_size > 10000000) {
            $errors[] = "<div>File Can't be more than 10,000,000 bytes (10000 KB)</div>";
        }
        if (!in_array($image_extension, $allowed_extensions)) {
            $errors[] = "<div>File is not valid</div>";
        }
    }

    if (file_exists($target_file)) {
        $count = 0;
        $file_name_without_extension = pathinfo($image_name, PATHINFO_FILENAME);
        $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        while (file_exists("hotel/image/banner/" . $image_name)) {
            $count++;
            $image_name = $file_name_without_extension . "-" . $count . "." . $file_extension;
            $target_file = "hotel/image/banner/" . $image_name;
        }
    }
    // image_name
    $result = move_uploaded_file($_FILES['my_work']['tmp_name'], $target_file);
    if ($result) {
        $sql1 = "UPDATE `sliders` SET `image`='$image_name'";
        if ($conn->query($sql1) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'Image Added Successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
            );
        }
       
    }
}
header('Content-Type: application/json');
echo json_encode($response);

?>