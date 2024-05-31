
<?php
session_start();
$response = array();
require('connect.php');
if (isset($_POST)) {
    $images = $_FILES['my_work'];
    $about_id = $_POST['about_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($images['name']) && $images['size'] > 0) {
        // var_dump($_FILES);
        // exit;
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

        $target_file = "img/about/" . $image_name;
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

                while (file_exists("img/about/" . $image_name)) {
                    $count++;
                    $image_name = $file_name_without_extension . "-" . $count . "." . $file_extension;
                    $target_file = "img/about/" . $image_name;
                }
            }

            $result = move_uploaded_file($_FILES['my_work']['tmp_name'], $target_file);
            // var_dump($image_name);exit;
            if ($result) {
                $sql1 = " UPDATE `aboutus` SET `about_title`='$title',`about_description`='$description',`about_image`='$image_name'";
                if ($conn->query($sql1) === TRUE) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'About updated successfully'
                    );
                }
                $conn->close();
            } else {
                echo "Image Can't be uploaded";
            }
        } else {
            foreach ($errors as $error) {
                echo  $error;
            }
        }
    } else {
        $sql = " UPDATE `aboutus` SET `about_title`='$title',`about_description`='$description'";
        if ($conn->query($sql) === TRUE) {
            $response = array(
                'status' => 'success',
                'message' => 'About updated successfully'
            );
        }
    }
}
header('Content-Type: application/json');
echo json_encode($response);
