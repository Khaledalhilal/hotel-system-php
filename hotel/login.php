<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

require('common/header.php');
require('../connect.php');
session_start();
$room_id = isset($_GET['room_id']) ? $_GET['room_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            // var_dump($row);exit;
            $_SESSION['clientEmail'] = $row['email'];
            

            header('Location: book.php?room_id=' . $room_id);
        } else {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incorrect password or email',
                        text: 'Please, Try Again!'
                    }).then(function() {
                        window.location.href = 'login.php?room_id=' . $room_id';
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
    <?php require('common/navbar.php'); ?>
    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">login</li>
            </ol>
        </div>
    </section>

    <section class="room-section spad">
        <div class="container">
            <section class="vh-100">
                <div class="container-fluid h-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="image/login.jpg" class="img-fluid" alt="Sample image">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter Your E-mail" required />
                                    <label>E-mail</label>
                                </div>
                                <div class="form-outline mb-3">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password" required />
                                    <label>Password</label>
                                </div>
                                <div class="text-center text-lg-end mt-4 pt-2">
                                    <input type="submit" class="btn btn-primary btn-lg" value="Login" style="padding-left: 2.5rem; padding-right: 2.5rem;"></input>
                                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php?room_id=<?php echo $room_id ?>" class="link-danger">Register</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <?php require('common/footer.php'); ?>


    <?php require('common/script.php'); ?>

</body>

</html>