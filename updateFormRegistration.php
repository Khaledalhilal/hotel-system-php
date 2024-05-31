<script src="js/sweetAlert.js"></script>

<?php
session_start();
require('common/header.php');
$registration_id = $_GET['registration_id'];
$course_id = $_GET['course_id'];
$student_id = $_GET['student_id'];


require('common/header.php');
include('connect.php');
$sql = "SELECT registrations.register_id, registrations.student_id, registrations.course_id,registrations.price,registrations.register_date, courses.courses_id,courses.title, students.student_id, coursestype.type_id, coursestype.courseType_name, courses.course_startDate, courses.course_endDate, courses.notes,students.student_fullName FROM `registrations`JOIN courses ON registrations.course_id = courses.courses_id JOIN coursestype ON courses.type_id = coursestype.type_id JOIN students ON registrations.student_id = students.student_id where registrations.register_id='$registration_id'";
$result = $conn->query($sql);
$registration = $result->fetch_assoc();

$sql_courses = "SELECT * FROM `courses`";
$result_courses = $conn->query($sql_courses);
$courses = $result_courses->fetch_all(MYSQLI_ASSOC);



$sql_student = "SELECT * FROM `students`";
$result_student = $conn->query($sql_student);
$students = $result_student->fetch_all(MYSQLI_ASSOC);
$conn->close();
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

                        <form action="updateRegistration.php" method="post">

                            <div class="input-group mb-3" hidden>
                                <span class="input-group-text w-120 text-center" style="width: 150px !important;">Instructor ID</span>
                                <input type="text" value="<?php echo $registration['register_id'] ?>" class="form-control" name="registrationID" required autocomplete="off">
                            </div>
                            <div class="input-group mb-3" aria-autocomplete="off">
                                <span class="input-group-text w-120 text-center" style="width: 150px !important;">Student Name</span>
                                <select class="form-select" id="selectStudent" name="studentID">
                                    <?php foreach ($students as $std) {
                                        $isSelected = ($std['student_id'] == $registration['student_id']) ? 'selected' : '';
                                        echo '<option value="' . $std['student_id'] . '" ' . $isSelected . '>' . $std['student_fullName'] . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3" aria-autocomplete="off">
                                <span class="input-group-text w-120 text-center" style="width: 150px !important;">Student Name</span>
                                <select class="form-select" id="selectCourse" name="courseID" require>
                                    <?php foreach ($courses as $course) {
                                        $isSelected = ($course['courses_id'] == $registration['course_id']) ? 'selected' : '';
                                        echo '<option value="' . $course['courses_id'] . '" ' . $isSelected . '>' . $course['title'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-120 text-center" style="width: 150px !important;">Register Date </span>
                                <input type="text" class="form-control" id="registerDate" name="registerDate" value="<?php echo $registration['register_date'] ?>" required autocomplete=" off">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text w-120 text-center" style="width: 150px !important;">Price</span>
                                <input type="number" class="form-control" id="registerDate" name="registerPrice" value="<?php echo $registration['price'] ?>" required autocomplete=" off">
                            </div>

                            <br>
                            <button type="submit" class="btn btn-primary float-end border-0" style="background-color: #f6de64;color:white; border-radius:4px; letter-spacing:1px;font-weight:bold ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        <?php require('common/footer.php') ?>
        <!-- Footer End -->
    </div>
    <!-- Content End -->
    <script>
        $(document).ready(function() {
            $('#selectStudent').select2();
            $('#selectCourse').select2();

        });
    </script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg  btn-lg-square back-to-top  bg-yellow" style="border-radius:0px"><i class="fa fa-angle-double-up" style="color: black;"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <!-- <?php require('common/script.php'); ?> -->
</body>

</html>