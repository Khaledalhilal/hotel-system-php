<?php
require('common/header.php');
?>
<?php
require('../connect.php');

$sql = "SELECT rooms.*, room_status.*,services.* FROM rooms INNER JOIN room_status ON rooms.room_id = room_status.room_id INNER JOIN services ON rooms.room_id=services.room_id";
$result = $conn->query($sql);
$rooms = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rooms);
// exit;
$sql_slider = "SELECT * from sliders";
$result_slider = $conn->query($sql_slider);
$sliders = $result_slider->fetch_all(MYSQLI_ASSOC);
$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);
$conn->close();

?>
<style>
    .room-section {
        padding-bottom: 0;
    }

    .spad {
        padding-top: 100px;
        padding-bottom: 100px;
    }

    .rooms-page-item {
        -webkit-box-shadow: 2px 15px 75px 6px #EBEBEB;
        box-shadow: 2px 15px 75px 6px #EBEBEB;
        margin-bottom: 100px;
    }

    .rooms-page-item .room-pic-slider .single-room-pic img {
        height: 379px;
    }

    .rooms-page-item .room-pic-slider.owl-carousel .owl-nav button[type=button] {
        color: #AE9548;
        font-size: 26px;
        height: 69px;
        width: 52px;
        background: #353535;
        line-height: 72px;
        position: absolute;
        left: 0;
        top: 50%;
        -webkit-transform: translateY(-34.5px);
        transform: translateY(-34.5px);
    }

    .rooms-page-item .room-pic-slider.owl-carousel .owl-nav button[type=button].owl-next {
        left: auto;
        right: 0;
    }

    .rooms-page-item .room-text {
        padding-top: 33px;
        padding-right: 30px;
        padding-bottom: 34px;
    }

    .rooms-page-item .room-text .room-title {
        overflow: hidden;
        margin-bottom: 18px;
        padding-right: 40px;
    }

    .rooms-page-item .room-text .room-title h2 {
        float: left;
        font-size: 36px;
        color: #2d220f;
    }

    .rooms-page-item .room-text .room-title .room-price {
        float: right;
        position: relative;
    }

    .rooms-page-item .room-text .room-title .room-price span {
        position: absolute;
        left: -40px;
        bottom: 7px;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 300;
        line-height: 14px;
        color: #2d220f;
    }

    .rooms-page-item .room-text .room-title .room-price h2 {
        font-size: 36px;
        color: #081624;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
    }

    .rooms-page-item .room-text .room-title .room-price sub {
        position: absolute;
        right: -37px;
        bottom: 13px;
        color: #2d220f;
        font-family: "Open Sans", sans-serif;
        font-weight: 300;
    }

    .rooms-page-item .room-text .room-desc {
        margin-bottom: 20px;
    }

    .rooms-page-item .room-text .room-desc p {
        font-size: 16px;
        color: #242424;
        line-height: 32px;
        letter-spacing: 0.2px;
    }

    .rooms-page-item .room-text .room-features {
        overflow: hidden;
        margin-bottom: 35px;
    }

    .rooms-page-item .room-text .room-features .room-info {
        float: left;
        text-align: center;
        margin-right: 38px;
    }

    .rooms-page-item .room-text .room-features .room-info.last {
        margin-right: 0;
    }

    .rooms-page-item .room-text .room-features .room-info i {
        display: block;
        color: #ae9548;
        margin-bottom: -4px;
    }

    .rooms-page-item .room-text .room-features .room-info span {
        display: block;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        color: #2d220f;
    }

    .rooms-page-item .room-text {
        padding-left: 35px;
    }

    .room-item .room-text {
        overflow: hidden;
        padding-left: 35px;
        padding-top: 35px;
        padding-right: 45px;
        padding-bottom: 37px;
    }

    .room-item .room-text .room-title {
        overflow: hidden;
        margin-bottom: 36px;
    }

    .room-item .room-text .room-title h2 {
        float: left;
        font-size: 36px;
        color: #2d220f;
    }

    .room-item .room-text .room-title .room-price {
        float: right;
        position: relative;
    }

    .room-item .room-text .room-title .room-price span {
        position: absolute;
        left: -40px;
        bottom: 7px;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 300;
        line-height: 14px;
        color: #2d220f;
    }

    .room-item .room-text .room-title .room-price h2 {
        font-size: 36px;
        color: #081624;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
    }

    .room-item .room-text .room-features {
        overflow: hidden;
    }

    .room-item .room-text .room-features .room-info {
        float: left;
        text-align: center;
        margin-right: 50px;
    }

    .room-item .room-text .room-features .room-info.last {
        margin-right: 0;
    }

    .room-item .room-text .room-features .room-info i {
        display: block;
        color: #ae9548;
        margin-bottom: -4px;
    }

    .room-item .room-text .room-features .room-info span {
        display: block;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        color: #2d220f;
    }

    .room-item .room-text .room-title h2 {
        font-size: 25px;
    }

    .room-item .room-text .room-title .room-price h2 {
        font-size: 25px;
    }

    .rooms-page-item .room-text .room-desc p {
        line-height: 24px;
    }

    .rooms-page-item .room-text .room-desc p {
        font-size: 16px;
        color: #242424;
        line-height: 32px;
        letter-spacing: 0.2px;
    }

    .rooms-page-item .room-text .room-features {
        overflow: hidden;
        margin-bottom: 35px;
    }

    .rooms-page-item .room-text .room-features .room-info {
        float: left;
        text-align: center;
        margin-right: 38px;
    }

    .rooms-page-item .room-text .room-features .room-info.last {
        margin-right: 0;
    }

    .rooms-page-item .room-text .room-features .room-info i {
        display: block;
        color: #ae9548;
        margin-bottom: -4px;
    }

    .rooms-page-item .room-text .room-features .room-info span {
        display: block;
        font-size: 14px;
        font-family: "Open Sans", sans-serif;
        font-weight: 400;
        color: #2d220f;
    }
