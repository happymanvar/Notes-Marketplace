<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">


    <!-- Title -->
    <title>Sign Up</title>

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
    $account_created = 0;

    $host = $_SERVER['HTTP_HOST'];
    $path = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");

    if (isset($_POST['submit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        $pass = password_hash($password, PASSWORD_DEFAULT);

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
            if ($password === $cpassword) {

                $insertquery = "INSERT INTO `users` (`RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `token`, `IsEmailVarified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('3', '$firstname', '$lastname', '$email', '$pass', '$token', b'0', current_timestamp(), NULL, current_timestamp(), NULL, b'1')";

                $iquery = mysqli_query($conn, $insertquery);

                if ($iquery) {

                    // This email address and name will be visible as sender of email

                    $mail->addAddress($email);  // This email is where you want to send the email
                    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

                    // Setting the email content
                    $mail->IsHTML(true);
                    $mail->Subject = "Note Marketplace - Email Verification";

                    $mail->Body = "
                <table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                <thead>
                    <th>
                        <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%; margin-left: 0px;'>
                    </th>
                </thead>
                <tbody>
                    <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                        <td class='text-1'>Email Verification</td>
                    </tr>
                    <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                        <td class='text-2'>Dear $firstname,</td>
                    </tr>
                    <tr style='height: 60px;'>
                        <td class='text-3'>
                            Thanks for Signing up! <br>
                            Simply click below for email verification.
                        </td>
                    </tr>
                    <tr style='height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;'>
                        <td style='text-align: center;'>
                            <button class='btn btn-verify' style='width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;'><a class='btn' href='http://$host$path/activation.php?token=$token' role='button' style='color: #fff; text-decoration: none; text-transform: uppercase;'>Verify email address</a>
                            </button>
                        </td>
                    </tr>
                </tbody>
                </table>";

                    $mail->send();
                    $account_created = 1;
                    $_SESSION['msg'] = "check your mail to activate your account $email";
            ?>
                    <script>
                        alert($_SESSION['msg'])
                    </script>
                <?php

                } else {
                ?>
                    <script>
                        alert("NO Inserted")
                    </script>
                <?php

                }
            } else {
                ?>
                <script>
                    alert("password and confirm password does not match")
                </script>
    <?php
            }
        }
    }
    mysqli_close($conn);

    ?>


    <!-- Sign Up -->

    <section id="signup">
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
                                <div class="signup-heading">
                                    <h3 class="text-center">Create an Account</h3>
                                    <p class="text-center">Enter your details to Signup</p>

                                </div>
                                <p class="text-center success" <?php if ($account_created != 1) {
                                                                    echo "hidden";
                                                                } ?>><i class="fa fa-check-circle" aria-hidden="true"></i> Your account has
                                    been
                                    successfully created.</p>
                            </div>

                            <div class="col-md-12">
                                <form action="" method="post">
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="firstname">First Name *</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter your First Name" required>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="lastname">Last Name *</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter your Last Name" required>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="emailAdd">Email *</label>
                                            <input type="email" name="email" class="form-control" id="emailAdd" placeholder="Enter your Email" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="password">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,24}" title="Must contain at least one number and one uppercase one special character and lowercase letter, and at least 6 or more characters" placeholder="Enter your Password" required>
                                            <img src="images/pre-login/eye.png" toggle="#password" class="field-icon toggle-password" />
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="con_password">Confirm Password</label>
                                            <input id="con_password" name="cpassword" type="password" class="form-control" placeholder="Re-enter your Password" title="password and confirm password do not match" required>
                                            <img src="images/pre-login/eye.png" toggle="#con_password" class="field-icon toggle-password" />

                                        </div>
                                    </div>

                                    <!-- login btn -->
                                    <div class="head-button form-group">
                                        <button type="submit" name="submit" class="btn pre-login-btns" onclick="return validation()">Sign Up</button>
                                    </div>
                                    <!-- login -->
                                    <p class="text-center sign-up-text">Already have an Account? <a href="../login.php">Login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign Up Ends -->




    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>


    <script>
        var validstring = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,24}$/g;

        var password = document.getElementById('password');
        var confirmpassword = document.getElementById('con_password');

        function validation() {


            if (password.value != confirmpassword.value) {
                return false;
            }
            if (password.value.match(decimal)) {
                return true;
            } else {
                return false;
            }

        }

        password.onkeyup = function() {

            if (password.value.match(validstring)) {
                password.classList.remove("invalid-border");
                password.classList.add("valid-border");
            } else {
                password.classList.remove("valid-border");
                password.classList.add("invalid-border");
            }

        }

        confirmpassword.onkeyup = function() {
            if (confirmpassword.value == password.value) {
                confirmpassword.classList.remove("invalid-border");
                confirmpassword.classList.add("valid-border");
            } else {
                confirmpassword.classList.remove("valid-border");
                confirmpassword.classList.add("invalid-border");
            }
        }
    </script>

</body>

</html>
