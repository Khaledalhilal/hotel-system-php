<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require('common/header.php');
?>
<?php
require('../connect.php');
$room_id = $_GET['room_id'];
$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);
if ($_POST) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $nationality = $_POST['nationality'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];
    $userType = $_POST['userType'];


    $sql = "SELECT * FROM users where email='$email'";
    $result = $conn->query($sql);
    $checkEmail = $result->fetch_all(MYSQLI_ASSOC);

    if (count($checkEmail) > 0) {
        echo "
             <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Email is already exists',
                    text: 'Please, Try Again!'
                }).then(function() {
                    window.location.href = 'register.php?room_id=$room_id';
                });
            });
        </script>
        ";
    }
    if ($password !== $repeatPassword) {
        echo "
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords are Not Matches',
                    text: 'Please, Try Again!'
                }).then(function() {
                    window.location.href = 'register.php?room_id=$room_id';
                });
            });
        </script>
        ";
    } else if (count($checkEmail) === 0 && $password === $repeatPassword) {
        $hashPassword = md5($password);
        // var_dump($hashPassword);exit;
        $sql_register = "INSERT INTO `users`( `FirstName`, `LastName`, `email`, `phone_number`, `nationality`, `user_type`, `password`) 
        VALUES ('$fName','$lName','$email','$phoneNumber','$nationality','$userType','$hashPassword')";

        if ($conn->query($sql_register) === TRUE) {
            // var_dump($sql_register);
            // exit;
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                            icon: 'success',
                            title: 'Registered Successfully!',
                            text: 'Than You For Your Registration',
                            // timer: 2000, // Show the alert for 2 seconds
                            showConfirmButton: true
                            }).then(function() {
                            window.location.href = 'login.php?room_id=$room_id';
                            });
                            
                    });
         </script>";
        }
    }
    $conn->close();
}


?>
<style>
    .gradient-custom-4 {
        background: #84fab0;
        background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
        background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
    }
</style>

<body>
    <?php require('common/navbar.php'); ?>
    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">login</li>
            </ol>
        </div>
    </section>


    <section class="m-4">
        <div class=" d-flex align-items-center gradient-custom-3" style="border-color: #1cc3b2 !important;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 0px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                                <form method="POST" action="">
                                    <div class="form-outline mb-4">
                                        <input type="text" name="fName" class="form-control form-control-lg" placeholder="Enter First Name" required />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" name="lName" class="form-control form-control-lg" placeholder="Enter Last Name" required />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter E-mail" required />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="number" name="phoneNumber" class="form-control form-control-lg" placeholder="Enter Phone Number" required />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="text" name="nationality" class="form-control form-control-lg" placeholder="Enter Your Nationality" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" placeholder="Enter password" required />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="repeatPassword" id="form3Example4cdg" class="form-control form-control-lg" placeholder="Repeat Password" required />
                                    </div>
                                    <div class="form-outline mb-4" hidden>
                                        <input type="text" name="userType" id="form3Example4cdg" value="client" class="form-control form-control-lg" />
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" value="Register" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" style="border: 0px;"></input>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php require('common/footer.php'); ?>


    <?php require('common/script.php'); ?>

</body>

</html>