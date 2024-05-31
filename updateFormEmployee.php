<?php
session_start();
require('common/header.php');
$user_id = $_GET['user_id'];
// var_dump($_GET);exit;
$emp_id = $_GET['employee_id'];
require('connect.php');
$sql = "SELECT users.*, employees.* FROM `users` INNER JOIN employees ON users.user_id = employees.user_id WHERE employees.employee_id='$emp_id'";
$result = $conn->query($sql);
$employee = $result->fetch_assoc();
// var_dump($employee);exit;
if (isset($_POST)) {
    if ($_FILES && $_FILES['images']['name']) {

        $target_dir = "img/employee/";
        $extension = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
        $img_name = str_replace("." . $extension, "", basename($_FILES["images"]["name"]));

        $count = 0;
        $image_name = $_FILES["images"]["name"];
        while (file_exists($target_dir . $image_name)) {
            $count++;
            $image_name = $img_name . "-" . $count . "." . $extension;
        }

        $target_file = $target_dir . $image_name;

        $result = move_uploaded_file($_FILES['images']['tmp_name'], $target_file);

        if ($result) {
            $sql = "UPDATE employees SET image='$image_name' WHERE employees.employee_id = " . $employee['employee_id'];
            $conn->query($sql);
        }
    } elseif (isset($_POST['deleteImage'])) {
        $imageToDelete = $_POST['imageNameToDelete'];
        $pathToDelete = "img/employee/" . $imageToDelete;

        if (unlink($pathToDelete)) {
            $sql = "UPDATE employees SET image=NULL WHERE employees.employee_id = " . $employee['employee_id'];
            $conn->query($sql);
        }
    }
}
?>

?>

<body>

    <!-- Sidebar Start -->
    <?php require('common/sidebar.php'); ?>
    <!-- Sidebar End -->
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php require('common/navbar.php'); ?>
        <!-- Navbar End -->
        <div class="container-fluid pt-4">

            <div class="row g-4 min-vh-100 rounded justify-content-center mx-0">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <?php
                            require('connect.php');
                            $imageName = "";
                            // Retrieve image name from the database
                            $sql = "SELECT image FROM employees WHERE employees.employee_id = " . $employee['employee_id'];
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $imageName = $row['image'];
                                }
                            }

                            if ($imageName) {
                                echo "<div>";
                                echo "<img class='rounded-circle' src='img/employee/$imageName' alt='Uploaded Image'width='115px'><br>";
                                echo "<form action='' method='post' class='mt-2'>";
                                echo "<input type='hidden' name='imageNameToDelete' value='$imageName'>";
                                echo "<input type='submit' id='deleteImage' name='deleteImage' value='Delete Image'>";
                                echo "</form>";
                                echo "</div>";
                            } else {
                                echo "<form action='' method='post' enctype='multipart/form-data'>";
                                echo "<input type='file' class='mb-2'  name='images' id='fileToUpload'>";
                                echo "<br/>";
                                echo "<input type='submit'  value='Save' id='addNewImage' name='submit'>";
                                echo "</form>";
                            }
                            ?>
                            <form action="updateEmployee.php" method="POST" class="mt-4">
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;">user ID</span>
                                    <input type="text" class="form-control" id="#" name="userID" value="<?php echo $employee['user_id'] ?>" required>
                                </div>
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;">Employee ID</span>
                                    <input type="text" class="form-control" id="#" name="employeeID" value="<?php echo $employee['employee_id'] ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">First Name</span>
                                    <input type="text" class="form-control" id="#" name="firstName" value="<?php echo $employee['FirstName'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Last Name</span>
                                    <input type="text" class="form-control" id="#" name="lastName" value="<?php echo  $employee['LastName']  ?>" required autocomplete="off">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Phone Number</span>
                                    <input type="text" class="form-control" id="#" name="phoneNumber" value="<?php echo $employee['phone_number'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">E-mail</span>
                                    <input type="email" class="form-control" id="#" name="email" value="<?php echo $employee['email'] ?>" required autocomplete="off">
                                </div>



                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Nationality</span>
                                    <input type="text" class="form-control" id="#" value="<?php echo $employee['nationality'] ?>" name="nationality" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Check In Date</span>
                                    <input type="date" class="form-control" id="#" value="<?php echo $employee['start_date'] ?>" name="checkIn" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Check Out Date</span>
                                    <input type="date" class="form-control" id="#" value="<?php echo $employee['end_date'] ?>" name="checkOut" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;">User Type</span>
                                    <input type="text" class="form-control" id="#" value="<?php echo $employee['user_type'] ?>" name="userType" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;">Password</span>
                                    <input type="password" class="form-control" id="#" value="<?php echo $employee['password'] ?>" name="password" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Position</span>
                                    <input type="text" class="form-control" id="#" value="<?php echo $employee['position'] ?>" name="position" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Salary</span>
                                    <input type="number" class="form-control" id="#" value="<?php echo $employee['salary'] ?>" name="salary" required autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        <?php
        $conn->close();
        require('common/footer.php')
        ?>
        <!-- Footer End -->
    </div>
    <!-- Content End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <?php require('common/script.php'); ?>
</body>

</html>