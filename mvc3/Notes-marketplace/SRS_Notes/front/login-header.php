    <?php include 'db_conntect.php';
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
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'search-notes') {
                                                                        echo 'active';
                                                                    } ?>" href="search-notes.php">Search Notes</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'dashboard') {
                                                                        echo 'active';
                                                                    } ?>" href="dashboard.php">Sell Your Notes</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'buyer-request') {
                                                                        echo 'active';
                                                                    } ?>" href="buyer-request.php">Buyer Requests</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'FAQ') {
                                                                        echo 'active';
                                                                    } ?>" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'contact-us') {
                                                                        echo 'active';
                                                                    } ?>" href="contact-us.php">Contact Us</a></li>
                            <li class="nav-item profile-dropdown dropdown">
                                <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $user_id = $_SESSION['user_id'];

                                    $userdp = "SELECT * FROM user_profile WHERE UserID = $user_id";
                                    $userdpquery = mysqli_query($conn, $userdp);
                                    if (!($userdpquery)) {
                                        die("QUERY FAILED" . mysqli_error($conn));
                                    } else {
                                        $rowdata = mysqli_fetch_assoc($userdpquery);
                                        $dpname = $rowdata['Profile Picture'];
                                        if ($dpname != "") {
                                            echo "<img src='../Members/$user_id/$dpname' class='rounded-circle'>";
                                        } else {
                                            echo "<img src='images/notes-details/reviewer-1.png' class='rounded-circle'>";
                                        }
                                    }

                                    ?>

                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="user-profile.php">My Profile</a>
                                    <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                    <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                    <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                    <a class="dropdown-item" href="../change-password.php">Change Password</a>
                                    <a class="dropdown-item logout btn-logout" href="../logout.php">Logout</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link btn-logout" href="../logout.php">Logout</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->
