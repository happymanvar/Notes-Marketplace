<?php
session_start();

if (!isset($_SESSION['is_loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
}
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Admin Notes Details</title>

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


</head>

<body>

    <!-- Navigation Bar -->
    <?php
    include 'admin-header.php';

    include 'db_conntect.php';
    include 'send_mail.php';
    error_reporting(E_ALL ^ E_WARNING);

    ?>

    <?php
    if (isset($_GET['id'])) {

        $noteid = $_GET['id'];

        $get_details = "SELECT * FROM sellernotes WHERE ID='$noteid' AND IsActive = b'1'";
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
    if (isset($_GET['rid'])) {
        $review = $_GET['rid'];
        $nid = $_GET['id'];

        $deletereview = "DELETE FROM sellernotesreviews WHERE ID=$review";
        $deletequery = mysqli_query($conn, $deletereview);
        if (!($deletequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
    ?>
            <script>
                window.location.href = "admin-note-detail.php?id=<?php echo $nid; ?>";
            </script>
    <?php
        }
    }
    ?>
    <!-- Navigation Bar END -->

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
                                        echo "<img src='admin-images/images/computer-science.png' alt='notedetail'>";
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
                                        <?php
                                        if ($sellingtype == 0) {
                                            echo "<a class='btn btn-download' href='admin-downloadnotes.php?id=$noteid' title='Download' role='button'>Download</a>";
                                        } else {
                                            echo "<a class='btn btn-download' href='admin-downloadnotes.php?id=$noteid' title='Download' role='button'>Download /$$price </a>";
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
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 left-side text-left">
                                    <p>Rating:</p>
                                </div>
                                <div class="col-md-6 col-6 col-sm-6 col-lg-6 right-side text-right">
                                    <p>
                                        <?php
                                        $getrating = "SELECT AVG(Ratings) AS Averagerating, COUNT(Ratings) AS counts FROM sellernotesreviews WHERE NoteID = $noteid";
                                        $ratingquery = mysqli_query($conn, $getrating);
                                        $avgrating = mysqli_fetch_assoc($ratingquery);
                                        $countrating = $avgrating['counts'];
                                        echo $countrating . " Reviews";
                                        ?>
                                    </p>
                                </div>
                                <div class="col-md-12 col-12 col-sm-9 col-lg-12 instruction left-side text-left">
                                    <p><?php
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

                                <div class="review-container">
                                    <div clas="note-reviews" style="overflow-y: auto; overflow-x: hidden;">
                                        <?php
                                        $getreviews = "SELECT * FROM sellernotesreviews WHERE NoteID = $noteid";
                                        $reviewquery = mysqli_query($conn, $getreviews);
                                        while ($reviewdata = mysqli_fetch_assoc($reviewquery)) {
                                            $reviewerid = $reviewdata['ReviewedByID'];
                                            $reviewratingcount = $reviewdata['Ratings'];
                                            $reviewdesc = $reviewdata['Comments'];

                                            $getuserdata = "SELECT * FROM users WHERE ID = $reviewerid";
                                            $userdataquery = mysqli_query($conn, $getuserdata);
                                            $reviewerdata = mysqli_fetch_assoc($userdataquery);
                                            $rfirstname = $reviewerdata['FirstName'];
                                            $rlastname = $reviewerdata['LastName'];

                                        ?>
                                            <!-- review 01 -->
                                            <div class=" review">
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
                                                                echo "<img src='admin-images/images/reviewer-1.png' alt='user' class='img-responsive img-circle'>";
                                                            }
                                                        }

                                                        ?>

                                                    </div>
                                                    <div class="review-detail col-md-10 col-10 col-sm-10">

                                                        <div class="row">
                                                            <div class="col-md-10 col-8 col-sm-10 text-left">
                                                                <h4><?php echo $rfirstname . " " . $rlastname; ?></h4>
                                                                <div class="stars text-left">
                                                                    <?php
                                                                    for ($j = 1; $j <= $reviewratingcount; $j++) { ?>
                                                                        <img src="admin-images/images/star.png" style="height: 20px;">
                                                                    <?php
                                                                    }
                                                                    for ($k = 1; $k <= 5 - $reviewratingcount; $k++) {
                                                                    ?>
                                                                        <img src="admin-images/images/star-white.png" style="height: 20px;">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 col-4 col-sm-2">
                                                                <div class="delete-icon text-right">
                                                                    <div id="delete-btn-1">
                                                                        <a class="btn delete-review" href="admin-note-detail.php?rid=<?php echo $reviewdata['ID']; ?>&id=<?php echo $noteid; ?>" title="delete" role="button">
                                                                            <img src="admin-images/images/delete.png" alt="menu" class=""></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p><?php echo $reviewdesc; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
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


    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Footer Ends -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        <div class="row">
                            <div class="col-md-12 col-12 col-sm-12">
                                <img src="admin-images/images/SUCCESS.png" alt="success">
                            </div>
                            <div class="col-md-12 col-12 col-sm-12">
                                <h3>Thank you for purchasing!</h3>
                            </div>
                        </div>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="admin-images/images/close.png" alt="close">
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Dear Smith,</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id tempora ab tenetur, a libero voluptatum vero officiis similique iste amet, quam, in autem culpa qui quisquam, maiores omnis minima recusandae?</p>

                    <p>In case, you have urgency,<br>Please contect us on +9195377345949</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque aliquam dolor excepturi porro, </p>

                    <p>Have a good day</p>
                </div>
            </div>
        </div>
    </div>


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- poper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-review').click(function() {
                if (confirm('Are you sure you want to delete this review?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


</body>

</html>