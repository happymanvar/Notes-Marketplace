<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Search Notes</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav CSS -->
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
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
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
                                <h3>Search Notes</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->


    <!-- Search Notes Starts-->
    <section id="search-filter">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="search-title col-md-12 col-lg-12">
                        <h3>Search and Filter notes</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="search-content col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="search-container">
                            <form>
                                <div class="form-group col-md-12 col-lg-12 col-12 col-sm-12">
                                    <input type="search" class="form-control" id="search-notes" placeholder="Search notes here.." name="search">
                                </div>

                                <div class="form-group col-md-12 col-lg-12 col-12 col-sm-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="type" class="form-control">
                                                <option selected>Select type</option>
                                                <option>Notes</option>
                                                <option>Material</option>
                                                <option>Hand Book</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="category" class="form-control">
                                                <option selected>Select category</option>
                                                <option>First</option>
                                                <option>Second</option>
                                                <option>Third</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="university" class="form-control">
                                                <option selected>Select university</option>
                                                <option>GECR</option>
                                                <option>IIT-Bombay</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="course" class="form-control">
                                                <option selected>Select course</option>
                                                <option>CE</option>
                                                <option>EC</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="country" class="form-control">
                                                <option selected>Select country</option>
                                                <option>India</option>
                                                <option>USA</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="rating" class="form-control">
                                                <option selected>Select rating</option>
                                                <option>Five</option>
                                                <option>Four</option>
                                                <option>Three</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Notes Ends -->

    <!-- Note List Starts -->
    <section id="note-list">
        <div class="conent-box-sm">
            <div class="container">
                <div class="row">
                    <div class="search-title col-md-12 col-lg-12 col-12 col-sm-12">
                        <h3>Total 18 Notes</h3>
                    </div>
                </div>



                <div class="row note-results">

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 01 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/1.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                               
                                <div class="note-title">
                                    <div class="row">
                                       
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Computer Operating System - Final Exam Book With Paper Solution</p>
                                            </a>
                                        </div>
                                         
                                    </div>
                                </div>
                               
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 02 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/2.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Computer Science</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 03 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/3.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Basic Computer Engineering Tech India Publication Series</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 04 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/4.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Computer Science Illuminted - Seventh Edition</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4  col-12 col-sm-12 notes">
                        <!-- note Table 05 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/5.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>The Principles Of Computer Hardware - Oxford</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 06 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/6.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>The Computer Book</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 07 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/1.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Computer Operating System - Final Exam Book With Paper Solution</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 08 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/2.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Computer Science</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 09 -->
                        <div class="note-table">
                            <div class="note-image">
                                <img src="images/Search/3.jpg" alt="notecoverimage" class="img-responsive">
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                           <a href="notes-details.php"> 
                                            <p>Basic Computer Engineering Tech India Publication Series</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <li><img src="images/Search/university.png" alt="university">University of California, US</li>
                                    <li><img src="images/Search/pages.png" alt="notebook">204 Pages</li>
                                    <li><img src="images/Search/date.png" alt="date">Thu, Nov 26 2020</li>
                                    <li><img src="images/Search/flag.png" alt="flag">5 Users marked this note as inappropriate</li>
                                </ul>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" /><label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" /><label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" /><label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" /><label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" /><label for="star1" title="text">1 star</label>
                                </div>
                                <div class="rating-text">
                                    <p>100 reviews</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><img src="images/Search/left-arrow.png" alt="left arrow"> </span>
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true"><img src="images/Search/right-arrow.png" alt="left arrow"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </section>
    <!-- Note List Ends -->

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