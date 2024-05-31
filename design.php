<!DOCTYPE html>
<html lang="en">
<?php session_start();
require('common/header.php');
$id = $_GET['user_id'];
require('connect.php');
$sql = "SELECT users.user_name, users.user_password, users.user_id, instructor_id, users.user_Type ,
 instructor_email, instructor_fullName, instructor_phoneNumber, instructor_address, instructor_image FROM instructors
  JOIN users ON users.user_id = instructors.user_id WHERE users.user_id = '$id' ";
$result = $conn->query($sql);
$instructors = $result->fetch_assoc();



if ($_POST) {
    if ($_FILES && $_FILES['images']['name']) {
        $target_dir = "img/instructors/";
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
            $sql = "UPDATE instructors SET instructor_image='$image_name' WHERE instructor_id = " . $instructors['instructor_id'];
            $conn->query($sql);
        }
    } elseif (isset($_POST['deleteImage'])) {
        $imageToDelete = $_POST['imageNameToDelete'];
        $pathToDelete = "img/instructors/" . $imageToDelete;

        if (unlink($pathToDelete)) {
            $sql = "UPDATE instructors SET instructor_image=NULL WHERE instructor_id = " . $instructors['instructor_id'];
            $conn->query($sql);
        }
    }
}
?>?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .profile-container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-image {
            max-width: 100%;
            height: auto;
            border-radius: 50%;
            border: 3px solid #1cc3b2;
        }

        .upload-button {
            background-color: #1cc3b2;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .upload-button:hover {
            background-color: #e6cc49;
        }

        .delete-button {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button:hover {
            background-color: #d35656;
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-container">
            <!-- Profile Image Section -->
            <div class="profile-image-section">
                <?php
                require('connect.php');
                $imageName = "";

                // Retrieve image name from the database
                $sql = "SELECT instructor_image FROM instructors WHERE instructor_id = " . $instructors['instructor_id'];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $imageName = $row['instructor_image'];
                    }
                }

                if ($imageName) {
                    echo "<img class='profile-image' src='img/instructors/$imageName' alt='Profile Image'>";
                    echo "<form action='' method='post' class='mt-2'>";
                    echo "<input type='hidden' name='imageNameToDelete' value='$imageName'>";
                    echo "<input type='submit' class='delete-button' id='deleteImage' name='deleteImage' value='Delete Image'>";
                    echo "</form>";
                } else {
                    echo "<form action='' method='post' enctype='multipart/form-data'>";
                    echo "<div class='input-group mb-3'>";
                    echo "<input type='file' class='form-control' name='images' id='fileToUpload' style='display: none;'>";
                    echo "<label for='fileToUpload' class='upload-button' id='addNewImage'>Add New Image</label>";
                    echo "</div>";
                    echo "</form>";
                }
                ?>

                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#addNewImage').click(function() {
                            $('#fileToUpload').click();
                        });
                    });
                </script>
            </div>

            <!-- Profile Details Section -->
            <div class="profile-details-section">
                <h1><?php echo $instructors['instructor_fullName'] ?></h1>
                <p>User ID: <?php echo $instructors['user_id'] ?></p>
                <p>User Name: <?php echo $instructors['user_name'] ?></p>
                <p>User Type: <?php echo $instructors['user_Type'] ?></p>
                <p>Email: <?php echo $instructors['instructor_email'] ?></p>
                <p>Phone Number: <?php echo $instructors['instructor_phoneNumber'] ?></p>
                <p>Address: <?php echo $instructors['instructor_address'] ?></p>
            </div>
        </div>
    </div>
</body>

</html>