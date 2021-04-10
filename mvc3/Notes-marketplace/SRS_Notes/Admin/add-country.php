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
    <title>ADD Category</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">


</head>

<body>

    <?php
    include 'db_conntect.php';

    if (isset($_GET['id'])) {
        $countryid = $_GET['id'];
        $getcountry = "SELECT * FROM countries WHERE ID = '$countryid'";
        $getcountryquery = mysqli_query($conn, $getcountry);
        if (!($getcountryquery)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            $countrydata = mysqli_fetch_assoc($getcountryquery);
            $countryname = $countrydata['Name'];
            $countrycode = $countrydata['CountryCode'];
            $editcountry = 1;
        }
    }


    if (isset($_POST['submit'])) {
        $cname = $_POST['countryname'];
        $code = $_POST['countrycode'];

        $ccode = "+" . $code;

        if (isset($editcountry)) {
            $updatecountry = "UPDATE countries SET `Name` = '$cname', `CountryCode` = '$ccode', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$countryid'";
            $updatequery = mysqli_query($conn, $updatecountry);
            if (!($updatequery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            } else {
                header('location:manage-country.php');
            }
        } else {
            $insertcountry = "INSERT INTO `countries` (`Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('$cname', '$ccode', current_timestamp(), '$adminid', current_timestamp(), '$adminid', b'1')";
            $countryquery = mysqli_query($conn, $insertcountry);

            if (!($countryquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
        }
    }
    ?>

    <!-- Navigation Bar -->
    <?php
    include 'admin-header.php';
    ?>
    <!-- Navigation Bar END -->

    <!-- Add Country Starts -->
    <section id="add-country">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="horizontal-heading">
                            <h3>Add Country</h3>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="country-name">Country Name *</label>
                                <input type="text" class="form-control" name="countryname" id="country-name" placeholder="Enter country name" <?php if (isset($countryname)) {
                                                                                                                                                    echo "value = $countryname";
                                                                                                                                                } ?> required>
                            </div>
                            <div class="form-group">
                                <label for="country-code">Country Code *</label>
                                <input type="text" class="form-control" name="countrycode" id="country-code" placeholder="Enter country code" <?php if (isset($countrycode)) {
                                                                                                                                                    echo "value = $countrycode";
                                                                                                                                                } ?> required>
                            </div>

                            <div id="add-country-submit-btn">
                                <!--<a class="btn general-btn" href="#" title="Submit" role="button">SUBMIT</a>-->
                                <button type="submit" id="add-country-btn" name="submit" class="btn general-btn">submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- My Profile Ends -->

    <!-- Footer -->
    <footer class="fixed-bottom">
        <section id="footer">
            <div class="container">
                <div class="row">
                    <!-- Copyright -->
                    <div class="col-md-6 col-sm-4 footer-text text-left">
                        <p>Version: 1.1.24</p>
                    </div>
                    <!-- Social Icon -->
                    <div class="col-md-6 col-sm-8 footer-icon text-right">
                        <p>Copyright &copy; TatvaSoft All Rights Reserved</p>
                    </div>
                </div>
            </div>

        </section>
    </footer>
    <!-- Footer Ends -->


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>