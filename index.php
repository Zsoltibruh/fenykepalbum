<?php
session_start();
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
            <ul>
                <li><a href="index.php">Főoldal</a></li>
                <li><a href="login.php">Bejelentkezés</a></li>
                <li><a href="signup.php">Regisztráció</a></li>
                <li><a href="upload.php">Feltöltés</a></li>
                <li><a href="albums.php">Albumok</a></li>
                <li><a href="photos.php">Fényképek</a></li>
                <li><a href="connection.php">SIKERÜLT-E CSATLAKOZNI?</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container">
            <?php
            if (isset($_SESSION["felhasznalonev"])) {
                $username = $_SESSION["felhasznalonev"];
                echo "<h1>Szia, $username!</h1>";
            } else {
                echo "<h1>Szia!</h1>";
            }
            ?>
        </div>
    </main>
    <footer>
        <h1>Az oracle lyo</h1>
    </footer>
</body>

</php>