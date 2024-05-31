<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

session_start();
require('common/header.php');
if (!isset($_SESSION['email'])) {
    echo " <script> window.location.href='signin.php';</script>;";
}
include('connect.php');


$sql_rooms = "SELECT *  from rooms";
$result_rooms = $conn->query($sql_rooms);
$rooms = $result_rooms->fetch_all(MYSQLI_ASSOC);

$sql_rooms_count = "SELECT count(*) as nb_rooms  from rooms";
$result_rooms_count = $conn->query($sql_rooms_count);
$rooms_count = $result_rooms_count->fetch_assoc();
// var_dump($rooms);
// exit;

$sql_reservation = "SELECT count(*) as nb_reservations from reservation";
$result_reservations = $conn->query($sql_reservation);
$reservations = $result_reservations->fetch_assoc();

$sql_employee = "SELECT count(*) as nb_employees from employees";
$result_employee = $conn->query($sql_employee);
$employee = $result_employee->fetch_assoc();

$conn->close();
?>
<style>
    .projects .responsive-table {
        overflow-x: auto;
    }

    .projects table {
        min-width: 1000px;
        border-spacing: 0;
    }

    .projects thead td {
        background-color: #eee;
        font-weight: bold;
    }

    .projects table td {
        padding: 15px;
    }

    .projects tbody td {
        border-bottom: 1px solid #eee;
        border-left: 1px solid #eee;
        transition: 0.3s;
    }

    .projects table tbody tr td:last-child {
        border-right: 1px solid #eee;
    }

    .projects tbody tr:hover td {
        background-color: #faf7f7;
    }

    .projects table img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        padding: 2px;
        background-color: white;
    }

    .projects table img:not(:first-child) {
        margin-left: -20px;
    }

    .projects table .label {
        font-size: 13px;
    }




    .counter {
        display: block;
        font-size: 32px;
        font-weight: 700;
        color: #0e2737;
        line-height: 28px
    }
</style>

<body>
    <div class="container-fluid position-relative  d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border " style="width: 5rem; height: 5rem; color:#1cc3b2" role="status">
                <span class="sr-only " style="color:#1cc3b2">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php require('common/sidebar.php'); ?>

        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content  bg-light">
            <!-- Navbar Start -->
            <?php require('common/navbar.php'); ?>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row ">
                    <h3>Dashboard</h3>
                    <a href="index.php" class="text-dark">
                        <p>Home
                    </a>
                    <span class="text-yellow"> / <a href="index.php" class="text-yellow">Dashboard</a></span>
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-user fa-3x text-yellow"></i>
                            <div class="ms-3">
                                <p class="mb-2">Number of rooms</p>
                                <h6 class="mb-0 counter text-center">
                                    <?php echo $rooms_count['nb_rooms']  ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class=" rounded d-flex align-items-center justify-content-between p-4" style="background-color: #0e2737;">
                            <i class="fa-solid fa-chalkboard-user fa-3x text-yellow"></i>
                            <div class="ms-3">
                                <p class="mb-2 " style="font-weight: bolder; color:white !important;font-size:16px">Number Of Reservers</p>
                                <h6 class="mb-0 counter text-center text-white">
                                    <?php echo $reservations['nb_reservations'] ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="bg-white rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-book fa-3x text-yellow"></i>
                            <div class="ms-3">
                                <p class="mb-2">Number of Employees</p>
                                <h6 class="mb-0 counter text-center">
                                    <?php echo $employee['nb_employees']  ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {

                            $('.counter').each(function() {
                                $(this).prop('Counter', 0).animate({
                                    Counter: $(this).text()
                                }, {
                                    duration: 4000,
                                    easing: 'swing',
                                    step: function(now) {
                                        $(this).text(Math.ceil(now));
                                    }
                                });
                            });

                        });
                    </script>
                </div>
            </div>
            <!-- room Start-->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white text-center rounded p-4">
                    <h1 class="mb-0 text-center mb-3" style="background-color: #0e2737; color:#1cc3b2 !important">Our Rooms</h1>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php foreach ($rooms as $room) { ?>

                            <div class="col mb-4">
                                <div class="card p-2">
                                    <td id="image">
                                        <img src="hotel/image/rooms/<?php echo $room['room_image'] ?>" width="100%" height="190px" alt="">
                                    </td>
                                    <hr>
                                    <div class="card-body text-start">
                                        <h4 class="card-title">
                                            Room Name: <?php echo $room['room_name'] ?>
                                            <span style="float:right" class="badge" style="vertical-align: middle;">

                                            </span>
                                        </h4>
                                        <p class="card-text">Type: <?php echo $room['room_type'] ?></p>
                                        <p class="card-text">Description: <?php echo $room['room_description'] ?> </p>
                                        <p class="card-text">Price/Night: <?php echo $room['price_per_night'] ?></p>
                                        <p class="card-text">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- room End-->
            <!-- Footer Start -->
            <?php require('common/footer.php'); ?>
            <!-- Footer End -->
            <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="padding:10px;border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
    </div>

    <!-- script start -->
    <?php require('common/script.php'); ?>
    <!-- script End -->
</body>

</html>