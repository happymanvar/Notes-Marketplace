<?php
session_start();
$page = 'dashboard';
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
    <title>Dashboard</title>

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
    include 'send_mail.php';


    if (isset($_POST['unpublishnote'])) {
        $remarkcontent = $_POST['remark-content'];
        $noteid = $_POST['noteid'];

        $sellerid = "";
        $selleremail = "";
        $sellername = "";
        $notename = "";

        $getsdetail = "SELECT * FROM sellernotes WHERE ID = $noteid";
        $getsdetailquery = mysqli_query($conn, $getsdetail);
        if ($getsdetailquery) {
            $snotedata = mysqli_fetch_assoc($getsdetailquery);

            $sellerid = $snotedata['SellerID'];
            $notename = $snotedata['Title'];

            $getseller = "SELECT * FROM users WHERE ID = $sellerid AND IsActive = b'1'";
            $getsellerquery = mysqli_query($conn, $getseller);
            $sellerdata = mysqli_fetch_assoc($getsellerquery);
            $selleremail = $sellerdata['EmailID'];
            $sellername = $sellerdata['FirstName'];
        }


        $remove = "UPDATE `sellernotes` SET `Status` = '11', `IsActive` = b'0', `AdminRemarks` = '$remarkcontent', `ActionedBy` = '$adminid' WHERE ID = '$noteid'";
        $removequery = mysqli_query($conn, $remove);
        if ($removequery) {
            $updatedwd = "UPDATE `downloads` SET `IsActive` = b'0' WHERE NoteID = '$noteid'";
            $updatedwdquery = mysqli_query($conn, $updatedwd);
            if (!($updatedwdquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            $updateatta = "UPDATE `sellernotesattachements` SET `IsAvtive` = b'0' WHERE NoteID = '$noteid'";
            $updateattaquery = mysqli_query($conn, $updateatta);
            if (!($updateattaquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }

            $mail->addAddress($selleremail);  // This email is where you want to send the email
            $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Sorry! we need to remove your notes from our portal.";

            $mail->Body = "Hello $sellername, <br><br> We want to inform you that, your note $notename has been removed from the portal. <br> Please find our remarks as below- <br> $remarkcontent <br><br> Regards,<br>Notes Marketplace";

            $mail->send();
        } else {
            die("QUERY FAILED" . mysqli_error($conn));
        }
    }

    ?>

    <!-- Navigation Bar END -->

    <!-- Dashboard Starts  -->
    <section id="admin-dashboard">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Deshboard</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $getdata = "SELECT * FROM sellernotes WHERE Status = 8 AND IsActive = b'1'";
                                                        $getdataquery = mysqli_query($conn, $getdata);
                                                        $count = mysqli_num_rows($getdataquery); ?>
                                <a class="note-detail-anchor" href="notes-under-review.php"><?php echo $count; ?></a>
                            </h3>
                            <p>Numbers of Notes in Review for publish</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $mydownload = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND IsActive = b'1' AND Seller != Downloader AND CreatedDate >= now() - INTERVAL 1 week GROUP BY NoteID,Downloader,CreatedDate";
                                                        $getdwddata = mysqli_query($conn, $mydownload);
                                                        $dwdcount = mysqli_num_rows($getdwddata);
                                                        ?>
                                <a class="note-detail-anchor" href="downloaded-notes.php"><?php echo $dwdcount; ?></a>
                            </h3>
                            <p>Numbers of New Notes Downloaded<br>(Lsat 7 Days)</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 dashboard-box-outer">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $userdata = "SELECT * FROM users WHERE RoleID = 3 AND IsActive = b'1' AND CreatedDate >= now() - INTERVAL 1 week";
                                                        $userdataquery = mysqli_query($conn, $userdata);
                                                        $mcount = mysqli_num_rows($userdataquery);
                                                        ?>
                                <a class="note-detail-anchor" href="mambers.php"><?php echo $mcount; ?></a>
                            </h3>
                            <p>Numbers of New Registrations (Last 7 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ends -->

    <!-- Published Notes Starts -->
    <section id="dashboard-published-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <div class="horizontal-heading-sm">
                            <h3>Published Notes</h3>
                        </div>
                    </div>

                    <div class="col-md-8 col-12">
                        <div class="row text-right">
                            <div class="col-md-5 col-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" name="searchnotes" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-3 col-4 table-header-search-btn">
                                <div id="search-btn">
                                    <a class="btn table-search-btn" name="btn-search" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 table-select-menu">
                                <form>
                                    <div class="form-group">
                                        <select class="form-control" id="month">
                                            <?php
                                            $currentMonthName = date('F');
                                            // $currentMonthValue = date('n');
                                            for ($i = 0; $i < 6; $i++) {
                                                $MonthName = date("F", strtotime(date('Y-m-01') . " -$i months"));
                                                $MonthValue = date("-m-Y", strtotime(date('Y-m-01') . " -$i months"));
                                                if ($MonthName == $currentMonthName) {
                                                    echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                                } else {
                                                    echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="dashboard-published-notes-table table-responsive">

                            <table class="table table-hover" id="published-notes">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">ATTACHMENT SIZE</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header seller">PUBLISHER</th>
                                        <th scope="col" class="table-header date">PUBLISHED DATE</th>
                                        <th scope="col" class="table-header">NUMBER OF DOWNLOADS</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sizes = array("Bytes", "KB", "MB", "GB");
                                    $size = 0;
                                    $getpnotes = "SELECT * FROM sellernotes WHERE Status = 9";
                                    $pnotequery = mysqli_query($conn, $getpnotes);
                                    $pcount = mysqli_num_rows($pnotequery);
                                    for ($i = 1; $i <= $pcount; $i++) {
                                        $pnotedata = mysqli_fetch_assoc($pnotequery);
                                    ?>
                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="note-detail-anchor" href="admin-note-detail.php?id=<?php echo $pnotedata['ID']; ?>"><?php echo $pnotedata['Title']; ?></a></td>
                                            <td><?php
                                                $catid = $pnotedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $pnoteid = $pnotedata['ID'];
                                                $noteatta = "SELECT * FROM sellernotesattachements WHERE NoteID = $pnoteid";
                                                $noteattaquery = mysqli_query($conn, $noteatta);
                                                while ($noteatta_row = mysqli_fetch_assoc($noteattaquery)) {
                                                    $filepath = $noteatta_row['FilePath'];
                                                    $size = $size + filesize($filepath);
                                                }
                                                $attachment_size = round($size / pow(1024, ($h = floor(log($size, 1024)))), 2) . $sizes[$h];
                                                echo $attachment_size;
                                                ?></td>
                                            <td><?php
                                                if ($pnotedata['IsPaid'] == 0) {
                                                    echo 'Free';
                                                } else {
                                                    echo 'Paid';
                                                } ?></td>
                                            <td><?php echo '$' . $pnotedata['SellingPrice']; ?></td>
                                            <td><?php
                                                $publisherid = $pnotedata['ActionedBy'];
                                                $getpublisher = "SELECT * FROM users WHERE ID= '$publisherid' AND IsActive = b'1'";
                                                $getpquery = mysqli_query($conn, $getpublisher);
                                                $getpublisherdata = mysqli_fetch_assoc($getpquery);
                                                echo $getpublisherdata['FirstName'] . " " . $getpublisherdata['LastName'];
                                                ?></td>
                                            <td><?php $publisheddate =  $pnotedata['PublishedDate'];
                                                $date = strtotime($publisheddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td style="color: #6255a5;"><?php
                                                                        $pnoteid = $pnotedata['ID'];
                                                                        $dwldnumber = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND IsActive = b'1' AND Seller != Downloader AND NoteID = '$pnoteid' GROUP BY NoteID,Seller,CreatedDate";
                                                                        $dwldnumberquery = mysqli_query($conn, $dwldnumber);
                                                                        $dwldcount = mysqli_num_rows($dwldnumberquery);
                                                                        ?>
                                                <a class="note-detail-anchor" href="downloaded-notes.php?id=<?php echo $pnotedata['ID']; ?>"><?php echo $dwldcount; ?> </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a href="admin-downloadnotes.php?id=<?php echo $pnotedata['ID']; ?>"><button class="dropdown-item" type="button">Download Notes</button></a>
                                                        <a href="admin-note-detail.php?id=<?php echo $pnotedata['ID']; ?>"> <button class="dropdown-item" type="button">View More Details</button></a>
                                                        <button class="dropdown-item" type="button" role="button" data-toggle="modal" data-target="#unpublish<?php echo $i; ?>">Unpublish</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="unpublish<?php echo $i; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h3>Unpublish a note</h3>
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
                                                                            <input type="text" class="form-control" id="remark-title" name="remark-title" value=" <?php echo $pnotedata['Title']; ?>" readonly />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="remark-content">Remarks*</label>
                                                                            <textarea class="form-control" id="remark-content" name="remark-content" placeholder="Remarks..." required></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <input type="hidden" name="noteid" value="<?php echo $pnotedata['ID']; ?>" />

                                                                    <button type="button" class="btn btn-secondary" style="margin: 0px 10px;" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="unpublishnote" class="btn btn-danger btn-unpublish">Unpublish</button>

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
    <!-- Dashboard Ends -->

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
            var table = $('#published-notes').DataTable({
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
            $(document).on('change', '#month', function() {
                shownotes($(this).val());
            });

            function shownotes(month) {
                let monthVal = month;
                table.column(7).search(monthVal).draw();
            }

            var currentMonth = $('#month').val();
            shownotes(currentMonth);

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-unpublish').click(function() {
                if (confirm('Are you sure you want to unpublish this note?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>

</body>

</html>