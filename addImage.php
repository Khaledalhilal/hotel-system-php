<?php
session_start();
require('connect.php');

if (isset($_POST['addImage'])) {
    $instructorID = $_POST['instructorID'];
    if ($_FILES['newImage']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['newImage']['tmp_name'];
        $newFileName = "uploads/instructor_$instructorID" . '_' . $_FILES['newImage']['name'];
        move_uploaded_file($tmpName, $newFileName);
        $sql = "UPDATE instructors SET instructor_image = '$newFileName' WHERE instructor_id = '$instructorID'";
        $conn->query($sql);
    }
    header("Location: index.php?user_id=$instructorID");
    exit();
}
