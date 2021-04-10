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
    <title>My Profile</title>

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
    ?>
    <!-- Navigation Bar END -->

    <?php
    include 'db_conntect.php';

    $name_to_store_pp = "";
    $isset_profile = "false";
    $dp_file_name = "";

    $get_data = "SELECT * FROM user_profile WHERE UserID='$adminid'";
    $result = mysqli_query($conn, $get_data);
    $count_id = mysqli_num_rows($result);

    if ($result) {
        if ($count_id > 0) {
            $data = mysqli_fetch_assoc($result);

            $edit_countrycode = $data['Phone number - Country Code'];
            $edit_secondary_email = $data['SecondaryEmailAddress'];
            $edit_phonenumber = $data['Phone number'];
            $dp_file_name = $data['Profile Picture'];
            $isset_profile = "true";
        } else {
            echo "no data";
        }
    } // get data from database and set it to inute tag for update profile
    else {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    if (isset($_POST['submit'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['p-email'];
        $semail = $_POST['s-email'];
        $countrycode = $_POST['ccode'];
        $phonenumber = $_POST['phonenumber'];


        $profile_picture = $_FILES['profilepic'];

        // display picture file data
        $profile_picture_filename = $profile_picture['name'];
        $profile_picture_fileerror = $profile_picture['error'];
        $profile_picture_filetemp = $profile_picture['tmp_name'];

        $profile_picture_fileext = explode('.', $profile_picture_filename);
        $profile_picture_filecheck = strtolower(end($profile_picture_fileext));
        $profile_picture_ext = end($profile_picture_fileext);
        $profile_picture_fileextstored = array('png', 'jpg', 'jpeg');

        if (!empty($profile_picture_filename)) {
            if (in_array($profile_picture_filecheck, $profile_picture_fileextstored)) {

                $name_to_store_pp = $profile_picture_filename;
            } else {
    ?>
                <script>
                    alert("select proper file type for profile picture")
                </script>
    <?php
            }
        } // display pic provided end 

        if ($isset_profile == "false") {
            if (!empty($firstname) && !empty($lastname)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                $update_profile = "INSERT INTO `user_profile` (`UserID`, `SecondaryEmailAddress`, `Phone number - Country Code`, `Phone number`, `Profile Picture`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$adminid', '$semail', '$countrycode', '$phonenumber', '$store_name_dp', current_timestamp(), '$adminid', current_timestamp(), '$adminid')";
                $query = mysqli_query($conn, $update_profile);

                if ($query) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$adminid")) {
                        mkdir("../Members/$adminid", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        move_uploaded_file($profile_picture_filetemp, "../Members/$adminid/$store_name_dp");
                    }
                    //header('location:http://localhost/Notes-marketplace/SRS_Notes/front/search-notes.php');
                } else {
                    echo "error";
                }
            } // data inserted

        } // data inserted ends 
        else {
            if (!empty($firstname) && !empty($lastname)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                if (!empty($name_to_store_pp)) {
                    $name_to_store_pp = $store_name_dp;
                }
                $update = "UPDATE `user_profile` SET `SecondaryEmailAddress` = '$semail', `Phone number - Country Code` = '$countrycode', `Phone number` = '$phonenumber', `Profile Picture` = '$name_to_store_pp', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE `user_profile`.`UserID` = '$adminid'";
                $query2 = mysqli_query($conn, $update);
                if ($query2) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$adminid")) {
                        mkdir("../Members/$adminid", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        if (!empty($dp_file_name) && file_exists("../Members/$adminid/$dp_file_name")) {
                            unlink("../Members/$adminid/$dp_file_name");
                        }
                        move_uploaded_file($profile_picture_filetemp, "../Members/$adminid/$store_name_dp");
                    } else {
                        if (!empty($dp_file_name) && file_exists("../Members/$adminid/$dp_file_name")) {
                            unlink("../Members/$adminid/$dp_file_name");
                        }
                    }
                    // header('location:http://localhost/Notes-marketplace/SRS_Notes/front/search-notes.php');
                } else {
                    echo "error update";
                }
            } // data inserted

        } // data updated ends


    }

    ?>

    <!-- My Profile Starts -->
    <section id="my-profile">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="horizontal-heading">
                            <h3>My Profile</h3>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-12">
                        <form action="" method="POST" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="first-name">First Name*</label>
                                <input type="text" class="form-control" name="firstname" id="first-name" placeholder="Enter your first name" <?php if (isset($first_name)) {
                                                                                                                                                    echo "value='$first_name'";
                                                                                                                                                } ?>>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name*</label>
                                <input type="text" class="form-control" name="lastname" id="last-name" placeholder="Enter your last name" <?php if (isset($last_name)) {
                                                                                                                                                echo "value='$last_name'";
                                                                                                                                            } ?>>
                            </div>
                            <div class="form-group">
                                <label for="p-email">Email*</label>
                                <input type="email" class="form-control" name="p-email" id="p-email" placeholder="Enter your email address" <?php if (isset($email_id)) {
                                                                                                                                                echo "value='$email_id'";
                                                                                                                                            } ?> readonly>
                            </div>
                            <div class="form-group">
                                <label for="s-email">Secondary Email</label>
                                <input type="email" class="form-control" name="s-email" id="s-email" placeholder="Enter your email address" <?php if (isset($edit_secondary_email)) {
                                                                                                                                                echo "value='$edit_secondary_email'";
                                                                                                                                            } ?>>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col-sm-4 col-4 col">
                                        <label for="country-code">Phone Number</label>
                                        <?php
                                        $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                        $countryquery = mysqli_query($conn, $getcountryquery);
                                        $countryrows = mysqli_num_rows($countryquery);
                                        ?>
                                        <select id="country-code" name="ccode" class="form-control">
                                            <?php
                                            if (!(isset($edit_countrycode))) {
                                            ?>
                                                <option selected hidden value="+91">+91<type></type>
                                                </option>
                                                <?php
                                                for ($i = 1; $i <= $countryrows; $i++) {
                                                    $countryrow = mysqli_fetch_array($countryquery);
                                                ?>
                                                    <option value="<?php echo $countryrow["CountryCode"] ?>"><?php echo $countryrow["CountryCode"] ?></option>
                                            <?php
                                                }
                                            } else {
                                                for ($i = 1; $i <= $countryrows; $i++) {
                                                    $countryrow = mysqli_fetch_array($countryquery);

                                                    $code_name = $countryrow['CountryCode'];
                                                    $code_id = $code_name;
                                                    if ($code_id == $edit_countrycode) {
                                                        echo "<option value='$code_id' selected>$code_id</option>";
                                                    } else {
                                                        echo "<option value='$code_id'>$code_id</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-8 col-8">
                                        <label for="phone-number"></label>
                                        <input type="text" class="form-control" name="phonenumber" id="phone-number" placeholder="Enter your phone number" <?php if (isset($edit_phonenumber)) {
                                                                                                                                                                echo "value='$edit_phonenumber'";
                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group file-upload">
                                <label for="profile-picture">Profile Picture</label>
                                <input type="file" class="form-control-file profile-picture" name="profilepic" id="profile-picture">
                            </div>
                            <div id="profile-submit-btn">
                                <button type="submit" id="add-admin-btn" name="submit" class="btn general-btn">submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- My Profile Ends -->

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