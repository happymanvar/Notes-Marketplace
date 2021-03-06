<?php 
session_start();

echo "success";
include 'send_mail.php';
        
        $email = $_SESSION['email'];
        $firstname = $_SESSION['username'];
        $lastname = $_SESSION['lastname'];
        $mail->addAddress($email);  // This email is where you want to send the email
        $mail->addReplyTo($config_email);   // If receiver replies to the email, it will be sent to this email address

        // Setting the email content
        $mail->IsHTML(true);  
        $mail->Subject = "$firstname, Allows you to download a note"; 

        $mail->Body = "Hello $firstname $lastname,<br><br> We would to inform you that, $firstname Allows you to download a note. <br>  Please login and see my Download tabs to download particular note. <br><br> Regards,<br>Notes Marketplace";

        if(!$mail->send()) {
            ?>
            <script>
                echo "alert('error to sent mail');";
                window.location.href = "http://localhost/Notes-marketplace/SRS_Notes/front/buyer-request.php";
            </script>
            <?php
        }
        else {
            header('location:http://localhost/Notes-marketplace/SRS_Notes/front/buyer-request.php');
        }

?>