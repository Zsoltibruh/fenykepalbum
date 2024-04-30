<!DOCTYPE php>
<html lang="en">

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
                    <li><a href="home.php">Home</a></li>
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
            session_start();
            require("includes/dbconnect.php");
            $neptun = "c##d7yp5c";
            $albumid = 37;
            $felh = 'Bobytest';
            $query = "SELECT kepek.* FROM $neptun.KEPEK 
            INNER JOIN $neptun.tartalmazza ON kepek.id = tartalmazza.id 
            INNER JOIN $neptun.album on album.ID = tartalmazza.albumid 
            WHERE kepek.felhasznalonev LIKE ? AND album.id LIKE ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $felh);
            $stmt->bindParam(2, $albumid);
            $stmt->execute();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <p id="username"> <?php echo $row['FELHASZNALONEV']; ?> </p>
                <img src="img/local/<?php echo $row['KEP']; ?>" alt="<?php echo $row['KEP']; ?>">
                <p id="imgtitle"> <?php echo $row['NEV']; ?> </p>
                <p id="imgdesc"> <?php echo $row['LEIRAS']; ?> </p>

                <?php allCommentList($conn, $row['ID']); ?>

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