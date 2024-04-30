<?php
session_start();
?>

<!DOCTYPE html>
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
                    <li><a href="home.php">Követések</a></li>
                    <li><a href="discovery.php">Felfedezés</a></li>
                    <li><a href="#">Albumjaim</a></li>
                    <li><a href="includes/logout.php">Kijelentkezés</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div id="album_container">
            <form method="post" id="album-form">
                <?php
                require("includes/func.php");
                ?>
                <input type="submit" name="ujalbum" value="Új album létrehozása" class="album-create-btn">
                <?php
                include 'includes/dbconnect.php';
                if (isset($_POST['ujalbum'])) {
                    echo "Album neve: <input type='text' name='nev'><br>";
                    echo "<input type='submit' name='letrehoz' value='Létrehozás' class='bttn'>";
                }
                echo "<div class='row'>";

                if (isset($_POST['letrehoz'])) {
                    $neptun = "C##D7YP5C";
                    $query = "insert into $neptun.album VALUES(?,?)";
                    $nev = $_POST["nev"];
                    $album = "SELECT Max(id)+1 AS ALBUMID FROM " . $neptun . ".album";
                    $album_id = $conn->prepare($album);
                    $album_id->execute();

                    $id = $album_id->fetch(PDO::FETCH_ASSOC);

                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1, $id["ALBUMID"]);
                    $stmt->bindParam(2, $nev);
                    $stmt->execute();

                    $query2 = "INSERT INTO $neptun.albumja VALUES(?,?)";

                    $stmt2 = $conn->prepare($query2);
                    $stmt2->bindParam(1, $id["ALBUMID"]);
                    $stmt2->bindParam(2, $_SESSION["felhasznalonev"]);
                    $stmt2->execute();

                    header("location: albums.php?success=uploadsuccess");
                    exit();
                }
                echo "</form>";
                // SQL lekérdezés előkészítése
                $neptun = "C##D7YP5C";
                $query = "SELECT * FROM $neptun.album 
                INNER JOIN $neptun.albumja ON album.id = albumja.id 
                INNER JOIN $neptun.felhasznalo on albumja.felhasznalonev = felhasznalo.felhasznalonev WHERE felhasznalo.felhasznalonev LIKE ?";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(1, $_SESSION["felhasznalonev"]);
                $stmt->execute();


                // Eredmények kiolvasása
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $query1 = "SELECT kep FROM $neptun.kepek WHERE album = ? FETCH FIRST 1 ROWS ONLY";
                    $stmt1 = $conn->prepare($query1);
                    $stmt1->bindParam(1, $row['ID']);
                    $stmt1->execute();

                    $result = $stmt1->fetch(PDO::FETCH_ASSOC);

                    if (empty($result)) {
                        echo "<form method='post' action='includes/manageAlbum.php' class='column'>";
                        echo "<div class='card'>";
                        echo "<h2>" . $row['ALBUMNEV'] . "</h2>";
                        echo "<div class='card-background no-picture'></div>";
                        echo "<div class='button-container'>";
                        echo "<input type='submit' name='megnyit' value='📖' class='album_bttn'>";
                        echo "<input type='submit' name='torol' value='🗑️' class='album_bttn'>";
                        echo "<input type='hidden' name='hiddentorol' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' name='szerkeszt' value='🖊️' class='album_bttn'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                    if (!empty($result)) {
                        echo "<form method='post' action='includes/manageAlbum.php' class='column'>";
                        echo "<div class='card'>";
                        echo "<h2>" . $row['ALBUMNEV'] . "</h2>";
                        echo "<div class='card-background' style='background-image: url(img/local/" . $result['KEP'] . ")'></div>";
                        echo "<div class='button-container'>";
                        echo "<input type='submit' name='megnyit' value='📖' class='album_bttn'>";
                        echo "<input type='submit' name='torol' value='🗑️' class='album_bttn'>";
                        echo "<input type='hidden' name='hiddentorol' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' name='szerkeszt' value='🖊️' class='album_bttn'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</form>";
                    }
                }


                echo "</div>";
                if (isset($_GET["success"])) {
                    if ($_GET["success"] == "uploadsuccess") {
                        echo '<p>Album létrehozva!</p>';
                    }
                    if ($_GET["success"] == "delete") {
                        echo '<p>Album sikeresen törölve!</p>';
                    }
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