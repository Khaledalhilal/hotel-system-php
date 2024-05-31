<script src="js/sweetAlert.js"></script>
<?php
session_start();
if ($_POST) {
    // var_dump($_POST);exit;
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $password = $_POST['password'];
    $posit = $_POST['posit'];

    $salary = $_POST['salary'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $userType = $_POST['userType'];
    $phoneNumber = $_POST['phoneNumber'];
    $nationality = $_POST['nationality'];
    $email = $_POST['email'];
}
require("connect.php");
$checkItemQuery = "SELECT * FROM `users` WHERE users.email='$email'";
$result = $conn->query($checkItemQuery);

if ($result->num_rows > 0) {
    echo "1";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'user Already Exists',
            text: 'The user you are trying to add already exists in the database.'
        }).then(function() {
            window.location.href = 'employeeDetails.php';
        });
    </script>";
} else {

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

        $target_file = "img/employee/" . $image_name;
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

                while (file_exists("img/employee/" . $image_name)) {
                    $count++;
                    $image_name = $file_name_without_extension . "-" . $count . "." . $file_extension;
                    $target_file = "img/employee/" . $image_name;
                }
            }

            $result = move_uploaded_file($_FILES['my_work']['tmp_name'], $target_file);
            // var_dump($result);exit;
            if ($result) {
                $sql1 = "INSERT INTO `users`(`FirstName`, `LastName`, `email`, `phone_number`, `nationality`, `user_type`, `password`) VALUES 
                ('$fName','$lName','$email','$phoneNumber','$nationality','$userType','$password')";
                if ($conn->query($sql1) === TRUE) {
                    
                    $user_id = $conn->insert_id;
                    $sql_emp = "INSERT INTO `employees`(`user_id`, `position`,  `salary`, `image`, `start_date`, `end_date`)
                             VALUES ('$user_id','$posit','$salary','$image_name','$checkIn','$checkOut')";
                    // var_dump($sql1);
                    // exit;
                    if ($conn->query($sql_emp) === TRUE) {
                        echo "1";
                        echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Employee Added',
                                        text: 'Employee Added Successfully'
                                    }).then(function() {
                                        window.location.href = 'employeeDetails.php';
                                    });
                                </script>";
                    }
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
    }
}
?>