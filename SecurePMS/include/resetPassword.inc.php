<?php
if (isset($_POST["resetPasswordSubmit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    if (empty($pwd) || empty($pwdRepeat)) {
        header("Location: ../createNewPassword?selector=$selector&validator=$validator");
        exit();
    } else if ($pwd != $pwdRepeat) {
        header("Location: ../createNewPassword?error=doesNotMatch");
        exit();
    }

    $currentDate = date("U");

    require 'conn.inc.php';

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error processing your request";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "An error has occured.";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "An error has occured.";
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM users WHERE user_Email=?;";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error processing your request";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "An error has occured.";
                        exit();
                    } else {
                        $sql = "UPDATE users SET user_Password=? WHERE user_Email=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "Error processing your request";
                            exit();
                        } else {
                            $hashPwd = hash_hmac("sha256", $pwd, $row['user_Salt'], false);
                            mysqli_stmt_bind_param($stmt, "ss", $hashPwd, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Error processing your request";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login?reset=success");
                            }
                        }
                    }
                }
            }

        }
    }

} else {
    header("Location: ../login");
}
