<?php
session_start();

$page = 'spam-reports';

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
    <title>Spam Report</title>

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
    <?php
    if (isset($_GET['rid'])) {
        $rid = $_GET['rid'];
        //echo $rid;


        $delete = "DELETE FROM `sellernotesreportedissues` WHERE ID = '$rid'";
        $deletequery = mysqli_query($conn, $delete);

        if (!($deletequery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            header('location: spam-report.php');
        }
    }

    ?>
    <!-- Navigation Bar END -->

    <!-- Spam Report Starts -->
    <section id="spam-report">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <div class="horizontal-heading">
                            <h3>Spam Reports</h3>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="row text-right">
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-8 table-search-bar">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="search" placeholder="Search">
                                        </div>
                                    </div>
                                    <div class="col-md-4 table-header-search-btn">
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
                        <div class="spam-report-table table-responsive">

                            <table class="table table-hover" id="spam-report-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">REPORTED BY</th>
                                        <th scope="col" class="table-header seller">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header date">DATE EDITED</th>
                                        <th scope="col" class="table-header remark">REMARK</th>
                                        <th scope="col" class="table-header">ACTION</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $spam = "SELECT * FROM sellernotesreportedissues WHERE IsActive = b'1' ORDER BY CreatedDate DESC";
                                    $spamquery = mysqli_query($conn, $spam);

                                    if (!($spamquery)) {
                                        die("QUERY FAILED" . mysqli_error($conn));
                                    } else {
                                        $spamcount = mysqli_num_rows($spamquery);
                                        for ($i = 1; $i <= $spamcount; $i++) {
                                            $spamdata = mysqli_fetch_assoc($spamquery);
                                    ?>
                                            <tr style="height: 50px;" class="text-center">
                                                <td><?php echo $i; ?></td>
                                                <td><?php
                                                    $rejecterid = $spamdata['ReportedByID'];
                                                    $getrejecter = "SELECT * FROM users WHERE ID= '$rejecterid' AND IsActive = b'1'";
                                                    $getrquery = mysqli_query($conn, $getrejecter);
                                                    $rejecterdata = mysqli_fetch_assoc($getrquery);
                                                    echo $rejecterdata['FirstName'] . " " . $rejecterdata['LastName'];
                                                    ?></td>
                                                <td style="color: #6255a5;"><?php
                                                                            $noteid = $spamdata['NoteID'];

                                                                            $notedata = "SELECT * FROM sellernotes WHERE ID = '$noteid' AND IsActive = b'1'";
                                                                            $notedataquery = mysqli_query($conn, $notedata);
                                                                            $ndata = mysqli_fetch_assoc($notedataquery);

                                                                            $catid = $ndata['Category'];

                                                                            $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                                            $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                                            $category = mysqli_fetch_assoc($categoryquery);
                                                                            ?><a class="note-detail-anchor" href="admin-note-detail.php?id=<?php echo $spamdata['NoteID']; ?>"> <?php
                                                                                                                                                                                echo $ndata['Title']; ?></a> </td>
                                                <td><?php echo $category['Name']; ?></td>

                                                <td><?php $addeddate =  $spamdata['CreatedDate'];
                                                    $date = strtotime($addeddate);
                                                    echo date('d-m-Y, H:i', $date); ?></td>
                                                <td><?php echo $spamdata['Remarks']; ?></td>
                                                <td class="text-center">
                                                    <a class="delete-report" name="deletereport" href="spam-report.php?rid=<?php echo $spamdata['ID']; ?>"><img src="admin-images/images/delete.png" alt="delete"></a>
                                                </td>
                                                <td>
                                                    <div class="btn-group dropleft">
                                                        <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <img src="admin-images/images/dots.png" alt="menu" class="">
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            <a href="admin-downloadnotes.php?id=<?php echo $spamdata['NoteID']; ?>"><button class="dropdown-item" type="button">Download Note</button></a>
                                                            <a href="admin-note-detail.php?id=<?php echo $spamdata['NoteID']; ?>"><button class="dropdown-item" type="button">View More Details</button></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
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
    <!-- Spam Report Ends -->

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
            var table = $('#spam-report-table').DataTable({
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
            $('.delete-report').click(function() {
                if (confirm('Are you sure you want to delete reported issue.')) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>


</body>

</html>