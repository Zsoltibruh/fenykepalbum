<?php
require('dbconnect.php');
require('func.php');

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