<?php
require('common/header.php');
?>
<?php
require('../connect.php');

$sql = "SELECT rooms.room_id, rooms.room_name,rooms.room_image, rooms.room_number, rooms.room_type, room_status.status_id,rooms.price_per_night, room_status.data, room_status.status FROM rooms INNER JOIN room_status ON rooms.room_id = room_status.room_id;";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);

$sql_slider = "SELECT * from sliders";
$result_slider = $conn->query($sql_slider);
$sliders = $result_slider->fetch_all(MYSQLI_ASSOC);

$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);
// var_dump($footer);exit;
$sql_about = "SELECT * from aboutus";
$result_about = $conn->query($sql_about);
$about = $result_about->fetch_assoc();

$sql_services = "SELECT * from services";
$result_services = $conn->query($sql_services);
$services = $result_services->fetch_all(MYSQLI_ASSOC);
// var_dump($services);
// exit;
$conn->close();

?>
<style>
    .hotel_img img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<body>
    <!--================Header Area =================-->
    <?php require('common/navbar.php'); ?>
    <!--================Header Area =================-->

    <!--================Banner Area =================-->
    <section class="banner_area" style="background-image: url('image/banner/<?php echo $sliders[0]['image'] ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2><?php echo $sliders[0]['head_text'] ?></h2>
                    <p><?php echo $sliders[0]['primary_text'] ?></p>
                </div>
            </div>
        </div>
    </section>
    <!--================Banner Area =================-->




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
    <!--================ Rooms Area  =================-->
    <section class="accommodation_area section_gap">
        <div class="container">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="pr-3">Our Rooms</span>
                <hr>
            </h2>
            <div class="row mb_30">
                <?php if (count($rooms) > 4) { ?>
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($rooms as $k => $room) { ?>
                                <?php if ($k % 4 == 0) { ?>
                                    <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?>">
                                        <div class="row">
                                        <?php } ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="accommodation_item text-center">
                                                <div class="hotel_img">
                                                    <img src="image/rooms/<?php echo $room['room_image'] ?>" alt="" style="width:20px !important; height:20px !important">
                                                    <a href="book.php?room_id=<?php echo $room['room_id'] ?>" class="btn theme_btn button_hover ">Book Now</a>
                                                </div>
                                                <h4 class=""><?php echo $room['room_type'] ?></h4>
                                                <h5>$<?php echo $room['price_per_night'] ?><small>/night</small></h5>
                                            </div>
                                        </div>

                                        <?php if (($k + 1) % 4 == 0 || $k === count($rooms) - 1) { ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <?php foreach ($rooms as $room) { ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="accommodation_item text-center">
                                <div class="hotel_img">
                                    <img src="image/rooms/<?php echo $room['room_image'] ?>" alt="">
                                    <a href="book.php?room_id=<?php echo $room['room_id'] ?>" class="btn theme_btn button_hover btn-info">Book Now</a>
                                </div>
                                <a href="#">
                                    <h4 class="sec_h4"><?php echo $room['room_type'] ?></h4>
                                </a>
                                <h5>$<?php echo $room['price_per_night'] ?><small>/night</small></h5>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>

    <!--================ Rooms Area  =================-->
    <!--================ Services Area  =================-->

    <section class="testimonial_area section_gap mb-4">
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
                        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?>">
                            <div class="row">
                                <?php foreach ($serviceChunk as $ser) { ?>
                                    <div class="col-lg-4">
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


    <!--================ Services Area  =================-->


    <!--================ start footer Area  =================-->
    <?php require('common/footer.php'); ?>
    <!--================ End footer Area  =================-->

    <!--================ Start Script  =================-->
    <?php require('common/script.php'); ?>
    <!--================ End Script  =================-->
</body>

</html>