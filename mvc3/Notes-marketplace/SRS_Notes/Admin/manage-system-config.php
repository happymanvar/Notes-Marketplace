<?php
session_start();

$page = 'settings';

if (!isset($_SESSION['is_loggedin']) && !isset($_SESSION['is_superadmin'])) {
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
    <title>Manage System Configuration</title>

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


    <!-- Navigation Bar -->
    <?php
    include 'admin-header.php';

    include 'db_conntect.php';

    ?>
    <!-- Navigation Bar END -->


    <?php
    $exist_configuration = mysqli_query($conn, "SELECT configurationkey,value FROM systemconfigurations");
    if (!($exist_configuration)) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    $exist_count = mysqli_num_rows($exist_configuration);
    $configkey = array();
    $configvalue = array();

    if ($exist_count != 0) {
        while ($configurerow = mysqli_fetch_assoc($exist_configuration)) {
            $key = $configurerow['configurationkey'];
            $value = $configurerow['value'];
            array_push($configkey, $key);
            array_push($configvalue, $value);
        }
        $flag = 1;
    }


    ?>

    <?php

    if (isset($_POST['submit'])) {
        $supportemail = $_POST['supportemail'];
        $supportphone = $_POST['supportphone'];
        $emailaddresses = $_POST['emailaddresses'];
        $facebookurl = $_POST['facebookurl'];
        $twitterurl = $_POST['twitterurl'];
        $linkedinurl = $_POST['linkedinurl'];
        $defaultprofilepicture = $_FILES['dp']['name'];
        $defaultpictmp = $_FILES['dp']['tmp_name'];
        $defaultnote = $_FILES['note']['name'];
        $defaultnotetmp = $_FILES['note']['tmp_name'];
        if (isset($flag)) {
            if ($defaultprofilepicture == "") {
                $defaultprofilepicture = $configvalue[6];
            } else {
                move_uploaded_file($defaultpictmp, "../Members/Systemconfiguration/$defaultprofilepicture");
                $deletepicpath =  "../Members/Systemconfiguration/" . $configvalue[6];
                unlink($deletepicpath);
            }
            if ($defaultnote == "") {
                $defaultnote = $configvalue[7];
            } else {
                move_uploaded_file($defaultnotetmp, "../Members/Systemconfiguration/$defaultnote");
                $deletepicpath =  "../Members/Systemconfiguration/" . $configvalue[7];
                unlink($deletepicpath);
            }
            $updateconfigarray = array($supportemail, $supportphone, $emailaddresses, $facebookurl, $twitterurl, $linkedinurl, $defaultprofilepicture, $defaultnote);
            for ($i = 0; $i < 8; $i++) {
                $updatequery = "UPDATE systemconfigurations SET value = '{$updateconfigarray[$i]}' WHERE configurationkey = '{$configkey[$i]}'";
                $updatequery = mysqli_query($conn, $updatequery);
                if (!($updatequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
            }
        } else {
            $insertmanageconfiguration = "INSERT INTO systemconfigurations (configurationkey,value,createddate,createdby)VALUES('supportemail','{$supportemail}',current_timestamp(),$adminid)";

            $insertmanageconfiguration .= ",('supportphone','{$supportphone}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('emailaddresses','{$emailaddresses}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('facebookurl','{$facebookurl}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('twitterurl','{$twitterurl}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('linkedinurl','{$linkedinurl}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('defaultprofilepicture','{$defaultprofilepicture}',current_timestamp(),$adminid)";
            $insertmanageconfiguration .= ",('defaultnote','{$defaultnote}',current_timestamp(),$adminid)";
            $insertmanageconfigurationquery = mysqli_query($conn, $insertmanageconfiguration);
            if (!($insertmanageconfigurationquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            if (!is_dir("../Members/Systemconfiguration")) {
                mkdir("../Members/Systemconfiguration");
            }
            move_uploaded_file($defaultpictmp, "../Members/Systemconfiguration/$defaultprofilepicture");
            move_uploaded_file($defaultnotetmp, "../Members/Systemconfiguration/$defaultnote");
        }
        header('location: admin_dashboard.php');
    }

    ?>

    <!-- Manage System configuraton Starts -->
    <section id="manage-system-config">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="horizontal-heading">
                            <h3>Manage System Configuration</h3>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <form action="" method="POST" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="support-email">Supports emails address *</label>
                                <input type="text" name="supportemail" class="form-control" id="support-email" placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label for="support-phone-no">Support phone number *</label>
                                <input type="text" name="supportphone" class="form-control" id="support-phone-no" placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="send-email">Email Address(es)(for various events system will send notifications to these users) *</label>
                                <input type="email" name="emailaddresses" class="form-control" id="sen-email" placeholder="Enter email address">
                            </div>
                            <div class="form-group">
                                <label for="fb-url">Facebook URL</label>
                                <input type="text" name="facebookurl" class="form-control" id="fb-url" placeholder="Enter facebook url">
                            </div>
                            <div class="form-group">
                                <label for="twitter-url">Twitter URL</label>
                                <input type="text" name="twitterurl" class="form-control" id="twitter-url" placeholder="Enter twitter url">
                            </div>
                            <div class="form-group">
                                <label for="linkedin-url">Linkedin URL</label>
                                <input type="text" name="linkedinurl" class="form-control" id="linkedin-url" placeholder="Enter linkedin url">
                            </div>

                            <div class="form-group file-upload">
                                <label for="note-image">Default images for notes (if seller do not upload)</label>
                                <input type="file" class="form-control-file note-image" id="note-image" name="note">
                            </div>
                            <div class="form-group file-upload">
                                <label for="default-profile-pic">Default profile picture (if seller do not upload)</label>
                                <input type="file" class="form-control-file default-profile-pic" id="default-profile-pic" name="dp">
                            </div>
                            <div id="profile-submit-btn">
                                <!--<a class="btn general-btn" name="submit" title="Submit" role="button">SUBMIT</a>-->
                                <button type="submit" name="submit" class="btn general-btn">submit</button>

                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Manage System Configuration Ends -->

    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <!-- Footer Ends -->


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>