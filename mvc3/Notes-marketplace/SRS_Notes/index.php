<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Homepage</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="front/css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="front/css/style.css">

    <!-- responsive CSS -->
    <link rel="stylesheet" href="front/css/responsive.css">

    <!-- custom nav bar -->
    <link rel="stylesheet" href="front/css/navigation.css">

</head>

<body>

    <!-- Navigation Bar -->
    <header>

        <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">

            <div class="container">
                <div class="row">

                    <!-- Logo -->
                    <div class="navbar-header col-lg-3 col-10">

                        <a class="navbar-brand text-left" href="#">
                            <img src="front/images/home/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'search-notes') {
                                                                        echo 'active';
                                                                    } ?>" href="front/search-notes.php">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'dashboard') {
                                                                        echo 'active';
                                                                    } ?>" href="front/dashboard.php">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'FAQ') {
                                                                        echo 'active';
                                                                    } ?>" href="front/FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'contact-us') {
                                                                        echo 'active';
                                                                    } ?>" href="front/contact-us.php">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->

    <!-- Head -->
    <section id="head">
        <div id="head-content">
            <div class="container">
                <div class="row">
                    <div id="head-content-inner" class="col-md-6 col-lg-6 col-12 col-sm-8">
                        <div class="head-heading">
                            <p>Download Free/Paid Notes <br> or Sale your Book</p>
                        </div>
                        <div class="head-text">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur distinctio magni! Excepturi adipisicing elit.</p>
                        </div>
                        <div class="head-button">
                            <a class="btn btn-head" href="#" title="Learn More" role="button">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Head Ends -->

    <!-- About Us -->
    <section id="about-us">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <!-- about left -->
                    <div class="col-md-4 col-lg-4 col-12">
                        <div class="about-left">
                            <div class="horizontal-heading">
                                <h3>About <br>NotesMarketPlace</h3>
                            </div>
                        </div>
                    </div>

                    <!-- about right -->
                    <div class="col-md-8 col-lg-8 col-12">
                        <div class="about-right">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam quisquam temporibus reiciendis deleniti dolore itaque ipsa eveniet amet, et deserunt quae sed a ipsam laborum nostrum obcaecati perferendis alias inventore.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis dolorem, eos voluptatem eius ad possimus debitis non accusamus facilis obcaecati odit architecto laudantium aliquam tempore ullam inventore laboriosam asperiores optio.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Ends -->

    <!-- work -->
    <section id="work">
        <div class="content-box">
            <div class="container">
                <!-- Heading -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12 text-center">
                        <div class="horizontal-heading">
                            <h3>How it Works</h3>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 col-lg-6 col-12 col-sm-6">
                        <div class="work-item text-center">
                            <div class="work-image">
                                <img src="front/images/home/download.png" alt="download">
                            </div>
                            <h5>Download Free/Paid Notes</h5>
                            <p>Get Material for your <br>Course etc.</p>
                            <div class="work-btn">
                                <a class="btn btn-work" href="front/search-notes.php" title="Download" role="button">Download</a>
                            </div>
                        </div>
                    </div>
                    <!-- Seller -->
                    <div class="col-md-6 col-lg-6 col-12 col-sm-6">
                        <div class="work-item text-center">
                            <div class="work-image">
                                <img src="front/images/home/seller.png" alt="download">
                            </div>
                            <h5>Seller</h5>
                            <p>Upload and Download Course <br>and Material etc.</p>
                            <div class="work-btn">
                                <a class="btn btn-work" href="front/dashboard.php" title="Sell Book" role="button">Sell Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- work Ends -->

    <!-- Testimonails -->
    <section id="testimonials">
        <div class="content-box">
            <div class="container">
                <!-- Heading -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12 text-center">
                        <div class="horizontal-heading">
                            <h3>What our Customers are Saying</h3>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="testimonial-outer col-md-6 col-lg-6 col-12 col-sm-12">
                        <!-- Testimonial - 01 -->
                        <div class="testimonial">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-lg-3 col-3">
                                    <img src="front/images/home/customer-1.png" alt="testimonial">
                                </div>
                                <div class="col-md-9 col-sm-9 col-lg-9 col-9">
                                    <div class="test-name-desc">
                                        <h5>Walter Meller</h5>
                                        <h6>Founder & CEO, Matrix Group</h6>
                                    </div>
                                </div>
                            </div>
                            <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt accusamus molla odio toanditiis, iure moleas asperiores elit consectetur unde in deserunt."</p>
                        </div>
                    </div>
                    <div class="col-md-6 testimonial-outer col-lg-6 col-12 col-sm-12">
                        <!-- Testimonial - 02 -->
                        <div class="testimonial">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-3 col-lg-3">
                                    <img src="front/images/home/customer-2.png" alt="testimonial">
                                </div>
                                <div class="col-md-9 col-sm-9 col-9 col-lg-9">
                                    <div class="test-name-desc">
                                        <h5>Jonnie Riley</h5>
                                        <h6>Employee, Curious Snakcs</h6>
                                    </div>
                                </div>
                            </div>
                            <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt accusamus molla odio toanditiis, iure moleas asperiores elit consectetur unde in deserunt."</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 testimonial-outer col-12 col-sm-12">
                        <!-- Testimonial - 03 -->
                        <div class="testimonial">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-3 col-lg-3">
                                    <img src="front/images/home/customer-3.png" alt="testimonial">
                                </div>
                                <div class="col-md-9 col-sm-9 col-9 col-lg-9">
                                    <div class="test-name-desc">
                                        <h5>Amilia Luna</h5>
                                        <h6>Teacher, Saint joseph High School</h6>
                                    </div>
                                </div>
                            </div>
                            <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt accusamus molla odio toanditiis, iure moleas asperiores elit consectetur unde in deserunt."</p>
                        </div>
                    </div>
                    <div class="col-md-6 testimonial-outer col-lg-6 col-12 col-sm-12">
                        <!-- Testimonial - 04 -->
                        <div class="testimonial">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-3 col-lg-3">
                                    <img src="front/images/home/customer-4.png" alt="testimonial">
                                </div>
                                <div class="col-md-9 col-sm-9 col-9 col-lg-9">
                                    <div class="test-name-desc">
                                        <h5>Danial Cardos</h5>
                                        <h6>Software engineer, Infinitum Company</h6>
                                    </div>
                                </div>
                            </div>
                            <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt accusamus molla odio toanditiis, iure moleas asperiores elit consectetur unde in deserunt."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonails Ends  -->

    <!-- Section Footer -->
    <footer>
        <div class="container">
            <div class="row">

                <!-- Copyright -->
                <div class="col-md-7 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved By</p>
                </div>

                <!-- Social Icon -->
                <div class="col-md-5 col-sm-4 foot-icon text-right">
                    <ul class="social-list">
                        <li><a href="#"><img src="front/images/User-Profile/facebook.png" alt="facbook"></a></li>
                        <li><a href="#"><img src="front/images/User-Profile/twitter.png" alt="twitter"></a></li>
                        <li><a href="#"><img src="front/images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!-- Section Footer END -->

    <!-- JQuery -->
    <script src="front/js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="front/js/bootstrap/bootstrap.min.js"></script>


    <!-- nav show hide JS -->
    <script src="front/js/nav-show-hide-script.js"></script>

</body>

</html>