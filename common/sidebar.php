<div class="sidebar  pb-3" style="background-color: #0e2737;">
    <nav class="navbar  navbar-light">
        <a href="index.html" class=" mt-0 mb-3 courses-system" style="background-color: #1cc3b2; width:250px !important;">
            <h5 style="color: white !important; padding:10px"><img src="img/logo.png" alt="" width="15%"> KH HOTEL</h5>
        </a>
        <div class="navbar-nav w-100">

            <div class="nav-item dropdown">
                <a href="index.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fa fa-tachometer-alt me-2 me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>
                    Dashboard</a>
            </div>

            <div class="nav-item dropdown">
                <a href="home.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'home.php'    ? 'active' : ''; ?> ">
                    <i class="fa-solid fa-user me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>
                    Home</a>
            </div>

            <div class="nav-item dropdown">
                <a href="employeeDetails.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'employeeDetails.php' || basename($_SERVER['PHP_SELF']) == 'updateFormEmployee.php' ? 'active' : ''; ?> ">
                    <i class="fa-solid fa-chalkboard-user me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>
                    Employee</a>
            </div>
            <div class="nav-item dropdown">
                <a href="roomsDetails.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'roomsDetails.php' ? 'active' : ''; ?> "><i class="fa-solid fa-school me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>Rooms</a>
            </div>
            <div class="nav-item dropdown">
                <a href="ServicesDetails.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'ServicesDetails.php'   ? 'active' : ''; ?> ">
                    <i class="fa-solid fa-calendar-days me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>Services</a>
            </div>
            <div class="nav-item dropdown">
                <a href="ReservationDetails.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'ReservationDetails.php'  || basename($_SERVER['PHP_SELF']) == 'ReservationInfo.php'  ? 'active' : ''; ?> "><i class="fa-solid fa-book me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>Reservations</a>
            </div>
            <div class="nav-item dropdown">
                <a href="contactus.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'contactus.php' ? 'active' : ''; ?> ">
                    <i class="fa-regular fa-square-check me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>Contact-Us</a>
            </div>
            <div class="nav-item dropdown">
                <a href="aboutDetails.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'aboutDetails.php'  ? 'active' : ''; ?> ">
                    <i class="fa-regular fa-square-check me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>About-Us</a>
            </div>
            <div class="nav-item dropdown">
                <a href="footer.php" class="nav-link text-white  <?php echo basename($_SERVER['PHP_SELF']) == 'footer.php'  ? 'active' : ''; ?> ">
                    <i class="fa-regular fa-square-check me-2" style="color: #1cc3b2 !important; background-color:#0e2737 !important"></i>Footer</a>
            </div>

        </div>
    </nav>
</div>