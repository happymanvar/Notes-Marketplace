<?php

$fb_url = mysqli_query($conn, "SELECT value FROM systemconfigurations WHERE configurationkey = 'facebookurl'");
if (!($fb_url)) {
    die("QUERY FAILED" . mysqli_error($conn));
}
$fb_url = mysqli_fetch_row($fb_url);
$fb_url = $fb_url[0];
$twitter_url = mysqli_query($conn, "SELECT value FROM systemconfigurations WHERE configurationkey = 'twitterurl'");
if (!($twitter_url)) {
    die("QUERY FAILED" . mysqli_error($conn));
}
$twitter_url = mysqli_fetch_row($twitter_url);
$twitter_url = $twitter_url[0];
$linkedin_url = mysqli_query($conn, "SELECT value FROM systemconfigurations WHERE configurationkey = 'linkedinurl'");
if (!($linkedin_url)) {
    die("QUERY FAILED" . mysqli_error($conn));
}
$linkedin_url = mysqli_fetch_row($linkedin_url);
$linkedin_url = $linkedin_url[0];

?>


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
                    <li><a href="<?php echo $fb_url; ?>"><img src="images/User-Profile/facebook.png" alt="facbook"></a></li>
                    <li><a href="<?php echo $twitter_url; ?>"><img src="images/User-Profile/twitter.png" alt="twitter"></a></li>
                    <li><a href="<?php echo $linkedin_url; ?>"><img src="images/User-Profile/linkedin.png" alt="linkedin"></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
<!-- Section Footer END -->
