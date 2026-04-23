<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Set viewport to make the website responsive across devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelAdvisor - Create Holiday Experiences</title>

    <!-- Load Bootstrap 5 stylesheet from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load Font Awesome 6 icons from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Load custom stylesheet (style.css) -->
    <!-- BASEURL is assumed to be a PHP constant storing the base URL of the site -->
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        /* Offset to prevent navbar overlap */
        section {
            scroll-margin-top: 80px;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">

    <!-- Start of Navbar -->
    <!-- 'navbar-expand-lg' means navbar will expand full width on 'large' screens and collapse on smaller screens -->
    <!-- 'fixed-top' keeps the navbar pinned at the top when scrolling -->
    <!-- 'shadow-sm' adds a slight shadow effect -->
    <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top shadow-sm">
        <div class="container-fluid px-4 px-lg-5">

            <!-- Brand/Website Logo -->
            <a class="navbar-brand" href="<?= BASEURL ?>">
                <i class="fa-solid fa-umbrella-beach text-warning"></i> TravelAdvisor
            </a>

            <!-- "Hamburger" button for mobile display -->
            <!-- This button only appears on small screens (below 'lg') -->
            <!-- 'data-bs-toggle="collapse"' and 'data-bs-target="#navbarNav"' are Bootstrap JS attributes -->
            <!-- They instruct this button to open/close the div with id "navbarNav" -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Start PHP Block to determine active page -->
            <?php
            // Get 'url' parameter from URL (via .htaccess/routing). If empty, set default to 'home'
            $current_url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';
            
            // Split URL by '/' to get segments
            $url_segments = explode('/', $current_url);
            
            // Get the first segment as current page marker
            $page = $url_segments[0];
            ?>
            <!-- End PHP Block -->

            <!-- This div contains navigation items that will be hidden on small screens -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <?php
                $isHome = ($page == 'home');
                $homeLink = $isHome ? '#home' : BASEURL . '/#home';
                $destinationsLink = $isHome ? '#destinations' : BASEURL . '/#destinations';
                $activitiesLink = $isHome ? '#activities' : BASEURL . '/#activities';
                $hotelsLink = $isHome ? '#hotels' : BASEURL . '/#hotels';
                ?>
                <ul class="navbar-nav mx-auto gap-2 mb-3 mb-lg-0 text-center pt-3 pt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $homeLink ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $destinationsLink ?>">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $activitiesLink ?>">Activities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $hotelsLink ?>">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page == 'about' ? 'active' : '' ?>" href="<?= BASEURL ?>/about">About Us</a>
                    </li>
                </ul>
                <!-- End of navigation menu list -->

                <!-- Start of right navbar section (User Menu/Login) -->
                <!-- Use d-flex to manage layout of login/user menu button -->
                <div
                    class="d-flex flex-column flex-lg-row align-items-center gap-3 justify-content-center pb-3 pb-lg-0">

                    <!-- Check if user is logged in (checking if 'user_id' exists in session) -->
                    <?php if(isset($_SESSION['user_id'])): ?>

                    <!-- IF LOGGED IN: Display user dropdown menu -->
                    <div class="dropdown">
                        <!-- Button to trigger dropdown -->
                        <button class="btn btn-outline-dark rounded-pill fw-bold dropdown-toggle px-4" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user me-1"></i>
                            <!-- Get user name from session, split by space, and only show the first name -->
                            <?= explode(' ', $_SESSION['user_name'])[0] ?>
                        </button>

                        <!-- List items inside dropdown -->
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 text-center text-lg-start">

                            <li><a class="dropdown-item" href="<?= BASEURL ?>/profile">My Profile</a></li>

                            <!-- Check if logged-in user role is 'admin' -->
                            <?php if($_SESSION['user_role'] == 'admin'): ?>
                            <!-- If 'admin', show link to Admin Dashboard -->
                            <li><a class="dropdown-item" href="<?= BASEURL ?>/admin">Admin Dashboard</a></li>
                            <?php endif; ?>

                            <!-- Divider line within dropdown -->
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Logout link -->
                            <li><a class="dropdown-item text-danger" href="<?= BASEURL ?>/auth/logout">Logout</a></li>
                        </ul>
                    </div>

                    <?php else: ?>

                    <!-- IF NOT LOGGED IN: Display Login button -->
                    <!-- This button triggers modal (popup) on click -->
                    <!-- 'data-bs-toggle="modal"' and 'data-bs-target="#authModal"' instructs Bootstrap JS -->
                    <!-- to open modal with id "authModal" when clicked -->
                    <button class="btn btn-login w-100 w-lg-auto" data-bs-toggle="modal" data-bs-target="#authModal">
                        Login
                    </button>

                    <?php endif; ?>
                    <!-- End conditional login check (if/else) -->
                </div>
                <!-- End of right navbar section -->

            </div>
            <!-- End 'collapse' div -->
        </div>
        <!-- End 'container' div -->
    </nav>
    <!-- End Navbar section -->


    <!-- Empty Div (Spacer) -->
    <!-- Because navbar uses 'fixed-top', it is taken out of the normal flow. -->
    <!-- The empty div acts as a "pusher" or "spacer" to ensure the page content starts below the navbar. -->
    <div style="height: 80px;"></div>

    <!-- Scrollspy automatically handles navigation active states -->


<!-- </html> and </body> tags are closed in another file (footer.php) -->
