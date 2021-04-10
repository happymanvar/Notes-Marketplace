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
            $catid = $_GET['id'];
            $getcat = "SELECT * FROM notecategories WHERE ID = '$catid'";
            $getcatquery = mysqli_query($conn, $getcat);
            if (!($getcatquery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            } else {
                $catdata = mysqli_fetch_assoc($getcatquery);
                $catname = $catdata['Name'];
                $catdesc = $catdata['Description'];
                $editcat = 1;
            }
        }

        if (isset($_POST['submit'])) {
            $cname = $_POST['catname'];
            $cdesc = $_POST['catdesc'];

            if (isset($editcat)) {
                $updatecat = "UPDATE notecategories SET `Name` = '$cname', `Description` = '$cdesc', `ModifiedDate` = current_timestamp(), `ModifiedBy` = '$adminid' WHERE ID = '$catid'";
                $updatequery = mysqli_query($conn, $updatecat);
                if (!($updatequery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {
                    header('location:manage-category.php');
                }
            } else {
                $insertcategory = "INSERT INTO `notecategories` (`Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ('$cname', '$cdesc', current_timestamp(), '$adminid', current_timestamp(), '$adminid', b'1')";
                $categoryquery = mysqli_query($conn, $insertcategory);

                if (!($categoryquery)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {
                    header('location:add-category.php');
                }
            }
        }

        ?>

     <!-- Navigation Bar -->
     <?php
        //include 'admin-header.php';
        ?>
     <!-- Navigation Bar END -->

     <!-- Add Category Starts -->
     <section id="add-category">
         <div class="content-box">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12 col-12">
                         <div class="horizontal-heading">
                             <h3>Add Category</h3>
                         </div>
                     </div>

                     <div class="col-md-6 col-12">
                         <form action="" method="POST">


                             <div class="form-group">
                                 <label for="category-name">Category Name *</label>
                                 <input type="text" class="form-control" name="catname" id="category-name" placeholder="Enter your category name" <?php if (isset($catname)) {
                                                                                                                                                        echo "value = $catname";
                                                                                                                                                    } ?> required>
                             </div>
                             <div class="form-group">
                                 <label for="description">Description *</label>
                                 <textarea class="form-control" id="description" name="catdesc" placeholder="Enter your description" required><?php if (isset($catdesc)) {
                                                                                                                                                    echo $catdesc;
                                                                                                                                                } ?></textarea>
                             </div>

                             <div id="add-category-submit-btn">
                                 <!--<a class="btn general-btn" href="#" title="Submit" role="button">SUBMIT</a>-->
                                 <button type="submit" id="add-category-btn" name="submit" class="btn general-btn">submit</button>
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