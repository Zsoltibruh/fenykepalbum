<?php
session_start();
?>

<!DOCTYPE php>
<php lang="hu">

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
                <ul>
                    <li><a href="index.php">Főoldal</a></li>
                    <li><a href="login.php">Bejelentkezés</a></li>
                    <li><a href="signup.php">Regisztráció</a></li>
                    <li><a href="upload.php">Feltöltés</a></li>
                    <li><a href="albums.php">Albumok</a></li>
                    <li><a href="connection.php">SIKERÜLT-E CSATLAKOZNI?</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div id="container">
                <form method="post" id="authform">
                    <input type="submit" name="ujalbum" value="Új album létrehozása">
                    <?php
                    include 'includes/dbconnect.php';
                    if (isset($_POST['ujalbum'])) {
                        echo "Album neve: <input type='text' name='nev'><br>";
                        echo "<input type='submit' name='letrehoz' value='Létrehozás' class='bttn'>";
                    }

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

                    // SQL lekérdezés előkészítése
                    $neptun = "C##D7YP5C";
                    $query = "SELECT * FROM $neptun.album INNER JOIN $neptun.albumja ON album.id = albumja.id INNER JOIN $neptun.felhasznalo on albumja.felhasznalonev = felhasznalo.felhasznalonev WHERE felhasznalo.felhasznalonev LIKE ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1, $_SESSION["felhasznalonev"]);
                    $stmt->execute();


                    // Eredmények kiolvasása
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='card'>";
                        echo "<h2>" . $row['ALBUMNEV'] . "</h2>";
                        echo "<div class='button-container'>";
                        echo "<input type='submit' name='torol' value='🗑️' class='album_bttn'>";
                        echo "<input type='hidden' name='hiddentorol' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' name='szerkeszt' value='🖊️' class='album_bttn'>";
                        echo "</div>";
                        echo "</div>";
                    }

                    if (isset($_POST['torol'])) {
                        $felt = $_POST['hiddentorol'];
                        $query = "DELETE FROM $neptun.albumja WHERE ID = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(1, $felt, PDO::PARAM_INT);
                        $stmt->execute();

                        header("location: albums.php?success=delete");
                    }

                    if (isset($_GET["success"]))
                    {
                        if ($_GET["success"] == "uploadsuccess")
                        {
                            echo '<p>Album létrehozva!</p>';
                        }
                        if ($_GET["success"] == "delete")
                        {
                            echo '<p>Album törölve!</p>';
                        }
                    }
                    ?>
                    

                </form>
            </div>
        </main>
        <footer>
            <h1>Ez lesz a footer</h1>
        </footer>
    </body>

</php>