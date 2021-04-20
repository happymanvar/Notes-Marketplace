<?php
include 'db_conntect.php';
?>

<section>
    <?php
    if (isset($_POST['page'])) {
        $page = (int)$_POST['page'];
    } else {
        $page = "";
    }

    if ($page == "" || $page == 1) {
        $page1 = 0;
    } else {
        $page1 = ($page * 9) - 9;
    }
    ?>

    <?php
    $sql = "SELECT *,sellernotes.ID AS id , AVG(Ratings) AS avgratings FROM sellernotes LEFT JOIN sellernotesreviews ON sellernotesreviews.NoteID = sellernotes.ID WHERE Status = 9";
    if (isset($_POST['dropdown'])) {
        $type = $_POST['note-type'];
        $category = $_POST['note-category'];
        $university = $_POST['university'];
        $course = $_POST['course'];
        $country = $_POST['country'];
        $ratings = $_POST['rating'];

        if ($type != "") {

            $sql .= " AND NoteType=$type";
        }

        if ($category != "") {

            $sql .= " AND Category=$category";
        }
        if ($university != "") {

            $sql .= " AND UniversityName='{$university}'";
        }
        if ($course != "") {

            $sql .= " AND Course='{$course}'";
        }
        if ($country != "") {

            $sql .= " AND Country=$country";
        }
    }
    if (isset($_POST['input'])) {
        $title = $_POST['search-notes'];

        if ($title != "") {
            $sql .= " AND Title LIKE '%$title%'";
        }
    }
    $sql .= " GROUP BY sellernotes.ID";
    if (isset($ratings)) {
        if ($ratings != "") {
            $sql .= " HAVING avgratings >= $ratings";
        }
    }

    $result = mysqli_query($conn, $sql);
    if (!($result)) {
        die("QUERY FAILED" . mysqli_error($conn));
    }
    $count = mysqli_num_rows($result);

    ?>
    <div class="conent-box-sm">
        <div class="container">
            <div class="row">
                <div class="search-title col-md-12 col-lg-12 col-12 col-sm-12">
                    <h3><?php
                        if ($count == 0) {
                            echo "No Notes Availiable";
                        } else {
                            echo "Total $count Notes";
                        }
                        ?>
                    </h3>
                </div>
            </div>

            <div class="row note-results">

                <?php

                $sql .= " LIMIT $page1,9";
                $select_query = mysqli_query($conn, $sql);
                if (!($select_query)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                }

                while ($data = mysqli_fetch_assoc($select_query)) {
                    $noteid = $data['id'];
                    $userid = $data['SellerID'];
                    $dpname = $data['DisplayPicture'];
                    if (isset($data['avgratings'])) {
                        $ratings = round($data['avgratings']);
                    } else {
                        $ratings = 0;
                    }
                ?>
                    <div class="col-md-4 col-lg-4 col-12 col-sm-12 notes">
                        <!-- note Table 01 -->
                        <div class="note-table">
                            <div class="note-image">
                                <?php
                                if ($dpname != "") {
                                    echo "<img src='../Members/$userid/$noteid/$dpname' alt='notecoverimage' class='img-responsive'>";
                                } else {
                                    echo "<img src='images/Search/1.jpg' alt='notecoverimage' class='img-responsive'>";
                                }
                                ?>
                            </div>
                            <div class="note-info">
                                <div class="note-title">
                                    <div class="row">
                                        <div class="col-md-12 col-12 col-sm-12">
                                            <a href="notes-details.php?id=<?php echo "$noteid"; ?>">
                                                <p><?php echo $data['Title']; ?></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="detail">
                                    <?php
                                    $cid = $data['Country'];
                                    $getcou = "SELECT * FROM countries WHERE ID = '$cid'";
                                    $getcquery = mysqli_query($conn, $getcou);
                                    $cdata = mysqli_fetch_assoc($getcquery);

                                    ?>
                                    <li><img src="images/Search/university.png" alt="university"><?php echo $data['UniversityName'] . ", " . $cdata['Name']; ?></li>
                                    <li><img src="images/Search/pages.png" alt="notebook"><?php echo $data['NumberofPages'] . " Pages"; ?></li>
                                    <li><img src="images/Search/date.png" alt="date"><?php $pdate = $data['PublishedDate'];
                                                                                        $date = strtotime($pdate);
                                                                                        echo date('D, M j Y', $date); ?></li>
                                    <li><img src="images/Search/flag.png" alt="flag">
                                        <?php
                                        $issue = "SELECT * FROM sellernotesreportedissues WHERE NoteID = $noteid";
                                        $issuequery = mysqli_query($conn, $issue);
                                        $countissue = mysqli_num_rows($issuequery);
                                        echo "$countissue Users marked this note as inappropriate";
                                        ?></li>
                                </ul>
                                <div class="rate">
                                    <?php
                                    $getrating = "SELECT AVG(Ratings) AS Averagerating, COUNT(Ratings) AS counts FROM sellernotesreviews WHERE NoteID = $noteid";
                                    $ratingquery = mysqli_query($conn, $getrating);
                                    $avgrating = mysqli_fetch_assoc($ratingquery);
                                    $rating = $avgrating['Averagerating'];
                                    $countrating = $avgrating['counts'];

                                    for ($j = 1; $j <= $ratings; $j++) {
                                    ?>
                                        <img src="images/Search/star.png">
                                    <?php
                                    }
                                    for ($k = 1; $k <= 5 - $ratings; $k++) {
                                    ?>
                                        <img src="images/Search/star-white.png">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="rating-text">
                                    <p><?php echo $countrating; ?> reviews</p>
                                </div>
                            </div>


                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
            <?php
            $count1 = ceil($count / 9);
            ?>

            <div class="row justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href='#'>
                                <img src="images/Search/left-arrow.png" alt="previous" class="left-arrow">
                            </a>
                        </li>
                        <?php


                        for ($i = 1; $i <= $count1; $i++) {
                            if ($i == $page || ($page == "" && $i == 1)) {
                                echo "<li class='active page-item'><a class='page-link' href=''>$i</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href=''>$i</a></li>";
                            }
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href='#'>
                                <img src="images/Search/right-arrow.png" alt="next" class="right-arrow">

                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>


</section>
