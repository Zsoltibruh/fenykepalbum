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
                <li><a href="connection.php">SIKERÜLT-E CSATLAKOZNI? (KELL VAGY MEGBUKSZXDDD)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container">
            <form action="includes/fileUpload.php" method="POST" id="image--upload">
                <h1>Kép feltötlése</h1> <br>
                <hr>
                <input type="file" name="image" id="image" accept="image/*"> <br> <br>
                <input type="submit" value="Feltöltés" name="upload">
                <?php
                if(isset($_GET["success"])) {
                    if ($_GET["success"] == "upload") {
                        echo '<p>Kép sikeresen feltöltve!</p>';
                    }
                }
                if(isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyinput") {
                        echo '<h3>Semmit nem lehet feltölteni!</h3>';
                    }
                }
                ?>
            </form>
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