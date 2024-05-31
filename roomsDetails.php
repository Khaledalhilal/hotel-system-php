<script src="js/sweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<?php

session_start();

if (!isset($_SESSION['email'])) {
    echo " <script> window.location.href='signin.php';</script>;";
}
include('connect.php');


$sql = "SELECT rooms.room_id,rooms.room_description, rooms.room_name,rooms.room_image, rooms.room_number, rooms.room_type, room_status.status_id,rooms.price_per_night, room_status.data, room_status.status FROM rooms INNER JOIN room_status ON rooms.room_id = room_status.room_id;";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rooms);
// exit;
$sql_config = "SELECT * FROM `config`";
$result_config = $conn->query($sql_config);
$config = $result_config->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<?php require('common/header.php') ?>
<div class="card-body">
    <div class="modal" id="myModal">
        <div class="modal-dialog border-0 ">
            <div class="modal-content border-0">
                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5 text-white" id="addImage">Add New Room </h1>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="addRoom.php" method="post" id="addForm" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Room Number</span>
                            <input type="number" class="form-control" name="roomNb" placeholder="Enter Room Number" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Floor </span>
                            <input type="text" class="form-control" name="floor" placeholder="Enter Floor " required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Room Type</span>
                            <input type="text" class="form-control" name="type" placeholder="Enter Room Type" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Status</span>
                            <input type="text" class="form-control" name="status" placeholder="Enter Status" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Date</span>
                            <input type="date" class="form-control" name="date" placeholder="Enter Date" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Price/Night</span>
                            <input type="number" class="form-control" name="price" placeholder="Enter Price" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text w-120" style="width: 150px !important;">Description</span>
                            <input type="text" class="form-control" name="des" placeholder="Enter Description" required autocomplete="off">
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="my_work" placeholder="Enter Image" required autocomplete="off">
                        </div>

                        <br>
                        <div class="d-flex align-items-center float-end">
                            <button type="submit" class="btn me-4 " style="background-color:red; border-radius:4px; letter-spacing:1px;font-weight:bold ">
                                <a href="roomsDetails.php" style="color:white;">Close</a>
                            </button>
                            <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<body>

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php require('common/sidebar.php'); ?>
        <!-- Sidebar End -->


        <div class="content">
            <!-- Navbar Start -->
            <?php require('common/navbar.php'); ?>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 min-vh-100 bg-light">
                <div class="row ms-2">
                    <h3>Rooms</h3>
                    <a href="index.php" class="text-dark">
                        <p>Home
                    </a> <span class="text-yellow"> / <a href="roomsDetails.php" class="text-yellow">Rooms</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center pt-4">
                            <div class="col-6">
                                <h3>All Rooms</h3>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn  float-end fw-bold text-dark bg-yellow border-2" data-bs-toggle="modal" data-bs-target="#myModal" style=" letter-spacing:1px; ">
                                    +Add Room </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive table-bordered table-hover">
                                <table id="dataTable" class="table display data-table text-nowrap table-striped" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting text-center text-white" hidden>room ID</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Room Image</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Number - Floor</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Room Type</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Status</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Date</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">price/night</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Description</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rooms as $room) {
                                        ?>
                                            <tr class="text-center">
                                                <td id="roomIDCell" hidden><?php echo $room['room_id']; ?></td>
                                                <td id=""><img src="hotel/image/rooms/<?php echo $room['room_image'] ?>" alt="Image Not Found" width="100%"></td>
                                                <td id=""><?php echo $room['room_number']; ?> - <?php echo $room['room_name']; ?></td>
                                                <td id=""><?php echo $room['room_type']; ?></td>
                                                <td id=""><?php echo $room['status']; ?></td>
                                                <td id=""><?php echo $room['data']; ?></td>

                                                <td id="priceCell"><?php echo $config[0]['value'] . $room['price_per_night']; ?></td>
                                                <td id=""><?php echo $room['room_description']; ?></td>
                                                <td>
                                                    <a data-id="<?php echo $room['room_id']; ?>" class="delete">
                                                        <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                    </a>
                                                    <button type="button" class="btn" data-bs-toggle="modal">
                                                        <a href="updateFormRoom.php?room_id=<?php echo $room['room_id'] ?>" title="Update"><i class=" fa-solid fa-pen-to-square" style="color: green;"></i></a>

                                                    </button>
                                                </td>
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
            <div class="container-fluid">
                <?php require('common/footer.php'); ?>
            </div>
            <!-- Footer End -->
        </div>
    </div>
    <!-- Content End -->


    <!-- Modal End for Course Type -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="padding:10px;border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>

    <!-- script start -->
    <?php require('common/script.php'); ?>

    <!-- script End -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            $('.delete').on('click', function() {
                // var id = $(this).attr('data-id');
                var id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            cache: false,
                            type: 'POST',
                            data: {
                                room_id: id
                            },
                            url: 'deleteRoom.php',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Room deleted successfully!",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'roomsDetails.php';
                                    });
                                } else {
                                    Swal.fire('You cannot delete this Room');
                                }
                            }
                        })
                    }
                });
            });

            $('#addForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                var form = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: form,
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary app_style'
                                }
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.href = 'roomsDetails.php';
                                }
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