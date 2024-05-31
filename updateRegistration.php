<?php
session_start();
if (isset($_POST)) {
  $registrationID = $_POST['registrationID'];
  $studentID = $_POST['studentID'];
  $courseID = $_POST['courseID'];
  $registerPrice = $_POST['registerPrice'];
  $registerDate = $_POST['registerDate'];

  include('connect.php');
  $sql_updateRegistration = "UPDATE `registrations` SET `student_id`='$studentID',`course_id`='$courseID',
`register_date`='$registerDate', `price`='$registerPrice' WHERE registrations.register_id='$registrationID'";

  if ($conn->query($sql_updateRegistration) === TRUE) {
    echo "Registration updated successfully";
    echo "<script>
        window.location.href = 'registrationDetails.php';
      </script>";
  }
}
