<?php
session_start();
$userName = $_SESSION["username"];
$hmacPwd = $_SESSION["userpassword"];
$user = strval(hash_hmac("sha256", $userName, $hmacPwd, false));
$filepath = '../userData/' . $user . '.json';
$json_string = file_get_contents($filepath);
print_r($json_string);
