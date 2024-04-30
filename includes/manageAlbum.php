<?php
require("dbconnect.php");
require("func.php");
    if (isset($_POST['torol'])) {
        albumDelete($conn, $_POST['hiddentorol']);
    } else if (isset($_POST["szerkeszt"])) {
        session_start();
        $_SESSION["albumid"] = $_POST["hiddentorol"];
        header("location: ../upload.php");
    } else if (isset($_POST["keptorol"])) {
        deleteImage($conn, $_POST["hiddentorol"], $_POST["hiddennev"]);
    }