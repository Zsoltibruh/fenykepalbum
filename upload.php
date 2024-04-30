<?php
session_start();
require("includes/dbconnect.php");
?>

<!DOCTYPE php>
<php lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fényképalbum</title>
</head>

<body>
<header>
        <nav>
            <div class="nav-back">
                <ul>
                    <li><a href="#">LOGÓ</a></li>
                </ul>
            </div>
            <ul class="nav-index">
                <div class="nav-auth">
                    <li><a href="albums.php">Vissza</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container">
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
                    if(isset($_GET["error"])) {
                        if ($_GET["error"] == "noimage") {
                            echo '<h3>Semmit nem lehet feltölteni!</h3>';
                        }
                        if ($_GET["error"] == "emptyinput") {
                            echo '<h3>Kérjük minden mezőt töltsön ki!</h3>';
                        }
                    }
                    ?>
                </form>
                <h1>Album képei</h1>
            <div id="kepek">
            <?php
            $neptun = "C##D7YP5C";
            $query = "SELECT * FROM $neptun.kepek
            INNER JOIN $neptun.tartalmazza ON kepek.id = tartalmazza.id
            INNER JOIN $neptun.album ON album.id = tartalmazza.albumid
            WHERE album.id = ".$_SESSION["albumid"]."";

            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<form method='post' action='includes/manageAlbum.php'>";
                echo "<div class='card'>";
                echo "<h2>" . $row['NEV'] . "</h2>";
                echo "<div class='card-background' style='background-image: url(img/local/" . $row['KEP'] . ")'></div>";
                echo "<div class='button-container'>";
                echo "<input type='submit' name='keptorol' value='🗑️' class='album_bttn'>";
                echo "<input type='hidden' name='hiddentorol' value='" . $row["ID"] . "'>";
                echo "<input type='hidden' name='hiddennev' value='" . $row["KEP"] . "'>";
                echo "</div>";
                echo "</div>";
                echo "</form>";
            }
            ?>
            </div>
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

</php>