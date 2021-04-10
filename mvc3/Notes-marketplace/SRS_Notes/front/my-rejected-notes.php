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
    <title>My Rejected Notes</title>

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


    <!-- My Rejected Notes Table -->
    <section id="my-rejected-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading">
                            <h3>My Rejected Notes</h3>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" name="valueToSearch" class=" form-control" id="search-notes" placeholder="Search">
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
                        <div class="rejected-note-table table-responsive">

                            <table class="table table-hover" id="rejected-noteds">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header title">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header remark">REMARKS</th>
                                        <th scope="col" class="table-header">CLONE</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rejected_note_query = "SELECT * FROM sellernotes WHERE Status = '10' AND SellerID = '$user_id'";
                                    $geterjectednotes = mysqli_query($conn, $rejected_note_query);
                                    $count = mysqli_num_rows($geterjectednotes);

                                    for ($i = 1; $i <= $count; $i++) {
                                        $rejected_row = mysqli_fetch_assoc($geterjectednotes);
                                        $noteid = $rejected_row['ID'];
                                    ?>
                                        <tr style="height: 50px;">
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"> <a class="notedetail" name="notedetail" href="notes-details.php?id=<?php echo $noteid; ?>" role="button"><?php echo $rejected_row['Title']; ?></a> </td>
                                            <td><?php
                                                $catid = $rejected_row['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>

                                            <td><?php echo $rejected_row['AdminRemarks']; ?></td>
                                            <td>Clone</td>
                                            <td class="text-center">
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
            var table = $('#rejected-noteds').DataTable({
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
                var x = $('#search-notes').val();
                table.search(x).draw();

            });

        });
    </script>

</body>

</html>