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
    <title>Contact Us</title>

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
    
    <?php 
    
    include 'db_conntect.php';
    include 'send_mail.php';
    
    if(isset($_POST['submit'])) {
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $comment = mysqli_real_escape_string($conn, $_POST['comments']);    

        $mail->setFrom($config_email, $fullname);
        // This email address and name will be visible as sender of email

        $mail->addAddress($config_email, 'Notes-Marketplace');  // This email is where you want to send the email
        $mail->addReplyTo($config_email, $fullname);   // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true);  
        $mail->Subject = "$fullname - $subject"; 

        $mail->Body = "Hello, <br><br> $comment <br><br> Regards, <br> $fullname";

        if($mail->send()) {
            ?>
            <script> alert("mail sent to admin.")</script>
            <?php    
        }else {
            ?>
            <script> alert("somthing went wrong. please try again,")</script>
            <?php
        }
        
    }
    
    ?>

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
                        <div class="col-md-12 col-12">
                            <div class="header-statement" class="text-center">
                                <h3>Contect Us</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- contect us  -->
    <section id="contect-us">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-left form-heading">
                        <div class="horizontal-heading">
                            <h3>Get in Touch</h3>
                        </div>
                        <p>Let us know how to ge back to you</p>
                    </div>
                </div>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="full-name">Full Name *</label>
                                <input type="text" id="full-name" name="fullname" class="form-control" placeholder="Enter your full name">
                            </div>
                            <div class="form-group">
                                <label for="email-address">Email Address *</label>
                                <input type="email" id="email-address" name="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="comment-area">
                                <div class="form-group">
                                    <label for="comments">Comments/Questions *</label>
                                    <textarea class="form-control" name="comments" id="comments" placeholder="Comments..."></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="btn-submit">
                       <button type="submit" name="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </section>
    <!-- Ends -->

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