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
    $query = "INSERT INTO $neptun.felhasznalo VALUES(?,?,?, 0)";

    $hashpass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $hashpass);
    $stmt->execute();

    header("location: ../login.php?success=signupsuccess");
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
    $neptun = "C##D7YP5C";
    $query = "SELECT * FROM $neptun.felhasznalo WHERE felhasznalonev = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $checkpassword = password_verify($password, $user['JELSZO']);

    if ($checkpassword === false) {
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    else {  
        session_start();
        $_SESSION["felhasznalonev"] = $user['FELHASZNALONEV'];
        header("location: ../albums.php");
        exit();
    } 
}

function deleteAlbum($conn, $albumID) {
    $neptun = "C##D7YP5C";
    $query = "DELETE * FROM $neptun.albumja WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $albumID);
    $stmt->execute();
    
    header("location: albums.php?success=delete");
}