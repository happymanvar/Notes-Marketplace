<?php
session_start();

if (!isset($_SESSION['is_loggedin'])) {
    header('location:../login.php');
} else {
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
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
    <title>My Downloads</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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

    include 'login-header.php';
    include 'db_conntect.php';


    if (isset($_POST['submit'])) {
        $rating = $_POST['rating'];
        $comment = $_POST['note-comment'];
        $noteid = $_POST['noteid'];

        $getid = "SELECT * FROM downloads WHERE NoteID = $noteid AND Downloader = $user_id";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $againstdwdid = $iddata['ID'];

        $check = "SELECT * FROM sellernotesreviews WHERE NoteID = '$noteid' AND ReviewedByID = '$user_id'";
        $checkquery = mysqli_query($conn, $check);
        $checkcount = mysqli_num_rows($checkquery);

        if ($checkcount == 0) {
            $insertrating = "INSERT INTO `sellernotesreviews` (`NoteID`, `ReviewedByID`, `AgainstDownloadsID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('$noteid', '$user_id', '$againstdwdid', '$rating', '$comment', current_timestamp(), '$user_id', current_timestamp(), '$user_id', b'1')";
            $insratingquery = mysqli_query($conn, $insertrating);
            if (!($insratingquery)) {
                echo "first";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        } else {
            $updaterating = "UPDATE `sellernotesreviews` SET `Ratings` = '$rating', `Comments` = '$comment', `IsActive` = b'1' WHERE NoteID = '$noteid' AND ReviewedByID = '$user_id'";
            $update = mysqli_query($conn, $updaterating);
            if (!($update)) {
                echo "second";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }

    if (isset($_POST['reportissue'])) {
        $remarkcontent = $_POST['remark-content'];
        $noteid = $_POST['noteid'];

        $getid = "SELECT * FROM downloads WHERE NoteID = $noteid AND Downloader = $user_id";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $againstdwdid = $iddata['ID'];

        $check = "SELECT * FROM sellernotesreportedissues WHERE NoteID = '$noteid' AND ReportedByID = '$user_id'";
        $checkquery = mysqli_query($conn, $check);
        $checkcount = mysqli_num_rows($checkquery);

        if ($checkcount == 0) {
            $insertremark = "INSERT INTO `sellernotesreportedissues` (`NoteID`, `ReportedByID`, `AgainstDownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$noteid', '$user_id', '$againstdwdid', '$remarkcontent', current_timestamp(), '$user_id', current_timestamp(), '$user_id')";
            $insremarkquery = mysqli_query($conn, $insertremark);
            if (!($insremarkquery)) {
                echo "first";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        } else {
            $updateremark = "UPDATE `sellernotesreportedissues` SET `Remarks` = '$remarkcontent', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$user_id' WHERE NoteID = '$noteid' AND ReportedByID = '$user_id'";
            $update = mysqli_query($conn, $updateremark);
            if (!($update)) {
                echo "second";
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }

    ?>

    <!-- My Downloads Table -->
    <section id="my-download">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading">
                            <h3>My Downloads</h3>
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" name="valueToSearch" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-4 col-sm-4 table-search-btn">
                                <div id="search-btn">
                                    <a class="btn search-btn" name="btn-search" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="dowmload-table table-responsive">

                            <table class="table table-hover" id="mydownloads-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header title">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">BUYER</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header date">DOWNLOADED DATE/TIME</th>
                                        <th scope="col" class="table-header blank"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mydownload = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND Seller != $user_id AND Downloader = $user_id GROUP BY NoteID,Downloader ORDER BY AttachmentDownloadedDate DESC";
                                    $getdata = mysqli_query($conn, $mydownload);
                                    $count = mysqli_num_rows($getdata);

                                    for ($i = 1; $i <= $count; $i++) {
                                        $download_row = mysqli_fetch_assoc($getdata);
                                        $noteid = $download_row['NoteID'];

                                        $getnote = "SELECT * FROM sellernotes WHERE ID = '$noteid'";
                                        $notedetail = mysqli_query($conn, $getnote);
                                        $notedata = mysqli_fetch_assoc($notedetail);



                                    ?>

                                        <tr style="height: 50px;">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="mydownload" name="mydownload" href="notes-details.php?id=<?php echo $noteid; ?>" role="button"><?php echo $notedata['Title']; ?></a></td>
                                            <td><?php
                                                $catid = $notedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php echo $email_id; ?></td>
                                            <td><?php
                                                if ($notedata['IsPaid'] == 0) {
                                                    echo "Free";
                                                } else {
                                                    echo "Paid";
                                                }
                                                ?></td>
                                            <td><?php echo "$" . $notedata['SellingPrice']; ?></td>
                                            <td><?php
                                                $dwddate = $download_row['AttachmentDownloadedDate'];
                                                $date = strtotime($dwddate);
                                                echo date('d M Y, H:i:s', $date); ?></td>
                                            <td class="text-center">
                                                <a href="notes-details.php?id=<?php echo $noteid; ?>"><img src="images/my-downloades/eye.png" alt="eye"></a>

                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="images/my-downloades/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <button class="dropdown-item" type="button"><a target="_blank" href="downloadnotes.php?id=<?php echo $noteid; ?>">Download Note</a></button>
                                                        <button class="dropdown-item" type="button" href="#" role="button" data-toggle="modal" data-target="#addreview<?php echo $i; ?>">Add Review/Feedback</button>
                                                        <button class="dropdown-item" type="button" role="button" data-toggle="modal" data-target="#inappropriate<?php echo $i; ?>">Report as Inappropriate</button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addreview<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="addreviewTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title" id="eaddreviewTitle">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3>Add Review</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <img src="images/notes-details/close.png" alt="close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">


                                                            <form action="" method="POST">
                                                                <div class="form-row col-md-12 align-content-center">
                                                                    <fieldset class="rating">
                                                                        <input type="radio" id="star<?php echo $i; ?>5" name="rating" value="5" /><label class="full" for="star<?php echo $i; ?>5" title="Awesome - 5 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>4half" name="rating" value="4.5" /><label class="half" for="star<?php echo $i; ?>4half" title="Pretty good - 4.5 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>4" name="rating" value="4" /><label class="full" for="star<?php echo $i; ?>4" title="Pretty good - 4 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>3half" name="rating" value="3.5" /><label class="half" for="star<?php echo $i; ?>3half" title="Meh - 3.5 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>3" name="rating" value="3" /><label class="full" for="star<?php echo $i; ?>3" title="Meh - 3 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>2half" name="rating" value="2.5" /><label class="half" for="star<?php echo $i; ?>2half" title="Kinda bad - 2.5 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>2" name="rating" value="2" /><label class="full" for="star<?php echo $i; ?>2" title="Kinda bad - 2 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>1half" name="rating" value="1.5" /><label class="half" for="star<?php echo $i; ?>1half" title="Meh - 1.5 stars"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>1" name="rating" value="1" /><label class="full" for="star<?php echo $i; ?>1" title="Sucks big time - 1 star"></label>
                                                                        <input type="radio" id="star<?php echo $i; ?>half" name="rating" value="0.5" /><label class="half" for="star<?php echo $i; ?>half" title="Sucks big time - 0.5 stars"></label>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <div class="comment-area col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="review-comment">Comments*</label>
                                                                            <textarea class="form-control" id="review-comment" name="note-comment" placeholder="Comments..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <input type="hidden" name="noteid" value="<?php echo $noteid; ?>" />
                                                                    <div class="btn-submit">
                                                                        <!--<a class="btn btn-submit" href="#" title="Submit" role="button">Submit</a>-->
                                                                        <button type="submit" id="rating-submit" name="submit" class="btn note-submit-btn">SUBMIT</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="inappropriate<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3>Report as an inappropriate</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form action="" method="POST">
                                                                <div class="form-row col-md-12">
                                                                    <div class="comment-area col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="remark-title">Title</label>
                                                                            <input type="text" class="form-control" id="remark-title" name="remark-title" value=" <?php echo $notedata['Title']; ?>" readonly />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="remark-content">Remarks</label>
                                                                            <textarea class="form-control" id="remark-content" name="remark-content" placeholder="Remarks..."></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <input type="hidden" name="noteid" value="<?php echo $noteid; ?>" />

                                                                    <button type="button" class="btn btn-secondary" style="margin: 0px 10px;" data-dismiss="modal">Close</button>
                                                                    <button type="submit" name="reportissue" class="btn btn-danger btn-issue">Report an issue</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- My Downloads Ends -->

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
                        <li>
                            <a href="#"><img src="images/User-Profile/facebook.png" alt="facbook"></a>
                        </li>
                        <li>
                            <a href="#"><img src="images/User-Profile/twitter.png" alt="twitter"></a>
                        </li>
                        <li>
                            <a href="#"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!-- Section Footer END -->




    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- poper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#mydownloads-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="images/Search/right-arrow.png">',
                        previous: '<img src="images/Search/left-arrow.png">'
                    }
                }
            });

            $('.search-btn').click(function() {
                var x = $('#search').val();
                table.search(x).draw();

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-issue').click(function() {
                if (confirm('Are you sure you want to mark this report as spam, you cannot update it later?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

</body>

</html>