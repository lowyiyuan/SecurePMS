<?php

if(isset($_POST["submit"])) {
    
    $userName = $_POST["userName"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $userConfirmPassword = $_POST["userConfirmPassword"];


    require_once "conn.inc.php";
    require_once "functions.inc.php";

    if(emptyInputSignup($userName, $firstName, $lastName, $userEmail, $userPassword, $userConfirmPassword) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if(invalidUsername($userName) !== false) {
        header("location: ../register.php?error=invaliduname");
        exit();
    }
    if(invalidEmail($userEmail) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    if(pdwMatch($userPassword, $userConfirmPassword) !== false) {
        header("location: ../register.php?error=notmatch");
        exit();
    }
    if(userNameExists($conn, $userName, $userEmail) !== false) {
        header("location: ../register.php?error=usernametaken&uname=$userName");
        exit();
    }
    
    createUser($conn, $userName, $firstName, $lastName, $userEmail, $userPassword);

}else {
    header("location: ../register.php");
    exit();
}