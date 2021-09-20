<?php

$selector = 'a';
echo $selector;
if ($resultData) {
    $sql2 = "UPDATE users SET (user_Name, user_Fname, user_Lname, user_Email, user_Password) VALUES (?,?,?,?,?) WHERE user_ID=?;";
    $stmt2 = mysqli_stmt_init($conn);
    // Returns the user to the sign up page if the SQL statement does not execute correctly
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../register?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "ssssss", $userName, $firstName, $lastName, $userEmail, $hmacPwd);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
} else {
    header("location: ../register?error=stmtfailed");
}
