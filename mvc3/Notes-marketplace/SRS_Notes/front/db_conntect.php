<?php 
 
$server = 'localhost';
$user = 'root';
$password = '';
$db = 'notes-marketplace';

$conn = mysqli_connect($server, $user, $password, $db);


if(!$conn){
    ?> 
    <script>
        alert("error to connect to database")
    </script>
    <?php
}


?>