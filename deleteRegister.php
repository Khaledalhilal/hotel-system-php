<script src="js/sweetAlert.js"></script>
<?php
include('connect.php');
$registration_id = $_GET['registration_id'];
$sql_registration = "DELETE FROM `registrations` WHERE registrations.register_id='$registration_id'";
if ($conn->query($sql_registration) === TRUE) {
    echo " <script> window.location.href='registrationDetails.php';</script>;";
}
$conn->close();
?>