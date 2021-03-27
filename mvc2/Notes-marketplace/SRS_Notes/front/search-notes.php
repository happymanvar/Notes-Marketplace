<?php
session_start();

$page = 'search-notes';
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- important meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Search Notes</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- custom nav CSS -->
    <link rel="stylesheet" href="css/navigation.css">

</head>

<body>

    <?php
    if (isset($_SESSION['is_loggedin'])) {
        include 'login-header.php';
    } else {
        include 'logout-header.php';
    }

    include 'db_conntect.php';
    ?>


    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="head-part-inner">
                        <div class="col-md-12">
                            <div class="header-statement" class="text-center">
                                <h3>Search Notes</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->


    <!-- Search Notes Starts-->
    <section id="search-filter">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="search-title col-md-12 col-lg-12">
                        <h3>Search and Filter notes</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="search-content col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="search-container">
                            <form>
                                <div class="form-group col-md-12 col-lg-12 col-12 col-sm-12">
                                    <input type="search" class="form-control" id="search-notes" placeholder="Search notes here.." name="search-notes">
                                </div>

                                <div class="form-group col-md-12 col-lg-12 col-12 col-sm-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <?php
                                            $gettypequery = "SELECT * FROM notetypes WHERE IsActive = b'1'";
                                            $typequery = mysqli_query($conn, $gettypequery);
                                            $typerows = mysqli_num_rows($typequery);
                                            ?>
                                            <select id="type" name="note-type" class="form-control">
                                                <option selected value="">Select type</option>
                                                <?php
                                                for ($i = 1; $i <= $typerows; $i++) {
                                                    $typerow = mysqli_fetch_array($typequery);
                                                ?>
                                                    <option value="<?php echo $typerow["ID"] ?>"><?php echo $typerow["Name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <?php
                                            $getcategoryquery = "SELECT * FROM notecategories WHERE IsActive = b'1'";
                                            $categoryquery = mysqli_query($conn, $getcategoryquery);
                                            $categoryrows = mysqli_num_rows($categoryquery);
                                            ?>
                                            <select id="category" name="note-category" class="form-control">
                                                <option selected value="">Select category</option>
                                                <?php
                                                for ($i = 1; $i <= $categoryrows; $i++) {
                                                    $categoryrow = mysqli_fetch_array($categoryquery);
                                                ?>
                                                    <option value="<?php echo $categoryrow["ID"] ?>"><?php echo $categoryrow["Name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <?php
                                            $getuniquery = "SELECT DISTINCT UniversityName FROM `sellernotes` WHERE IsActive = b'1' ORDER BY UniversityName";
                                            $uniquery = mysqli_query($conn, $getuniquery);
                                            $unirows = mysqli_num_rows($uniquery);
                                            ?>
                                            <select id="university" name="university" class="form-control">
                                                <option selected value="">Select university</option>
                                                <?php
                                                for ($i = 1; $i <= $unirows; $i++) {
                                                    $unirow = mysqli_fetch_array($uniquery);
                                                ?>
                                                    <option value="<?php echo $unirow["UniversityName"] ?>"><?php echo $unirow["UniversityName"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <?php
                                            $getcoursequery = "SELECT DISTINCT Course FROM `sellernotes` WHERE IsActive = b'1' ORDER BY Course";
                                            $coursequery = mysqli_query($conn, $getcoursequery);
                                            $courserows = mysqli_num_rows($coursequery);
                                            ?>
                                            <select id="course" name="course" class="form-control">
                                                <option selected value="">Select course</option>
                                                <?php
                                                for ($i = 1; $i <= $courserows; $i++) {
                                                    $courserow = mysqli_fetch_array($coursequery);
                                                ?>
                                                    <option value="<?php echo $courserow["Course"] ?>"><?php echo $courserow["Course"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <?php
                                            $getcountryquery = "SELECT * FROM `countries` WHERE IsActive = b'1'";
                                            $countryquery = mysqli_query($conn, $getcountryquery);
                                            $countryrows = mysqli_num_rows($countryquery);
                                            ?>
                                            <select id="country" name="country" class="form-control">
                                                <option selected value="">Select country</option>
                                                <?php
                                                for ($i = 1; $i <= $countryrows; $i++) {
                                                    $countryrow = mysqli_fetch_array($countryquery);
                                                ?>
                                                    <option value="<?php echo $countryrow["ID"] ?>"><?php echo $countryrow["Name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 col-lg-2 col-6 col-sm-6">
                                            <select id="rating" name="rating" class="form-control">
                                                <option selected value="">Select rating</option>
                                                <option value="1">1+</option>
                                                <option value="2">2+</option>
                                                <option value="3">3+</option>
                                                <option value="4">4+</option>
                                                <option value="5">5+</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Notes Ends -->

    <!-- Note List Starts -->
    <section id="note-list">

    </section>
    <!-- Note List Ends -->

    <?php
    include 'footer.php';
    ?>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {
            var page = 1;
            $('#note-list').load('filter_notes.php');
            $('#note-list').on('click', 'a.page-link', function(e) {
                e.preventDefault();
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();
                var title = $('input').val();


                if ($(this).find('.left-arrow').attr('class') == $('.left-arrow').attr("class")) {

                    if (parseInt($('.active .page-link').text()) == 1) {
                        var page = parseInt($('.active .page-link').text());

                    } else {
                        var page = parseInt($('.active .page-link').text()) - 1;
                    }
                } else if ($(this).find('.right-arrow').attr('class') == $('.right-arrow').attr("class")) {

                    if (parseInt($('.active .page-link').text()) == parseInt($(this).parent().prev().text())) {
                        var page = parseInt($('.active .page-link').text());
                    } else {
                        var page = parseInt($('.active .page-link').text()) + 1;
                    }
                } else {
                    var page = $(this).text();
                }

                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'search-notes': title,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(res) {
                        $('#note-list').html(res);
                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });

            $('select').change(function() {
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();

                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(response) {
                        $("#note-list").html(response);

                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });


            $("input").keyup(function() {
                var title = $(this).val();
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();
                $.ajax({
                    url: "filter_notes.php",
                    type: "POST",
                    data: {
                        'search-notes': title,
                        'input': "input",
                        'note-type': type,
                        'note-category': category,
                        'university': university,
                        'course': course,
                        'country': country,
                        'rating': rating,
                        'dropdown': "dropdown",
                        'page': page
                    },
                    dataType: "text",
                    success: function(res) {
                        $('#note-list').html(res);
                    },
                    error: function(err) {
                        console.log(err.statusText);
                    },
                });
            });
        });
    </script>

</body>

</html>