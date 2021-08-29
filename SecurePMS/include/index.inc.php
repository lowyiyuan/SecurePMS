<?php

if(!isset($_SESSION["username"])) {
    header("location: login?error=nosession");
    exit();
}