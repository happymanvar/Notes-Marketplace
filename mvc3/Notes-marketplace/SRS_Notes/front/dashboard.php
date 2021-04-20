<?php
session_start();
$page = 'dashboard';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>DashBoard</title>
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
    ?>
    <?php
    if (isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        $delete_row = "DELETE FROM sellernotes WHERE ID='delete'";
        $delete_row_query = mysqli_query($conn, $delete_row);
        if (!($delete_row_query)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        header("location:dashboard.php");
    }
    ?>


    <?php
    if (isset($_SESSION['is_loggedin'])) {
        include 'login-header.php';
    } else {
        header('location:../login.php');
    }
    ?>

    <!-- Dashboard section -->
    <section id="dashboard">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                        <div class="title">
                            <h3 class="text-left">Dashboard</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                        <div class="add-note-btn text-right">
                            <a class="btn btn-add-note" href="add-notes.php" title="Add Note" role="button">Add Note</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 earning-box">
                        <div class="my-earning-box text-center" id="my-earning">
                            <img src="images/Dashboard/my-earning.png">
                            <h5>My Earning</h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 box-lg">
                        <div class="dashboard-box dashboard-box-lg">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
                                    <?php
                                    $soldnote = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND Seller = $userID AND Downloader != $userID GROUP BY NoteID,Downloader";
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

                                    ?>
                                    <h3 class="heading-numeric"><?php echo $soldnotecount; ?></h3>
                                    <p>Number of Notes Sold</p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
                                    <h3 class="heading-numeric"><?php echo "$" . $totalearn; ?></h3>
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $mydownload = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND AtachmentPath IS NOT NULL AND Seller != $userID AND Downloader = $userID GROUP BY NoteID,Downloader";
                                                        $getdwddata = mysqli_query($conn, $mydownload);
                                                        $dwdcount = mysqli_num_rows($getdwddata);
                                                        echo $dwdcount;

                                                        ?></h3>
                            <p>My Downloads</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $rejected_note_query = "SELECT * FROM sellernotes WHERE Status = '10' AND SellerID = '$userID'";
                                                        $geterjectednotes = mysqli_query($conn, $rejected_note_query);
                                                        $rejectedcount = mysqli_num_rows($geterjectednotes);
                                                        echo $rejectedcount;

                                                        ?></h3>
                            <p>My Rejected Notes</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric"><?php
                                                        $buyer_request_query = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 0 AND IsPaid = 1 AND Downloader != $userID AND Seller = $userID GROUP BY NoteID,Downloader";
                                                        $buyer_request = mysqli_query($conn, $buyer_request_query);
                                                        $buyercount = mysqli_num_rows($buyer_request);
                                                        echo $buyercount;
                                                        ?></h3>
                            <p>Buyer Request</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DashBoard Ends -->
    <!-- In Progress Notes Table Section -->
    <section id="in-progress-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading-sm">
                            <h3>In Progress Notes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                        <div class="row text-right">
                            <div class="col-md-8 col-lg-8 col-sm-8 col-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" name="valueToSearch" class="form-control" id="search1" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-4 col-sm-4 table-search-btn">
                                <div id="search-btn">
                                    <a class="btn search-btn1" title="search" name="btn-search" role="button">SEARCH</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 co-12">
                        <div class="in-progress-table table-responsive">
                            <table class="table table-hover" id="in-progress-notes-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header dashboard-date">ADDED DATE</th>
                                        <th scope="col" class="table-header">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">STATUS</th>
                                        <th scope="col" class="table-header">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $fetch_progress_query = "SELECT sellernotes.Status AS s_id,sellernotes.CreatedDate AS added_date,sellernotes.Title AS title,sellernotes.ID as noteid, notecategories.Name AS category,referencedata.Value AS status FROM sellernotes,referencedata,notecategories WHERE sellernotes.Status = referencedata.ID AND sellernotes.Category = notecategories.ID AND sellernotes.Status IN ( 6, 7, 8) AND SellerID = $userID";
                                    $progress_notes = mysqli_query($conn, $fetch_progress_query);
                                    while ($progress_row = mysqli_fetch_array($progress_notes)) {
                                    ?>
                                        <tr>
                                            <td><?php $adddate = $progress_row["added_date"];
                                                $date = strtotime($adddate);
                                                echo date('j-m-Y', $date); ?></td>
                                            <td><?php echo $progress_row["title"]; ?></td>
                                            <td><?php echo $progress_row["category"]; ?></td>
                                            <td><?php echo $progress_row["status"]; ?></td>
                                            <?php
                                            $id = $progress_row["noteid"];
                                            if ($progress_row["s_id"] == 6) {
                                                echo "<td><a href='edit-notes.php?edit=$id'><img src='images/Dashboard/edit.png' alt='edit'><a href='?delete=$id' id='dlt-link' onclick='return chk()'><img src='images/Dashboard/delete.png' alt='delete'></td>";
                                            } else {
                                                echo "<td><a href='notes-details.php?id=$id'><img src='images/Dashboard/eye.png' alt='view'></td>";
                                            } ?>
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
    <!-- In Progress Notes Table Section Ends -->
    <!-- Published Notes Table Section -->
    <section id="published-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading-sm">
                            <h3>Published Notes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" name="search-inprogress-note" class="form-control" id="search2" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-4 col-sm-4 table-search-btn">
                                <div id="search-btn">
                                    <a class="btn search-btn2" name="search" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="published-notes-table table-responsive">
                            <table class="table table-hover" id="published-note-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header dashboard-date">ADDED DATE</th>
                                        <th scope="col" class="table-header">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $fetch_progress_query1 = "SELECT sellernotes.ID AS id,sellernotes.Status AS s_id,sellernotes.CreatedDate AS added_date,sellernotes.Title AS title,sellernotes.IsPaid AS ispaid,sellernotes.SellingPrice AS price,notecategories.Name AS category,referencedata.Value AS status FROM sellernotes,referencedata,notecategories WHERE sellernotes.Status = referencedata.ID AND sellernotes.Category = notecategories.ID AND sellernotes.Status= 9 AND SellerID = $userID";
                                    $progress_notes1 = mysqli_query($conn, $fetch_progress_query1);
                                    while ($progress_row1 = mysqli_fetch_array($progress_notes1)) {
                                    ?>
                                        <tr>
                                            <td><?php $adddate = $progress_row1["added_date"];
                                                $date = strtotime($adddate);
                                                echo date('j-m-Y', $date); ?></td>
                                            <td><?php echo $progress_row1["title"]; ?></td>
                                            <td><?php echo $progress_row1["category"]; ?></td>
                                            <td><?php if ($progress_row1["ispaid"] == 0) {
                                                    echo 'Free';
                                                } else {
                                                    echo "Paid";
                                                } ?></td>
                                            <td><?php echo "$" . $progress_row1["price"]; ?></td>
                                            <td><?php
                                                if ($progress_row1["s_id"] == 9) {
                                                    $nid = $progress_row1["id"];
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='notes-details.php?id=$nid'><img src='images/dashboard/eye.png' alt='view'></a>";
                                                } ?></td>
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
    <!-- Published Notes Table Section Ends -->
    <?php
    include 'footer.php';
    ?>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- DataTable JS -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        function chk() {
            if (confirm("yes or no")) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#in-progress-notes-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/Search/right-arrow.png">',
                        previous: '<img src="images/Search/left-arrow.png">'
                    }
                },
                columnDefs: [{
                    targets: [4],
                    orderable: false,
                }]
            });

            $('.search-btn1').click(function() {
                var x = $('#search1').val();
                table.search(x).draw();

            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#published-note-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/Search/right-arrow.png">',
                        previous: '<img src="images/Search/left-arrow.png">'
                    }
                },
                columnDefs: [{
                    targets: [5],
                    orderable: false,
                }]
            });

            $('.search-btn2').click(function() {
                var x = $('#search2').val();
                table.search(x).draw();

            });

        });
    </script>



</body>

</html>
