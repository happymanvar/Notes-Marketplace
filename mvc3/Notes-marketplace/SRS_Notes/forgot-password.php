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
    <title>Forgot Password</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="front/css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="front/css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="front/css/responsive.css">

</head>

<body>

    <?php

    include 'front/db_conntect.php';
    include 'send_mail.php';

    if (isset($_POST['submit'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);


        $token = bin2hex(random_bytes(4));
        $password_encrypt = password_hash($token, PASSWORD_DEFAULT);

        $emailquery = "SELECT * FROM users WHERE EmailID='$email'";
        $query = mysqli_query($conn, $emailquery);

        $emailcount = mysqli_num_rows($query);

        if ($emailcount > 0) {


            // This email address and name will be visible as sender of email

            $mail->addAddress($email);  // This email is where you want to send the email
            $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "New Temporary Password has been created for you";

            $mail->Body = " Hello,<br><br>We have generated a new password for you <br>password: $token <br><br> Regards,<br>Notes Marketplace ";

            $mail->send();

            $updatequery = "UPDATE users SET Password = '$password_encrypt' WHERE EmailID = '$email'";
            $update_pass_query = mysqli_query($conn, $updatequery);

            if ($update_pass_query) {
                $_SESSION['update_pass_msg'] = "check your mail to see your updated password";
                $msg = $_SESSION['update_pass_msg']
    ?>
                <script>
                    <?php echo "alert('$msg');"; ?>
                </script>

            <?php
            } else {
            ?>
                <script>
                    alert("your password is not updated. Please try again.")
                </script>

            <?php
            }
        } else {
            ?>
            <script>
                alert("email you entered is note exists. Please enter valid email address.")
            </script>

    <?php
        }
    }
    mysqli_close($conn);

    ?>


    <!-- Forgot Password -->
    <section id="forgot-password">
        <div class="white-box">
            <div class="logo">
                <div class="text-center">
                    <img src="front/images/pre-login/top-logo.png" alt="logo">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-12 col-sm-12 col-lg-12">
                    <div class="form-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forgot-password-heading">
                                    <h3 class="text-center">Forgot Password?</h3>
                                    <p class="text-center">Enter your email to reset your password</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <form id="forgot-password-form" class="form" action="" method="post">

                                    <!-- email -->
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="forgot-pass-email">Email</label>
                                            <input type="email" name="email" class="form-control" id="forgot-pass-email" aria-describedby="emailHelp" placeholder="Enter your email" required>
                                        </div>
                                    </div>

                                    <!-- forgot password btn -->
                                    <div class="head-button form-group">
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
    <!-- Forgot Password Ends -->

    <!-- JQuery -->
    <script src="front/js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="front/js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="front/js/script.js"></script>

</body>

</html>