<?php

if(isset($_POST["submit"])) {
    
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];

    require_once "conn.inc.php";
    require_once "functions.inc.php";

    if(emptyInputLogin($userName, $userPassword) !== false) {
        header("location: ../login?error=emptyinput");
        exit();
    }
    loginUser($conn, $userName, $userPassword);
}else {
    header("location: ../login");
    exit();
}