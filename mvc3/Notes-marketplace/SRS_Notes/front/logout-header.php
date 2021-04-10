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
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'FAQ') {
                                                                        echo 'active';
                                                                    } ?>" href="FAQ.php">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link <?php if ($page == 'contact-us') {
                                                                        echo 'active';
                                                                    } ?>" href="contact-us.php">Contact Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="../login.php">Login</a></li>
                        </ul>

                    </div>

                </div>
            </div>

        </nav>

    </header>
    <!-- Navigation Bar END -->