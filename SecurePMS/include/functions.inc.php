<?php

// Detect if Sign Up form has empty input
function emptyInputSignup($userName, $firstName, $lastName, $userEmail, $userPassword, $userConfirmPassword)
{
    $result;
    if (empty($userName) || empty($firstName) || empty($lastName) || empty($userEmail) || empty($userPassword) || empty($userConfirmPassword)) {
        // returns true if the fields are empty and false if fields are not empty a.k.a filled
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check if username contains special characters
function invalidUsername($userName)
{
    $result;
    // Compare username with the regular expression code, returns true if username contains special characters
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check if email is in correct formatting
function invalidEmail($userEmail)
{
    $result;
    // Validate email to make sure is in xxx@xxx.com format, returns true if the email is in the wrong format
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check if re-entered password match the original password
function pdwMatch($userPassword, $userConfirmPassword)
{
    $result;
    // $result = true if both password does not match
    if ($userPassword !== $userConfirmPassword) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Check from SQL database if the username/email exists in the database
function userNameExists($conn, $userName, $userEmail)
{
    // SQL statement to get the username or user email
    $sql = "SELECT * FROM users WHERE user_Name = ? OR user_Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    // Returns user to the sign up page if user exists
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register?error=stmtfailed");
        exit();
    }
    // Continues to get the row from database if user does not exist
    mysqli_stmt_bind_param($stmt, "ss", $userName, $userEmail);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    // Store the row if SQL command executes successfully
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

// Function to create a new user
function createUser($conn, $userName, $firstName, $lastName, $userEmail, $userPassword, $salt)
{
    // Prepare the SQL statement to insert the user into the database
    $sql = "INSERT INTO users (user_Name, user_Fname, user_Lname, user_Email, user_Password, user_Salt) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    // Returns the user to the sign up page if the SQL statement does not execute correctly
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register?error=stmtfailed");
        exit();
    }
    // Hash the password using HMAC algorithm as well as sha256 hash function
    $hmacPwd = hash_hmac("sha256", $userPassword, $salt, false);
    // Bind the input and execute the SQL statement
    mysqli_stmt_bind_param($stmt, "ssssss", $userName, $firstName, $lastName, $userEmail, $hmacPwd, $salt);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $filename = strval(hash_hmac("sha256", $userName, $hmacPwd, false));
    $filePath = "../userData/" . $filename . ".json";
    $createNewFile = array(
        "loginDetails" => [],
        "licenseKey" => [],
        "paymentCard" => [],
        "identityCard" => [],
        "secureNotes" => [],
    );

    fopen($filePath, "w");
    if (is_writeable($filePath)) {
        file_put_contents($filePath, json_encode($createNewFile));
    }

    // Returns user to sign up page with no errors if successful
    header("location: ../login");

    exit();
}

// Detect if Login page is submitted with empty fields
function emptyInputLogin($userName, $userPassword)
{
    $result;
    if (empty($userName) || empty($userPassword)) {
        // $result is true if either fields are empty
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// Function to login to the system
function loginUser($conn, $userName, $userPassword)
{
    // Check if username exists and returns user to the login page if it does not exist
    $uidExists = userNameExists($conn, $userName, $userName);
    if ($uidExists === false) {
        header("location: ../login?error=wronglogin");
        exit();
    }
    // Retrieve hashed password and salt from database
    $pwdHashed = $uidExists['user_Password'];
    $salt = $uidExists['user_Salt'];
    // Perform HMAC hashing on the received input
    $checkPwd = hash_hmac("sha256", $userPassword, $salt, false);
    // Compare both stored password and newly entered password, returns user to login page if password does not match
    if ($checkPwd != $pwdHashed) {
        header("location: ../login?error=wronglogin");
        exit();
    } else {
        // Start a new session and set session variables if login is successful
        session_start();
        $_SESSION["userid"] = $uidExists["user_ID"];
        $_SESSION["username"] = $uidExists["user_Name"];
        $_SESSION["userfname"] = $uidExists["user_Fname"];
        $_SESSION["userlname"] = $uidExists["user_Lname"];
        $_SESSION["useremail"] = $uidExists["user_Email"];
        $_SESSION["userpassword"] = $uidExists["user_Password"];
        $_SESSION["hash"] = $uidExists["user_Salt"];
        setcookie('userid', $uidExists['user_ID'], time() + (60 * 60), "/", false, true);
        setcookie('username', $uidExists['user_Name'], time() + (60 * 60), "/", false, true);
        setcookie('firstname', $uidExists['user_Fname'], time() + (60 * 60), "/", false, true);
        setcookie('lastname', $uidExists['user_Lname'], time() + (60 * 60), "/", false, true);
        setcookie('useremail', $uidExists['user_Email'], time() + (60 * 60), "/", false, true);
        setcookie('userpassword', $uidExists['user_Password'], time() + (60 * 60), "/", false, true);
        setcookie('hash', $uidExists['user_Salt'], time() + (60 * 60), "/", false, true);
        header("location: ../index");
        exit();
    }
}
