<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
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
                    <li><a href="#">Követések</a></li>
                    <li><a href="discovery.php">Felfedezés</a></li>
                    <li><a href="albums.php">Albumjaim</a></li>
                    <li><a href="includes/logout.php">Kijelentkezés</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container-home">

            <?php
            require('includes/func.php');
            require("includes/dbconnect.php");
            session_start();
            $neptun = "c##d7yp5c";

            $query = "SELECT KIT FROM $neptun.koveti                
                    INNER JOIN $neptun.felhasznalo on koveti.Ki = felhasznalo.felhasznalonev  
                    INNER JOIN $neptun.albumja on felhasznalo.felhasznalonev = albumja.felhasznalonev
                    INNER JOIN $neptun.album on albumja.id = album.id     
                    WHERE kepek.felhasznalonev LIKE '" . $_SESSION["felhasznalonev"] . "'";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

                <?php
                $query2 = "SELECT * FROM $neptun.kepek WHERE felhasznalonev LIKE ?";
                $stmt2 = $conn->prepare($query2);
                $stmt2->bindParam(1, $row["KIT"]);
                $stmt2->execute();
                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="post-element">

                        <p id="username"> <?php echo $row2['FELHASZNALONEV']; ?> </p>
                        <img src="img/local/<?php echo $row2['KEP']; ?>" alt="<?php echo $row2['KEP']; ?>">
                        <p id="imgtitle"> <?php echo $row2['NEV']; ?> </p>
                        <p id="imgdesc"> <?php echo $row2['LEIRAS']; ?> </p>

                        <?php allCommentList($conn, $row2['ID']); ?>
                    </div>
                <?php endwhile ?>
            <?php endwhile ?>


            <?php
            if (isset($_POST["comment-btn"])) {
                setComment($conn, $_POST['comment_hidden']);
            }
            ?>
        </div>
    </main>
    <footer>
        <a href="#">Logó?</a>
        <a href="#">Rólunk</a>
        <a href="#">ÁSZF</a>
        <a href="#">Feltételek</a>
        <a href="#">Hirdetés</a>
    </footer>

</body>


</html>