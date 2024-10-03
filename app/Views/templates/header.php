<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$title;?></title>

    <link rel="stylesheet" href="<?=base_url();?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url();?>css/header.css">
    <link rel="stylesheet" href="<?=base_url();?>css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_H6wQhY-ksDyboh_b-Sa17kkUbeKPdmk&libraries=places"></script>
    <style>
        .owl-carousel{
            display: flex;
        }

        .owl-carousel .owl-item{
            flex:1!important;
        }
        .nav-action a {
            text-decoration: none;
        }
        .dropdown-menu {
            background-color: #f8f9fa; /* Light background */
            border: 1px solid #ddd;
            padding: 10px; /* Adds padding inside the dropdown */
        }

        .dropdown-item {
            font-size: 16px;
            color: #333; /* Text color */
            padding: 10px 15px;
            border-radius: 8px; /* Rounded corners for items */
            transition: background-color 0.3s ease;
        }

        .dropdown-item i {
            font-size: 18px; /* Icon size */
        }

        .dropdown-item:hover {
            background-color: #AB39CD; /* Hover background color */
            color: #fff; /* Hover text color */
        }

        .dropdown-item:hover i {
            color: #fff; /* Hover icon color */
        }

        .dropdown-menu .dropdown-item:not(:last-child) {
            margin-bottom: 5px; /* Space between items */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg main-nav container-fluid">
    <div class="w-100 justify-content-center">
        <div class="row w-100 align-items-center justify-content-end justify-content-sm-between">
            <div class="col-md-7 ps-4 col-sm-10 d-flex align-items-center  justify-content-sm-start">
                <!-- Logo -->
                <a class="navbar-brand" href="/">
                    <img src="<?=base_url();?>img/Logo.png" alt="Logo">
                </a>
                <!-- Search Form -->
                <form class="d-flex align-items-center gap-1 nav-form-search" role="search" method="GET" action="/events">
                    <i class="bi bi-search"></i>
                    <input class="form-control me-2" type="search" placeholder="Search City Agenda" name="city" aria-label="Search City Agenda">
                </form>
            </div>
            <!-- Toggler Button for Mobile -->
            <div class="col-2 d-lg-none d-flex justify-content-end mt-0 mt-lg-0">
                <button class="navbar-toggler p-2" type="button" onclick="toggleSidebar()">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <!-- Navbar Links -->
            <div class="col-md-5 col-sm-12 collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="d-flex gap-3 align-items-center nav-control justify-content-lg-end justify-content-between pt-lg-0 pb-lg-0 pt-sm-3 pb-sm-3 p-0">
                    <a href="/login"><button class="new-event">Create New Event</button></a>
                    <div class="nav-action d-flex gap-3 align-items-center">
                        <!-- Professional Dropdown for grid icon -->
                        <div class="dropdown">
                            <!-- Toggle button (icon) -->
                            <a href="#" id="gridIconDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-grid-3x3-gap-fill" style="font-size: 24px;"></i>
                            </a>

                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="gridIconDropdown" style="min-width: 200px; border-radius: 10px;">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/organizer/add-event">
                                        Create New Event
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/organizer/profile/<?=session()->get('organizer_emailaddress')?>/<?=session()->get('organizer_user_id')?>">
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/about-us">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/contact-us">
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/blogs">
                                        Blog & Resources
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center gap-2" href="/faq">
                                        FAQ
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <hr class="d-none d-sm-block">
                        <a href="/profile/<?=session()->get('organizer_emailaddress')?>/<?=session()->get('organizer_user_id')?>">
                            <i class="bi bi-person-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
        <button class="close-btn" onclick="toggleSidebar()">&#10005;</button>
    </div>
    <div class="sidebar-content">
        <h5>Explore</h5>
        <ul>
            <li><a href="/organizer/add-event"><button class="new-event">Create New Event</button></a>
            </li>
            <li><a href="/my-profile">My Profile</a></li>
            <li><a href="about-us">About Us</a></li>
            <li> <a href="contact-us">Contact Us</a> </li>
            <li><a href="/blogs">Blog and Resources</a> </li>
        </ul>
    </div>
</div>