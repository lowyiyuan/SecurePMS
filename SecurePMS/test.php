<?php

require_once 'include/conn.inc.php';

$sql = "SELECT user_ID, user_Name, user_Fname, user_Lname, user_Password, user_Email FROM users WHERE user_Email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($uid, $uname, $ufname, $ulname, $upassword, $uemail);
$stmt->fetch();
$stmt->close();

$salt = hash_hmac('sha256', $upassword, $uname, false);

echo '<a href="retrievePassword.php?q=' . $salt . '" class="list-group-item list-group-item-action border-start-0 border-end-0 py-4"> '. $uid . " " . $uname . ' <span class="align-middle"><i class="fas float-end fa-chevron-right"></i></span></a>'



?>