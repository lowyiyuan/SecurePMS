<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'conn.php';
    
    if(isset($_POST["username"])){
        echo '<script>alert("Please enter a username!")</script>';
    }

    $username = $_POST["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = hash_hmac("sha256", $_POST["password"], "bleuberrrry", false);

    

}

?>