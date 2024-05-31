<?php require('common/header.php');
require('../connect.php');
$sql_normal = "SELECT * from rooms WHERE room_type in('Single','Economy Double')";
$result_normal = $conn->query($sql_normal);
$normal = $result_normal->fetch_all(MYSQLI_ASSOC);

$sql_special = "SELECT * from rooms WHERE room_type in('Dublex','Economy Double')";
$result_special = $conn->query($sql_special);
$special = $result_special->fetch_all(MYSQLI_ASSOC);

$sql_all = "SELECT * from rooms";
$result_all = $conn->query($sql_all);
$all = $result_all->fetch_all(MYSQLI_ASSOC);

$sql_footer = "SELECT * from footer";
$result_footer = $conn->query($sql_footer);
$footer = $result_footer->fetch_all(MYSQLI_ASSOC);

?>

<style>
    .hotel_img img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<body>
    <?php require('common/navbar.php'); ?>

    <section class="breadcrumb_area mt-4 shadow">
        <div class="container">
            <ol class="breadcrumb mt-3">
                <li><a href="index.php">Home</a></li>
                <li class="active">accomodation</li>
            </ol>
        </div>
    </section>


    <section class="accomodation_area section_gap">
        <div class="container">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="pr-3">All Accomodation</span>
                <hr>
            </h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $allChunks = array_chunk($all, 3);
                    foreach ($allChunks as $k => $allChunk) { ?>
                        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> ">
                            <div class="row">
                                <?php foreach ($allChunk as $all) { ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="accommodation_item text-center">
                                            <div class="hotel_img">
                                                <img src="image/rooms/<?php echo $all['room_image'] ?>" alt="">
                                                <a href="book.php?room_id=<?php echo $all['room_id'] ?>" class="btn theme_btn button_hover ">Book Now</a>
                                            </div>
                                            <h4 class=""><?php echo $all['room_type'] ?></h4>
                                            <h5>$<?php echo $all['price_per_night'] ?><small>/night</small></h5>
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

    <section class="accomodation_area section_gap">
        <div class="container">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="pr-3">Special Accomodation</span>
                <hr>
            </h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $specialChunks = array_chunk($special, 3);
                    foreach ($specialChunks as $k => $specialChunks) { ?>
                        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> ">
                            <div class="row">
                                <?php foreach ($specialChunks as $special) { ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="accommodation_item text-center">
                                            <div class="hotel_img">
                                                <img src="image/rooms/<?php echo $special['room_image'] ?>" alt="">
                                                <a href="book.php?room_id=<?php echo $special['room_id'] ?>" class="btn theme_btn button_hover ">Book Now</a>
                                            </div>
                                            <h4 class=""><?php echo $special['room_type'] ?></h4>
                                            <h5>$<?php echo $special['price_per_night'] ?><small>/night</small></h5>
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


    <section class="accomodation_area section_gap">
        <div class="container">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="pr-3">Normal Accomodation</span>
                <hr>
            </h2>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $normalChunks = array_chunk($normal, 3);
                    foreach ($normalChunks as $k => $normalChunk) { ?>
                        <div class="carousel-item <?php echo $k === 0 ? 'active' : ''; ?> ">
                            <div class="row">
                                <?php foreach ($normalChunk as $room) { ?>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="accommodation_item text-center">
                                            <div class="hotel_img">
                                                <img src="image/rooms/<?php echo $room['room_image'] ?>" alt="">
                                                <a href="book.php?room_id=<?php echo $room['room_id'] ?>" class="btn theme_btn button_hover ">Book Now</a>
                                            </div>
                                            <h4 class=""><?php echo $room['room_type'] ?></h4>
                                            <h5>$<?php echo $room['price_per_night'] ?><small>/night</small></h5>
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
    <?php require('common/footer.php'); ?>
    <?php require('common/script.php'); ?>

</body>

</html>