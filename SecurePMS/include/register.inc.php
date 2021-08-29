<?php

if(isset($_POST["submit"])) {
    
    $userName = $_POST["userName"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $userEmail = $_POST["userEmail"];
    $userPassword = $_POST["userPassword"];
    $userConfirmPassword = $_POST["userConfirmPassword"];
    // Generate a new salt
    $salt = hash("sha256", rand(-69420, 69420), false);

    require_once "conn.inc.php";
    require_once "functions.inc.php";

    if(emptyInputSignup($userName, $firstName, $lastName, $userEmail, $userPassword, $userConfirmPassword) !== false) {
        header("location: ../register?error=emptyinput");
        exit();
    }
    if(invalidUsername($userName) !== false) {
        header("location: ../register?error=invaliduname");
        exit();
    }
    if(invalidEmail($userEmail) !== false) {
        header("location: ../register?error=invalidemail");
        exit();
    }
    if(pdwMatch($userPassword, $userConfirmPassword) !== false) {
        header("location: ../register?error=notmatch");
        exit();
    }
    if(userNameExists($conn, $userName, $userEmail) !== false) {
        header("location: ../register?error=usernametaken&uname=$userName");
        exit();
    }
    
    createUser($conn, $userName, $firstName, $lastName, $userEmail, $userPassword, $salt);

}else {
    header("location: ../register");
    exit();
}