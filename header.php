<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>samhitha_agriculture</title>
    <!-- Favicon img -->
    <link rel="shortcut icon" href="assets/images/logo/logo_111.png">
    <!-- Bootstarp min css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- All min css -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Swiper bundle min css -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Magnigic popup css -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">





    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>


</head>

<body>

    <!-- Preloader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-icon text-center d-flex flex-column align-items-center justify-content-center">
                    <img class="loading-logo" src="assets/images/preloader.svg" alt="icon">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader area end -->

    <!-- Header area start here -->
    <header class="header header-one bor-bottom">
        <div class="header-section">
            <div class="d-flex justify-content-between align-items-center">

                <div class="header-one__logo d-none d-xl-block">
                    <a href="index.php">
                        <img src="assets/images/logo/logo_111.png" alt="logo" class="img-fluid">
                    </a>
                </div>
                <div class="header-one__item w-100">
                    <div class="header-wrapper flex-column text-center">

                        <!-- Samhitha Title (always centered) -->
                        <div class="samhitha-title py-2 d-md-none">
                            <strong class="samhitha_agri">SAMHITA Soil  Solution </strong>
                        </div>

                        <div class="samhitha-title py-2 d-none d-md-block">
                            <strong class="samhitha_agri">SAMHITA &nbsp; <span class="soli_section">Soil</span> &nbsp;<span class="solution_section"> Solution</span> </strong>
                        </div>

                        <!-- Mobile: Logo Left + Toggle Right -->
                        <div class="d-flex justify-content-between align-items-center d-xl-none px-3 w-100">
                            <!-- Logo on Left -->
                            <div class="logo-menu">
                                <a href="index.php" class="logo">
                                    <img src="assets/images/logo/logo_111.png" alt="logo" style="width: 70px;">
                                </a>
                            </div>

                            <!-- Toggle on Right -->
                            <div class="header-bar"
                                onclick="document.querySelector('.main-menu').classList.toggle('show-mobile')">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <!-- Navigation Menu -->
                        <ul class="main-menu mx-auto">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li class="has-submenu">
                                <a
                                    href="service.php"
                                    onmouseover="handleHover(event)"
                                    onclick="handleClick(event)">
                                    Services
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="biopesticides.php">Biopesticides</a></li>
                                    <li><a href="biofertilizers.php">Biofertilizers</a></li>
                                </ul>
                            </li>

                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>

                    </div>
                </div>



                <div class="header-one__item d-none d-xl-block">
                    <ul class="header-wrapper header-one__info bor-left">
                        <!-- <li class="menu-btn">
                  <a href="contact.php"><span>Get a quote</span> <i class="fa-solid fa-angles-right"></i></a>
                </li> -->
                        <li class="menu_info bg-image ms-0" data-background="assets/images/header/header-info-bg.png">
                            <i class="fa-solid call_ico fa-phone-volume"></i>
                            <div class="call_info">
                                <span>Contact Us</span>
                                <a class="d-block p-0" href="tel:+919848549349">+91 9848549349</a>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>


    <!-- <script>
        function toggleSubMenu(event) {
            event.preventDefault();
            const subMenu = event.target.nextElementSibling;
            if (subMenu && subMenu.classList.contains('sub-menu')) {
                subMenu.classList.toggle('active');
            }
        }
    </script> -->

    <script>
        function handleClick(event) {
            // Only on small screens: prevent default link and toggle submenu
            if (window.innerWidth < 992) {
                event.preventDefault();
                const subMenu = event.target.nextElementSibling;
                if (subMenu && subMenu.classList.contains('sub-menu')) {
                    subMenu.classList.toggle('active');
                }
            }
        }

        function handleHover(event) {
            // Optional: prevent hover toggle on small screens
            if (window.innerWidth < 992) {
                return;
            }
            // On desktop, no need to block hover
        }
    </script>





    <a href="https://api.whatsapp.com/send?phone=9848549349" style="color: #fff;" class="whatsapp-link" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>