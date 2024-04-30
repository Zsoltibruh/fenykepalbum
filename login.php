<!DOCTYPE php>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fényképalbum</title>
</head>

<body>
    <dialog id="successModal">
        <h2>Sikeres regisztráció!</h2>
    </dialog>
    <header>
        <nav>
            <div class="nav-back">
                <ul>
                    <li><a href="index.php">Vissza</a></li>
                </ul>
            </div>
            <ul class="nav-index">
                <div class="nav-auth">
                    <li><a href="login.php" class="active">Bejelentkezés</a></li>
                    <li><a href="signup.php">Regisztráció</a></li>
                </div>
            </ul>
        </nav>
    </header>
    <main>
        <div id="container">
            <form action="includes/manageLogin.php" method="POST" id="authform">
                <label for="username">Felhasználónév</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Jelszó</label>
                <input type="password" name="password" id="password" required>
                <div>
                    <input type="submit" value="Bejelentkezés" name="login" class="bttn">
                    <?php
                    if (isset($_GET["error"]))
                    {
                        if ($_GET["error"] == "emptyinput")
                        {
                            echo '<p class="errorcode">Kérjük minden mezőt töltsön ki!</p>';
                        }
/*                         else if ($_GET["error"] == "nametaken")
                        {
                            echo '<p class="errorcode">Nem létező felhasználónév!</p>';
                        } */
                        else if ($_GET["error"] == "wrongpassword")
                        {
                            echo '<p class="errorcode">Helytelen jelszó!</p>';
                        }
                        else if ($_GET["error"] == "unkownerror")
                        {
                            echo '<p class="errorcode">Ismeretlen hiba!</p>';
                        }
                    }
                    ?>
                </div>
            <?php
            if (isset($_GET["success"]))
            {
                if ($_GET["success"] == "signupsuccess")
                {
                    echo "<script>
                    let modal = document.getElementById('successModal');
                    modal.showModal();
                    
                    setTimeout(() => {
                        modal.close();
                    }, 1000);
                    </script>";
                }
            }
            ?>
            </form>
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