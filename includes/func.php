<?php
function emptyInputSignup($username,$email,$password,$repassword){
    $result = false;
    if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
        $result = true;
    }
    return $result;
}

function nameExists($kapcs, $username, $email){
    //TODO: Dobjon hibát, ha már létezik a felhasználónév
}

function invalidEmail($email){
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function passNotMatches($password, $repassword){
    $result = false;
    if ($password !== $repassword) {
        $result = true;
    }
    return $result;
}

function createUser($kapcs, $username, $email, $password){
    //TODO: Felhasználó létrehozásának megvalósítása
    header("location: ../index.php?success=signupsuccess");
    exit();
}

function emptyInputLogin($username,$password){
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    return $result;
}

function loginUser($kapcs, $username, $password){
    $usernameExists = nameExists($kapcs, $username, $username);

    if ($usernameExists === false) {
        header("location: ../index.php?error=namealreadytaken");
        exit();
    }

    $checkpassword = password_verify($password, $usernameExists["jelszo"]);

    if ($checkpassword === false) {
        header("location: ../index.php?error=wrongpassword");
        exit();
    }
    else if($checkpassword === true){
        session_start();
        $_SESSION["username"] = $usernameExists["username"];
        header("location: ../index.html");
        exit();
    } 

}