<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0 bg-white">

    <a href="" class="sidebar-toggler flex-shrink-0">
        <!-- <i class="fa fa-bars"></i> -->
        <i class="fa-solid fa-bars-staggered fa-2x" style="color:#1cc3b2; width:10px"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto display-sm-none">

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2" style="color: red;"></i>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>

        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex">
                    <?php
                    if (isset($_SESSION)) {
                        echo $_SESSION['firstName'];
                    } else {
                        echo "Guest";
                    }
                    ?>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">My Profile</a>
                <a href="signin.php" class="dropdown-item">Sign In</a>
                <a href="logout.php" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>