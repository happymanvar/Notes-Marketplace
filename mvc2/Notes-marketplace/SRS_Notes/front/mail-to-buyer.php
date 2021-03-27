<?php
session_start();

if (isset($_SESSION['is_loggedin'])) {
    $first_name = $_SESSION['username'];
    $last_name = $_SESSION['lastname'];
    $email_id = $_SESSION['email'];
    $userid = $_SESSION['user_id'];
}

include 'send_mail.php';
include 'db_conntect.php';

if (isset($_GET['id'])) {
    $noteid = $_GET['id'];

    $getatta = "SELECT * FROM sellernotesattachements WHERE NoteID = $noteid";
    $attachements = mysqli_query($conn, $getatta);
    if ($attachements) {
        $getid = "SELECT * FROM downloads WHERE `downloads`.`NoteID` = $noteid AND Downloader != $userid";
        $getidquery = mysqli_query($conn, $getid);
        $iddata = mysqli_fetch_assoc($getidquery);
        $idcount = $iddata['ID'];
        $buyerid = $iddata['Downloader'];

        while ($atta = mysqli_fetch_assoc($attachements)) {
            $filepath = $atta['FilePath'];

            $updatedetail = "UPDATE `downloads` SET `IsSellerHasAllowedDownload` = b'1', `AtachmentPath` = '$filepath'  WHERE NoteID = '$noteid' AND Downloader = '$buyerid' AND ID = '$idcount'";
            $updatequery = mysqli_query($conn, $updatedetail);
            if (!($updatequery)) {
                die("QUERY FAILED" . mysqli_error($conn));
            }
            $idcount++;
        }
    } else {
        die("QUERY FAILED" . mysqli_error($conn));
    }

    $getbuyerdetail = "SELECT * FROM users WHERE ID = $buyerid";
    $buyerquery = mysqli_query($conn, $getbuyerdetail);
    $buyerdata = mysqli_fetch_assoc($buyerquery);


    $buyeremail = $buyerdata['EmailID'];
    $buyername = $buyerdata['FirstName'];



    $mail->addAddress($buyeremail);  // This email is where you want to send the email
    $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "$first_name, Allows you to download a note";

    $mail->Body = "Hello $buyername,<br><br> We would to inform you that, $first_name Allows you to download a note. <br>  Please login and see my Download tabs to download particular note. <br><br> Regards,<br>Notes Marketplace";

    if (!$mail->send()) {


?>
        <script>
            alert('error to sent mail');
            window.location.href = "buyer-request.php";
        </script>
<?php
    } else {
        header('location:buyer-request.php');
    }
}


?>