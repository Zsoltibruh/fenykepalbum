<?php
require("dbconnect.php");
require("func.php");
session_start();

if(isset($_POST["liked_button"])){
    $id = $_POST["id"];
    likePress($conn, $id, $_SESSION["felhasznalonev"], TRUE);
    header("location: ../home.php");
} else if(isset($_POST["like_button"])){
    $id = $_POST["id"];
    likePress($conn, $id, $_SESSION["felhasznalonev"], FALSE);
    header("location: ../home.php");
}