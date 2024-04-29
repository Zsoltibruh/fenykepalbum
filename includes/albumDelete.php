<?php
require("dbconnect.php");
require("func.php");
    if (isset($_POST['torol'])) {
        albumDelete($conn, $_POST['hiddentorol']);
    }
?>