<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
session_start();
require 'common/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = md5($password);

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $hash_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            if ($row['user_type'] === 'admin') {
                $_SESSION['email'] = $row['email'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['firstName'] = $row['FirstName'];
                $_SESSION['user_id'] = $row['user_id'];

                header('Location: index.php');
                exit;
            } else {
                echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect password or email',
                    text: 'Please, Try Again!'
                }).then(function() {
                    window.location.href = 'signin.php';
                });
            });
        </script>
        ";
            }
        } else {
            echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect password or email',
                    text: 'Please, Try Again!'
                }).then(function() {
                    window.location.href = 'signin.php';
                });
            });
        </script>
        ";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>


<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<body>
    <div class="container-fluid">
        <center>
            <div>
                <h1 class="mt-2"> <span style="background-color: #1cc3b2; color:#0e2737;padding:10px">KH </span><span style="background-color: #0e2737; color:#1cc3b2;padding:10px">HOTEL</span></h1>
            </div>
        </center>
    </div>
    <section class="vh-90">
        <div class="container-fluid h-custom" style=" height: calc(100vh - 64px) !important;">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="hotel/image/login.jpg" class="img-fluid" alt="Sample image" width="100%">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="" method="post">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                            <button type="button" class="btn  btn-floating mx-1" style="background-color:#1cc3b2">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn  btn-floating mx-1" style="background-color:#1cc3b2">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn  btn-floating mx-1" style="background-color:#1cc3b2">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>


                        <div class="input-group mb-3">
                            <span class="input-group-text w-120 text-center" style="width: 130px !important;">E-mail</span>
                            <input type="email" class="form-control" id="userName" name="email" placeholder="Enter Your Email" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 130px !important;"> user password</span>
                            <input type="password" class="form-control" id="userPassword" name="password" placeholder="Enter User Password" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3" hidden>
                            <span class="input-group-text w-120" style="width: 130px !important;"> user Type</span>
                            <input type="text" value="admin" class="form-control" id="user_type" name="user_type" autocomplete="off" required>
                        </div>
                        <div class="text-center text-lg-end mt-4 pt-2">
                            <input type="submit" class="btn  btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:#1cc3b2" value="Login"></input>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>

</body>