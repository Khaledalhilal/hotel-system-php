<?php
session_start();
require('common/header.php');
require('../connect.php');
// var_dump($_SESSION);exit;
$room_id = $_GET['room_id'];
$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);
$sql_rooms = "SELECT * FROM  rooms ";
$result_rooms = $conn->query($sql_rooms);
$rooms = $result_rooms->fetch_all(MYSQLI_ASSOC);
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
                <li class="active">Book</li>
            </ol>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ Accomodation Area  =================-->



    <section>
        <div class="container-fluid">
            <section class="h-100 h-custom ">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12">
                            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                                <div class="card-body p-0">
                                    <form id="registrationForm" action="../addBooking.php">

                                        <div class="col-lg-12" style="background-color: #1cc3b2 !important; color:#0e2737;">
                                            <center>
                                                <div class="row">
                                                    <div class="p-5">
                                                        <div class="mb-4 pb-2">
                                                            <div class="form-group">
                                                                <div class='input-group date' id='datetimepicker11'>
                                                                    <input type='text' class="form-control form-control-lg" name="checkIn" placeholder="Arrival Date" required />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4 pb-2" hidden>
                                                            <div class="form-group">
                                                                <div class='input-group date' id=''>
                                                                    <input type='text' value="<?php echo $room_id ?>" name="room_id" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4 pb-2">
                                                            <div class="form-group">
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type='text' class="form-control form-control-lg" name="checkOut" placeholder="Departure Date" required />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4 pb-2">
                                                            <div class="input-group">
                                                                <select class="wide form-control form-control-lg" name="gender" required>
                                                                    <option data-display="Adult">Adult</option>
                                                                    <option value="1">Old</option>
                                                                    <option value="2">Younger</option>
                                                                    <option value="3">Potato</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4 pb-2">
                                                            <div class="input-group">
                                                                <select class="wide form-control form-control-lg" name="nbrChildren" required>
                                                                    <option data-display="Child">Child</option>
                                                                    <option value="1">Child</option>
                                                                    <option value="2">Baby</option>
                                                                    <option value="3">Child</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 pb-2 align-items-end">
                                                            <input type="submit" value="submit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </center>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <?php require('common/footer.php'); ?>

    <!--================ End footer Area  =================-->

    <?php require('common/script.php'); ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#datetimepicker11').datetimepicker({
                format: 'YYYY-MM-DD', 
            
            });

            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD', 
              
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(e) {
                // Check if user is logged in
                if (!<?php echo isset($_SESSION['clientEmail']) ? 'true' : 'false'; ?>) {
                    e.preventDefault();
                    window.location.href = 'login.php?room_id=<?php echo $room_id; ?>';
                    return;
                }
                e.preventDefault();
                var form = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: form,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function() {
                                window.location.href = 'index.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>