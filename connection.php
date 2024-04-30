<?php
require("includes/dbconnect.php");

$neptun = "C##D7YP5C";
$sth = $conn->prepare("SELECT * FROM $neptun.felhasznalo WHERE isAdmin = 1");
$sth->execute();
$result = $sth->fetchAll();
echo '<h2>Adminok listája</h2>';
foreach ($result as $record){
    print_r($record); // Array ( [DUMMY] => X [0] => X )
}

echo '<h1>Sikeres csatlakozás!</h1>';