<?php

if (isset($_POST['resetRequestSubmit'])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "https://lowyiyuan.dev/securepms/createNewPassword?selector=" . $selector . "&validator=" . bin2hex($token);
    $expiryDate = date("U") + 600;

    require 'conn.inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error processing your requesta";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error processing your requestb";
        exit();
    } else {

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expiryDate);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $sendTo = $userEmail;

    $subject = 'Reset password for SecurePMS.';

    $message = "<p>You have requested for a password reset. The link to reset your password is <a href=" . $url . ">here</a>. If you did not make this request, please secure your account immediately!</p>";
    $message .= '<p>Here is your password reset link: </br></p>';
    $message .= "<p><a href=" . $url . '>' . $url . "</a></p>";

    $headers = "From: Yiyuan Low <yiyuanlow8@gmail.com>\r\n";
    $headers .= "Reply-To: <yiyuanlow8@gmail.com>\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($sendTo, $subject, $message, $headers);

    header("Location: ../resetPassword?reset=success");
} else {
    echo 'error';
}
