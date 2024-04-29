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
    session_start();
    require("includes/dbconnect.php");
    $neptun = "c##d7yp5c";

    $query = "SELECT $neptun.kit FROM koveti
        INNER JOIN $neptun.felhasznalo on koveti.Ki = felhasznalo.felhasznalonev  
        INNER JOIN $neptun.albumja on felhasznalo.felhasznalonev = albumja.felhasznalonev
        INNER JOIN $neptun.album on albumja.id = album.id 
        INNER JOIN $neptun.tartalmazza on album.ID = tartalmazza.albumid 
        INNER JOIN $neptun.kepek ON kepek.id = tartalmazza.id       
        WHERE kepek.felhasznalonev LIKE '" . $_SESSION["felhasznalonev"] . "'";
    $stmt = $conn->prepare($query);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <?php
        $query2 = "SELECT * FROM $neptun.kepek WHERE felhasznalonev LIKE '?'";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(1, $row["KIT"]);
        $stmt2->execute();
        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
        ?>

        <p id="username"> <?php print_r($row2['FELHASZNALONEV']); ?> </p>
        <img src="img/<?php print_r($row2['KEP']); ?>" alt="<?php print_r($row2['KEP']); ?>">
        <p id="imgtitle"> <?php print_r($row2['NEV']); ?> </p>
        <p id="imgdesc"> <?php print_r($row2['LEIRAS']); ?> </p>

        <?php allCommentList($conn, $row2['ID']); ?>

    <?php endwhile ?>

    <?php setComment($conn, $_POST['comment_hidden']) ?>

    <footer>
        <a href="#">Logó?</a>
        <a href="#">Rólunk</a>
        <a href="#">ÁSZF</a>
        <a href="#">Feltételek</a>
        <a href="#">Hirdetés</a>
    </footer>
</body>

</html>