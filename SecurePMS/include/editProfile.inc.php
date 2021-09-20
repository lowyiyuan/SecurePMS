<?php

if (isset($_POST["save-profile"])) {
    session_start();
    require 'conn.inc.php';

    $userID = $_POST["uuid"];
    $newEmail = $_POST["newEmail"];
    $newFname = $_POST["newFname"];
    $newLname = $_POST["newLname"];
    $passwordVerify = $_POST["confirmPass"];
    $hashPwd = hash_hmac("sha256", $passwordVerify, $_SESSION["hash"], false);

    $sql = "SELECT user_Password FROM users WHERE user_ID=?";
    $stmt = mysqli_stmt_init($conn);
    // Returns the user to the previous page if the SQL statement does not execute correctly
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../editProfile?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        if ($hashPwd === $row['user_Password']) {
            $sql = "UPDATE users SET user_Fname=?, user_Lname=?, user_Email=? WHERE user_ID=$userID;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../editProfile?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sss", $newFname, $newLname, $newEmail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            header("location: ../editProfile?error=wrongpassword");
        }
    } else {
        header("location: ../editProfile?error=stmtfailed");
    }
    session_start();
    session_unset();
    session_destroy();
    header("location: ../login?error=relog");
    exit();
} else {
    header("location: ../editProfile");
}
