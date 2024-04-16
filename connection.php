<?php
require("includes/dbconnect.php");

$sth = $conn->prepare("SELECT * FROM DUAL");
$sth->execute();
$result = $sth->fetchAll();
foreach ($result as $record){
    print_r($record); // Array ( [DUMMY] => X [0] => X )
}

echo '<h1>Sikeres csatlakozás!</h1>';