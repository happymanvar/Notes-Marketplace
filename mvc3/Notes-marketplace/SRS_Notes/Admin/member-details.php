<?php
session_start();

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
    <title>Member Details</title>

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
    ?>

    <?php
    if (isset($_GET['id'])) {

        $userid = $_GET['id'];

        $get_user_detail = "SELECT * FROM users WHERE ID='$userid' AND IsActive = b'1'";
        $details_query = mysqli_query($conn, $get_user_detail);

        $user_bdata = mysqli_fetch_assoc($details_query);

        $fname = $user_bdata['FirstName'];
        $lname = $user_bdata['LastName'];
        $email = $user_bdata['EmailID'];

        $get_details = "SELECT * FROM user_profile WHERE UserID='$userid'";
        $details = mysqli_query($conn, $get_details);
        if (!($details)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $data = mysqli_fetch_assoc($details);
        $dpname = $data['Profile Picture'];
        $dob = $data['DOB'];
        $phonenumber = $data['Phone number'];
        $university = $data['University'];
        $address1 = $data['Address Line 1'];
        $address2 = $data['Address Line 2'];
        $city = $data['City'];
        $state = $data['State'];
        $country = $data['Country'];
        $zipcode = $data['Zip Code'];
    }

    ?>
    <!-- Navigation Bar END -->


    <!-- Member Details -->
    <section id="member-details">
        <div class="content-box member-detail">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-sm-12 col-12">
                        <div class="member-detail-left">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 horizontal-heading-sm text-left">
                                    <h3>Member Details</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-lg-3 col-sm-4 col-12 member-image">
                                    <?php
                                    if ($dpname != "") {
                                        echo "<img src='admin-images/images/member.png' alt='memberpic'>";
                                        //echo "<img src='../Members/$userid/$dpname' alt='memberpic' class='img-responsive'>";
                                    } else {
                                        echo "<img src='admin-images/images/member.png' alt='memberpic'>";
                                    }

                                    ?>

                                </div>

                                <div class="col-md-8 col-lg-9 col-sm-8 col-12 member-bio">
                                    <div class="member-bio-detail-right">
                                        <div class="row">
                                            <div class="col-md-6 col-5 left-side text-left">
                                                <p>First Name:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php echo $fname; ?></p>
                                            </div>
                                            <div class="col-md-6 col-5 left-side text-left">
                                                <p>Last Name:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php echo $lname; ?></p>
                                            </div>
                                            <div class="col-md-6 col-5 left-side text-left">
                                                <p>Email:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php echo $email; ?></p>
                                            </div>
                                            <div class="col-md-6 col-5 left-side text-left">
                                                <p>DOB:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php
                                                    $date = strtotime($dob);
                                                    echo date('d-m-Y', $date); ?></p>
                                            </div>
                                            <div class="col-md-6 col-5 left-side text-left">
                                                <p>Phone Number:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php echo $phonenumber; ?></p>
                                            </div>
                                            <div class="col-md-6  col-5 left-side text-left">
                                                <p>College/University:</p>
                                            </div>
                                            <div class="col-md-6 col-7 right-side text-left">
                                                <p><?php echo $university; ?></p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 col-lg-4 col-12">
                        <div class="member-detail-rigt">
                            <div class="row">
                                <div class="col-md-4 col-lg-5 col-sm-4 col-5 left-side text-left">
                                    <p>Address 1:</p>
                                </div>
                                <div class="col-md-8 col-lg-7 col-sm-8 col-7 right-side text-left">
                                    <p><?php echo $address1; ?></p>
                                </div>
                                <div class="col-md-4 col-lg-5 col-sm-4 col-5 left-side text-left">
                                    <p>Address 2:</p>
                                </div>
                                <div class="col-md-8 col-lg-7 col-sm-8 col-7 right-side text-left">
                                    <p><?php echo $address2; ?></p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-5 col-5 left-side text-left">
                                    <p>City:</p>
                                </div>
                                <div class="col-md-8 col-sm-8 col-lg-7 col-7 right-side text-left">
                                    <p><?php echo $city; ?></p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-5 col-5 left-side text-left">
                                    <p>State:</p>
                                </div>
                                <div class="col-md-8 col-7 col-lg-7 col-sm-8 right-side text-left">
                                    <p><?php echo $state; ?></p>
                                </div>
                                <div class="col-md-4 col-5 col-lg-5 col-sm-4 left-side text-left">
                                    <p>Country:</p>
                                </div>
                                <div class="col-md-8 col-7 col-lg-7 col-sm-8 right-side text-left">
                                    <p><?php echo $country; ?></p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-lg-5 col-5 left-side text-left">
                                    <p>Zip Code:</p>
                                </div>
                                <div class="col-md-8 col-sm-8 col-lg-7 col-7 right-side text-left">
                                    <p><?php echo $zipcode; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="bottom-border col-md-12 col-12">

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Notes Details Ends -->



    <!-- Notes Table Starts -->
    <section id="notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="horizontal-heading">
                            <h3>Notes</h3>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="notes-table table-responsive">

                            <table class="table table-hover" id="seller-notes-table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header seller">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">STATUS</th>
                                        <th scope="col" class="table-header">DOWNLOADED NOTES</th>
                                        <th scope="col" class="table-header">TOTAL EARNINGS</th>
                                        <th scope="col" class="table-header date">DATE ADDED</th>
                                        <th scope="col" class="table-header date">PUBLISHED DATE</th>
                                        <th scope="col" class="table-header"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getnotes = "SELECT * FROM sellernotes WHERE SellerID = $userid AND Status IN(7,8,9,10) ORDER BY CreatedDate ASC";
                                    $getnotesquery = mysqli_query($conn, $getnotes);
                                    $getnotescount = mysqli_num_rows($getnotesquery);
                                    for ($i = 1; $i <= $getnotescount; $i++) {
                                        $notesdata = mysqli_fetch_assoc($getnotesquery);
                                        $noteid = $notesdata['ID'];

                                    ?>
                                        <tr style="height: 50px;" class="text-center">
                                            <td><?php echo $i; ?></td>
                                            <td style="color: #6255a5;"><a class="note-detail-anchor" href="admin-note-detail.php?id=<?php echo $notesdata['ID']; ?>"><?php echo $notesdata['Title'] ?></a></td>
                                            <td><?php
                                                $catid = $notesdata['Category'];
                                                $getcategoryquery = "SELECT * FROM notecategories WHERE ID = '$catid' AND IsActive = b'1'";
                                                $categoryquery = mysqli_query($conn, $getcategoryquery);
                                                $category = mysqli_fetch_assoc($categoryquery);
                                                echo $category['Name']; ?></td>
                                            <td><?php
                                                $statusid = $notesdata['Status'];
                                                $getstatusquery = "SELECT * FROM referencedata WHERE ID = '$statusid' AND IsActive = b'1'";
                                                $statusquery = mysqli_query($conn, $getstatusquery);
                                                $status = mysqli_fetch_assoc($statusquery);
                                                echo $status['Value']; ?></td>
                                            <td style="color: #6255a5;"><?php
                                                                        $soldnote = "SELECT * FROM downloads WHERE IsSellerHasAllowedDownload = 1 AND IsActive = b'1' AND NoteID = $noteid AND Seller = $userid AND Downloader != $userid GROUP BY NoteID,Downloader";
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
                                                <a class="note-detail-anchor" href="downloaded-notes.php?id=<?php echo $notesdata['ID']; ?>"><?php
                                                                                                                                                echo $soldnotecount;
                                                                                                                                                ?>
                                            </td>
                                            <td><?php
                                                if ($notesdata['Status'] == 9) {
                                                    echo '$' . $totalearn;
                                                } else {
                                                    echo '$0';
                                                }
                                                ?></td>
                                            <td><?php $addeddate =  $notesdata['CreatedDate'];
                                                $date = strtotime($addeddate);
                                                echo date('d-m-Y, H:i', $date); ?></td>
                                            <td><?php
                                                if ($notesdata['Status'] == 9) {
                                                    $publisheddate =  $notesdata['PublishedDate'];
                                                    $date = strtotime($publisheddate);
                                                    echo date('d-m-Y, H:i', $date);
                                                } else {
                                                    echo 'NA';
                                                }
                                                ?></td>
                                            <td>
                                                <div class="btn-group dropleft">
                                                    <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="admin-images/images/dots.png" alt="menu" class="">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <a href="admin-downloadnotes.php?id=<?php echo $notesdata['ID']; ?>"><button class="dropdown-item" type="button">Download Notes</button></a>
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
    <!-- Notes Table Ends -->

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
            var table = $('#seller-notes-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="admin-images/images/right-arrow.png">',
                        previous: '<img src="admin-images/images/left-arrow.png">'
                    }
                }
            });

        });
    </script>

</body>

</html>