<header>

    <nav class="navbar navbar-expand-lg white-navbar navbar-fixed-height fixed-top">

        <div class="container">
            <div class="row">

                <!-- Logo -->
                <div class="navbar-header col-lg-3 col-10">

                    <a class="navbar-brand text-left" href="#">
                        <img src="admin-images/images/logo.png" alt="logo">
                    </a>

                </div>

                <button class="navbar-toggler collapsed col-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="mobile-nav-close-btn">&times;</span>
                    <span class="mobile-nav-open-btn">&#9776;</span>
                </button>

                <div class="collapse navbar-collapse col-lg-9" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item"><a class="nav-link <?php if ($page == 'dashboard') {
                                                                    echo 'active';
                                                                } ?>" href="admin-dashboard.php">Dashboard</a></li>

                        <li class="nav-item notes-dropdown">
                            <a class="nav-link <?php if ($page == 'notes') {
                                                    echo 'active';
                                                } ?>" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Notes</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="notes-under-review.php">Notes Under Review</a>
                                <a class="dropdown-item" href="published-notes.php">Published Notes</a>
                                <a class="dropdown-item" href="downloaded-notes.php">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejected-notes.php">Rejected Notes</a>
                            </div>
                        </li>

                        <li class="nav-item"><a class="nav-link <?php if ($page == 'members') {
                                                                    echo 'active';
                                                                } ?>" href="mambers.php">Members</a></li>

                        <li class="nav-item reports-dropdown">
                            <a class="nav-link <?php if ($page == 'spam-reports') {
                                                    echo 'active';
                                                } ?>" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Reports</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="spam-report.php">Spam Reports</a>
                            </div>
                        </li>

                        <li class="nav-item setting-dropdown">
                            <a class="nav-link <?php if ($page == 'settings') {
                                                    echo 'active';
                                                } ?>" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Settings</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="manage-system-config.php" <?php if (!isset($_SESSION['is_superadmin'])) {
                                                                                                echo "hidden";
                                                                                            } ?>>Manage System Configuration</a>
                                <a class="dropdown-item" href="manage-administrator.php" <?php if (!isset($_SESSION['is_superadmin'])) {
                                                                                                echo "hidden";
                                                                                            } ?>>Manage Administrator</a>
                                <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                            </div>
                        </li>

                        <li class="nav-item profile-dropdown">
                            <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="admin-images/images/reviewer-1.png" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="my-profile.php">Update Profile</a>
                                <a class="dropdown-item" href="../change-password.php">Change Password</a>
                                <a class="dropdown-item logout-action" href="../logout.php"><span>Logout</span></a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
                    </ul>

                </div>

            </div>
        </div>

    </nav>

</header>