<?php 
session_start();

if(!isset($_SESSION['username'])) {
    header('location:login.php');
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>User Profile</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">

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
                            <img src="images/home/logo.png" alt="logo">
                        </a>

                    </div>

                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>

                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="search-notes.php">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="buyer-request.php">Buyer Requests</a></li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                            <li class="nav-item profile-dropdown dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/notes-details/reviewer-1.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="user-profile.php">My Profile</a>
                                    <a class="dropdown-item" href="my-downloads.html">My Downloads</a>
                                    <a class="dropdown-item" href="my-sold-notes.html">My Sold Notes</a>
                                    <a class="dropdown-item" href="my-rejected-notes.html">My Rejected Notes</a>
                                    <a class="dropdown-item" href="change-password.html">Change Password</a>
                                    <a class="dropdown-item logout" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->

    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="head-part-inner">
                        <div class="col-md-12">
                            <div class="header-statement" class="text-center">
                                <h3>User Profile</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- Basic Profile Details -->
    <section id="basic-details">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-left">

                        <div class="horizontal-heading">
                            <h3>Basic Profile Details</h3>
                        </div>

                    </div>

                    <div class="col-md-12 col-12 col-sm-12">

                        <form>
                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="first-name">FirstName *</label>
                                    <input type="text" class="form-control" id="first-name" placeholder="Enter your first name">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="last-name">Last Name *</label>
                                    <input type="text" class="form-control" id="last-name" placeholder="Enter your last name">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="date">Date Of Birth</label>
                                    <input type="text" class="form-control" id="date" name="date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Enter your date of birth">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12 gender">
                                    <label for="gender">Gender</label>
                                    <select id="gender" class="form-control">
                                        <option selected>Select your gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <div class="form-row">
                                        <div class="form-group col-sm-3 col col-3">
                                            <label for="country-code">Phone Number</label>
                                            <select id="country-code" class="form-control">
                                                <option selected>+91</option>
                                                <option>+91</option>
                                                <option>+1</option>
                                                <option>+66</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-9 col-9">
                                            <label for="phone-number"> </label>
                                            <input type="text" class="form-control" id="phone-number" placeholder="Enter your phone number">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-12 col-md-6 col-12">
                                    <label for="profile-picture">Profile Picture</label>
                                    <input type="file" class="form-control-file image-upload" id="profile-picture">
                                </div>

                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Address Details</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="address-line-one">Address Line 1 *</label>
                                    <input type="text" class="form-control" id="address-line-one" placeholder="Enter your address">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="address-line-two">Address Line 2</label>
                                    <input type="text" class="form-control" id="address-line-two" placeholder="Enter your address">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="city">City *</label>
                                    <input type="text" class="form-control" id="city" placeholder="Enter your city">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="state">State *</label>
                                    <input type="text" class="form-control" id="state" placeholder="Enter your state">
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="zipcode">ZipCode *</label>
                                    <input type="text" class="form-control" id="zipcode" placeholder="Enter your zipcode">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="country">Country *</label>
                                    <select id="country" class="form-control">
                                        <option selected>Select your country</option>
                                        <option>India</option>
                                        <option>USA</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                            </div>

                            <!-- university details -->
                            <div class="form-group-heading">
                                <h3>University and College information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="university">University</label>
                                    <input type="text" class="form-control" id="university" placeholder="Enter your university">
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="college">College</label>
                                    <input type="text" class="form-control" id="college" placeholder="Enter your college">
                                </div>

                            </div>

                            <div id="submit-btn">
                                <a class="btn submit-btn" href="#" title="Submit" role="button">SUBMIT</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Profile Details Ends -->

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
                        <li><a href="#"><img src="images/User-Profile/facebook.png" alt="facbook"></a></li>
                        <li><a href="#"><img src="images/User-Profile/twitter.png" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!-- Section Footer END -->


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>