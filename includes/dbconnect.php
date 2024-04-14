<?php
$tns = "(DESCRIPTION = (ADDRESS_LIST =    (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)) ) (CONNECT_DATA =(SID = orania2))) ";
$db_username = "C##NEPTUNKÓD";
$db_password = "kruvaanyad";
try{
    $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
}catch(PDOException $e){
    echo ($e->getMessage());
    exit;
}

$sth = $conn->prepare("SELECT * FROM DUAL");
$sth->execute();
$result = $sth->fetchAll();
foreach ($result as $record){
    print_r($record); // Array ( [DUMMY] => X [0] => X )
}
?>