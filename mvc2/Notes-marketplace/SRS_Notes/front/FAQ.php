<?php
session_start();
$page = 'FAQ';
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>FAQ</title>

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
    if (isset($_SESSION['is_loggedin'])) {
        include 'login-header.php';
    } else {
        include 'logout-header.php';
    }
    ?>

    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="faq-head-part-inner">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="faq-header-statement" class="text-center">
                                <h3>Frequently Asked Questions</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- General question -->
    <section id="general-question">
        <div class="content-box">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 horizontal-heading">
                        <h3>General Questions</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="accordion" id="general-faq">

                            <div class="card">
                                <div class="card-header" id="general-headingOne">
                                    <h6 class="mb-0">What is Notes Marketplace?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#general-collapseOne" aria-expanded="false" aria-controls="general-collapseOne">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="general-collapseOne" class="collapse" aria-labelledby="general-headingOne" data-parent="#general-faq">
                                    <div class="card-body">
                                        <p>Notes Marketplace is an online marketplace for university students to buy and sell their course notes.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="general-headingTwo">
                                    <h6 class="mb-0">Where did Notes Marketplace start?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#general-collapseTwo" aria-expanded="false" aria-controls="general-collapseTwo">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="general-collapseTwo" class="collapse" aria-labelledby="general-headingTwo" data-parent="#general-faq">
                                    <div class="card-body">
                                        <p>What started out as four friends chucking around an idea in Ahmedabad ended up turning into an earliest version of Notes Marketplace. So, with 2021 batch of tatvasoft – we has developed this product.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- General question Ends -->

    <!-- Uploaders question -->
    <section id="uploader-question">
        <div class="content-box">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 horizontal-heading">
                        <h3>Uploaders</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="accordion" id="uploader-faq">

                            <div class="card">
                                <div class="card-header" id="uploader-headingOne">
                                    <h6 class="mb-0">What is Notes Marketplace?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#uploader-collapseOne" aria-expanded="false" aria-controls="uploader-collapseOne">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="uploader-collapseOne" class="collapse" aria-labelledby="uploader-headingOne" data-parent="#uploader-faq">
                                    <div class="card-body">
                                        <p>Notes Marketplace is an online marketplace for university students to buy and sell their course notes.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="uploader-headingTwo">
                                    <h6 class="mb-0">Where did Notes Marketplace start?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#uploader-collapseTwo" aria-expanded="false" aria-controls="uploader-collapseTwo">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="uploader-collapseTwo" class="collapse" aria-labelledby="uploader-headingTwo" data-parent="#uploader-faq">
                                    <div class="card-body">
                                        <p>What started out as four friends chucking around an idea in Ahmedabad ended up turning into an earliest version of Notes Marketplace. So, with 2021 batch of tatvasoft – we has developed this product.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="uploader-headingThree">
                                    <h6 class="mb-0">How long does it take to upload?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#uploader-collapseThree" aria-expanded="false" aria-controls="uploader-collapseThree">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="uploader-collapseThree" class="collapse" aria-labelledby="uploader-headingThree" data-parent="#uploader-faq">
                                    <div class="card-body">
                                        <p>Uploading notes is quick and easy. It can take as little as 90 seconds per set of notes. Put it this way, in
                                            the time it took to read these FAQs, you could’ve uploaded several sets of notes.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Uploaders question Ends -->

    <!-- Downloader question -->
    <section id="downloader-question">
        <div class="content-box">
            <div class="container">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 horizontal-heading">
                        <h3>Downloaders</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="accordion" id="download-faq">

                            <div class="card">
                                <div class="card-header" id="download-headingOne">
                                    <h6 class="mb-0">How do I buy notes?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#download-collapseOne" aria-expanded="false" aria-controls="download-collapseOne">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="download-collapseOne" class="collapse" aria-labelledby="download-headingOne" data-parent="#download-faq">
                                    <div class="card-body">
                                        <p>Search for the notes you are after using the 'SEARCH NOTES' tab at the at the top right of every page.
                                            You can then filter results by university, category, course information etc. To purchase, go to detail page
                                            of note and click on download button. If notes are free to download – it will download over the browser
                                            and if notes are paid, Once Seller will allow download you can have notes at my downloads grid for
                                            actual download.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="download-headingTwo">
                                    <h6 class="mb-0">Why should I buy notes?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#download-collapseTwo" aria-expanded="false" aria-controls="download-collapseTwo">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="download-collapseTwo" class="collapse" aria-labelledby="download-headingTwo" data-parent="#download-faq">
                                    <div class="card-body">
                                        <p>The notes on our site are incredibly useful as an educational tool when used correctly. They effectively
                                            demonstrate the techniques that top students employ in order to receive top marks. They also
                                            summaries the course in a concise format and show what that student believed were the most
                                            important elements of the course. Learn from the best.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="download-headingThree">
                                    <h6 class="mb-0">Will downloading notes guarantee I improve my grades?</h6>
                                    <a class="btn btn-link" type="button" data-toggle="collapse" data-target="#download-collapseThree" aria-expanded="false" aria-controls="download-collapseThree">
                                        <img class="img-faq" src="images/FAQ/add.png" alt="add">
                                    </a>
                                </div>

                                <div id="download-collapseThree" class="collapse" aria-labelledby="download-headingThree" data-parent="#download-faq">
                                    <div class="card-body">
                                        <p>How long is a piece of string? However, 90% of students who purchased notes through our site said that
                                            doing so improved their grades.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Downloader question Ends -->

    <?php
    include 'footer.php';
    ?>


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>