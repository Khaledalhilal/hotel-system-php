<?php
session_start();
require('common/header.php');
// var_dump($_GET);exit;
$room_id = $_GET['room_id'];
require('connect.php');
$sql = "SELECT *, rooms.room_id,rooms.room_name,room_description, rooms.room_number, rooms.room_type, rooms.price_per_night FROM `room_status` INNER JOIN rooms on room_status.room_id = rooms.room_id where rooms.room_id = '$room_id'";
$result = $conn->query($sql);
$room = $result->fetch_assoc();
if (isset($_POST)) {
    if ($_FILES && $_FILES['images']['name']) {

        $target_dir = "hotel/image/rooms/";
        $extension = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
        $img_name = str_replace("." . $extension, "", basename($_FILES["images"]["name"]));

        $count = 0;
        $image_name = $_FILES["images"]["name"];
        while (file_exists($target_dir . $image_name)) {
            $count++;
            $image_name = $img_name . "-" . $count . "." . $extension;
        }

        $target_file = $target_dir . $image_name;

        $result = move_uploaded_file($_FILES['images']['tmp_name'], $target_file);

        if ($result) {
            $sql = "UPDATE rooms SET room_image='$image_name' WHERE room_id = " . $room['room_id'];
            $conn->query($sql);
        }
    } elseif (isset($_POST['deleteImage'])) {
        $imageToDelete = $_POST['imageNameToDelete'];
        $pathToDelete = "hotel/image/rooms/" . $imageToDelete;

        if (unlink($pathToDelete)) {
            $sql = "UPDATE rooms SET room_image=NULL WHERE room_id = " . $room['room_id'];
            $conn->query($sql);
        }
    }
}

?>


<body>

    <!-- Sidebar Start -->
    <?php require('common/sidebar.php'); ?>
    <!-- Sidebar End -->
    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <?php require('common/navbar.php'); ?>
        <!-- Navbar End -->
        <div class="container-fluid pt-4">

            <div class="row g-4 min-vh-100 rounded justify-content-center mx-0">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <?php
                            require('connect.php');
                            $imageName = "";
                            // Retrieve image name from the database
                            $sql = "SELECT room_image FROM rooms WHERE room_id = " . $room['room_id'];
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $imageName = $row['room_image'];
                                }
                            }

                            if ($imageName) {
                                echo "<div>";
                                echo "<img class='rounded-circle' src='hotel/image/rooms/$imageName' alt='Uploaded Image'width='115px'><br>";
                                echo "<form action='' method='post' class='mt-2'>";
                                echo "<input type='hidden' name='imageNameToDelete' value='$imageName'>";
                                echo "<input type='submit' id='deleteImage' name='deleteImage' value='Delete Image'>";
                                echo "</form>";
                                echo "</div>";
                            } else {
                                echo "<form action='' method='post' enctype='multipart/form-data'>";
                                echo "<input type='file' class='mb-2'  name='images' id='fileToUpload'>";
                                echo "<br/>";
                                echo "<input type='submit'  value='Save' id='addNewImage' name='submit'>";
                                echo "</form>";
                            }
                            ?>
                            <form action="updateRoom.php" method="POST" class="mt-4">
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;" hidden>userId</span>
                                    <input type="text" class="form-control" id="#" name="room_id" value="<?php echo $room['room_id'] ?>" required>
                                </div>
                                <div class="input-group mb-3" hidden>
                                    <span class="input-group-text" style="width: 130px !important;" hidden>status ID</span>
                                    <input type="text" class="form-control" id="#" name="status_id" value="<?php echo $room['status_id'] ?>" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Floor Name: </span>
                                    <input type="text" class="form-control" id="#" name="block" value="<?php echo $room['room_name'] ?>" required autocomplete="off">
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Room Number</span>
                                    <input type="number" class="form-control" id="#" name="room_number" value="<?php echo $room['room_number'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Room Type</span>
                                    <input type="text" class="form-control" id="#" name="room_type" value="<?php echo $room['room_type'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Status</span>
                                    <input type="text" class="form-control" id="#" name="status" value="<?php echo $room['status'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Date</span>
                                    <input type="text" class="form-control" id="#" name="date" value="<?php echo $room['data'] ?>" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Price Per Night</span>
                                    <input type="number" class="form-control" id="#" value="<?php echo $room['price_per_night'] ?>" name="price_per_night" required autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" style="width: 130px !important;">Description</span>
                                    <input type="text" class="form-control" id="#" value="<?php echo $room['room_description'] ?>" name="des" required autocomplete="off">
                                </div>

                                <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #1cc3b2;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        <?php
        $conn->close();
        require('common/footer.php')
        ?>
        <!-- Footer End -->
    </div>
    <!-- Content End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <?php require('common/script.php'); ?>
</body>

</html>