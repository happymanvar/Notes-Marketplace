<?php
session_start();
$page = 'buyer-request';

if (!isset($_SESSION['is_loggedin'])) {
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
    <title>Buyer Request</title>

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

    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">


</head>

<body>
    <?php
    include 'db_conntect.php';
    $userID = $_SESSION['user_id'];
    $email = $_SESSION['email'];


    ?>

    <?php
    include 'login-header.php';
    ?>

    <!-- Buyer request Table -->
    <section id="buyer-request">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading">
                            <h3>Buyer Requests</h3>
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
                                    <a class="btn search-btn" title="search-btn" name="btn-search" role="button">SEARCH</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="buyer-request-table table-responsive">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header title">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">BUYER</th>
                                        <th scope="col" class="table-header date">PHONE NO.</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header date">DOWNLOADED DATE/TIME</th>
                                        <th scope="col" class="table-header blank"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $buyer_request_query = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 0 AND IsPaid = 1 AND Downloader != $userID AND Seller = $userID GROUP BY NoteID,Downloader ORDER BY AttachmentDownloadedDate DESC";
                                    $buyer_request = mysqli_query($conn, $buyer_request_query);
                                    $count = mysqli_num_rows($buyer_request);


                                    for ($i = 1; $i <= $count; $i++) {
                                        $buyer_row = mysqli_fetch_assoc($buyer_request);
                                        $noteid = $buyer_row['NoteID'];

                                        $getnote = "SELECT * FROM sellernotes WHERE ID = '$noteid'";
                                        $notedetail = mysqli_query($conn, $getnote);
                                        $notedata = mysqli_fetch_assoc($notedetail);

                                    ?>
                                        <tr style="height: 50px;">
                                            <td><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="buyerrequest" name="buyrrequest" href="notes-details.php?id=<?php echo $noteid; ?>" role="button"><?php echo $notedata["Title"]; ?></a></td>
                                            <td><?php
                                                $catid = $notedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $buyerid = $buyer_row['Downloader'];
                                                $getbuyerquery = "SELECT * FROM users WHERE ID = '$buyerid' AND IsActive = b'1'";
                                                $buyerquery = mysqli_query($conn, $getbuyerquery);
                                                $buyerdata = mysqli_fetch_assoc($buyerquery);
                                                echo $buyerdata['EmailID']; ?></td>
                                            <td><?php
                                                $getbuyerid = $buyer_row['Downloader'];
                                                $getbuyerquery2 = "SELECT * FROM user_profile WHERE UserID = '$getbuyerid'";
                                                $buyerdata = mysqli_query($conn, $getbuyerquery2);
                                                $buyerdetail = mysqli_fetch_assoc($buyerdata);
                                                echo $buyerdetail['Phone number - Country Code'] . " " . $buyerdetail['Phone number']; ?></td>
                                            <td><?php if ($notedata["IsPaid"] == 0) {
                                                    echo 'Free';
                                                } else {
                                                    echo "Paid";
                                                } ?></td>
                                            <td><?php echo "$" . $notedata["SellingPrice"]; ?></td>
                                            <td><?php
                                                $dwddate = $buyer_row['AttachmentDownloadedDate'];
                                                $date = strtotime($dwddate);
                                                echo date('d M Y, H:i:s', $date); ?></td>
                                            <td class="text-center" style="min-width: 100px;"><?php

                                                                                                echo "&nbsp;<a href='notes-details.php?id=$noteid'><img src='images/dashboard/eye.png' alt='view'></a>&nbsp;<div class='btn-group dropleft'>
                                                <button type='button' id='dropdownMenu2' class='btn' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <img src='images/my-downloades/dots.png' alt='menu' class=''>
                                                </button>
                                                <div class='dropdown-menu alow-download' aria-labelledby='dropdownMenu2'>
                                                    <button class='dropdown-item' name='alow-download' type='button'><a href='mail-to-buyer.php?id=$noteid'>Allow Download</a></button>
                                                </div>
                                            </div>";
                                                                                                ?></td>
                                        </tr>
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

    <?php
    include 'footer.php';
    ?>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- popper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('table').DataTable({
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

</body>

</html>