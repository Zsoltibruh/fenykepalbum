<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

    <?php
    require('includes/func.php');
    require("includes/dbconnect.php");
    $neptun = "c##d7yp5c";

    $query = "SELECT * FROM $neptun.KEPEK 
        INNER JOIN $neptun.tartalmazza ON kepek.id = tartalmazza.id 
        INNER JOIN $neptun.album on album.ID = tartalmazza.albumid 
        INNER JOIN $neptun.albumja on albumja.id = album.id 
        INNER JOIN $neptun.felhasznalo on felhasznalo.felhasznalonev = albumja.felhasznalonev
        INNER JOIN $neptun.koveti on koveti.Ki = felhasznalo.felhasznalonev                
        WHERE kepek.felhasznalonev LIKE '".$_SESSION["felhasznalonev"]."'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <p id="username"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
        <img src="img/<?php print_r($row['KEP']); ?>" alt="<?php print_r($row['KEP']); ?>">
        <p id="imgtitle"> <?php print_r($row['NEV']); ?> </p>
        <p id="imgdesc"> <?php print_r($row['LEIRAS']); ?> </p>

        <?php allCommentList($conn, $row['ID']); ?>
        
        <?php endwhile ?>

        <?php setComment($conn, $_POST['comment_hidden']) ?>
        

</body>

</html>