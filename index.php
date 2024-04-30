<?php
session_start();
?>

<!DOCTYPE php>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fényképalbum</title>
    <style>
        body {
            transition: 0.5s ease-in-out;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-image: url("img/hatter3.jpg");
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul class="nav-index">
                <div class="nav-auth">
                    <li><a href="login.php">Bejelentkezés</a></li>
                    <li><a href="signup.php">Regisztráció</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div id="welcome-card">
            <h1>Üdvözlünk az <span class="highlight-text">Image</span>-In oldalán!</h1>
            <div id="welcome-text">
            <h3>Csatlakozz az <span class="highlight-text">Image</span>-In közösségéhez, kövess be embereket, kedvelj albumokat és képeket, feltöltött képeid rendezd albumokba, amit bárkivel megoszthatsz!</h3>
            </div>
        </div>
    </main>
    <footer>
        <a href="#">Rólunk</a>
        <a href="#">ÁSZF</a>
        <a href="#">Feltételek</a>
        <a href="#">Hirdetés</a>
    </footer>
    <script src="index.js"></script>
</body>

</html>