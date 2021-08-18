<?php

function emptyInputSignup($userName, $firstName, $lastName, $userEmail, $userPassword, $userConfirmPassword) {
    $result;
    if(empty($userName) || empty($firstName) || empty($lastName) || empty($userEmail) || empty($userPassword) || empty($userConfirmPassword)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidUsername($userName) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidEmail($userEmail) {
    $result;
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function pdwMatch($userPassword, $userConfirmPassword) {
    $result;
    if ($userPassword !== $userConfirmPassword) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function userNameExists($conn, $userName, $userEmail) {
    $sql = "SELECT * FROM users WHERE user_Name = ? OR user_Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $userName, $firstName, $lastName, $userEmail, $userPassword) {
    $sql = "INSERT INTO users (user_Name, user_Fname, user_Lname, user_Email, user_Password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }
    $salt = hash("sha256", $userName, false);
    $hmacPwd = hash_hmac("sha256", $userPassword, $salt, false);
    mysqli_stmt_bind_param($stmt, "sssss", $userName, $firstName, $lastName, $userEmail, $hmacPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?error=none");
    exit();
}

function emptyInputLogin($userName, $userPassword) {
    $result;
    if(empty($userName) || empty($userPassword)) {
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $userName, $userPassword){
    $uidExists = userNameExists($conn, $userName, $userName);
    if($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $uidExists['user_Password'];
    $salt = hash("sha256", $userName, false);
    $checkPwd = hash_hmac("sha256", $userPassword, $salt, false);
    if(!$checkPwd === $pwdHashed) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }else {
        session_start();
        $_SESSION["userid"] = $uidExists["user_ID"]; 
        $_SESSION["username"] = $uidExists["user_Name"]; 
        $_SESSION["useremail"] = $uidExists["user_Email"]; 
        $_SESSION["userpassword"] = $uidExists["user_Password"];
        header("location: ../index.php");
        exit();
    }
}
