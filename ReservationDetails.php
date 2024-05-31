<script src="js/sweetAlert.js"></script>
<style>
    .custom-confirm-button-class {
        background-color: #1cc3b2;
        color: white;
        width: 150px;
        height: 50px;
        font-size: 30px;
        font-weight: bolder;
    }
</style>
<?php
session_start();
require('common/header.php');
require('connect.php');
$user_id = $_SESSION['user_id'];
$sql = "SELECT *, rooms.room_name, rooms.room_id, users.user_id,users.FirstName, users.LastName, users.email, rooms.room_number FROM reservation INNER JOIN rooms ON reservation.room_id = rooms.room_id INNER JOIN users ON reservation.user_id = users.user_id GROUP BY users.FirstName";
$result = $conn->query($sql);
$reservations = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php require('common/sidebar.php'); ?>
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require('common/navbar.php'); ?>
            <!-- Navbar End -->
            <!-- Blank Start -->
            <div class="container-fluid pt-4 min-vh-100 bg-light">
                <div class="row ms-2">
                    <h3>Reservation</h3>
                    <a href="index.php" style="color: black;">
                        <p>Home
                    </a> <span style="color: #1cc3b2;"> / <a href="reservationDetails.php" style="color:#1cc3b2">All Reservers</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Reservation Data</h3>
                            </div>
                        </div>

                        <div class=" row mt-4">
                            <div class="table-responsive">
                                <table class="table display data-table text-nowrap table-striped" id="dataTable" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Reserver Name</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">E-mail</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Floor/Number</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Start Date</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">End Date</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservations as $res) { ?>
                                            <tr class="text-center">
                                                <td id=""><?php echo $res['FirstName'] . " " . $res['LastName'] ?></td>
                                                <td id=""><?php echo  $res['email'] ?></td>
                                                <td id=""><?php echo $res['room_number']; ?> / <?php echo $res['room_name']; ?></td>
                                                <td id=""><?php echo $res['check_in']; ?></td>
                                                <td id=""><?php echo $res['chack_out']; ?></td>
                                                <td id=""><a href="ReservationInfo.php?user_id=<?php echo $res['user_id'] ?>">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </a></td>
                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->

            <!-- Footer Start -->
            <?php require('common/footer.php'); ?>
            <!-- Footer End -->

        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>

    <!-- script start -->
    <?php require('common/script.php'); ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $('#selectInstructor').select2();
            $('#selectCourse').select2();

        });
    </script>

    <!-- script End -->

</body>

</html>