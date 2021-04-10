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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Rejected Notes</title>

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
            header('location:rejected-notes.php');
        }
    }
    ?>
    <!-- Navigation Bar END -->



    <!-- Rejected Notes -->
    <section id="rejected-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Rejected Notes</h3>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 text-left">
                        <form>
                            <div class="form-group col-12 col-md-5">
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
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 col-12">
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
                    <div class="col-md-12 col-12">
                        <div class="rejected-notes-table table-responsive">

                            <table class="table table-hover" id="rejected-notes-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header seller">SELLER</th>
                                        <th scope="col" class="table-header date">DATE EDITED</th>
                                        <th scope="col" class="table-header seller">REJECTED BY</th>
                                        <th scope="col" class="table-header remark">REMARK</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getdata = "SELECT * FROM sellernotes WHERE Status = 10 AND IsActive = b'1' ORDER BY ModifiedDate DESC";
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
                                            <td>25-11-2020, 11:08</td>
                                            <td><?php
                                                $adminid = $notedata['ActionedBy'];
                                                $getadmin = "SELECT * FROM users WHERE ID= '$adminid' AND IsActive = b'1'";
                                                $getaquery = mysqli_query($conn, $getadmin);
                                                $getadmindata = mysqli_fetch_assoc($getaquery);
                                                echo $getadmindata['FirstName'] . " " . $getadmindata['LastName'];
                                                ?></td>
                                            <td><?php echo $notedata['AdminRemarks']; ?></td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a class="approve-note" name="approve" href="rejected-notes.php?approve=<?php echo $notedata['ID']; ?>" title="search" role="button"><button class="dropdown-item" type="button">Approve</button></a>
                                                        <a href="admin-downloadnotes.php?id=<?php echo $notedata['ID']; ?>"><button class="dropdown-item" type="button">Download Notes</button></a>
                                                        <a href="admin-note-detail.php?id=<?php echo $notedata['ID']; ?>"><button class="dropdown-item" type="button">View More Details</button></a>
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
    <!-- My Downloads Ends -->

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
            var table = $('#rejected-notes-table').DataTable({
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


</body>

</html>