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
            session_start();
            require("includes/dbconnect.php");
            $neptun = "c##d7yp5c";
            ?>

            <form action="includes/fileUpload.php" method="POST" enctype="multipart/form-data" id="image--upload">
                <h1>Kép feltötlése</h1> <br>
                <hr>
                <input type="file" name="image" id="image" accept="image/*"> <br> <br>
                <div id="image-data">
                    <h2>Név</h2>
                    <input type='text' name='image-name'>
                    <h2>Leírás</h2>
                    <textarea id="desc" name="description" rows="5" cols="50"></textarea>
                </div>
                <input type="submit" value="Feltöltés" name="upload" id="upload-btn">
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "noimage") {
                        echo '<h3>Semmit nem lehet feltölteni!</h3>';
                    }
                    if ($_GET["error"] == "emptyinput") {
                        echo '<h3>Kérjük minden mezőt töltsön ki!</h3>';
                    }
                }
                ?>
            </form>




            <?php
            $query = "SELECT kepek.* FROM $neptun.KEPEK WHERE album LIKE ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $_SESSION["albumid"]);
            $stmt->execute();

            $album_query = "SELECT ALBUMNEV FROM $neptun.album WHERE $neptun.album.id LIKE ?";
            $album_stmt = $conn->prepare($album_query);
            $album_stmt->bindParam(1, $albumid);
            $album_stmt->execute();


            ?>
            <?php
            while ($album_row = $album_stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <h1>Ezek itt most a <?php echo $album_row['ALBUMNEV']; ?> nevetezű albumodban található képek!</h1>

            <?php
            endwhile;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="post-element">

                    <p id="username"> <?php echo $row['FELHASZNALONEV']; ?> </p>
                    <img src="img/local/<?php echo $row['KEP']; ?>" alt="<?php echo $row['KEP']; ?>">
                    <p id="imgtitle"> <?php echo $row['NEV']; ?> </p>
                    <p id="imgdesc"> <?php echo $row['LEIRAS']; ?> </p>

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
        <a href="#">Logó?</a>
        <a href="#">Rólunk</a>
        <a href="#">ÁSZF</a>
        <a href="#">Feltételek</a>
        <a href="#">Hirdetés</a>
    </footer>

</body>


</html>