<?php
require('common/header.php');
?>

<?php
require('../connect.php');
$sql = "SELECT rooms.room_id, rooms.room_name,rooms.room_image, rooms.room_number, rooms.room_type, room_status.status_id,rooms.price_per_night, room_status.data, room_status.status FROM rooms INNER JOIN room_status ON rooms.room_id = room_status.room_id limit 5;";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);
$sql_about = "SELECT * from aboutus";
$result_about = $conn->query($sql_about);
$about = $result_about->fetch_assoc();
$sql_services = "SELECT * from services";
$result_services = $conn->query($sql_services);
$services = $result_services->fetch_all(MYSQLI_ASSOC);

$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);
$conn->close();

?>

<body>
    <!--================Header Area =================-->
    <?php require('common/navbar.php'); ?>

    <!--================Header Area =================-->

    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">About</li>
            </ol>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color"><?php echo $about['about_title'] ?></h2>
                        <p><?php echo $about['about_description'] ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="../img/about/<?php echo $about['about_image'] ?>" alt="img">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->

    <section class="testimonial_area section_gap mb-4" style="background-color: #1cc3b2;">
        <div class="container">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="pr-3">Our Services</span>
                <hr>
            </h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    // Split services into chunks of 3
                    $serviceChunks = array_chunk($services, 3);
                    foreach ($serviceChunks as $k => $serviceChunk) { ?>
                        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> ">
                            <div class="row">
                                <?php foreach ($serviceChunk as $ser) { ?>
                                    <div class="col-lg-4 ">
                                        <div class="media testimonial_item">
                                            <div class="media-body shadow m-4 p-4 bg-white text-center" style="min-height: 350px;">
                                                <h4 class="sec_h4"><?php echo $ser['service_name'] ?></h4>
                                                <p><?php echo $ser['service_description'] ?></p>
                                                <h2><?php echo $ser['service_price'] ?>$</h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" style="color: white;" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" style="color: white;" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!--================ start footer Area  =================-->
    <?php require('common/footer.php'); ?>

    <!--================ End footer Area  =================-->


    <?php require('common/script.php'); ?>

</body>

</html>