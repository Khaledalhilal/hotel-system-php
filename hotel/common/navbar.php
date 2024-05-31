<header class="header_area shadow">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a class="navbar-brand logo_h theme_btn" href="index.php">KH HOTEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?> "><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?> "><a class="nav-link" href="about.php">About us</a></li>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'accomodation.php' ? 'active' : ''; ?> "><a class="nav-link" href="accomodation.php">Accomodation</a></li>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'rooms.php' ? 'active' : ''; ?> "><a class="nav-link" href="rooms.php">Rooms</a></li>
                    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?> "><a class="nav-link" href="contact.php">Contact</a></li>
                    
                </ul>
            </div>
        </nav>
    </div>
</header>