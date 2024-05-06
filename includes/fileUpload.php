<?php
require("dbconnect.php");
require("func.php");
session_start();

if (isset($_POST["upload"])) {
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        header("location: ../photos.php?error=noimage");
        exit();
    }

    $name = $_POST["image-name"];
    $desc = $_POST["description"];
    $filename = basename($_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../img/local/".$filename;
    $albumid = $_SESSION["albumid"];

    if (strlen($name) > 30 || strlen($desc) > 1500) {
        header("location: ../photos.php?error=inputlength");
        exit();
    }

    if (emptyInputUpload($desc, $name, $filename)) {
        header("location: ../photos.php?error=emptyinput");
        exit();
    }

    if (move_uploaded_file($tempname, $folder)) {
        uploadImage($conn, $_SESSION["felhasznalonev"], $desc, $name, $filename, $albumid);
    }
}