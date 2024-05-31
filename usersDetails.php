<script src="js/sweetAlert.js"></script>
<script src='js/jQuery.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php
session_start();
$user_id = $_SESSION['user_id'];
require('common/header.php');
include('connect.php');
$sql_userType = "SELECT * FROM users where users.user_id = '$user_id'";
$result_userType = $conn->query($sql_userType);
$user = $result_userType->fetch_assoc();
$sql = "SELECT * from users";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($users);
// exit;
$conn->close();

?>
<div class="modal" id="addProduct1" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header " style="background-color: #1cc3b2;">
                <h1 class="modal-title fs-5 text-white" id="addProduct">Add User</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120 text-center" style="width: 130px !important;">User Name</span>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;"> user password</span>
                        <input type="password" class="form-control" id="" name="userPassword" placeholder="Enter User Password" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text w-120" style="width: 130px !important;">User Type</span>
                        <input type="text" class="form-control" id="" name="userType" value="client" readonly required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;">Nationality</span>
                        <input type="text" class="form-control" id="" name="nationality" placeholder="Enter Nationality" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;">Check In</span>
                        <input type="date" class="form-control" id="" name="checkIn" placeholder="Enter Check In" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;">Check Out</span>
                        <input type="date" class="form-control" id="" name="checkOut" placeholder="Enter Check Out" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;">Phone Number</span>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" required autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;"> Address</span>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required autocomplete="off">
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="image" name="my_work" placeholder="Enter Image" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text w-120" style="width: 130px !important;"> E-mail</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail" aria-label="Username" required autocomplete="off">
                    </div>
                    <br>
                    <div class="d-flex align-items-center float-end">
                        <button type="close" class="btn me-4 " style="background-color:red; border-radius:4px; letter-spacing:1px;font-weight:bold ">
                            <a href="usersDetails.php" style="color:white;">Close</a>
                        </button>
                        <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                    </div>
                </form>
            </div>
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
                    <h3>Users</h3>
                    <a href="index.php" class="text-dark">
                        <p>Home
                    </a> <span class="text-yellow"> / <a href="usersDetails.php" class="text-yellow">All Users</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center pt-4">
                            <div class="col-6">
                                <h3>All Users</h3>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn  float-end fw-bold text-dark bg-yellow border-2" data-bs-toggle="modal" data-bs-target="#addProduct1">
                                    + Add User </button>
                            </div>
                        </div>

                        <!-- The Modal -->


                        <div class="row">
                            <div class="table-responsive table-bordered table-hover">
                                <table id="dataTable" class="table display data-table text-nowrap table-striped" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th hidden></th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">User Profile</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">User Name</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">E-mail</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">address</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Phone Number</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) { ?>
                                            <tr class="text-center">
                                                <td id="" hidden><?php echo $user['user_id']; ?></td>
                                                <td id=""><img src="img/students/<?php echo $user['user_image'] ?>" width="10%" alt=""></td>
                                                <td id=""><?php echo $user['userName']; ?></td>
                                                <td id=""><?php echo $user['email']; ?></td>
                                                <td id=""><?php echo $user['address']; ?></td>
                                                <td id=""><?php echo $user['phone_number']; ?></td>
                                                <td>
                                                    <a data-id="<?php echo $user['user_id']; ?>" class="delete">
                                                        <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                    </a>
                                                    <button type="button" class="btn" data-bs-toggle="modal">
                                                        <a href="update_form_products.php?product_id=<?php echo $user["user_id"] ?>" title="Update">
                                                            <i class=" fa-solid fa-pen-to-square" style="color: green;"></i>
                                                        </a>
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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="padding:10px;border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>

    <!-- script start -->
    <?php require('common/script.php'); ?>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="jquery-3.7.1.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/sweetAlert.js"></script>
    <!-- <script src='js/jQuery.js'></script> -->
    <!-- script End -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $('#addForm').submit(function(e) {
            e.preventDefault();
            var form = new FormData(this);
            $.ajax({
                url: 'addUser.php',
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
                                confirmButton: 'button btn btn-primary '
                            }
                        }).then(function() {
                            window.location.replace('usersDetails.php');
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
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
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
                        type: 'GET',
                        data: {
                            user_id: id
                        },
                        url: 'deleteUser.php',

                        success: function(response) {
                            console.log(response);
                            if (response == 0) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then(function() {
                                    window.location.replace('usersDetails.php');
                                });
                            } else {
                                Swal.fire('You can not deleted this user')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        },
                    })
                }
            });
        });
    </script>
</body>

</html>