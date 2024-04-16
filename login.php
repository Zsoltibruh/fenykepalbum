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
                <li><a href="connection.php">SIKERÜLT-E CSATLAKOZNI? (KELL VAGY MEGBUKSZXDDD)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container">
            <form action="includes/manageAuth.php" method="POST" id="authform">
                <label for="email">E-mail cím</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" required>
                <div>
                    <input type="submit" value="Bejelentkezés" name="login">
                </div>
            </form>
        </div>
    </main>
    <footer>
        <h1>Az oracle lyo</h1>
    </footer>
</body>

</php>