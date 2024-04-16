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
                    $felhnev = 'Vargavirag';
                    if (isset($_POST['ujalbum'])) {
                        echo "Album neve: <input type='text' name='nev'><br>";
                        echo "<input type='submit' name='letrehoz' value='Létrehozás'>";
                    }

                        if (isset($_POST['letrehoz'])) {
                            $neptun = "C##D7YP5C";
                            $query = "insert into $neptun.album VALUES(?,?)";
                            $id = 20;
                            $nev = $_POST["nev"];
                        
                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(1, $id);
                            $stmt->bindParam(2, $nev);
                            $stmt->execute();

/*                             $query2 = "insert into $neptun.albumja VALUES(?,?)";
                        
                            $stmt2 = $conn->prepare($query);
                            $stmt2->bindParam(1, $result["id"]);
                            $stmt2->bindParam(2, $felhnev);
                            $stmt2->execute(); */
                        
                            header("location: albums.php?success=uploadsuccess");
                            exit();
                        }

                    // SQL lekérdezés előkészítése
                    $neptun = "C##D7YP5C";
                    $query = "SELECT * FROM $neptun.album INNER JOIN $neptun.albumja ON album.id = albumja.id INNER JOIN $neptun.felhasznalo on albumja.felhasznalonev = felhasznalo.felhasznalonev WHERE felhasznalo.felhasznalonev LIKE ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1, $felhnev);
                    $stmt->execute();


                    // Eredmények kiolvasása
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='card'>";
                        echo "<h2>" . $row['ALBUMNEV'] . "</h2>";
                        echo "<div class='button-container'>";
                        echo "<input type='submit' name='torol' value='Törlés'>";
                        echo "<input type='hidden' name='hiddentorol' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' name='szerkeszt' value='Szerkesztés'>";
                        echo "</div>";
                        echo "</div>";
                    }

                    if (isset($_POST['torol'])) {
                        $felt = $_POST['hiddentorol'];
                        $query = "DELETE FROM $neptun.album WHERE ID = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(1, $felt, PDO::PARAM_INT);
                        $stmt->execute();
                    }

                    if (isset($_GET["success"]))
                    {
                        if ($_GET["success"] == "uploadsuccess")
                        {
                            echo '<p>Album létrehozva!</p>';
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