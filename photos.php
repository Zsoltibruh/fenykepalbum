<!DOCTYPE php>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Fényképalbum</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-back">
                <ul>
                    <li>
                        <p>Logó?</p>
                    </li>
                </ul>
            </div>
            <ul class="nav-index">
                <div class="nav-auth">
                    <li><a href="albums.php">Albumjaim</a></li>
                    <li><a href="includes/logout.php">Kijelentkezés</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
<div class="container">
    <?php
    require("includes/dbconnect.php");
    require("includes/func.php");
    $neptun = "c##d7yp5c";

    
    $query = "SELECT * FROM $neptun.KEPEK 
                INNER JOIN $neptun.tartalmazza ON kepek.id = tartalmazza.id 
                INNER JOIN $neptun.album on album.ID = tartalmazza.albumid 
                INNER JOIN $neptun.albumja on albumja.id = album.id 
                INNER JOIN $neptun.felhasznalo on felhasznalo.felhasznalonev = albumja.felhasznalonev                
                WHERE kepek.felhasznalonev LIKE ?;";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $_SESSION["felhasznalonev"]);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

                <p id="username"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
                <img src="img/local<?php print_r($row['KEP']); ?>" alt="<?php print_r($row['KEP']); ?>">
                <p id="imgtitle"> <?php print_r($row['NEV']); ?> </p>
                <p id="imgdesc"> <?php print_r($row['LEIRAS']); ?> </p>

        <?php allCommentList($conn, $row['ID']); ?>

    <?php endwhile ?>

    <?php setComment($conn,  $_POST['comment_hidden']); ?>
</div>
</main>
    <footer>
        <h1>Ez lesz a footer</h1>
    </footer>
</body>

</html>