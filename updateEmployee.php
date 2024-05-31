<script src="js/sweetAlert.js"></script>

<?php
session_start();
if (isset($_POST)) {

    $userID = $_POST['userID'];
    $employeeID = $_POST['employeeID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $nationality = $_POST['nationality'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    include('connect.php');

    $sql_user = "UPDATE `users` SET `FirstName`='$firstName',`LastName`='$lastName',
    `email`='$email',`phone_number`='$phoneNumber',`nationality`='$nationality',`password`='$password'
     WHERE users.user_id='$userID'";

    if ($conn->query($sql_user) === TRUE) {
        $sql_emp = "UPDATE `employees` SET `position`='$position',`start_date`='$checkIn',`end_date`='$checkOut',`salary`='$salary' WHERE employees.employee_id='$employeeID'";
        if ($conn->query($sql_emp) === TRUE) {
            echo "1";
            echo "<script>
                        Swal.fire({
                        icon: 'success',
                        title: 'Employee Updated',
                        text: 'Employee Updated Successfully'
                        }).then(function() {
                            window.location.href = 'employeeDetails.php';
                        });
                </script>";
        }
    }
}
