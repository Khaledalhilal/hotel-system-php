<script src="js/sweetAlert.js"></script>
<script src='js/jQuery.js'></script>
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
if (!isset($_SESSION['email'])) {
    echo " <script> window.location.href='signin.php';</script>;";
}
include('connect.php');
require('common/header.php');
$user_id = $_SESSION['user_id'];
$sql_userType = "SELECT * FROM users where users.user_id = '$user_id'";
$result_userType = $conn->query($sql_userType);
$user = $result_userType->fetch_assoc();

$sql = "SELECT employees.*, users.* FROM employees INNER JOIN users ON employees.user_id = users.user_id";
$result = $conn->query($sql);
$employees = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($employees);exit;
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
                    <h3>Employees</h3>
                    <a href="index.php" style="color: black;">
                        <p>Home
                    </a> <span style="color: #1cc3b2;"> / <a href="employeeDetails.php" style="color:#1cc3b2">All
                            Employees</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Employees Data</h3>
                            </div>

                        </div>

                        <button type="button" class="btn float-end btn-width-sm text-dark" data-bs-toggle="modal" data-bs-target="#myModal" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">
                            + Add Employee </button>
                        <div class="card-body">

                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog border-0 ">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-dark">
                                            <h1 class="modal-title fs-5 text-white" id="addImage">Add New Employee </h1>
                                            <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="addEmployee.php" method="post" enctype="multipart/form-data">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">First Name</span>
                                                    <input type="text" class="form-control" name="fName" placeholder="Enter Fist Name" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Last Name</span>
                                                    <input type="text" class="form-control" name="lName" placeholder="Enter Last Name" required autocomplete="off">
                                                </div>

                                                <div class="input-group mb-3" hidden>
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;"> Password</span>
                                                    <input type="password" class="form-control" id="email" name="password" value="noPassword" placeholder="Enter password" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Position</span>
                                                    <input type="text" class="form-control" id="" name="posit" placeholder="Enter Position" required autocomplete="off">
                                                </div>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Salary</span>
                                                    <input type="number" class="form-control" id="" name="salary" placeholder="Enter Salary" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Nationality</span>
                                                    <input type="text" class="form-control" id="" name="nationality" placeholder="Enter Nationality" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Check In Date</span>
                                                    <input type="date" class="form-control" id="" name="checkIn" placeholder="Enter Check In Date" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Check out Date</span>
                                                    <input type="date" class="form-control" id="" name="checkOut" placeholder="Enter Check In Date" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3" hidden>
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">user Type</span>
                                                    <input type="text" class="form-control" id="phoneNumber" name="userType" value="employee" required autocomplete="off">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;">Phone Number</span>
                                                    <input type="number" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter Phone Number" required autocomplete="off">
                                                </div>


                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" id="image" name="my_work" placeholder="Enter Image" required>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text w-120 text-center" style="width: 130px !important;"> E-mail</span>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail" required autocomplete="off">
                                                </div>

                                                <br>
                                                <div class="d-flex align-items-center float-end">
                                                    <button type="submit" class="btn me-4 " style="background-color:red; border-radius:4px; letter-spacing:1px;font-weight:bold ">
                                                        <a href="employeeDetails.php" style="color:white;">Close</a>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" row mt-4">
                            <div class="table-bordered table-responsive table-hover">
                                <table class="table display data-table text-nowrap table-striped" id="dataTable" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th hidden></th>
                                            <th hidden></th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Employee Profile</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Employee Name</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">E-mail</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Phone Number</th>
                                            <th class="sorting text-center text-white" style="background-color: #1cc3b2;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($employees as $emp) {
                                        ?>
                                            <tr class="text-center">
                                                <td id="" hidden><?php echo $emp['user_id']; ?></td>
                                                <td id="" hidden><?php echo $emp['employee_id']; ?>
                                                </td>
                                                <td id="" style="width: 5%; height:5%">
                                                    <img src="img/employee/<?php echo $emp['image'] ?>" width="100%" alt="">
                                                </td>

                                                <td id=""><?php echo $emp['FirstName'] . " " . $emp['LastName']; ?>
                                                </td>
                                                <td id=""><?php echo $emp['email']; ?>
                                                </td>
                                                </td>
                                                <td id="">
                                                    <?php echo $emp['phone_number']; ?></td>
                                                <td>
                                                    <a href="#" onclick="confirmDelete(<?php echo $emp['employee_id']; ?>, '<?php echo $emp['FirstName']; ?>');">
                                                        <i class="fa-solid fa-trash" style="color: red; margin-right: 10px;" title="Delete"></i>
                                                    </a>
                                                    <script>
                                                        function confirmDelete(empID, fullName) {
                                                            swal.fire({
                                                                title: 'Are you sure to delete ' + fullName + '?',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#1cc3b2',
                                                                cancelButtonColor: 'red',
                                                                confirmButtonText: 'DELETE'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    window.location.href = 'deleteEmployee.php?employee_id=' + empID;
                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    <a href="updateFormEmployee.php?employee_id=<?php echo $emp['employee_id']; ?>&user_id=<?php echo $emp['user_id']; ?>" title="Update"><i class=" fa-solid fa-pen-to-square" style="color: green;"></i></a>

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
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>

    <!-- script start -->
    <?php require('common/script.php'); ?>
    <!-- script End -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

        });
    </script>

</body>

</html>