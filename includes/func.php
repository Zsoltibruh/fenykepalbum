<?php
function emptyInputSignup($username,$email,$password,$repassword){
    $result = false;
    if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
        $result = true;
    }
    return $result;
}

function nameExists($conn, $username){
    try {
        $neptun = "C##D7YP5C";
        $query = "SELECT * FROM $neptun.felhasznalo WHERE felhasznalonev = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        return false;
    }
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

function createUser($conn, $username, $email, $password){
    $neptun = "C##D7YP5C";
    $query = "INSERT INTO $neptun.felhasznalo VALUES(?,?,?)";

    $hashpass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $hashpass);
    $stmt->execute();

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

function loginUser($conn, $username, $password){
    $usernameExists = nameExists($conn, $username, $username);

    if ($usernameExists === false) {
        header("location: ../login.php?error=nametaken");
        exit();
    }

    $checkpassword = password_verify($password, $usernameExists["jelszo"]);

    if ($checkpassword === false) {
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    else {
        session_start();
        $_SESSION["felhasznalonev"] = $usernameExists["felhasznalonev"];
        header("location: ../index.php");
        exit();
    } 
}