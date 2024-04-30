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

                if(isset($_GET["success"])) {
/*                     if ($_GET["success"] == "upload") {
                        echo "<h3>Sikeres feltöltés!</h3>";
                    } */
                }
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