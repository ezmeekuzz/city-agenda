<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>City Agenda | Blog Inner</title>

    <link rel="stylesheet" href="<?=base_url();?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url();?>css/header.css">
    <link rel="stylesheet" href="<?=base_url();?>css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
    <style>
        .owl-carousel{
            display: flex;
        }

        .owl-carousel .owl-item{
            flex:1!important;
        }
    </style>
</head>



<body>
  <!--==========Navbar==========-->

<nav class="navbar navbar-expand-lg main-nav container-fluid">
    <div class="w-100 justify-content-center">
        <div class="row w-100 align-items-center justify-content-end justify-content-sm-between">
            <div class="col-md-7 ps-4 col-sm-10 d-flex align-items-center  justify-content-sm-start">
                <!-- Logo -->
                <a class="navbar-brand" href="/">
                    <img src="<?=base_url();?>img/Logo.png" alt="Logo">
                </a>
                <!-- Search Form -->
                <form class="d-flex align-items-center gap-1 nav-form-search" role="search">
                    <i class="bi bi-search"></i>
                    <input class="form-control me-2" type="search" placeholder="Search City Agenda" aria-label="Search City Agenda">
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
                    <a href="create-new-event-page.html"><button class="new-event">Create New Event</button></a>
                    <div class="nav-action d-flex gap-3 align-items-center">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                        <hr class="d-none d-sm-block">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!--==========Sidebar==========-->

<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
        <button class="close-btn" onclick="toggleSidebar()">&#10005;</button>
    </div>
    <div class="sidebar-content">
        <h5>Explore</h5>
        <ul>
            <li><a href="create-new-event-page.html"><button class="new-event">Create New Event</button></a>
            </li>
            <li><a href="my-profile.html">My Profile</a></li>
            <li><a href="about-us.html">About Us</a></li>
            <li> <a href="contact-us.html">Contact Us</a> </li>
            <li><a href="main-blog.html">Blog and Resources</a> </li>
        </ul>
    </div>
</div>