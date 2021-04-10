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
    <title>My Sold Notes</title>

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

    include 'login-header.php';
    include 'db_conntect.php';

    ?>

    <!-- My Sold Notes Table -->
    <section id="my-sold-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading">
                            <h3>My Sold Notes</h3>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8  table-search-bar">
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
                        <div class="sold-note-table table-responsive">

                            <table class="table table-hover" id="mysoldnotes-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header title">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">BUYER</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header date">DOWNLOADED DATE/TIME</th>
                                        <th scope="col" class="table-header action"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mysoldnotes = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND IsActive = b'1' AND Seller = $user_id AND Downloader != $user_id GROUP BY NoteID,Downloader ORDER BY AttachmentDownloadedDate DESC";
                                    $getdata = mysqli_query($conn, $mysoldnotes);
                                    $count = mysqli_num_rows($getdata);

                                    for ($i = 1; $i <= $count; $i++) {
                                        $soldnotes_row = mysqli_fetch_assoc($getdata);
                                        $noteid = $soldnotes_row['NoteID'];

                                        $getnote = "SELECT * FROM sellernotes WHERE ID = '$noteid'";
                                        $notedetail = mysqli_query($conn, $getnote);
                                        $notedata = mysqli_fetch_assoc($notedetail);



                                    ?>

                                        <tr style="height: 50px;">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="mysoldnote" name="mysoldnote" href="notes-details.php?id=<?php echo $noteid; ?>" role="button"><?php echo $notedata['Title']; ?></a></td>
                                            <td><?php
                                                $catid = $notedata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $buyerid = $soldnotes_row['Downloader'];
                                                $buyerdata = "SELECT * FROM users WHERE ID = $buyerid";
                                                $buyer = mysqli_query($conn, $buyerdata);
                                                $buyerdetail = mysqli_fetch_assoc($buyer);

                                                echo $buyerdetail['EmailID']; ?></td>
                                            <td><?php
                                                if ($notedata['IsPaid'] == 0) {
                                                    echo "Free";
                                                } else {
                                                    echo "Paid";
                                                }
                                                ?></td>
                                            <td><?php echo "$" . $notedata['SellingPrice']; ?></td>
                                            <td><?php
                                                $dwddate = $soldnotes_row['AttachmentDownloadedDate'];
                                                $date = strtotime($dwddate);
                                                echo date('d M Y, H:i:s', $date); ?></td>
                                            <td class="text-center"><a href="notes-details.php?id=<?php echo $noteid; ?>"><img src="images/Dashboard/eye.png" alt="eye"></a>
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="images/my-downloades/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <button class="dropdown-item" type="button"><a target="_blank" href="downloadnotes.php?id=<?php echo $noteid; ?>">Download Note</a></button>
                                                    </div>
                                                </div>
                                            </td>

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
    <!-- My Sold Notes Ends -->

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
                        <li><a href="#"><img src="images/User-Profile/facebook.png" alt="facbook"></a></li>
                        <li><a href="#"><img src="images/User-Profile/twitter.png" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    <!-- Section Footer END -->


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
            var table = $('#mysoldnotes-table').DataTable({
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