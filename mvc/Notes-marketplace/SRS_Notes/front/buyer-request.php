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
    <title>Buyer Request</title>

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
    $email = $_SESSION['email'];


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

    <!-- Buyer request Table -->
    <section id="buyer-request">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="horizontal-heading">
                            <h3>Buyer Requests</h3>
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
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="buyer-request-table table-responsive">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-header">SR NO.</th>
                                        <th scope="col" class="table-header title">NOTE TITLE</th>
                                        <th scope="col" class="table-header">CATEGORY</th>
                                        <th scope="col" class="table-header">BUYER</th>
                                        <th scope="col" class="table-header date">PHONE NO.</th>
                                        <th scope="col" class="table-header">SELL TYPE</th>
                                        <th scope="col" class="table-header">PRICE</th>
                                        <th scope="col" class="table-header date">DOWNLOADED DATE/TIME</th>
                                        <th scope="col" class="table-header blank"></th>
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
                                    
                                       
                                           // $fetch_num_query = "SELECT * FROM sellernotes WHERE sellerID='$userID' AND Status=9";
                                            $fetch_num_query = "SELECT * FROM sellernotes WHERE Status=9";
                                            $fetch_num = mysqli_query($conn,$fetch_num_query);
                                       
                                        $total_records = mysqli_num_rows($fetch_num);
                                        $num_per_page = 10;
                                        $total_pages = ceil($total_records / $num_per_page);
                                        $start_from = ($page-1)*$num_per_page;
                                    
                                    
                                        
                                        $buyer_request_query = "SELECT sellernotes.Status AS s_id,sellernotes.Title AS title,sellernotes.IsPaid AS ispaid,sellernotes.SellingPrice AS price,notecategories.Name AS category,referencedata.Value AS status FROM sellernotes,referencedata,notecategories WHERE sellernotes.Status = referencedata.ID AND sellernotes.Category = notecategories.ID AND sellernotes.Status=9 LIMIT $start_from,$num_per_page";
                                        $buyer_request = mysqli_query($conn,$buyer_request_query);
                                    
                                        
                                        for($i=1;$i<$buyer_row = mysqli_fetch_array($buyer_request);$i++) {  
                                        ?>
                                            <tr style="height: 50px;">
                                                <td><?php echo $i;?></td>
                                                <td style="color: #6255a5;"><?php echo $buyer_row["title"]; ?></td>
                                                <td><?php echo $buyer_row["category"]; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo "+91 6547793214"; ?></td>
                                                <td><?php if( $buyer_row["ispaid"] == 0) { echo 'Free';} else {
                                                echo "Paid";} ?></td>
                                                <td><?php echo "$".$buyer_row["price"]; ?></td>
                                                <td><?php echo "13 Apr 2020, 11:34:24"; ?></td>
                                                <td class="text-center" style="min-width: 100px;"><?php 
                                                    if( $buyer_row["s_id"] == 9 ){
                                                        echo '&nbsp;<a href="#"><img src="images/dashboard/eye.png" alt="view"></a>&nbsp;<div class="btn-group dropleft">
                                                <button type="button" id="dropdownMenu2" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="images/my-downloades/dots.png" alt="menu" class="">
                                                </button>
                                                <div class="dropdown-menu alow-download" aria-labelledby="dropdownMenu2">
                                                    <button class="dropdown-item" name="alow-download" type="button"><a href="mail-to-buyer.php">Allow Download</a></button>
                                                </div>
                                            </div>';
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
                            <li class="<?php if($page == 1){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="buyer-request.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                                <span aria-hidden="true"><img src="images/Search/left-arrow.png" alt="previous"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            </li>
                    
                            <?php
                    
                            for($i=1;$i<=$total_pages;$i++){
                            ?>  
                                <li class="<?php if($page == $i) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="buyer-request.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            
                            <?php
                            }
                    
                            ?>
                    
                        <li class="<?php if($page == $total_pages){ echo 'disabled'; }?> page-item">
                            <a class="page-link" href="buyer-request.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
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
    <!-- My Downloads Ends -->

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

    <!-- popper JS -->
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>