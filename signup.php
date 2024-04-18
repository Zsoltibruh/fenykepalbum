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
            <form action="includes/manageSignup.php" method="POST" id="authform">
                <label for="username">Felhasználónév</label>
                <input type="text" name="username" id="username" required>
                <label for="email">E-mail cím</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" required>
                <label for="repassword">Jelszó újra</label>
                <input type="password" name="repassword" id="repassword" required>
                <div>
                    <input type="submit" value="Regisztráció" name="signup">
                </div>
                <?php
            if (isset($_GET["error"]))
            {
                if ($_GET["error"] == "emptyinput")
                {
                    echo '<p>Kérjük minden mezőt töltsön ki!</p>';
                }
                else if ($_GET["error"] == "usernametaken")
                {
                    echo '<p>Felhasználónév foglalt!</p>';
                }
                else if ($_GET["error"] == "invalidemail")
                {
                    echo '<p>Helytelen email cím!</p>';
                }
                else if ($_GET["error"] == "passwordnotmatches")
                {
                    echo '<p>Jelszavak nem egyeznek!</p>';
                }
            }
            ?>
            </form>
        </div>
    </main>
    <footer>
        <h1>Az oracle lyo</h1>
    </footer>
</body>

</php>