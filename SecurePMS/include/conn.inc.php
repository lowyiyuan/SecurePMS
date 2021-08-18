<?php

$serverName = "127.0.0.1";
$dBUsername = "root";
$dBPassword = "";
$dBName = "securepms";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
