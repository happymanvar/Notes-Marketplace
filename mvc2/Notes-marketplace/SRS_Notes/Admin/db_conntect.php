<?php 
 
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'notes-marketplace';

$conn = mysqli_connect($server, $user, $password, $db);


if($conn){
    echo "Connection Successfull";
}else {
    echo "NO Connection";
}


?>