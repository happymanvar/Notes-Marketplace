<?php

session_start();

include 'db_conntect.php';

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    
    $updatequery = "UPDATE users SET IsEmailVarified = b'1' WHERE token = '$token'";
    
    $query = mysqli_query($conn, $updatequery);
    
    if($query) {
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account updated successfully";
            header('location:../login.php');
        }else {
            $_SESSION['msg'] = "You are logged out.";
            header('location:../login.php');
        }
    }else {
        $_SESSION['msg'] = "Account not updated"; 
        header('location:../login.php'); 
    }
}