</style>

<body>
    <!--================Header Area =================-->
    <?php require('common/navbar.php'); ?>

    <!--================Header Area =================-->

    <!--================Breadcrumb Area =================-->

    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">Rooms</li>
            </ol>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================ Accomodation Area  =================-->
    <section class="room-section spad">
        <div class="container">


            <?php foreach ($rooms as $k => $room) { ?>
                <div class="rooms-page-item">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="room-pic-slider ">
                                <div class="single-room-pic" style="border-radius: 0px ;">
                                    <img src="image/rooms/<?php echo $room['room_image'] ?>" width="100%" alt="">
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="room-text">
                                <div class="room-title">
                                    <h2><?php echo $room['room_type'] ?></h2>
                                    <div class="room-price">
                                        <h2>$<?php echo $room['price_per_night'] ?></h2>
                                        <sub>/night</sub>
                                    </div>
                                </div>
                                <div class="room-desc">
                                    <p><?php echo $room['room_description'] ?></p>
                                    <h4>Room Services:</h4>
                                    <p>
                                        <?php echo $room['service_name'] ?>.
                                    </p>
                                    <p>
                                        <?php echo $room['service_description'] ?>
                                    </p>
                                </div>
                                <a href="book.php?room_id=<?php echo $room['room_id']  ?>" class="btn theme_btn button_hover">Book Now <i class="lnr lnr-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <!--================ Accomodation Area  =================-->
    <!--================Booking Tabel Area =================-->

    <!--================Booking Tabel Area  =================-->
    <!--================ Accomodation Area  =================-->

    <!--================ Accomodation Area  =================-->
    <!--================ start footer Area  =================-->
    <?php require('common/footer.php'); ?>

    <!--================ End footer Area  =================-->

    <?php require('common/script.php'); ?>

</body>

</html>