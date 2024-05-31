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

        li {
            list-style-type: none !important;
        }
    </style>
    <?php
    session_start();
    require('common/header.php');
    include('connect.php');

    $sql = "SELECT services.*, rooms.* FROM services INNER JOIN rooms ON services.room_id = rooms.room_id";
    $result = $conn->query($sql);
    $services = $result->fetch_all(MYSQLI_ASSOC);

    $sql_rooms = "SELECT * FROM  rooms ";
    $result_rooms = $conn->query($sql_rooms);
    $rooms = $result_rooms->fetch_all(MYSQLI_ASSOC);
    // var_dump($services);
    // exit;
    $sql_config = "SELECT * FROM `config`";
    $result_config = $conn->query($sql_config);
    $config = $result_config->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    ?>
    <div class="modal fade" id="updateService1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <div class="modal-header " style="background-color: #3D464D;">
                    <h1 class="modal-title fs-5 text-white" id="addCategory">Update Service</h1>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateService" action="updateService.php">
                        <div class="input-group mb-3" hidden>
                            <span class="input-group-text">ID</span>
                            <input type="text" name="service_id" id="updateID" class="form-control">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text w-120 text-center" style="width: 150px !important;">Room Type</span>
                            <select class="form-select" name="room_Id" id="updateRoomId" required>
                                <option value="" disabled>Select Room Type</option>
                                <?php foreach ($rooms as $room) {
                                    $selected = ($room['room_id'] == $ser['room_id']) ? 'selected' : '';
                                    echo '<option value="' . $room['room_id'] . '" ' . $selected . '>' . $room['room_type'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 150px !important;">Name</span>
                            <input type="text" name="name" id="updateName" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 150px !important;">Description</span>
                            <input type="text" name="description" id="updateDescription" class="form-control" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 150px !important;">price</span>
                            <input type="number" name="price" id="updatePrice" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

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
                        <h3>Service</h3>
                        <a href="index.php" class="text-dark">
                            <p>Home
                        </a> <span class="text-yellow"> / <a href="servicesDetails.php" class="text-yellow">Services</a></span></p>
                    </div>
                    <div class="card height-auto border-0">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Services Data</h3>
                                </div>
                            </div>
                            <button type="button" class="btn  float-end text-dark" data-bs-toggle="modal" data-bs-target="#myModal" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">
                                + Add Services
                            </button>
                            <div class="card-body">
                                <div class="modal" id="myModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content border-0">
                                            <div class="modal-header " style="background-color: #0e2737;">
                                                <h1 class="modal-title fs-5 text-white" id="addCategory">Add new service</h1>
                                                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="addService.php" id="addForm">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text w-120 text-center" style="width: 150px !important;">Room Type</span>
                                                        <select class="form-select" name="room_id" required>
                                                            <option value="" disabled selected>Select Room Type</option>
                                                            <?php foreach ($rooms as $room) {
                                                                echo '<option value="' . $room['room_id'] . '">' . $room['room_type'] . '</option>';
                                                            } ?>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text w-120 text-center" style="width: 150px !important;">Name</span>
                                                        <input type="text" class="form-control" name="name" placeholder="Enter Service Name" required autocomplete="off">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text w-120 text-center" style="width: 150px !important;">Description</span>
                                                        <input type="text" class="form-control" name="description" placeholder="Enter Service Description" required autocomplete="off">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text w-120 text-center" style="width: 150px !important;">Price</span>
                                                        <input type="number" class="form-control" name="price" placeholder="Enter Service Price" required autocomplete="off">
                                                    </div>

                                                    <br>
                                                    <div class="d-flex align-items-center float-end">
                                                        <button type="button" class="btn me-4" style="background-color: red; border-radius: 4px; letter-spacing: 1px; font-weight: bold">
                                                            <a href="servicesDetails.php" style="color: white;">Close</a>
                                                        </button>
                                                        <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2; color: white; border-radius: 4px; letter-spacing: 1px; font-weight: bold">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" row mt-4">
                                <div class="table-responsive">

                                    <table id="dataTable" class="table display data-table text-nowrap table-striped" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Services Name</th>
                                                <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Room Type</th>
                                                <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Services Description</th>
                                                <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Services Price</th>
                                                <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($services as $ser) {
                                            ?>
                                                <tr class="text-center">
                                                    <td id="#"><?php echo $ser['service_name']; ?></td>
                                                    <td id="#"><?php echo $ser['room_type']; ?></td>
                                                    <td id="#"><?php echo $ser['service_description']; ?></td>
                                                    <td id="#"><?php echo $config[0]['value'] . $ser['service_price']; ?></td>
                                                    <td>
                                                        <a href="#" class="delete" data-id=<?php echo $ser['service_id'] ?>>
                                                            <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                        </a>
                                                        <a href="#" title="Update" class="edit" data-id="<?php echo $about['about_id'] ?>" id="<?php echo $ser['service_id'] ?>" name="<?php echo $ser['service_name'] ?>" description="<?php echo $ser['service_description'] ?>" price="<?php echo $ser['service_price'] ?>" data-bs-toggle="modal" data-bs-target="#updateService1"><i class=" fa-solid fa-pen-to-square" style="color: green;"></i></a>
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
                                    service_id: id
                                },
                                url: 'deleteService.php',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Service deleted successfully!",
                                            icon: "success"
                                        }).then((result) => {
                                            window.location.href = 'servicesDetails.php';
                                        });
                                    } else {
                                        Swal.fire('You cannot delete this Services');
                                    }
                                }
                            })
                        }
                    });
                });

                $('#addForm').submit(function(e) {
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
                                        window.location.href = 'ServicesDetails.php';
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
        <script>
            $('.edit').on('click', function() {
                var id = $(this).attr('id');
                var name = $(this).attr('name');
                var description = $(this).attr('description');
                var price = $(this).attr('price');


                $('#updateID').val(id);
                $('#updateName').val(name);
                $('#updateDescription').val(description);
                $('#updatePrice').val(price);


            });
            $('#updateService').submit(function(e) {
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
                                window.location.href = 'ServicesDetails.php';
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
        </script>
    </body>

    </html>