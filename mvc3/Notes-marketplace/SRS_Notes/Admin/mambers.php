<?php
session_start();

$page = 'members';


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
    <title>Members</title>

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

    ?>
    <!-- Navigation Bar END -->

    <?php
    if (isset($_GET['id'])) {
        $editmemberid = $_GET['id'];

        $updatemember = "UPDATE users SET `IsActive` = b'0', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$editmemberid'";
        $updatequery = mysqli_query($conn, $updatemember);
        if (!($updatequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location:mambers.php');
        }
    }
    ?>

    <!-- Members Starts -->
    <section id="members">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12 text-left">
                        <div class="horizontal-heading">
                            <h3>Members</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row text-right">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 col-12">
                                <div class="row">
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
                        <div class="members-table table-responsive">

                            <table class="table table-hover" id="members-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header">FIRST NAME</th>
                                        <th scope="col" class="table-header">LAST NAME</th>
                                        <th scope="col" class="table-header">EMAIL</th>
                                        <th scope="col" class="table-header joining-date">JOINING DATE</th>
                                        <th scope="col" class="table-header">UNDER REVIEW NOTES</th>
                                        <th scope="col" class="table-header">PUBLISHED NOTES</th>
                                        <th scope="col" class="table-header">DOWNLOADED NOTES</th>
                                        <th scope="col" class="table-header">TOTAL EXPENSES</th>
                                        <th scope="col" class="table-header">TOTAL EARNINGS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $userdata = "SELECT * FROM users WHERE RoleID = 3 AND IsActive = b'1' ORDER BY CreatedDate DESC";
                                    $userdataquery = mysqli_query($conn, $userdata);
                                    $count = mysqli_num_rows($userdataquery);
                                    for ($i = 1; $i <= $count; $i++) {
                                        $udata = mysqli_fetch_assoc($userdataquery);

                                    ?>

                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $udata['FirstName']; ?></td>
                                            <td><?php echo $udata['LastName']; ?></td>
                                            <td><?php echo $udata['EmailID']; ?></td>
                                            <td><?php $addeddate =  $udata['CreatedDate'];
                                                $date = strtotime($addeddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td style="color: #6255a5;"><?php
                                                                        $uid = $udata['ID'];
                                                                        $urnotes = "SELECT * FROM sellernotes WHERE SellerID = '$uid' AND Status IN(7,8) AND IsActive = b'1'";
                                                                        $urnotesquery = mysqli_query($conn, $urnotes);
                                                                        $urnotescount = mysqli_num_rows($urnotesquery);
                                                                        ?>
                                                <a class="note-detail-anchor" href="notes-under-review.php?id=<?php echo $udata['ID']; ?>"><?php echo $urnotescount;
                                                                                                                                            ?></a>
                                            </td>
                                            <td style="color: #6255a5;"><?php

                                                                        $pnotes = "SELECT * FROM sellernotes WHERE SellerID = '$uid' AND Status = 9 AND IsActive = b'1'";
                                                                        $pnotesquery = mysqli_query($conn, $pnotes);
                                                                        $pnotescount = mysqli_num_rows($pnotesquery);
                                                                        ?>
                                                <a class="note-detail-anchor" href="published-notes.php?id=<?php echo $udata['ID']; ?>"><?php
                                                                                                                                        echo $pnotescount;
                                                                                                                                        ?>
                                            </td>
                                            <td style="color: #6255a5;"><?php
                                                                        $mydownload = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND Seller != $uid AND Downloader = $uid GROUP BY NoteID,Downloader";
                                                                        $getdwddata = mysqli_query($conn, $mydownload);
                                                                        $dwdcount = mysqli_num_rows($getdwddata);
                                                                        ?>
                                                <a class="note-detail-anchor" href="downloaded-notes.php?mid=<?php echo $udata['ID']; ?>"><?php
                                                                                                                                            echo $dwdcount;
                                                                                                                                            $totalexpenses = 0;
                                                                                                                                            if ($dwdcount != 0) {
                                                                                                                                                while ($dwdnotedata1 = mysqli_fetch_assoc($getdwddata)) {
                                                                                                                                                    $eprice = $dwdnotedata1['PurchasedPrice'];
                                                                                                                                                    if ($eprice == NULL) {
                                                                                                                                                        $eprice = 0;
                                                                                                                                                    }
                                                                                                                                                    $totalexpenses = $totalexpenses + (int)$eprice;
                                                                                                                                                }
                                                                                                                                            }


                                                                                                                                            ?>
                                            </td>
                                            <td style="color: #6255a5;"><a class="note-detail-anchor" href="downloaded-notes.php?mid=<?php echo $udata['ID']; ?>"><?php echo '$' . $totalexpenses; ?></a></td>
                                            <td><?php

                                                $soldnote = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND Seller = $uid AND Downloader != $uid GROUP BY NoteID,Downloader";
                                                $soldnotequery = mysqli_query($conn, $soldnote);
                                                $soldnotecount = mysqli_num_rows($soldnotequery);
                                                $totalearn = 0;
                                                if ($soldnotecount != 0) {
                                                    while ($soldnotedata1 = mysqli_fetch_assoc($soldnotequery)) {
                                                        $pprice = $soldnotedata1['PurchasedPrice'];
                                                        if ($pprice == NULL) {
                                                            $pprice = 0;
                                                        }
                                                        $totalearn = $totalearn + (int)$pprice;
                                                    }
                                                }
                                                echo '$' . $totalearn;
                                                ?></td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a href="member-details.php?id=<?php echo $udata['ID']; ?>"><button class="dropdown-item" type="button">View More Details</button></a>
                                                        <a class="deactivate-member" href="mambers.php?id=<?php echo $udata['ID']; ?>"><button class="dropdown-item" type="button">Deactivate</button></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
    <!-- Members Ends -->

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
            var table = $('#members-table').DataTable({
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

        });
    </script>

    <script>
        $(document).ready(function() {
            $('.deactivate-member').click(function() {
                if (confirm('Are you sure you want to make this member inactive?')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


</body>

</html>