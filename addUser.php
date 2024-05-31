 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <?php
    session_start();
    if ($_POST) {
        // var_dump($_POST);exit;
        $userName = $_POST['userName'];
        $password = $_POST['userPassword'];
        $userType = $_POST['userType'];
        $nationality = $_POST['nationality'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];
        $email = $_POST['email'];

        require("connect.php");

        $sql = "SELECT * from users where userName='$userName'";
        $result = $conn->query($sql);
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $result = $users;
        // var_dump($result);
        // exit;
        if ($result) {
            $response = array(
                'status' => 'error',
                'message' => 'user name is already exists'
            );
            // $conn->close();
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            // exit;
            if (isset($_FILES["my_work"])) {
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
                $target_file = "img/users/" . $image_name;
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
                    while (file_exists("img/users/" . $image_name)) {
                        $count++;
                        $image_name = $file_name_without_extension . "-" . $count . "." . $file_extension;
                        $target_file = "img/users/" . $image_name;
                    }
                }
                $result = move_uploaded_file($_FILES['my_work']['tmp_name'], $target_file);
                if ($result) {
                    $sql1 = "INSERT INTO `users`( `userName`, `user_image`, `email`, `phone_number`, `address`, `nationality`, `check_in_date`, `check_out_data`, `user_type`, `password`)
                 VALUES ('$userName','$image_name','$email','$phoneNumber','$address','$nationality','$checkIn','$checkOut','$userType','$password')";
                    if ($conn->query($sql1) === TRUE) {
                        $response = array(
                            'status' => 'success',
                            'message' => 'User added successfully'
                        );
                    } else {
                        $response = array(
                            'status' => 'error',
                            'message' => 'Invalid file type. Please upload only images with .jpg, .jpeg, or .png extensions.'
                        );
                    }
                    $conn->close();
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    ?>