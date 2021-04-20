<?php
session_start();
ob_start();

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
    <title>User Profile</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <link rel="stylesheet" href="css/jquery-ui.min.css">

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

    $name_to_store_pp = "";
    $isset_profile = "false";
    $dp_file_name = "";

    $get_data = "SELECT * FROM user_profile WHERE UserID='$user_id'";
    $result = mysqli_query($conn, $get_data);
    $count_id = mysqli_num_rows($result);
    if ($result) {
        if ($count_id > 0) {
            $data = mysqli_fetch_assoc($result);

            $edit_dob = $data['DOB'];
            $edit_gender = $data['Gender'];
            $edit_countrycode = $data['Phone number - Country Code'];
            $edit_phonenumber = $data['Phone number'];
            $edit_addline1 = $data['Address Line 1'];
            $edit_addline2 = $data['Address Line 2'];
            $edit_city = $data['City'];
            $edit_state = $data['State'];
            $edit_zipcode = $data['Zip Code'];
            $edit_country = $data['Country'];
            $edit_university = $data['University'];
            $edit_college = $data['College'];
            $dp_file_name = $data['Profile Picture'];
            $isset_profile = "true";
        } else {
            echo "no data";
        }
    } // get data from database and set it to inute tag for update profile
    else {
        die("QUERY FAILED" . mysqli_error($conn));
    }


    if (isset($_POST['set-profile'])) {

        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $DOB = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $countrycode = mysqli_real_escape_string($conn, $_POST['countrycode']);
        $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
        $addressline1 = mysqli_real_escape_string($conn, $_POST['addressline1']);
        $addressline2 = mysqli_real_escape_string($conn, $_POST['addressline2']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $university = mysqli_real_escape_string($conn, $_POST['university']);
        $college = mysqli_real_escape_string($conn, $_POST['college']);

        $profile_picture = $_FILES['profilepicture'];

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
            if (!empty($countrycode) && !empty($phonenumber) && !empty($addressline1) && !empty($addressline2) && !empty($city) && !empty($state) && !empty($zipcode) && !empty($country)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                $update_profile = "INSERT INTO `user_profile` (`UserID`, `DOB`, `Gender`, `SecondaryEmailAddress`, `Phone number - Country Code`, `Phone number`, `Profile Picture`, `Address Line 1`, `Address Line 2`, `City`, `State`, `Zip Code`, `Country`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$user_id', '$DOB', '$gender', NULL, '$countrycode', '$phonenumber', '$store_name_dp', '$addressline1', '$addressline2', '$city', '$state', '$zipcode', '$country', '$university', '$college', current_timestamp(), '1', current_timestamp(), '1')";
                $query = mysqli_query($conn, $update_profile);

                if ($query) {
                    $isset_profile = "true";

                    if (!is_dir("../Members/$user_id")) {
                        mkdir("../Members/$user_id", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        move_uploaded_file($profile_picture_filetemp, "../Members/$user_id/$store_name_dp");
                    }
                    header('location:search-notes.php');
                } else {
                    echo "error";
                }
            } // data inserted

        } // data inserted ends 
        else {
            if (!empty($countrycode) && !empty($phonenumber) && !empty($addressline1) && !empty($addressline2) && !empty($city) && !empty($state) && !empty($zipcode) && !empty($country)) {
                date_default_timezone_set('Asia/Kolkata');
                $store_name_dp = "DP_" . date("dmyhis") . "." . $profile_picture_ext;
                if (!empty($name_to_store_pp)) {
                    $name_to_store_pp = $store_name_dp;
                }
                $update = "UPDATE `user_profile` SET `DOB` = '$DOB', `Gender` = '$gender', `Phone number - Country Code` = '$countrycode', `Phone number` = '$phonenumber', `Profile Picture` = '$name_to_store_pp', `Address Line 1` = '$addressline1', `Address Line 2` = '$addressline2', `City` = '$city', `State` = '$state', `Zip Code` = '$zipcode', `Country` = '$country', `University` = '$university', `College` = '$college', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$user_id' WHERE `user_profile`.`UserID` = '$user_id'";
                $query2 = mysqli_query($conn, $update);
                if ($query2) {
                    $isset_profile = "true";
                    echo "$isset_profile";

                    if (!is_dir("../Members/$user_id")) {
                        mkdir("../Members/$user_id", 0777, true);
                    }

                    if (!empty($profile_picture_filetemp)) {
                        if (!empty($dp_file_name) && file_exists("../Members/$user_id/$dp_file_name")) {
                            unlink("../Members/$user_id/$dp_file_name");
                        }
                        move_uploaded_file($profile_picture_filetemp, "../Members/$user_id/$store_name_dp");
                    } else {
                        if (!empty($dp_file_name) && file_exists("../Members/$user_id/$dp_file_name")) {
                            unlink("../Members/$user_id/$dp_file_name");
                        }
                    }
                    header('location:search-notes.php');
                } else {
                    echo "error update";
                }
            } // data inserted

        } // data updated ends


    }

    ?>

    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="head-part-inner">
                        <div class="col-md-12">
                            <div class="header-statement" class="text-center">
                                <h3>User Profile</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- Basic Profile Details -->
    <section id="basic-details">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12 col-sm-12 text-left">

                        <div class="horizontal-heading">
                            <h3>Basic Profile Details</h3>
                        </div>

                    </div>

                    <div class="col-md-12 col-12 col-sm-12">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="first-name">FirstName *</label>
                                    <input type="text" class="form-control" id="first-name" name="firstname" placeholder="Enter your first name" <?php if (isset($first_name)) {
                                                                                                                                                        echo "value='$first_name'";
                                                                                                                                                    } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="last-name">Last Name *</label>
                                    <input type="text" class="form-control" id="last-name" name="lastname" placeholder="Enter your last name" <?php if (isset($last_name)) {
                                                                                                                                                    echo "value='$last_name'";
                                                                                                                                                } ?>>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" <?php if (isset($email_id)) {
                                                                                                                                                echo "value='$email_id'";
                                                                                                                                            } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="date">Date Of Birth</label>
                                    <input type="text" class="form-control" id="datepicker" name="dateofbirth" name="date" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Enter your date of birth" <?php if (isset($edit_dob)) {
                                                                                                                                                                                                                                echo "value='$edit_dob'";
                                                                                                                                                                                                                            } ?>>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12 gender">
                                    <label for="gender">Gender</label>
                                    <?php
                                    $getgenderquery = "SELECT * FROM referencedata WHERE IsActive = b'1' AND RefCategory = 'Gender'";
                                    $genderquery = mysqli_query($conn, $getgenderquery);
                                    $genderrows = mysqli_num_rows($genderquery);
                                    ?>
                                    <select id="gender" name="gender" class="form-control">
                                        <?php
                                        if (!(isset($edit_gender))) {

                                        ?>
                                            <option selected hidden value="">Select your gender</option>
                                            <?php
                                            for ($i = 1; $i <= $genderrows; $i++) {
                                                $genderrow = mysqli_fetch_array($genderquery);
                                            ?>
                                                <option value="<?php echo $genderrow["ID"] ?>"><?php echo $genderrow["Value"] ?></option>
                                        <?php
                                            }
                                        } else {

                                            for ($i = 1; $i <= $genderrows; $i++) {
                                                $genderrow = mysqli_fetch_array($genderquery);
                                                $gender_id = $genderrow['ID'];
                                                $gender_name = $genderrow['Value'];
                                                if ($gender_id == $edit_gender) {
                                                    echo "<option value='$gender_id' selected>$gender_name</option>";
                                                } else {
                                                    echo "<option value='$gender_id'>$gender_name</option>";
                                                }
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <div class="form-row">
                                        <div class="form-group col-sm-3 col col-3">
                                            <label for="country-code">Phone Number</label>
                                            <?php
                                            $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                            $countryquery = mysqli_query($conn, $getcountryquery);
                                            $countryrows = mysqli_num_rows($countryquery);
                                            ?>
                                            <select id="country-code" name="countrycode" class="form-control">
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
                                        <div class="form-group col-sm-9 col-9">
                                            <label for="phone-number"> </label>
                                            <input type="text" class="form-control" name="phonenumber" id="phone-number" placeholder="Enter your phone number" required <?php if (isset($edit_phonenumber)) {
                                                                                                                                                                            echo "value='$edit_phonenumber'";
                                                                                                                                                                        } ?>>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-12 col-md-6 col-12">
                                    <label for="profile-picture">Profile Picture</label>
                                    <input type="file" class="form-control-file image-upload" name="profilepicture" id="profile-picture">
                                </div>

                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Address Details</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="address-line-one">Address Line 1 *</label>
                                    <input type="text" class="form-control" name="addressline1" id="address-line-one" placeholder="Enter your address" required <?php if (isset($edit_addline1)) {
                                                                                                                                                                    echo "value='$edit_addline1'";
                                                                                                                                                                } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="address-line-two">Address Line 2</label>
                                    <input type="text" class="form-control" name="addressline2" id="address-line-two" placeholder="Enter your address" required <?php if (isset($edit_addline2)) {
                                                                                                                                                                    echo "value='$edit_addline2'";
                                                                                                                                                                } ?>>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="city">City *</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city" required <?php if (isset($edit_city)) {
                                                                                                                                                echo "value='$edit_city'";
                                                                                                                                            } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="state">State *</label>
                                    <input type="text" class="form-control" name="state" id="state" placeholder="Enter your state" required <?php if (isset($edit_state)) {
                                                                                                                                                echo "value='$edit_state'";
                                                                                                                                            } ?>>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="zipcode">ZipCode *</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter your zipcode" required <?php if (isset($edit_zipcode)) {
                                                                                                                                                        echo "value='$edit_zipcode'";
                                                                                                                                                    } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="country">Country *</label>
                                    <?php
                                    $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                    $countryquery = mysqli_query($conn, $getcountryquery);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    ?>
                                    <select id="country" name="country" class="form-control" required>
                                        <?php
                                        if (!(isset($edit_country))) {
                                        ?>
                                            <option selected hidden value="">Select your country<type></type>
                                            </option>
                                            <?php
                                            for ($i = 1; $i <= $countryrows; $i++) {
                                                $countryrow = mysqli_fetch_array($countryquery);
                                            ?>
                                                <option value="<?php echo $countryrow["Name"] ?>"><?php echo $countryrow["Name"] ?></option>
                                        <?php
                                            }
                                        } else {
                                            for ($i = 1; $i <= $countryrows; $i++) {
                                                $countryrow = mysqli_fetch_array($countryquery);

                                                $country_name = $countryrow['Name'];

                                                if ($country_name == $edit_country) {
                                                    echo "<option value='$country_name' selected>$country_name</option>";
                                                } else {
                                                    echo "<option value='$country_name'>$country_name</option>";
                                                }
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                            </div>

                            <!-- university details -->
                            <div class="form-group-heading">
                                <h3>University and College information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="university">University</label>
                                    <input type="text" class="form-control" name="university" id="university" placeholder="Enter your university" <?php if (isset($edit_university)) {
                                                                                                                                                        echo "value='$edit_university'";
                                                                                                                                                    } ?>>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-12">
                                    <label for="college">College</label>
                                    <input type="text" class="form-control" name="college" id="college" placeholder="Enter your college" <?php if (isset($edit_college)) {
                                                                                                                                                echo "value='$edit_college'";
                                                                                                                                            } ?>>
                                </div>

                            </div>

                            <div id="submit-btn">
                                <!-- <a class="btn submit-btn" href="#" title="Submit" role="button">SUBMIT</a>-->
                                <button type="submit" name="set-profile" class="btn submit-btn">submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Profile Details Ends -->

    <?php
    include 'footer.php';
    ?>


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <script src="js/jquery-ui.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>



</body>

</html>
