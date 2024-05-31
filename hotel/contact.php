<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
require('common/header.php');
?>
<?php
require('../connect.php');

$sql = "SELECT rooms.*, room_status.*,services.* FROM rooms INNER JOIN room_status ON rooms.room_id = room_status.room_id INNER JOIN services ON rooms.room_id=services.room_id";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rooms);
// exit;
$sql_slider = "SELECT * from sliders";
$result_slider = $conn->query($sql_slider);
$sliders = $result_slider->fetch_all(MYSQLI_ASSOC);
$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);

if ($_POST) {
    // var_dump($_POST);exit;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contactus`( `user_name`, `user_email`, `subject`, `message`)
     VALUES ('$name','$email','$subject','$message')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sended',
                        text: 'Thank you for contacting us, we will reply to your message soon'
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                });
            </script>
            ";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

?>

<body>
    <!--================Header Area =================-->
    <?php require('common/navbar.php'); ?>

    <!--================Header Area =================-->

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">Contact Us</li>
            </ol>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="contact_info">
                        <div class="info_item mb-4">
                            <i class="lnr lnr-home"></i>
                            <h6><?php echo $footer[0]['address'] ?></h6>
                        </div>
                        <div class="info_item mb-4">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6><a href="#"><?php echo $footer[0]['phone_number'] ?></a></h6>
                        </div>
                        <div class="info_item mb-4">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="#"><?php echo $footer[0]['email'] ?></a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <form class="row contact_form" action="" method="post">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="1" placeholder="Enter Message" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <input type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->

    <!--================ start footer Area  =================-->
    <?php require('common/footer.php'); ?>

    <!--================ End footer Area  =================-->

    <?php require('common/script.php'); ?>
</body>

</html>