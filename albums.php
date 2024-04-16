<!DOCTYPE php>
<php lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Fényképalbum</title>
        <style>
        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #333;
        }

        .card p {
            color: #666;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-container input {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-container input:hover {
            background-color: #0056b3;
        }

    </style>
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="index.php">Főoldal</a></li>
                    <li><a href="login.php">Bejelentkezés</a></li>
                    <li><a href="signup.php">Regisztráció</a></li>
                    <li><a href="albums.php">Albumok</a></li>
                    <li><a href="connection.php">SIKERÜLT-E CSATLAKOZNI?</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div id="container">
                <form method="post">
                    <input type="submit" name="ujalbum" value="Új album létrehozása">


                    <?php
                    include 'connection.php';
                    $conn = new PDO("oci:dbname=".$tns,$db_username,$db_password);
                    if (isset($_POST['ujalbum'])) {
                        echo "Album neve: <input type='text' name='nev'><br>";
                        echo "<input type='submit' name='letrehoz' value='Létrehozás'>";
                    }/*
                    if (isset($_POST['letrehoz'])) {
                        $incrementquery = "SELECT COUNT(*) FROM album";
                        $incrementeredm = oci_parse($conn, $incrementquery);
                        oci_execute($incrementeredm);
                        $increment = oci_fetch_assoc($incrementeredm);
                        $nev = $_POST['nev'];
                        $albumquery = "INSERT INTO album (id, albumnev) VALUES ($increment + 1,'$nev');";
                        $albumeredm = oci_parse($conn, $albumquery);
                    }*/



                    $felhnev = 'Boytea';
                    // SQL lekérdezés előkészítése
                    $query = "SELECT * FROM album INNER JOIN albumja ON album.id = albumja.id INNER JOIN felhasznalo on albumja.felhasznalonev = felhasznalo.felhasznalonev WHERE felhasznalo.felhasznalonev LIKE ?";
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
                        print_r($row['ALBUMNEV']);
                    }

                    if (isset($_POST['torol'])) {
                        $felt = $_POST['hiddentorol'];
                        $query = "DELETE FROM album WHERE ID LIKE ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(1, $felt);
                        $stmt->execute();
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