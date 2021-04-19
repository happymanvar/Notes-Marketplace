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
    <title>Add Notes</title>

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
    include 'send_mail.php';
    ?>
    <?php
    if (!(isset($_SESSION['is_loggedin']))) {
        header("Location:../login.php");
    } else {
        $first_name = $_SESSION['username'];
        $last_name = $_SESSION['lastname'];
        $email_id = $_SESSION['email'];
        $user_id = $_SESSION['user_id'];
    }

    if (!(isset($_GET['edit']))) {
        header("Location:dashboard.php");
    } else {
        $note_id = (int)$_GET['edit'];

        $edit_notes = "SELECT * FROM sellernotes WHERE ID='$note_id'";
        $edit_notes_query = mysqli_query($conn, $edit_notes);
        if (!($edit_notes_query)) {
            die("QUERY FAILED" . mysqli_error($conn));
        }
        $count = mysqli_num_rows($edit_notes_query);

        $row = mysqli_fetch_assoc($edit_notes_query);

        $edit_title = $row['Title'];

        $edit_category = $row['Category'];
        $edit_type = $row['NoteType'];
        $edit_pages = $row['NumberofPages'];
        $description = $row['Description'];
        $country = $row['Country'];
        $institution_name = $row['UniversityName'];
        $course = $row['Course'];
        $course_code = $row['CourseCode'];
        $professor = $row['Professor'];
        $sell = $row['IsPaid'];
        $sell_price = $row['SellingPrice'];
        $edit_dp = $row['DisplayPicture'];
        $edit_cv = $row['NotesPreview'];
        //$flag = 1;
    }

    if (isset($_POST['submit'])) {
        date_default_timezone_set('Asia/Kolkata');
        $save_title = $_POST['title'];

        $save_category = $_POST['category'];
        $save_type = $_POST['note-type'];
        $save_pages = $_POST['number-of-pages'];
        $save_description = $_POST['description'];
        $save_country = $_POST['country'];
        $save_institution_name = $_POST['institute-name'];
        $save_course = $_POST['course-name'];
        $save_course_code = $_POST['course-code'];
        $save_professor = $_POST['professor-name'];
        $save_sell = $_POST['sellingtype'];
        $save_sell_price = $_POST['sellprice'];

        $attachment = $_FILES['notes-data']['name'];
        $attachment_temp = $_FILES['notes-data']['tmp_name'];

        $profile_picture = $_FILES['display-picture']['name'];
        $profile_picture_tmp = $_FILES['display-picture']['tmp_name'];
        $preview_cv = $_FILES['note-preview']['name'];
        $preview_cv_tmp = $_FILES['note-preview']['tmp_name'];
        $accepted_image = array('png', 'jpg', 'jpeg');
        $accepted_pdf = array('pdf');


        if (!empty($_FILES['display-picture']['tmp_name'])) {

            $profile_picture_ext = pathinfo($_FILES["display-picture"]["name"], PATHINFO_EXTENSION);

            $profile_picture = "DP_" . date("dmYhis") . "." . $profile_picture_ext;
        } else {
            $profile_picture = $edit_dp;
            $profile_picture_ext = "jpg";
        }
        if (!empty($_FILES['note-preview']['tmp_name'])) {
            $preview_cv_ext = pathinfo($_FILES["note-preview"]["name"], PATHINFO_EXTENSION);
            $preview_cv = "Preview_" . date("dmYhis") . "." . $preview_cv_ext;
        } else {
            $preview_cv = $edit_cv;
            $preview_cv_ext = "pdf";
        }


        if (!in_array($profile_picture_ext, $accepted_image)) {
            echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
        } elseif (!in_array($preview_cv_ext, $accepted_pdf)) {
            echo "<script>alert('please enter valid image file extension like .jpg ,.jpeg or .png ');</script>";
        }
        $update_query = "UPDATE sellernotes SET Title = '{$save_title}', ";
        $update_query .= "Category = '{$save_category}', ";
        $update_query .= "NoteType = '{$save_type}', ";
        $update_query .= "NumberofPages = '{$save_pages}', ";
        $update_query .= "Country = '{$save_country}', ";
        $update_query .= "UniversityName = '{$save_institution_name}', ";
        $update_query .= "Course = '{$save_course}', ";
        $update_query .= "CourseCode = '{$save_course_code}', ";
        $update_query .= "Professor = '{$save_professor}', ";
        $update_query .= "IsPaid = $save_sell, ";
        $update_query .= "SellingPrice = $save_sell_price, ";
        $update_query .= "DisplayPicture = '{$profile_picture}', ";
        $update_query .= "NotesPreview = '{$preview_cv}' ";
        $update_query .= "WHERE ID= $note_id ";
        $update_select_query = mysqli_query($conn, $update_query);
        if (!($update_select_query)) {
            die("QUERY FAILED" . mysqli_error($conn));
        } else {

            $atta_count = count($_FILES['notes-data']['name']);
            print_r($_FILES['notes-data']['name']);
            if ($attachment_temp[0] != "") {
                $get_attachment = mysqli_query($conn, "SELECT * FROM sellernotesattachements WHERE NoteID = '$note_id'");
                if (!($get_attachment)) {
                    die("QUERY FAILED" . mysqli_error($conn));
                } else {

                    $att_count = mysqli_num_rows($get_attachment);
                    echo "<script> alert('happy')</script>";
                    while ($atta_data = mysqli_fetch_assoc($get_attachment)) {
                        $atta_name = $atta_data['FileName'];
                        if (file_exists("../Members/$user_id/$note_id/Attachements/$atta_name")) {
                            unlink("../Members/$user_id/$note_id/Attachements/$atta_name");
                        }
                    }
                    $delete_atta = mysqli_query($conn, "DELETE FROM sellernotesattachements WHERE NoteID = '$note_id'");
                    if (!($delete_atta)) {
                        die("QUERY FAILED" . mysqli_error($conn));
                    }
                }
            }

            if ($attachment_temp[0] != "") {

                for ($i = 0; $i < $atta_count; $i++) {
                    $notes_data_filename = $_FILES['notes-data']['name'][$i];
                    $notes_data_filetemp = $_FILES['notes-data']['tmp_name'][$i];

                    $note_date_fileext = explode('.', $notes_data_filename);
                    $note_data_filecheck = strtolower(end($note_date_fileext));
                    $note_data_ext = end($note_date_fileext);

                    if (in_array($note_data_filecheck, $accepted_pdf)) {

                        $store_name_atta = "Attachement_" . $i . "_" . date("dmyhis") . "." . $note_data_ext;
                        $atta_path = "../Members/$user_id/$note_id/Attachements/$store_name_atta";

                        $insert_attachements = "INSERT INTO `sellernotesattachements`(`NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES ($note_id, '$store_name_atta', '$atta_path', current_timestamp(), '$user_id', current_timestamp(), '$user_id', b'1')";

                        date_default_timezone_set('Asia/Kolkata');

                        if (!is_dir("../Members/$user_id/$note_id/Attachements")) {
                            mkdir("../Members/$user_id/$note_id/Attachements", 0777, true);
                        }
                        move_uploaded_file($notes_data_filetemp, "../Members/$user_id/$note_id/Attachements/$store_name_atta");

                        $ins_atta_query = mysqli_query($conn, $insert_attachements);
                        if (!($ins_atta_query)) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }
                    } else {
    ?>
                        <script>
                            alert("select proper file type for note attachements")
                        </script>
                <?php
                    }
                } // for loop over
            }

            if ($profile_picture != $edit_dp) {
                if (file_exists("../Members/$user_id/$note_id/$edit_dp")) {
                    unlink("../Members/$user_id/$note_id/$edit_dp");
                    move_uploaded_file($profile_picture_tmp, "../Members/$user_id/$note_id/$profile_picture");
                } else {
                    move_uploaded_file($profile_picture_tmp, "../Members/$user_id/$note_id/$profile_picture");
                }
            }

            if ($preview_cv != $edit_cv) {
                if (file_exists("../Members/$user_id/$note_id/$edit_cv")) {
                    unlink("../Members/$user_id/$note_id/$edit_cv");
                    move_uploaded_file($preview_cv_tmp, "../Members/$user_id/$note_id/$preview_cv");
                } else {
                    move_uploaded_file($preview_cv_tmp, "../Members/$user_id/$note_id/$preview_cv");
                }
            }


            header('location:dashboard.php');
        }
    }

    if (isset($_POST['publish'])) {

        $last_note_id = $_SESSION['last_id'];
        $seller_email = $_SESSION['email'];
        $seller_name =  $_SESSION['username'];
        $note_title = $_SESSION['note_title'];
        $query = "UPDATE sellernotes SET Status = 7 WHERE ID = $note_id";
        $uquery = mysqli_query($conn, $query);
        if ($uquery) {

            // This email address and name will be visible as sender of email

            $mail->addAddress($seller_email);  // This email is where you want to send the email
            $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "$seller_name sent his note for review";

            $mail->Body = "Hello Admins,<br><br> We want to inform you that, $seller_name sent his note <br> $note_title for review. Please look at the notes and take required actions. <br><br> Regards,<br>Notes Marketplace";

            if (!$mail->send()) {
                ?>
                <script>
                    alert('somthing went wrong');
                </script>
            <?php
            } else {
                header('location:dashboard.php');
            }
        } else {
            ?>
            <script>
                alert("query fail")
            </script>
    <?php
        }
    }

    ?>

    <?php
    include 'login-header.php';
    ?>


    <!-- Header Image Part -->
    <section id="head-part">
        <div id="head-part-content">
            <div class="container">
                <div class="row">
                    <div id="head-part-inner">
                        <div class="col-md-12">
                            <div class="header-statement" class="text-center">
                                <h3>Add Notes</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Header Image Part Ends -->

    <!-- Basic Notes Detail Strats -->
    <section id="basic-notes-details">
        <div class="content-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-left">

                        <div class="horizontal-heading">
                            <h3>Basic Note Details</h3>
                        </div>

                    </div>

                    <div class="col-md-12 col-sm-12 col-12">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">

                                <div class="form-group col-sm-6 col-12 col-md-6">
                                    <label for="title">Title *</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter your notes title" <?php if (isset($edit_title)) {
                                                                                                                                                echo "value='$edit_title'";
                                                                                                                                            } ?>>
                                </div>


                                <div class="form-group col-sm-6 col-12 col-md-6">
                                    <label for="category">Category *</label>
                                    <?php
                                    $getcategoryquery = "SELECT * FROM notecategories WHERE IsActive = b'1'";
                                    $categoryquery = mysqli_query($conn, $getcategoryquery);
                                    $categoryrows = mysqli_num_rows($categoryquery);
                                    ?>
                                    <select id="category" name="category" class="form-control">
                                        <?php
                                        for ($i = 1; $i <= $categoryrows; $i++) {
                                            $categoryrow = mysqli_fetch_array($categoryquery);
                                            $cat_id = $categoryrow['ID'];
                                            $cat_name = $categoryrow['Name'];
                                            if ($cat_id == $edit_category) {
                                                echo "<option value='$cat_id}' selected>$cat_name</option>";
                                            } else {
                                                echo "<option value='$cat_id}'>$cat_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-sm-6 col-12 col-md-6 file-upload">
                                    <label for="display-picture">Display Picture</label>
                                    <input type="file" name="display-picture" class="form-control-file display-picture" id="display-picture">
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="upload-notes">Upload Notes *</label>
                                    <input type="file" name="notes-data[]" class="form-control-file upload-notes" id="upload-notes" multiple>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="type">Type</label>
                                    <?php
                                    $getnotetypequery = "SELECT * FROM notetypes WHERE IsActive = b'1'";
                                    $notetypequery = mysqli_query($conn, $getnotetypequery);
                                    $notetyperows = mysqli_num_rows($notetypequery);
                                    ?>
                                    <select id="type" name="note-type" class="form-control">
                                        <?php
                                        for ($i = 1; $i <= $notetyperows; $i++) {
                                            $notetyperow = mysqli_fetch_array($notetypequery);
                                            $note_type_id = $notetyperow['ID'];
                                            $note_type_name = $notetyperow['Name'];
                                            if ($note_type_id == $edit_type) {
                                                echo "<option value='$note_type_id}' selected>$note_type_name</option>";
                                            } else {
                                                echo "<option value='$note_type_id}'>$note_type_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="number-of-page">Number of Pages</label>
                                    <input type="text" name="number-of-pages" class="form-control" id="number-of-page" placeholder="Enter number of note pages" <?php if (isset($edit_pages)) {
                                                                                                                                                                    echo "value='$edit_pages'";
                                                                                                                                                                } ?>>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-12 col-md-12">
                                    <label for="description">Description *</label>
                                    <textarea class="form-control" name="description" id="description" <?php echo "placeholder='$description'"; ?>></textarea>
                                </div>
                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Institution Information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="country">Country</label>
                                    <?php
                                    $getcountryquery = "SELECT * FROM countries WHERE IsActive = b'1'";
                                    $countryquery = mysqli_query($conn, $getcountryquery);
                                    $countryrows = mysqli_num_rows($countryquery);
                                    ?>
                                    <select id="country" name="country" class="form-control">
                                        <?php
                                        for ($i = 1; $i <= $countryrows; $i++) {
                                            $countryrow = mysqli_fetch_array($countryquery);
                                            $country_id = $countryrow['ID'];
                                            $country_name = $countryrow['Name'];
                                            if ($note_type_id == $country) {
                                                echo "<option value='$country_id' selected>$country_name</option>";
                                            } else {
                                                echo "<option value='$country_id'>$country_name</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="institution-name">Institution Name</label>
                                    <input type="text" name="institute-name" class="form-control" id="institution-name" placeholder="Enter your institution name" <?php if (isset($institution_name)) {
                                                                                                                                                                        echo "value='$institution_name'";
                                                                                                                                                                    } ?>>
                                </div>
                            </div>

                            <!-- address details -->
                            <div class="form-group-heading">
                                <h3>Course Details</h3>
                            </div>


                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-name">Course Name</label>
                                    <input type="text" name="course-name" class="form-control" id="course-name" placeholder="Enter your course name" <?php if (isset($course)) {
                                                                                                                                                            echo "value='$course'";
                                                                                                                                                        } ?>>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="course-code">Course Code</label>
                                    <input type="text" name="course-code" class="form-control" id="course-code" placeholder="Enter your course code" <?php if (isset($course_code)) {
                                                                                                                                                            echo "value='$course_code'";
                                                                                                                                                        } ?>>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="professor-name">Professor/Lecturer</label>
                                    <input type="text" name="professor-name" class="form-control" id="professor-name" placeholder="Enter your professor name" <?php if (isset($professor)) {
                                                                                                                                                                    echo "value='$professor'";
                                                                                                                                                                } ?>>
                                </div>

                            </div>

                            <!-- university details -->
                            <div class="form-group-heading">
                                <h3>Selling Information</h3>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <div class="row checkBox">
                                        <div class="form-group sell-for-div col-lg-12 col-md-12 col-sm-12 col-12" id="btn-radio-paid-free">
                                            <p id="radio-heading" style="margin-bottom: 9px;">Sell For *</p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sellingtype" id="free" value="0" <?php if ($sell == 0) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                <label class="form-check-label" for="free">Free</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sellingtype" id="paid" value="1" <?php if ($sell == 1) {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
                                                <label class="form-check-label" for="paid">Paid</label>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="sell-price" style="margin-top: 6px;">Sell Price *</label>
                                    <input type="text" name="sellprice" class="form-control" id="sell-price" placeholder="Enter your price" style="margin-top: 6px;" <?php if ($sell == 1) {
                                                                                                                                                                            echo "value='$sell_price'";
                                                                                                                                                                        } ?>>
                                </div>
                                <div class="form-group col-12 col-sm-6 col-md-6">
                                    <label for="note-preview">Note Preview</label>
                                    <input type="file" name="note-preview" class="form-control-file note-preview" id="note-preview">
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-10 col-md-6 col-lg-4 col-sm-7">
                                    <div class="row">
                                        <div class="col-6 col-md-6 col-lg-6 col-sm-6" style="padding-right: 0px;">
                                            <div id="notes-submit-btn">
                                                <button type="submit" id="note-submit" name="submit" class="btn note-submit-btn" <?php echo isset($_POST['submit']) ? 'disabled="true"' : ''; ?>>SUBMIT</button>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6 col-lg-6 col-sm-6" style="padding: 0px;">
                                            <div id="publish-btn">
                                                <button type="submit" id="note-publish" name="publish" class="btn publish-btn">Publish</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Notes Detail Strats -->

    <?php
    include 'footer.php';
    ?>




    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>
