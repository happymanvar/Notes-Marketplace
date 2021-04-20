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
    <title>Notes Details</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">

</head>

<body>

    <?php
    if (isset($_SESSION['is_loggedin'])) {
        include 'login-header.php';
        $buyerid = $_SESSION['user_id'];
        $buyername = $_SESSION['username'];
        $user_id = $_SESSION['user_id'];
    } else {
        include 'logout-header.php';
    }

    include 'db_conntect.php';
    include 'send_mail.php';

    ?>


    <?php
    if (isset($_GET['id'])) {

        $noteid = $_GET['id'];

        $get_details = "SELECT * FROM sellernotes WHERE ID='$noteid'";
        $details = mysqli_query($conn, $get_details);
        if (!($details)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $data = mysqli_fetch_assoc($details);
        $notetitle = $data['Title'];
        $sellerid = $data['SellerID'];

        $notecategory = $data['Category'];
        $notedesc = $data['Description'];
        $noteuni = $data['UniversityName'];
        $unicontry = $data['Country'];
        $notecourse = $data['Course'];
        $notecoursecode = $data['CourseCode'];
        $noteprof = $data['Professor'];
        $notepage = $data['NumberofPages'];
        $noteapprdate = $data['PublishedDate'];
        $sellingtype = $data['IsPaid'];
        $price = $data['SellingPrice'];
        $notedp = $data['DisplayPicture'];

        $getcategory = "SELECT * FROM notecategories WHERE ID = '$notecategory' AND IsActive = b'1'";
        $catquery = mysqli_query($conn, $getcategory);
        $catdeatil = mysqli_fetch_assoc($catquery);
        $catname = $catdeatil['Name'];

        $getseller = "SELECT * FROM users WHERE ID = $sellerid";
        $seller = mysqli_query($conn, $getseller);
        $fetchseller = mysqli_fetch_assoc($seller);
        $sellername = $fetchseller['FirstName'];
        $selleremail = $fetchseller['EmailID'];
    }

    ?>
    <?php
    if (isset($_POST['paidnotes'])) {

        $getattacount = "SELECT * FROM sellernotesattachements WHERE NoteID = $noteid";
        $getattacountquery = mysqli_query($conn, $getattacount);
        while ($attacount = mysqli_fetch_assoc($getattacountquery)) {
            $paidnote = "INSERT INTO `downloads` (`NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AtachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$noteid', '$sellerid', '$buyerid', b'0', NULL, b'0', current_timestamp(), b'1', '$price', '{$notetitle}', '{$catname}', current_timestamp(), '$buyerid', current_timestamp(), '$buyerid')";
            $paidresult = mysqli_query($conn, $paidnote);
            if (!($paidresult)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
        $mail->addAddress($selleremail);  // This email is where you want to send the email
        $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "$buyername wants to purchase your notes";

        $mail->Body = "Hello $sellername, <br><br> We would like to inform you that, $buyername wants to purchase your notes. Please see Buyer Request tab and allow download access to Buyer if you have received the payment from him. <br><br> Regards,<br>Notes Marketplace";

        $mail->send();
    }
    ?>

    <!-- Notes Details -->
    <section id="note-details">
        <div class="content-box notes-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-12 col-sm-12">
                        <div class="note-detail-left">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Notes Details</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-12 col-lg-5 col-sm-5 note-image">
                                    <?php
                                    if ($notedp != "") {
                                        echo "<img src='../Members/$sellerid/$noteid/$notedp' alt='notedetail' class='img-responsive'>";
                                    } else {
                                        echo "<img src='images/notes-details/1.jpg' alt='notedetail'>";
                                    }

                                    ?>
                                </div>

                                <div class="col-md-7 col-12 col-lg-7 col-sm-7">
                                    <div class="note-heading">
                                        <h2><?php echo "$notetitle"; ?></h2>

                                        <p><?php
                                            $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$notecategory' AND IsActive = b'1'";
                                            $categoryquery = mysqli_query($conn, $getcategoryquery);
                                            $categoryrow = mysqli_fetch_array($categoryquery);
                                            echo $categoryrow["Name"]; ?></p>
                                    </div>
                                    <div class="note-description">
                                        <p><?php echo "$notedesc"; ?></p>
                                    </div>
                                    <div class="download-btn">
                                        <?php if (isset($_SESSION['is_loggedin'])) {
                                            if ($sellingtype == 0) {
                                        ?>
                                                <button type="button" class="btn btn-download"><a target="_blank" href="downloadnotes.php?id=<?php echo "$noteid"; ?>">Download</a></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-download" id="paid-notes-btn">Download <?php echo "/$" . "$price"; ?></button>
                                            <?php
                                            }
                                            ?>

                                        <?php } else {
                                        ?>
                                            <button type="button" class="btn btn-download" onclick="login()">Download <?php echo "/$" . "$price"; ?></button>
                                        <?php
                                        }
                                        ?>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 col-12 col-lg-6 col-sm-12">
                        <div class="note-detail-right">
                            <div class="row">
                                <div class="col-md-6 col-6 col-lg-6 col-sm-6 left-side text-left">
                                    <p>Institution:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php echo "$noteuni"; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Country:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php
                                        $getcountryquery = "SELECT * FROM `countries` WHERE ID = '$unicontry' AND IsActive = b'1'";
                                        $countryquery = mysqli_query($conn, $getcountryquery);
                                        $countryrow = mysqli_fetch_array($countryquery);

                                        echo $countryrow["Name"]; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Course Name:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php echo "$notecourse"; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Course Code:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php echo "$notecoursecode"; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Professor:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php echo "$noteprof"; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Number of Pages:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php echo "$notepage"; ?></p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Approved Date:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p><?php
                                        $apprdate = $noteapprdate;
                                        $date = strtotime($apprdate);
                                        echo date('F j Y', $date);

                                        ?></p>
                                </div>
                                <div class="col-md-4 col-4 col-sm-4 col-lg-4 left-side text-left">
                                    <p>Rating:</p>
                                </div>
                                <div class="col-md-8 col-8 col-sm-8 col-lg-8 right-side note-rating text-right">
                                    <div class="row">
                                        <div class="col-lg-7 col-6 col-sm-7 col-md-7">
                                            <div class="stars text-right">
                                                <?php
                                                $getrating = "SELECT AVG(Ratings) AS Averagerating, COUNT(Ratings) AS counts FROM sellernotesreviews WHERE NoteID = $noteid";
                                                $ratingquery = mysqli_query($conn, $getrating);
                                                $avgrating = mysqli_fetch_assoc($ratingquery);
                                                $rating = $avgrating['Averagerating'];
                                                $roundratings = round($rating);
                                                $countrating = $avgrating['counts'];
                                                for ($j = 1; $j <= $roundratings; $j++) {
                                                ?>
                                                    <img src="images/Search/star.png">
                                                <?php
                                                }
                                                for ($k = 1; $k <= 5 - $roundratings; $k++) {
                                                ?>
                                                    <img src="images/Search/star-white.png">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-6 col-sm-5 col-md-5">
                                            <p><?php echo $countrating; ?> Reviews</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12 col-12 col-sm-9 col-lg-12 instruction left-side text-left">
                                    <p> <?php
                                        $issue = "SELECT * FROM sellernotesreportedissues WHERE NoteID = $noteid";
                                        $issuequery = mysqli_query($conn, $issue);
                                        $count = mysqli_num_rows($issuequery);
                                        echo "$count Users marked this note as inappropriate";
                                        ?></p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="bottom-border col-md-12">

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Notes Details Ends -->

    <!-- Notes Preview -->
    <section id="notes-preview">
        <div class="content-box note-preview">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-12 col-sm-12 preview">
                        <div class="note-preview-left">
                            <div class="row">
                                <div class="col-md-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Notes Preview</h3>
                                </div>

                                <div class="note-detail-preview">
                                    <?php
                                    $getpreview = "SELECT * FROM sellernotes WHERE ID = $noteid";
                                    $previewquery = mysqli_query($conn, $getpreview);
                                    if ($previewquery) {
                                        $previewdata = mysqli_fetch_assoc($previewquery);
                                        $previewpdf = $previewdata['NotesPreview'];
                                        if ($previewpdf != "") {

                                            $notesellerid = $previewdata['SellerID'];

                                            echo  "<iframe src='../Members/$notesellerid/$noteid/$previewpdf' scrolling='no'></iframe>";
                                        } else {
                                    ?>
                                            <iframe src="http://www.africau.edu/images/default/sample.pdf" scrolling="no"></iframe>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <iframe src="http://www.africau.edu/images/default/sample.pdf" scrolling="no"></iframe>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-7 col-12 col-sm-12 preview">
                        <div class="note-preview-right">
                            <div class="row">
                                <div class="col-md-12 col-12 col-sm-12 horizontal-heading-sm text-left">
                                    <h3>Customer Reviews</h3>
                                </div>

                                <div class="review-container col-md-12 col-lg-12 col-12">
                                    <div clas="note-reviews" style="overflow-y: auto; overflow-x: hidden;">
                                        <?php
                                        $getreviews = "SELECT * FROM sellernotesreviews WHERE NoteID = $noteid ORDER BY Ratings DESC,CreatedDate DESC";
                                        $reviewquery = mysqli_query($conn, $getreviews);
                                        if (mysqli_num_rows($reviewquery) == 0) {
                                            echo '<h3 style="color:#6255a5;text-align: center;">No Reviews</h3>';
                                        } else {
                                            while ($reviewdata = mysqli_fetch_assoc($reviewquery)) {
                                                $reviewerid = $reviewdata['ReviewedByID'];
                                                $reviewratingcount = $reviewdata['Ratings'];
                                                $reviewdesc = $reviewdata['Comments'];
                                                $reviewratingcount = round($reviewratingcount);

                                                $getuserdata = "SELECT * FROM users WHERE ID = $reviewerid";
                                                $userdataquery = mysqli_query($conn, $getuserdata);
                                                $reviewerdata = mysqli_fetch_assoc($userdataquery);
                                                $rfirstname = $reviewerdata['FirstName'];
                                                $rlastname = $reviewerdata['LastName'];

                                        ?>

                                                <!-- review 01 -->
                                                <div class="review">
                                                    <div class="row">
                                                        <div class="user-image col-md-2 col-2 col-sm-2">
                                                            <?php

                                                            $userdp = "SELECT * FROM user_profile WHERE UserID = $reviewerid";
                                                            $userdpquery = mysqli_query($conn, $userdp);
                                                            if (!($userdpquery)) {
                                                                die("QUERY FAILED" . mysqli_error($conn));
                                                            } else {
                                                                $rowdata = mysqli_fetch_assoc($userdpquery);
                                                                $dpname = $rowdata['Profile Picture'];
                                                                if ($dpname != "") {
                                                                    echo "<img src='../Members/$reviewerid/$dpname' alt='user' class='img-responsive img-circle'>";
                                                                } else {
                                                                    echo "<img src='images/notes-details/reviewer-1.png' alt='user' class='img-responsive img-circle'>";
                                                                }
                                                            }

                                                            ?>
                                                        </div>
                                                        <div class="review-detail col-md-10 col-10 col-sm-10">

                                                            <h4><?php echo $rfirstname . " " . $rlastname; ?></h4>
                                                            <div class="stars text-left">
                                                                <?php
                                                                for ($j = 1; $j <= $reviewratingcount; $j++) { ?>
                                                                    <img src="images/Search/star.png" style="height: 20px;">
                                                                <?php
                                                                }
                                                                for ($k = 1; $k <= 5 - $reviewratingcount; $k++) {
                                                                ?>
                                                                    <img src="images/Search/star-white.png" style="height: 20px;">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <p><?php echo $reviewdesc; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Notes Preview Ends -->


    <?php
    include 'footer.php';
    ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <div class="row">
                            <div class="col-md-12 col-12 col-sm-12">
                                <img src="images/notes-details/SUCCESS.png" alt="success">
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <h3>Thank you for purchasing!</h3>
                            </div>
                        </div>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="images/notes-details/close.png" alt="close">
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Dear <?php echo $buyername; ?>,</h5>
                    <p>Hey, thank you for purchasing the note. </p>

                    <p>As this is paid notes - you need to pay the amount to seller <b><?php echo $sellername; ?></b> offline in order to download the note. </p>

                    <p>We will send mail Seller an email that you want to download this note. Seller may contact you further for pyment process completion.</p>

                    <p>In case, you have urgency,<br>Please contect us on <b>+9195377345949</b></p>
                    <p>Once Seller receives the payment and acknowledge us - selected notes you can see over my downloads tab for download. </p>

                    <p>Have a good day</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        function login() {
            alert("please login first to download note.");
            window.location.href = "../login.php";
        }

        $('#paid-notes-btn').click(function() {
            if (confirm('Are you sure you want to download this paid note. Please confirm')) {
                $(this).attr('data-toggle', 'modal').attr('data-target', '#exampleModalLong');
                $.ajax({
                    type: "POST",
                    url: "notes-details.php?id=<?php echo $noteid; ?>",
                    data: {
                        'paidnotes': 'paidnotes'
                    },
                    dataType: "text",
                    success: function(res) {},
                    error: function(res) {
                        alert("error in ajax call");
                    }
                });
                return true;

            } else {
                return false;
            }
        });
    </script>

</body>

</html>
