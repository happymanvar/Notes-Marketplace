<?php
session_start();

$page = 'notes';

if (!isset($_SESSION['is_loggedin']) && !((isset($_SESSION['is_admin'])) || (isset($_SESSION['is_superadmin'])))) {
    header('location:../login.php');
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
    <title>Downloaded Notes</title>

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

    <!-- Downloaded Notes -->
    <section id="downloaded-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Downloaded Notes</h3>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-12 text-left">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-sm-4 col-12 col-lg-4 col-md-4">
                                    <label for="note">Note</label>
                                    <?php
                                    $dwldnote = "SELECT DISTINCT(NoteID) AS 'nid' FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND IsActive = b'1' AND Seller != Downloader";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $dwldnote .= " AND NoteID = '$selectedid' GROUP BY NoteID,Downloader,CreatedDate";
                                    } else {
                                        $dwldnote .= " GROUP BY NoteID,Downloader,CreatedDate";
                                    }
                                    $getdwdname = mysqli_query($conn, $dwldnote);
                                    $dwdncount = mysqli_num_rows($getdwdname);

                                    ?>
                                    <select id="note" name="note" class="form-control">
                                        <option selected value="">Select note</option>
                                        <?php
                                        for ($j = 1; $j <= $dwdncount; $j++) {
                                            $notenamedata = mysqli_fetch_assoc($getdwdname);

                                            $nid = $notenamedata['nid'];

                                            $notedetail = "SELECT * FROM sellernotes WHERE ID = $nid AND IsActive = b'1'";
                                            $notedetailquery = mysqli_query($conn, $notedetail);
                                            $ndetail = mysqli_fetch_assoc($notedetailquery);
                                        ?>
                                            <option value="<?php echo $ndetail['Title'] ?>"><?php echo $ndetail['Title'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-4 col-md-4 col-lg-4">
                                    <label for="seller">Seller</label>
                                    <?php
                                    $getseller  = "SELECT DISTINCT(SellerID) AS 'sid' From sellernotes";
                                    $getsellerquery = mysqli_query($conn, $getseller);
                                    $sellercount = mysqli_num_rows($getsellerquery);
                                    ?>
                                    <select id="seller" name="seller" class="form-control">
                                        <option selected value="">Select seller</option>
                                        <?php
                                        for ($j = 1; $j <= $sellercount; $j++) {
                                            $sellerID = mysqli_fetch_assoc($getsellerquery);

                                            $sid = $sellerID['sid'];

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
                                <div class="form-group col-12 col-sm-4 col-lg-4 col-md-4">
                                    <label for="buyer">Buyer</label>
                                    <?php
                                    $getbuyer  = "SELECT DISTINCT(Downloader) AS 'bid' From downloads";
                                    if (isset($_GET['mid'])) {
                                        $selectedmid = $_GET['mid'];
                                        $getbuyer .= " WHERE Downloader = '$selectedmid'";
                                    }
                                    $getbuyerquery = mysqli_query($conn, $getbuyer);
                                    $buyercount = mysqli_num_rows($getbuyerquery);
                                    ?>
                                    <select id="buyer" name="buyer" class="form-control">
                                        <option selected value="">Select buyer</option>
                                        <?php
                                        for ($j = 1; $j <= $buyercount; $j++) {
                                            $buyerID = mysqli_fetch_assoc($getbuyerquery);

                                            $bid = $buyerID['bid'];

                                            $buyerdetail = "SELECT * FROM users WHERE ID = $bid AND IsActive = b'1'";
                                            $buyerdetailquery = mysqli_query($conn, $buyerdetail);
                                            $bdetail = mysqli_fetch_assoc($buyerdetailquery);
                                        ?>
                                            <option value="<?php echo $bdetail['FirstName'] . " " . $bdetail['LastName'] ?>"><?php echo $bdetail['FirstName'] . " " . $bdetail['LastName'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-12 col-12">
                        <div class="row text-right">
                            <div class="col-md-5 col-lg-5">
                            </div>
                            <div class="col-md-7 col-lg-7 col-sm-12 col-12">
                                <div class="row search-kit">
                                    <div class="col-md-8 col-lg-8 col-sm-8 col-8 table-search-bar">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="search" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4 col-sm-4 table-header-search-btn">
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
                    <div class="col-md-12 col-12">
                        <div class="downloaded-notes-table table-responsive">

                            <table class="table table-hover" id="downloaded-notes-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header seller">BUYER</th>
                                        <th scope="col" class="table-header seller">SELLER</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header date">DOWNLOADED DATE/TIME</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mydownload = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND IsActive = b'1' AND Seller != Downloader";
                                    if (isset($_GET['id'])) {
                                        $selectedid = $_GET['id'];
                                        $mydownload .= " AND NoteID = '$selectedid' GROUP BY NoteID,Downloader,CreatedDate ORDER BY AttachmentDownloadedDate DESC";
                                    } else if (isset($_GET['mid'])) {
                                        $selectedmid = $_GET['mid'];
                                        $mydownload .= " AND Downloader = '$selectedmid' GROUP BY NoteID,Downloader,CreatedDate ORDER BY AttachmentDownloadedDate DESC";
                                    } else {
                                        $mydownload .= " GROUP BY NoteID,Downloader,CreatedDate ORDER BY AttachmentDownloadedDate DESC";
                                    }
                                    $getdwddata = mysqli_query($conn, $mydownload);
                                    $dwdcount = mysqli_num_rows($getdwddata);

                                    for ($i = 1; $i <= $dwdcount; $i++) {
                                        $ndata = mysqli_fetch_assoc($getdwddata);
                                        $noteid = $ndata['NoteID'];
                                        $notedata = "SELECT * FROM sellernotes WHERE ID = '$noteid' AND IsActive = b'1'";
                                        $notedataquery = mysqli_query($conn, $notedata);
                                        $getnotedata = mysqli_fetch_assoc($notedataquery);

                                    ?>
                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="note-detail-anchor" href="admin-note-detail.php?id=<?php echo $noteid; ?>"><?php echo $getnotedata['Title']; ?></a></td>
                                            <td><?php
                                                $catid = $getnotedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $buyerid = $ndata['Downloader'];
                                                $buyerdata = "SELECT * FROM users WHERE ID = $buyerid AND IsActive = b'1'";
                                                $buyerdataquery = mysqli_query($conn, $buyerdata);
                                                $getbuyerdata = mysqli_fetch_assoc($buyerdataquery);
                                                echo $getbuyerdata['FirstName'] . " " . $getbuyerdata['LastName'];
                                                ?> <a href="member-details.php?id=<?php echo $buyerid; ?>"><img src="admin-images/images/eye.png" alt="edit"></a></td>
                                            <td><?php
                                                $sellerid = $ndata['Seller'];
                                                $sellerdata = "SELECT * FROM users WHERE ID = $sellerid AND IsActive = b'1'";
                                                $sellerdataquery = mysqli_query($conn, $sellerdata);
                                                $getsellerdata = mysqli_fetch_assoc($sellerdataquery);
                                                echo $getsellerdata['FirstName'] . " " . $getsellerdata['LastName'];
                                                ?> <a href="member-details.php?id=<?php echo $sellerid; ?>"><img src="admin-images/images/eye.png" alt="edit"></a></td>
                                            <td><?php
                                                if ($getnotedata['IsPaid'] == 0) {
                                                    echo 'Free';
                                                } else {
                                                    echo 'Paid';
                                                } ?></td>
                                            <td><?php echo '$' . $getnotedata['SellingPrice']; ?></td>
                                            <td><?php $addeddate =  $ndata['AttachmentDownloadedDate'];
                                                $date = strtotime($addeddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td class="text-center">
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a href="admin-downloadnotes.php?id=<?php echo $noteid; ?>"><button class="dropdown-item" type="button">Download Note</button></a>
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
    <!-- Downloaded Ends Ends -->

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
            var table = $('#downloaded-notes-table').DataTable({
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
                var x = $('#seller').val();
                table.columns(4).search(x).draw();
            });

            $('select').change(function() {
                var y = $('#buyer').val();
                table.columns(3).search(y).draw();
            });

            $('select').change(function() {
                var z = $('#note').val();
                table.columns(1).search(z).draw();
            });
        });
    </script>

</body>

</html>