<?php
session_start();
ob_start();

if (isset($_SESSION['msg'])) {
    $message = $_SESSION['msg'];
?>
    <script>
        <?php echo "alert('$message');"; ?>
    </script>
<?php
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
    <title>Login</title>

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
    $user_id = "";

    if (isset($_POST['submit'])) {
        $email = $_POST['login-email'];
        $loginpassword = $_POST['email-password'];

        $email_search = "SELECT * FROM users WHERE EmailID='$email' and IsEmailVarified = b'1'";
        $query = mysqli_query($conn, $email_search);

        $email_count = mysqli_num_rows($query);

        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass = $email_pass['Password'];
            $user_id = $email_pass['ID'];

            $role_id = $email_pass['RoleID'];

            $_SESSION['username'] = $email_pass['FirstName'];
            $_SESSION['lastname'] = $email_pass['LastName'];
            $_SESSION['user_id'] = $email_pass['ID'];
            $_SESSION['is_loggedin'] = "yes";
            $_SESSION['email'] = $email_pass['EmailID'];

            $check_pass = password_verify($loginpassword, $db_pass);

            $checkquery = "SELECT * FROM user_profile WHERE UserID='$user_id'";
            $result = mysqli_query($conn, $checkquery);
            $count = mysqli_num_rows($result);

            if ($check_pass) {
                if (isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time() + 86400);
                    setcookie('passwordcookie', $loginpassword, time() + 86400);

                    if ($count == 0 && $role_id == 3) {
                        header('location:front/user-profile.php');
                    } else if ($count == 1 && $role_id == 3) {
                        header('location:front/search-notes.php');
                    } else if ($role_id == 2) {
                        $_SESSION['is_admin'] = "yes";
                        header('location:admin/admin-dashboard.php');
                    } else if ($role_id == 1) {
                        $_SESSION['is_superadmin'] = "yes";
                        header('location:admin/admin-dashboard.php');
                    }
                } else {
                    if ($count == 0 && $role_id == 3) {
                        header('location:front/user-profile.php');
                    } else if ($count == 1 && $role_id == 3) {
                        header('location:front/search-notes.php');
                    } else if ($role_id == 2) {
                        $_SESSION['is_admin'] = "yes";
                        header('location:admin/admin-dashboard.php');
                    } else if ($role_id == 1) {
                        $_SESSION['is_superadmin'] = "yes";
                        header('location:admin/admin-dashboard.php');
                    }
                }
            } else {
    ?>
                <script>
                    alert("password incorect, Please enter correct password")
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Email you have entered is invalid, Please enter valid email address")
            </script>
    <?php
        }
    }



    ?>

    <!-- Login -->

    <section id="login">
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
                                <div class="login-heading">
                                    <h3 class="text-center">Login</h3>
                                    <p class="text-center">Enter your email address and password to login</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <form id="login-form" class="form" action="" method="post">

                                    <!-- email -->
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-12 col-lg-12 col-sm-12">
                                            <label for="login-email">Email</label>
                                            <input type="email" name="login-email" class="form-control" id="login-email" aria-describedby="emailHelp" placeholder="Enter your email" value="<?php if (isset($_COOKIE['emailcookie'])) {
                                                                                                                                                                                                echo $_COOKIE['emailcookie'];
                                                                                                                                                                                            } ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12 col-12 col-sm-12 col-lg-12">
                                            <div class="password-forgotpass">
                                                <label for="email-password" class="text-left">Password</label>
                                                <a href="forgot-password.php" class="text-right">Forgot Password ?</a>
                                            </div>
                                            <div class="password-input">
                                                <input id="email-password" name="email-password" type="password" class="form-control" placeholder="Enter your Password" value="<?php if (isset($_COOKIE['passwordcookie'])) {
                                                                                                                                                                                    echo $_COOKIE['passwordcookie'];
                                                                                                                                                                                } ?>" required>
                                                <img src="front/images/pre-login/eye.png" toggle="#email-password" class="field-icon toggle-password" />

                                            </div>
                                            <small id="passwordHelpBlock" class="form-text" hidden>
                                                The password that you've entered is incorrect
                                            </small>
                                        </div>
                                    </div>

                                    <!-- remember me -->
                                    <div class="form-row">
                                        <div class="form-group form-check col-12 col-lg-12 col-md-12 col-sm-12">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberme">
                                            <label class="form-check-label" for="exampleCheck1"> Remember Me</label>
                                        </div>
                                    </div>

                                    <!-- login btn -->
                                    <div class="head-button">
                                        <button type="submit" name="submit" class="btn pre-login-btns">Login</button>
                                        <!--<a class="btn pre-login-btns" id="login-btn" href="#" title="Login" role="button">Login</a>-->
                                    </div>
                                    <!-- signup -->
                                    <p class="text-center sign-up-text">Don't have an account? <a href="front/signup.php">Sign Up</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Ends -->

    <!-- JQuery -->
    <script src="front/js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="front/js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="front/js/script.js"></script>

</body>

</html>