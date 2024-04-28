<?php
require("dbconnect.php");
session_start();

if (isset($_POST["upload"])) {
    $image_name = $_FILES["image"]["name"];
    $image = file_get_contents($_FILES["image"]["tmp_name"]);

    if (empty($image_name)) {
        header("location: ../upload.php?error=emptyinput");
    }
}