<script src="js/sweetAlert.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<?php

session_start();

if (!isset($_SESSION['email'])) {
    echo " <script> window.location.href='signin.php';</script>;";
}
include('connect.php');


$sql = "SELECT * FROM contactus";
$result = $conn->query($sql);
$contacts = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($contacts);
// exit;
$sql_config = "SELECT * FROM `config`";
$result_config = $conn->query($sql_config);
$config = $result_config->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<?php require('common/header.php') ?>

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
                    <h3>Contacted-Us</h3>
                    <a href="index.php" class="text-dark">
                        <p>Home
                    </a> <span class="text-yellow"> / <a href="" class="text-yellow">Contacts</a></span></p>
                </div>
                <div class="card height-auto border-0">
                    <div class="card-body">
                        <div class="row d-flex justify-content-center align-items-center pt-4">

                        </div>

                        <div class="row">
                            <div class="table-responsive table-bordered table-hover">
                                <table id="dataTable" class="table display data-table text-nowrap table-striped" role="grid">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Name</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Email</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Subject</th>
                                            <th class="sorting text-center" style="background-color: #1cc3b2;">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($contacts as $contact) {
                                        ?>
                                            <tr class="text-center">
                                                <td><?php echo $contact['user_name']; ?> </td>
                                                <td><?php echo $contact['user_email']; ?></td>
                                                <td><?php echo $contact['subject']; ?></td>
                                                <td><?php echo $contact['message']; ?></td>

                                               
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
                console.log(id);
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
                                contact_id: id
                            },
                            url: 'deletecontact.php',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Contact deleted successfully!",
                                        icon: "success"
                                    }).then((result) => {
                                        window.location.href = 'contactus.php';
                                    });
                                } else {
                                    Swal.fire('You cannot delete this contact');
                                }
                            }
                        })
                    }
                });
            });

        });
    </script>

</body>

</html>