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
     <title>ADD Type</title>

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
            $typeid = $_GET['id'];
            $gettype = "SELECT * FROM notetypes WHERE ID = '$typeid'";
            $gettypequery = mysqli_query($conn, $gettype);
            if (!($gettypequery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            } else {
                $typedata = mysqli_fetch_assoc($gettypequery);
                $typename = $typedata['Name'];
                $typedesc = $typedata['Description'];
                $edittype = 1;
            }
        }

        if (isset($_POST['submit'])) {
            $tname = $_POST['typename'];
            $tdesc = $_POST['typedesc'];

            if (isset($edittype)) {
                $updatetype = "UPDATE notetypes SET `Name` = '$tname', `Description` = '$tdesc', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$typeid'";
                $updatequery = mysqli_query($conn, $updatetype);
                if (!($updatequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {
                    header('location:manage-type.php');
                }
            } else {
                $inserttype = "INSERT INTO `notetypes` (`Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('$tname', '$tdesc', current_timestamp(), '$adminid', current_timestamp(), '$adminid', b'1')";
                $typequery = mysqli_query($conn, $inserttype);

                if (!($typequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {
                    header('location:add-type.php');
                }
            }
        }
        ?>

     <!-- Navigation Bar -->
     <?php
        include 'admin-header.php';
        ?>
     <!-- Navigation Bar END -->

     <!-- Add Type Starts -->
     <section id="add-type">
         <div class="content-box">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12 col-12">
                         <div class="horizontal-heading">
                             <h3>Add Type</h3>
                         </div>
                     </div>

                     <div class="col-md-6 col-12">
                         <form action="" method="POST">


                             <div class="form-group">
                                 <label for="type">Type *</label>
                                 <input type="text" class="form-control" name="typename" id="type" placeholder="Enter type" <?php if (isset($typename)) {
                                                                                                                                echo "value = $typename";
                                                                                                                            } ?> required>
                             </div>
                             <div class="form-group">
                                 <label for="description">Description *</label>
                                 <textarea class="form-control" id="description" name="typedesc" placeholder="Enter your description" required><?php if (isset($typedesc)) {
                                                                                                                                                    echo $typedesc;
                                                                                                                                                } ?></textarea>
                             </div>

                             <div id="add-type-submit-btn">
                                 <!--<a class="btn general-btn" href="#" title="Submit" role="button">SUBMIT</a>-->
                                 <button type="submit" id="add-type-btn" name="submit" class="btn general-btn">submit</button>
                             </div>
                         </form>

                     </div>
                 </div>

             </div>
         </div>
     </section>
     <!-- Add Type Ends -->

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