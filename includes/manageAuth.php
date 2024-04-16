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
    
    if (nameExists($conn, $username, $email)) {
        header("location: ../signup.php?error=usernametaken");
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

    createUser($conn, $username, $email, $password);

} else{
    header("location: ../login.php");
    exit();
}

//Bejelentkezés kezelése
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (emptyInputLogin($username,$password)) {
        header("location: ../index.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password);
    exit();
} else{
    header("location: ../index.php");
    exit();
}