<?php
session_start();
require('connect.php');

if (isset($_POST['deleteImage'])) {
    $instructorID = $_POST['instructorID'];

    $sql = "SELECT instructor_image FROM instructors WHERE instructor_id = '$instructorID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentImage = $row['instructor_image'];

    if (!empty($currentImage)) {
        unlink($currentImage);
    }

    $sql = "UPDATE instructors SET instructor_image = NULL WHERE instructor_id = '$instructorID'";
    $conn->query($sql);
    header("Location: your-page.php?user_id=$instructorID");
    exit();
}
