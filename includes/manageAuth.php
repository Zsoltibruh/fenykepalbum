<?php
require('dbconnect.php');
require('func.php');

//Regisztráció kezelése
if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    if (emptyInputSignup($username,$email,$password,$repassword)) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    
    if (invalidEmail($email)) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (passNotMatches($password,$repassword)) {
        header("location: ../signup.php?error=passwordnotmatches");
        exit();
    }

    if (nameExists($kapcs,$username, $email)) {
        header("location: ../signup.php?error=nametaken");
        exit();
    }

    createUser($kapcs, $username, $email, $password);

} else{
    header("location: ../index.php");
    exit();
}

//Bejelentkezés kezelése
if (isset($_POST["login"])) {
    $username = $_POST["login"];
    $password = $_POST["password"];

    if (invalidEmail($email)) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (emptyInputLogin($username,$password)) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($kapcs, $username, $password);
    exit();
} else{
    header("location: ../index.php");
    exit();
}