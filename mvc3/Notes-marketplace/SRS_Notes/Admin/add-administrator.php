<?php
session_start();

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
    <title>ADD Administrator</title>

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
    include 'send_mail.php';

    $last_inserted_id = "";

    if (isset($_GET['id'])) {
        $editadminid = $_GET['id'];
        $getadmin = "SELECT * FROM users WHERE ID = '$editadminid'";
        $getadminquery = mysqli_query($conn, $getadmin);

        $getadminphone = mysqli_query($conn, "SELECT * FROM user_profile WHERE UserID = '$editadminid'");

        if (!($getadminquery) || !($getadminphone)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {
            $admindata = mysqli_fetch_assoc($getadminquery);
            $adminphonedata = mysqli_fetch_assoc($getadminphone);
            $adminfname = $admindata['FirstName'];
            $adminlname = $admindata['LastName'];
            $adminemail = $admindata['EmailID'];
            $adminpcode = $adminphonedata['Phone number - Country Code'];
            $adminphone = $adminphonedata['Phone number'];
            $editadmin = 1;
        }
    }

    if (isset($_POST['submit'])) {
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $ccode = $_POST['countrycode'];
        $phonenumber = $_POST['phonenumber'];


        if (isset($editadmin)) {
            $updateadmin = "UPDATE users SET `FirstName` = '$fname', `LastName` = '$lname', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$editadminid'";
            $updatequery = mysqli_query($conn, $updateadmin);


            $updatecontect = "UPDATE user_profile SET `Phone number - Country Code` = '$ccode', `Phone number` = '$phonenumber', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE UserID = '$editadminid'";
            $updatecontactquery = mysqli_query($conn, $updatecontect);
            if (!($updateadmin) || !($updatecontactquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            } else {
                header('location:manage-administrator.php');
            }
        } else {
            $pass = bin2hex(random_bytes(4));
            $password_encrypt = password_hash($pass, PASSWORD_DEFAULT);

            $token = bin2hex(random_bytes(15));

            $emailquery = "SELECT * FROM users WHERE EmailID='$email'";
            $query = mysqli_query($conn, $emailquery);

            $emailcount = mysqli_num_rows($query);

            if ($emailcount > 0) {
    ?>
                <script>
                    alert("email already exists")
                </script>
                <?php
            } else {
                $insertadmin = "INSERT INTO `users` (`RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `token`, `IsEmailVarified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('2', '$fname', '$lname', '$email', '$password_encrypt', '$token', b'1', current_timestamp(), '$adminid', current_timestamp(), '$adminid', b'1')";
                $adminquery = mysqli_query($conn, $insertadmin);

                $last_inserted_id = mysqli_insert_id($conn);

                if ($adminquery) {
                    // This email address and name will be visible as sender of email

                    $mail->addAddress($email);  // This email is where you want to send the email
                    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

                    // Setting the email content
                    $mail->IsHTML(true);
                    $mail->Subject = "Login Credentials for admin";

                    $mail->Body = " Hello Admin,<br><br>We have generated an username and  password for you <br>username: $email <br> password: $pass <br><br> Regards,<br>Notes Marketplace ";

                    if (!($mail->send())) {
                ?>
                        <script>
                            alert("error in sending mail")
                        </script>
    <?php
                    }
                }
                $insertcontect = "INSERT INTO `user_profile` (`UserID`, `Phone number - Country Code`, `Phone number`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES ('$last_inserted_id', '$ccode', '$phonenumber', current_timestamp(), '$adminid', current_timestamp(), '$adminid')";
                $phonequery = mysqli_query($conn, $insertcontect);
                if (!($phonequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }
            }
        }
    }
    ?>

    <!-- Navigation Bar -->
    <?php
    include 'admin-header.php';
    ?>
    <!-- Navigation Bar END -->

    <!-- Add Administrator Starts -->
    <section id="add-administrator">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="horizontal-heading">
                            <h3>Add Administrator</h3>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <form action="" method="POST">


                            <div class="form-group">
                                <label for="first-name">First Name*</label>
                                <input type="text" name="firstname" class="form-control" id="first-name" placeholder="Enter your first name" <?php if (isset($adminfname)) {
                                                                                                                                                    echo "value = $adminfname";
                                                                                                                                                } ?> required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name*</label>
                                <input type="text" name="lastname" class="form-control" id="last-name" placeholder="Enter your last name" <?php if (isset($adminlname)) {
                                                                                                                                                echo "value = $adminlname";
                                                                                                                                            } ?> required>
                            </div>
                            <div class="form-group">
                                <label for="p-email">Email*</label>
                                <input type="email" name="email" class="form-control" id="p-email" placeholder="Enter your email address" <?php if (isset($adminemail)) {
                                                                                                                                                echo "value = $adminemail";
                                                                                                                                            } ?> required>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="country-code">Phone Number</label>
                                        <?php
                                        $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                        $countryquery = mysqli_query($conn, $getcountryquery);
                                        $countryrows = mysqli_num_rows($countryquery);
                                        ?>
                                        <select id="country-code" name="countrycode" class="form-control">
                                            <?php
                                            if (!(isset($adminpcode))) {
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
                                                    if ($code_id == $adminpcode) {
                                                        echo "<option value='$code_id' selected>$code_id</option>";
                                                    } else {
                                                        echo "<option value='$code_id'>$code_id</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-9">
                                        <label for="phone-number"></label>
                                        <input type="text" class="form-control" name="phonenumber" id="phone-number" placeholder="Enter your phone number" <?php if (isset($adminphone)) {
                                                                                                                                                                echo "value = $adminphone";
                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                            </div>

                            <div id="add-admini-submit-btn">
                                <button type="submit" id="add-admin-btn" name="submit" class="btn general-btn">submit</button>
                                <!-- <a class="btn general-btn" href="#" title="Submit" role="button">SUBMIT</a>-->
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