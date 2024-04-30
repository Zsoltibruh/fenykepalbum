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
                    <li><a href="home.php">Követések</a></li>
                    <li><a href="#">Felfedezés</a></li>
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
            ?>

            <?php
            $query = "SELECT kepek.* FROM $neptun.KEPEK";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="post-element">

                    <p class="username"> <?php echo $row['FELHASZNALONEV']; ?> </p>
                    <p class="imgtitle"> <?php echo $row['NEV']; ?> </p>
                    <p class="imgdesc"> <?php echo $row['LEIRAS']; ?> </p>
                    <img src="img/local/<?php echo $row['KEP']; ?>" class="home-pic" alt="<?php echo $row['KEP']; ?>">

                    <?php allCommentList($conn, $row['ID']); ?>
                </div>
            <?php endwhile ?>

            <?php
            if (isset($_POST["comment-btn"])) {
                setComment($conn, $_POST['comment_hidden']);
            }
            ?>
        </div>
    </main>
    <footer>
        <a href="#">Rólunk</a>
        <a href="#">ÁSZF</a>
        <a href="#">Feltételek</a>
        <a href="#">Hirdetés</a>
    </footer>

</body>


</html>