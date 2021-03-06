<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>DashBoard</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- custom nav with profile image CSS -->
    <link rel="stylesheet" href="css/navigation.css">
</head>
<body>
<?php 
    include 'db_conntect.php';
    $userID = $_SESSION['user_id'];  
?>
<?php 
    if(isset($_GET['delete'])) {
        $delete = $_GET['delete'];
        $delete_row = "DELETE FROM sellernotes WHERE ID='delete'";
        $delete_row_query = mysqli_query($conn,$delete_row);
        if(!($delete_row_query)) {
            die("QUERY FAILED".mysqli_error($conn));
        }
        header("location:dashboard.php");
    }
?>
       <!-- Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">
            <div class="container">
                <div class="row">
                    <!-- Logo -->
                   <div class="navbar-header col-lg-3 col-10">
                        <a class="navbar-brand text-left" href="#">
                            <img src="images/home/logo.png" alt="logo">
                        </a>
                    </div>
                    <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="mobile-nav-close-btn">&times;</span>
                        <span class="mobile-nav-open-btn">&#9776;</span>
                    </button>
                    <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="search-notes.php">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link" href="buyer-request.php">Buyer Requests</a></li>
                            <li class="nav-item"><a class="nav-link" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>
                            <li class="nav-item profile-dropdown dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="images/notes-details/reviewer-1.png" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="user-profile.php">My Profile</a>
                                    <a class="dropdown-item" href="my-downloads.html">My Downloads</a>
                                    <a class="dropdown-item" href="my-sold-notes.html">My Sold Notes</a>
                                    <a class="dropdown-item" href="my-rejected-notes.html">My Rejected Notes</a>
                                    <a class="dropdown-item" href="change-password.html">Change Password</a>
                                    <a class="dropdown-item logout" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="http://localhost/Notes-marketplace/SRS_Notes/front/logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navigation Bar END -->
    <!-- Dashboard section -->
    <section id="dashboard">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                        <div class="title">
                            <h3 class="text-left">Dashboard</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                        <div class="add-note-btn text-right">
                            <a class="btn btn-add-note" href="add-notes.php" title="Add Note" role="button">Add Note</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 earning-box">
                        <div class="my-earning-box text-center" id="my-earning">
                            <img src="images/Dashboard/my-earning.png">
                            <h5>My Earning</h5>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 box-lg">
                        <div class="dashboard-box dashboard-box-lg">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
                                    <h3 class="heading-numeric">100</h3>
                                    <p>Number of Notes Sold</p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-12 text-center">
                                    <h3 class="heading-numeric">$10,000</h3>
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">100</h3>
                            <p>My Downloads</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">12</h3>
                            <p>My Rejected Notes</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-12 col-sm-12 same-box">
                        <div class="dashboard-box notes-earning-info text-center">
                            <h3 class="heading-numeric">100</h3>
                            <p>Buyer Request</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- DashBoard Ends -->
    <!-- In Progress Notes Table Section -->
    <section id="in-progress-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading-sm">
                            <h3>In Progress Notes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                            <form action="" method="get">
                            <div class="form-row">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-4 col-sm-4 table-search-btn">
                                <div id="search-btn">
                                    <a class="btn search-btn" href="#" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 co-12">
                        <div class="in-progress-table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header dashboard-date">ADDED DATE</th>
                                        <th scope="col" class="table-header">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">STATUS</th>
                                        <th scope="col" class="table-header">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  
                                        if(isset($_GET['page'])){
                                            $page = $_GET['page'];
                                            $page =mysqli_real_escape_string($conn,$page);
                                            $page = htmlentities($page);
                                        }else{
                                            $page = 1;
                                        }
                                        $fetch_num_query = "SELECT * FROM sellernotes WHERE sellerID='$userID' AND Status IN ( 6, 7, 8)";
                                        $fetch_num = mysqli_query($conn,$fetch_num_query);
                                        $total_records = mysqli_num_rows($fetch_num);
                                        $num_per_page = 05;
                                        $total_pages = ceil($total_records / $num_per_page);
                                        $start_from = ($page-1)*$num_per_page;
                                        $fetch_progress_query = "SELECT sellernotes.Status AS s_id,sellernotes.CreatedDate AS added_date,sellernotes.Title AS title,sellernotes.ID as noteid, notecategories.Name AS category,referencedata.Value AS status FROM sellernotes,referencedata,notecategories WHERE sellernotes.Status = referencedata.ID AND sellernotes.Category = notecategories.ID AND sellernotes.Status IN ( 6, 7, 8) LIMIT $start_from,$num_per_page";
                                        $progress_notes = mysqli_query($conn,$fetch_progress_query);
                                        while ($progress_row = mysqli_fetch_array($progress_notes)) {  
                                        ?>
                                            <tr>
                                                <td><?php echo $progress_row["added_date"]; ?></td>
                                                <td><?php echo $progress_row["title"]; ?></td>
                                                <td><?php echo $progress_row["category"]; ?></td>
                                                <td><?php echo $progress_row["status"]; ?></td>
                                                <?php 
                                                    $id = $progress_row["noteid"];
                                                    if( $progress_row["s_id"] == 6 ){ echo "<td><a href='edit-notes.php?edit=$id'><img src='images/Dashboard/edit.png' alt='edit'><a href='?delete=$$id' id='dlt-link' onclick='return chk()'><img src='images/Dashboard/delete.png' alt='delete'></td>"; }
                                                    else{
                                                        echo "<td><a href='http://localhost/Notes-marketplace/SRS_Notes/front/notes-details.php'><img src='images/Dashboard/eye.png' alt='view'></td>";
                                                    }?>
                                            </tr>
                                        <?php  
                                        };  
                                        ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="<?php if($page == 1){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="dashboard.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                                <span aria-hidden="true"><img src="images/Search/left-arrow.png" alt="previous"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <?php
                            for($i=1;$i<=$total_pages;$i++){
                            ?>  
                                <li class="<?php if($page == $i) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="dashboard.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            <?php
                            }
                            ?>
                        <li class="<?php if($page == $total_pages){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="dashboard.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
                                <span aria-hidden="true"><img src="images/Search/right-arrow.png" alt="next"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- In Progress Notes Table Section Ends -->
    <!-- Published Notes Table Section -->
    <section id="published-notes">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading-sm">
                            <h3>Published Notes</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="row text-right">
                           <form>
                           <div class="form-row">
                            <div class="col-md-8 col-lg-8 col-8 col-sm-8 table-search-bar">
                                <div class="form-group">
                                    <input type="search" class="form-control" id="search" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-4 col-sm-4 table-search-btn">
                                <div id="search-btn">
                                    <a class="btn search-btn" href="#" title="search" role="button">SEARCH</a>
                                </div>
                            </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                        <div class="published-notes-table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header dashboard-date">ADDED DATE</th>
                                        <th scope="col" class="table-header">TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        if(isset($_GET['page1'])){
                                            $page1 = $_GET['page1'];
                                            $page1 =mysqli_real_escape_string($conn,$page1);
                                            $page1 = htmlentities($page1);
                                        }else{
                                            $page1 = 1;
                                        }
                                        $fetch_num_query1 = "SELECT * FROM sellernotes WHERE sellerID='$userID' AND Status=9";
                                        $fetch_num1 = mysqli_query($conn,$fetch_num_query1);
                                        $total_records1 = mysqli_num_rows($fetch_num1);
                                        $num_per_page1 = 05;
                                        $total_pages1 = ceil($total_records1 / $num_per_page1);
                                        $start_from1 = ($page1-1) * $num_per_page1;
                                        $fetch_progress_query1 = "SELECT sellernotes.Status AS s_id,sellernotes.CreatedDate AS added_date,sellernotes.Title AS title,sellernotes.IsPaid AS ispaid,sellernotes.SellingPrice AS price,notecategories.Name AS category,referencedata.Value AS status FROM sellernotes,referencedata,notecategories WHERE sellernotes.Status = referencedata.ID AND sellernotes.Category = notecategories.ID AND sellernotes.Status= 9 LIMIT $start_from1,$num_per_page1";
                                        $progress_notes1 = mysqli_query($conn,$fetch_progress_query1);
                                        while ($progress_row1 = mysqli_fetch_array($progress_notes1)) {  
                                        ?>
                                            <tr>
                                                <td><?php echo $progress_row1["added_date"]; ?></td>
                                                <td><?php echo $progress_row1["title"]; ?></td>
                                                <td><?php echo $progress_row1["category"]; ?></td>
                                                <td><?php if( $progress_row1["ispaid"] == 0) { echo 'Free';} else {
                                                echo "Paid";} ?></td>
                                                <td><?php echo "$".$progress_row1["price"]; ?></td>
                                                <td><?php 
                                                    if( $progress_row1["s_id"] == 9 ){
                                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/Notes-marketplace/SRS_Notes/front/notes-details.php"><img src="images/dashboard/eye.png" alt="view"></a>';
                                                    }?></td>
                                            </tr>
                                        <?php  
                                        };  
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="<?php if($page1 == 1){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="dashboard.php?page1=<?php echo $page1-1 ; ?>" aria-label="Previous">
                                <span aria-hidden="true"><img src="images/Search/left-arrow.png" alt="previous"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                            <?php
                            for($j=1;$j<=$total_pages1;$j++){
                            ?>  
                                <li class="<?php if($page1 == $j) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="dashboard.php?page1=<?php echo $j ; ?>"><?php echo $j ;?></a></li>
                            <?php
                            }
                            ?>
                        <li class="<?php if($page1 == $total_pages1){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="dashboard.php?page1=<?php echo $page1+1 ; ?>" aria-label="Next">
                                <span aria-hidden="true"><img src="images/Search/right-arrow.png" alt="next"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Published Notes Table Section Ends -->
    <!-- Section Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- Copyright -->
                <div class="col-md-7 col-sm-8 footer-text text-left">
                    <p>Copyright &copy; TatvaSoft All Rights Reserved By</p>
                </div>
                <!-- Social Icon -->
                <div class="col-md-5 col-sm-4 foot-icon text-right">
                    <ul class="social-list">
                        <li><a href="#"><img src="images/User-Profile/facebook.png" alt="facbook"></a></li>
                        <li><a href="#"><img src="images/User-Profile/twitter.png" alt="twitter"></a></li>
                        <li><a href="#"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Section Footer END -->
    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
        function chk() {
            if(confirm("yesh or no")){
                return true;
            }else {
                return false;
            }
        }
    </script>
</body>
</html>