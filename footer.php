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


$sql = "SELECT * from footer";
$result = $conn->query($sql);
$footer = $result->fetch_assoc();
$conn->close();
?>


<div class="modal fade" id="updateFooter1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #0e2737;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">Update Footer</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateFooterr" action="updateFooter.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text">ID</span>
                        <input type="text" name="footer_id" id="updateID" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Address</span>
                        <input type="text" name="address" id="updateAddress" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Email</span>
                        <input type="text" name="email" id="updateEmail" class="form-control" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" style="width: 130px;">Phone Number</span>
                        <input type="number" name="phone_number" id="updatePhoneNumber" class="form-control">
                    </div>
                    <div id="imagee"></div>
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
                    <h3>Footer</h3>
                    <a href="index.php" style="color: black;">
                        <p>Home
                    </a> <span style="color: #1cc3b2;"> / <a href="footer.php" style="color:#1cc3b2">Footer</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Footer Data</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn  edit" data-id="<?php echo $footer['footer_id'] ?>" email="<?php echo $footer['email'] ?>" phoneNumber="<?php echo $footer['phone_number'] ?>" address="<?php echo $footer['address'] ?>" data-bs-toggle="modal" data-bs-target="#updateFooter1" style="background-color:#1cc3b2;text-align:right">
                                    Update Footer
                                </button>
                            </div>
                        </div>
                        <div class=" row mt-4">
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 mb-3 ">
                                    <div class="shadow p-3 mb-5 bg-body rounded" style="min-height: 220px;">
                                        <h4 class="text-center mb-2">Address</h4>
                                        <div class="card-body">
                                            <h6> <?php echo $footer['address'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mb-3">
                                    <div class="shadow p-3 mb-5 bg-body rounded" style="min-height: 220px;">
                                        <h4 class="text-center mb-2">Phone Number</h4>
                                        <div class="card-body">
                                            <?php echo $footer['phone_number'] ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mb-3">
                                    <div class="shadow p-3 mb-5 bg-body rounded" style="min-height: 220px;">
                                        <h4 class="text-center mb-2">E-mail</h4>
                                        <div class="card-body">
                                            <?php echo $footer['email'] ?>
                                        </div>
                                    </div>
                                </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- script End -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

        });
    </script>
    <script>
        $('.edit').on('click', function() {
            var id = $(this).data('id');
            var email = $(this).attr('email');
            var address = $(this).attr('address');
            var phoneNumber = $(this).attr('phoneNumber');


            $('#updateID').val(id);
            $('#updatePhoneNumber').val(phoneNumber);
            $('#updateEmail').val(email);
            $('#updateAddress').val(address);


        });
        $('#updateFooterr').submit(function(e) {
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
                            window.location.href = 'footer.php';
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