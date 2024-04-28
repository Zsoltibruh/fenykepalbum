<?php
require("func.php");
require("dbconnect.php");

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    loginUser($conn, $username, $password);
    exit();
} else{
    header("location: ../login.php?error=unkownerror");
    exit();
}