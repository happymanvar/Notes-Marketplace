<?php
session_start();

if (isset($_SESSION['is_loggedin'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">


    <!-- Title -->
    <title>Change Password</title>

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
    if (isset($_POST['submit'])) {
        $olspass = mysqli_real_escape_string($conn, $_POST['oldpassword']);
        $newpass = mysqli_real_escape_string($conn, $_POST['newpassword']);
        $confirmpass = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

        $hash_newpass = password_hash($newpass, PASSWORD_DEFAULT);

        $query = "SELECT * FROM users WHERE ID='$user_id'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            $data = mysqli_fetch_assoc($result);

            $user_pass = $data['Password'];

            $check_old_pass = password_verify($olspass, $user_pass);

            if ($check_old_pass) {

                if ($newpass === $confirmpass) {

                    $update_pass = "UPDATE `users` SET `Password` = '$hash_newpass' WHERE `users`.`ID` = '$user_id'";

                    $set_pass = mysqli_query($conn, $update_pass);
                    if ($set_pass) {
    ?>
                        <script>
                            alert("password changed successfully!! you can login with new password!")
                            window.location.href = "http://localhost/Notes-marketplace/SRS_Notes/front/logout.php";
                        </script>
    <?php

                    } else {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                } else {
                    echo "your new password and confirm password is not match!!!";
                }
            } else {
                echo "please enter correct password";
            }
        } else {
            echo "query fail";
        }
    }
    ?>

    <!-- Change Password -->
    <section id="change-password">
        <div class="white-box">
            <div class="logo">
                <div class="text-center">
                    <img src="images/pre-login/top-logo.png" alt="logo">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-12 col-sm-12 col-lg-12">
                    <div class="form-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="change-password-heading">
                                    <h3 class="text-center">Change Password</h3>
                                    <p class="text-center">Enter your new password to change your password</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <form id="change-password-form" class="form" action="" method="post">

                                    <!-- password -->
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="old-password">Old Password</label>
                                            <input id="old-password" type="password" class="form-control" name="oldpassword" placeholder="Enter your old Password" required>
                                            <img src="images/pre-login/eye.png" toggle="#old-password" class="field-icon toggle-password" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="new-password">New Password</label>
                                            <input id="new-password" type="password" class="form-control" name="newpassword" placeholder="Enter your new Password" required>
                                            <img src="images/pre-login/eye.png" toggle="#new-password" class="field-icon toggle-password" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="confirm-new-password">Confirm Password</label>
                                            <input id="confirm-new-password" type="password" class="form-control" name="confirmpassword" placeholder="Enter your confirm Password" required>
                                            <img src="images/pre-login/eye.png" toggle="#confirm-new-password" class="field-icon toggle-password" />
                                        </div>
                                    </div>

                                    <!-- submit btn -->
                                    <div class="head-button">
                                        <!--<a class="btn pre-login-btns" id="change-pass-btn" href="#" title="submit" role="button">Submit</a>-->
                                        <button type="submit" name="submit" class="btn pre-login-btns">submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Change Password Ends -->

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>