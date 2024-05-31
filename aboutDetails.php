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


$sql = "SELECT * from aboutus";
$result = $conn->query($sql);
$about = $result->fetch_assoc();
$conn->close();
?>


<div class="modal fade" id="updateAbout1" tabindex="-1" aria-labelledby="updateCoupon" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header " style="background-color: #0e2737;">
                <h1 class="modal-title fs-5 text-white" id="addCategory">Update About</h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateAboutt" action="updateAbout.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3" hidden>
                        <span class="input-group-text">ID</span>
                        <input type="text" name="about_id" id="updateID" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Title</span>
                        <input type="text" name="title" id="updateTitle" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <input type="text" name="description" id="updateDescription" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" name="my_work" class="form-control">
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
                    <h3>About Us</h3>
                    <a href="index.php" style="color: black;">
                        <p>Home
                    </a> <span style="color: #1cc3b2;"> / <a href="aboutDetails.php" style="color:#1cc3b2">All
                            about</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All About Us Data</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn  edit" data-id="<?php echo $about['about_id'] ?>" title="<?php echo $about['about_title'] ?>" description="<?php echo $about['about_description'] ?>" img="<?php echo $about['about_image'] ?>" data-bs-toggle="modal" data-bs-target="#updateAbout1" style="background-color:#1cc3b2;text-align:right">
                                    Update About
                                </button>
                            </div>
                        </div>
                        <div class=" row mt-4">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mb-3 ">
                                    <div class="shadow p-3 mb-5 bg-body rounded" style="min-height: 220px;">
                                        <h4 class="text-center mb-2">Title</h4>
                                        <div class="card-body">
                                            <h6> <?php echo $about['about_title'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mb-3">
                                    <div class="shadow p-3 mb-5 bg-body rounded">
                                        <h4 class="text-center mb-2">Description</h4>
                                        <div class="card-body">
                                            <?php echo $about['about_description'] ?>
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <div class="col-lg-6 col-sm-12 mb-3">
                                        <div class="shadow p-3 mb-5 bg-body rounded">
                                            <h4 class="text-center mb-2">About Image</h4>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <img src="img/about/<?php echo $about['about_image'] ?>" width="100%" height="200px" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </center>
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
            var title = $(this).attr('title');
            var description = $(this).attr('description');
            var img = $(this).attr('img');


            $('#updateID').val(id);
            $('#updateTitle').val(title);
            $('#updateDescription').val(description);
            $('#imagee').html('<img src="img/about/' + img + '" height="150px" width="150px" alt="">');


        });
        $('#updateAboutt').submit(function(e) {
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
                            window.location.href = 'aboutDetails.php';
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