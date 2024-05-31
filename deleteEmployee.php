 <script src="js/sweetAlert.js"></script>
 <script src='js/jQuery.js'></script>
 <style>
     .custom-confirm-button-class {
         background-color: #1cc3b2;
         color: white;
         width: 150px;
         height: 50px;
         font-size: 30px;
         font-weight: bolder;
     }
 </style>
 <?php
    session_start();
    include('connect.php');
    $employee_id = $_GET['employee_id'];



    $sql = "DELETE FROM `employees` WHERE employee_id='$employee_id'";
    $query = mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
        echo " <script> window.location.href='employeeDetails.php';</script>;";
    }
    $conn->close();
    ?>