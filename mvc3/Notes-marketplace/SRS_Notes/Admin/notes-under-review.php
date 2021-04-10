<?php
session_start();

$page = 'notes';

if (!isset($_SESSION['is_loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
} else {
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $adminid = $_SESSION['user_id'];
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
    <title>Notes Under Review</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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


    if (isset($_GET['approve'])) {
        $noteid = $_GET['approve'];

        $approve = "UPDATE `sellernotes` SET `Status` = '9', `IsActive` = b'1', `ActionedBy` = '$adminid', `PublishedDate` = current_timestamp() WHERE ID = '$noteid'";
        $approvequery = mysqli_query($conn, $approve);
        if (!($approvequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:notes-under-review.php');
        }
    }

    if (isset($_GET['inreview'])) {
        $inoteid = $_GET['inreview'];

        $inreview = "UPDATE `sellernotes` SET `Status` = '8', `IsActive` = b'1', `ActionedBy` = '$adminid', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$inoteid'";
        $inreviewquery = mysqli_query($conn, $inreview);
        if (!($inreviewquery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:notes-under-review.php');
        }
    }

    if (isset($_POST['rejectnote'])) {
        $remarkcontent = $_POST['remark-content'];
        $rnoteid = $_POST['noteid'];

        $reject = "UPDATE `sellernotes` SET `Status` = '10', `IsActive` = b'1', `AdminRemarks` = '$remarkcontent', `ActionedBy` = '$adminid', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$rnoteid'";
        $rejectquery = mysqli_query($conn, $reject);
        if (!($rejectquery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
    }
    ?>
    <!-- Navigation Bar END -->



    <!-- Notes Under Review -->
    <section id="notes-under-review">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Notes Under Review</h3>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 text-left">
                        <form>
                            <div class="form-group col-md-4">
                                <label for="seller">Seller</label>
                                <?php
                                $getseller  = "SELECT DISTINCT(SellerID) AS 'sid' FROM sellernotes";
                                if (isset($_GET['id'])) {
                                    $selectedid = $_GET['id'];
                                    $getseller .= " WHERE SellerID = '$selectedid'";
                                }
                                $getsellerquery = mysqli_query($conn, $getseller);
                                $sellercount = mysqli_num_rows($getsellerquery);
                                ?>
                                <select id="seller" name="seller" class="form-control">
                                    <option selected value="">Select seller</option>
                                    <?php
                                    for ($j = 1; $j <= $sellercount; $j++) {
                                        $sellerid = mysqli_fetch_assoc($getsellerquery);

                                        $sid = $sellerid['sid'];

                                        $sellerdetail = "SELECT * FROM users WHERE ID = $sid AND IsActive = b'1'";
                                        $sellerdetailquery = mysqli_query($conn, $sellerdetail);
                                        $sdetail = mysqli_fetch_assoc($sellerdetailquery);
                                    ?>
                                        <option value="<?php echo $sdetail['FirstName'] . " " . $sdetail['LastName'] ?>"><?php echo $sdetail['FirstName'] . " " . $sdetail['LastName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row text-right">
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-7 col-12">
                                <div class="row search-kit">
                                    <div class="col-md-8 col-8 table-search-bar">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="search" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4 table-header-search-btn">
                                        <div id="search-btn">
                                            <a class="btn table-search-btn" title="search" role="button">SEARCH</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="notes-under-review-table table-responsive">

                            <table class="table table-hover" id="notes-under-review-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header seller">SELLER</th>
                                        <th scope="col" class="table-header date">DATE ADDED</th>
                                        <th scope="col" class="table-header">STATUS</th>
                                        <th scope="col" class="table-header actions" style="min-width: 320px;">ACTION</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getdata = "SELECT * FROM sellernotes WHERE Status IN(7,8) AND IsActive = b'1'";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $getdata .= " AND SellerID = '$selectedid' ORDER BY CreatedDate ASC";
                                    } else {
                                        $getdata .= " ORDER BY CreatedDate ASC";
                                    }
                                    $getdataquery = mysqli_query($conn, $getdata);
                                    $count = mysqli_num_rows($getdataquery);
                                    for ($i = 1; $i <= $count; $i++) {
                                        $notedata = mysqli_fetch_assoc($getdataquery);


                                    ?>
                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="note-detail-anchor" href="admin-note-detail.php?id=<?php echo $notedata['ID']; ?>"><?php echo $notedata['Title']; ?></a></td>
                                            <td><?php
                                                $catid = $notedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $publisherid = $notedata['SellerID'];
                                                $getpublisher = "SELECT * FROM users WHERE ID= '$publisherid' AND IsActive = b'1'";
                                                $getpquery = mysqli_query($conn, $getpublisher);
                                                $getpublisherdata = mysqli_fetch_assoc($getpquery);
                                                echo $getpublisherdata['FirstName'] . " " . $getpublisherdata['LastName'];
                                                ?> <a href="member-details.php?id=<?php echo $publisherid; ?>"><img src="admin-images/images/eye.png" alt="edit"></a></td>
                                            <td><?php $addeddate =  $notedata['CreatedDate'];
                                                $date = strtotime($addeddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td><?php
                                                $statusid = $notedata['Status'];
                                                $getstatusquery = "SELECT * FROM referencedata WHERE ID = '$statusid' AND IsActive = b'1'";
                                                $statusquery = mysqli_query($conn, $getstatusquery);
                                                $status = mysqli_fetch_assoc($statusquery);
                                                echo $status['Value']; ?></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4 col-4 col-sm-4 col-lg-4 action-btns">
                                                        <div id="approve-action-one">
                                                            <a class="btn approve-action-btn approve-note" name="approve" href="notes-under-review.php?approve=<?php echo $notedata['ID']; ?>" title="search" role="button">Approve</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-4 col-sm-4 col-lg-4 action-btns">
                                                        <div id="reject-action-one">
                                                            <a class="btn review-action-btn" title="search" role="button" data-toggle="modal" data-target="#reject<?php echo $i; ?>">Reject</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-4 col-sm-4 col-lg-4 action-btns">
                                                        <div id="inreview-action-one">
                                                            <a class="btn inreview-action-btn" name="inreview" href="notes-under-review.php?inreview=<?php echo $notedata['ID']; ?>" title="search" role="button">InReview</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a href="admin-downloadnotes.php?id=<?php echo $notedata['ID']; ?>"><button class="dropdown-item" type="button">Download Notes</button></a>
                                                        <a href="admin-note-detail.php?id=<?php echo $notedata['ID']; ?>"><button class="dropdown-item" type="button">View More Details</button></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="reject<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3><?php echo $notedata['Title'] . " - " . $category['Name']; ?></h3>
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
                                                                            <label for="remark-content">Remarks*</label>
                                                                            <textarea class="form-control" id="remark-content" name="remark-content" placeholder="Write remarks" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <input type="hidden" name="noteid" value="<?php echo $notedata['ID']; ?>" />

                                                                    <button type="button" class="btn btn-secondary" style="margin: 0px 10px;" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="rejectnote" class="btn btn-danger btn-reject">Reject</button>

                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Notes Under Reivew Ends -->

    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Footer Ends -->



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
            var table = $('#notes-under-review-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="admin-images/images/right-arrow.png">',
                        previous: '<img src="admin-images/images/left-arrow.png">'
                    }
                }
            });

            $('.table-search-btn').click(function() {
                var x = $('#search').val();
                table.search(x).draw();

            });

            $('select').change(function() {
                var x = $(this).val();
                table.columns(3).search(x).draw();
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.approve-note').click(function() {
                if (confirm('If you approve the notes - System will publish the notes over portal. Please press yes to continue.')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.inreview-action-btn').click(function() {
                if (confirm('Via marking the notes In Review - System will let user know that review process has been initiated. Please press yes to continue.')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-reject').click(function() {
                if (confirm('Are you sure you want to reject seller request?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
</body>

</html>