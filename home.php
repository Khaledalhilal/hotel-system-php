<script src="js/sweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
require('common/header.php');
require('connect.php');
$sql = "SELECT * FROM `sliders`";
$result = $conn->query($sql);
$sliders = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($sliders);
// exit;


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="addImage" aria-hidden="true">
    <div class="modal-dialog border-0 ">
        <div class="modal-content border-0">
            <div class="modal-header bg-dark">
                <h1 class="modal-title fs-5 text-white" id="addImage">Add New Landing </h1>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="addHomeImage.php" id="addForm" method="post" enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <span class="input-group-text">Image</span>
                        <input type="file" name="my_work" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
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
            <div class="container-fluid pt-4 min-vh-100 bg-light ">
                <div class="row ms-2">
                    <h3>Home</h3>
                    <a href="index.php" style="color: black;">
                        <p>Home
                    </a> <span style="color: #1cc3b2;"> / <a href=".php" style="color:#1cc3b2">All Sliders</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col text-start ms-4 border-0">
                                <form action="">
                                    <button type="button" class="btn bg-dark text-white p-2" data-bs-toggle="modal" data-bs-target="#addImage">
                                        Update Image
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="card-body">
                                <img src="hotel/image/banner/<?php echo $sliders[0]['image'] ?>" class="d-block w-100" alt="image not found" data-item-id="<?php echo $s['id']; ?>">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="card-body">
                                <div class="col-lg-8 mb-3">
                                    <?php foreach ($sliders as $s) { ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="headInput_<?php echo $s["id"] ?>" value="<?php echo $s['head_text'] ?>">
                                            <span class="input-group-text" style="background-color: #1cc3b2 !important;border-radius:0px;">
                                                <button class="btn updateHead text-white" data-id="<?php echo $s["id"] ?>">
                                                    Update
                                                </button>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="card-body">
                                <div class="col-lg-8 mb-3">
                                    <?php foreach ($sliders as $s) { ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="primaryInput_<?php echo $s["id"] ?>" value="<?php echo $s['primary_text'] ?>">
                                            <span class="input-group-text" style="background-color: #1cc3b2 !important;border-radius:0px;">
                                                <button class="btn updatePrimary text-white" data-id="<?php echo $s["id"] ?>">
                                                    Update
                                                </button>
                                            </span>
                                        </div>
                                    <?php } ?>
                                </div>
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

    <!-- script End -->
    <script>
        $(document).ready(function() {
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
                        // console.log(response);
                        if (response.status === 'success') {
                            window.location.href = 'home.php';;
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
            $('#delete-image-button').click(function() {
                var id = $('#carouselExampleIndicators .carousel-item.active img').data('item-id');
                // console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms the deletion, send an Ajax request
                        $.ajax({
                            url: 'deleteHomeImage.php', // Replace with your server-side script
                            type: 'POST',

                            data: {
                                deleteImage_id: id,
                            }, // Send the item ID to delete
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    // Remove the deleted carousel item from the DOM
                                    $('#carouselExampleIndicators .carousel-item.active').remove();

                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your image has been deleted.',
                                        icon: 'success'
                                    }).then((result) => {
                                        window.location.href = 'home.php';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'An error occurred while deleting the image.',
                                        icon: 'error'
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('.updatePrimary').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var primary = $('#primaryInput_' + id).val(); // Get the updated title from the input field

                $.ajax({
                    url: 'updateHome/primaryText.php',
                    type: 'POST',
                    data: {
                        id: id,
                        primary: primary,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'an error occurred, please try again',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        } else {

                        }
                    }
                });
            });
            $('.updateHead').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var head = $('#headInput_' + id).val(); // Get the updated title from the input field

                $.ajax({
                    url: 'updateHome/headText.php',
                    type: 'POST',
                    data: {
                        id: id,
                        head: head,
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'an error occurred, please try again',
                                showConfirmButton: true,
                                customClass: {
                                    confirmButton: 'button btn btn-primary'
                                }
                            });
                        } else {

                        }
                    }
                });
            });
        });
    </script>
</body>

</html>