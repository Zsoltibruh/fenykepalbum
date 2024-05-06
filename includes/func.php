<?php
function emptyInputSignup($username, $email, $password, $repassword)
{
    $result = false;
    if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
        $result = true;
    }
    return $result;
}

function nameExists($conn, $username)
{
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


function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function passNotMatches($password, $repassword)
{
    $result = false;
    if ($password !== $repassword) {
        $result = true;
    }
    return $result;
}

function createUser($conn, $username, $email, $password)
{
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

function emptyInputLogin($username, $password)
{
    $result = false;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    return $result;
}

function loginUser($conn, $username, $password)
{
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
    } else {
        session_start();
        $_SESSION["felhasznalonev"] = $user['FELHASZNALONEV'];
        header("location: ../home.php");
        exit();
    }
}

function deleteAlbum($conn, $albumID)
{
    $neptun = "C##D7YP5C";
    $query = "DELETE * FROM $neptun.albumja WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $albumID);
    $stmt->execute();

    header("location: albums.php?success=delete");
}

function likePress($conn, $pic_id, $username, bool $like)
{
    $neptun = "c##d7yp5c";

    if ($like) {
        $query = "DELETE FROM $neptun.KEDVELI WHERE felhasznalonev LIKE ? AND KEPEKID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $pic_id);
        $stmt->execute();
    } else {
        $query = "INSERT INTO $neptun.KEDVELI VALUES (?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $pic_id);
        $stmt->execute();
    }
}


function allCommentList($conn, $pic_id)
{
    $neptun = "c##d7yp5c";
    $query = "SELECT KOMMENTID,FELHASZNALONEV,SZOVEG FROM " . $neptun . ".komment WHERE KEPEKID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $pic_id);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <div id="comment_element">
            <hr>
            <p id="commentname"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
            <p id="commenttext"> <?php print_r($row['SZOVEG']); ?> </p>
        </div>

    <?php endwhile ?>


    <form action="" method="POST">
        <input type="hidden" name="comment_hidden" value='<?php print $pic_id ?>'>
        <input type="text" name="comment_text" id="" class="comment-text-box" placeholder="Comment...">
        <input type="submit" value="✔" class="comment-btn" name="comment-btn">
    </form>
    <hr>
<?php

}

function setComment($conn, $pic_id)
{
    $neptun = "c##d7yp5c";
    if ($_POST["comment_text"] == "") {
        return;
    }

    $comment_query = "SELECT Max(kommentid)+1 AS NEXTID FROM " . $neptun . ".komment";
    $comment_id = $conn->prepare($comment_query);
    $comment_id->execute();

    $row2 = $comment_id->fetch(PDO::FETCH_ASSOC);

    $username = $_SESSION["felhasznalonev"];
    $comment_text = $_POST['comment_text'];

    $query2 = "INSERT INTO " . $neptun . ".komment VALUES (?,?,?,?)";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(1, $row2['NEXTID']);
    $stmt2->bindParam(2, $username);
    $stmt2->bindParam(3, $pic_id);
    $stmt2->bindParam(4, $comment_text);
    $stmt2->execute();

    header("Refresh:0");
}

function albumDelete($conn, $pic_id)
{
    $neptun = "c##d7yp5c";
    $query = "DELETE FROM $neptun.albumja WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $pic_id);
    $stmt->execute();

    header("location: ../albums.php?success=delete");
}

function uploadImage($conn, $username, $description, $name, $filename, $album)
{
    $neptun = "c##d7yp5c";
    $maxQuery = "SELECT Max(id)+1 AS NEXTID FROM $neptun.kepek";
    $id_stmt = $conn->prepare($maxQuery);
    $id_stmt->execute();
    $ID = $id_stmt->fetch(PDO::FETCH_ASSOC);

    $query = "INSERT INTO $neptun.kepek VALUES(?,?,?,?,?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $ID["NEXTID"]);
    $stmt->bindParam(2, $username);
    $stmt->bindParam(3, $description);
    $stmt->bindParam(4, $name);
    $stmt->bindParam(5, $filename);
    $stmt->bindParam(6, $album);
    $stmt->execute();


    header("location: ../photos.php?success=upload");
    exit();
}

function emptyInputUpload($description, $name, $filename)
{
    if (empty($description) || empty($name) || empty($filename)) {
        return TRUE;
    }

    return FALSE;
}

function deleteImage($conn, $imageID, $filename)
{
    if (unlink("../img/local/" . $filename)) {
        $neptun = "c##d7yp5c";
        $query = "DELETE FROM $neptun.kepek WHERE id = ?";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(1, $imageID);
        $stmt->execute();

        header("location: ../photos.php?success=imagedelete");
        exit();
    }
}

function likeButtons($conn,$username,$pic_id, $like_count)
{
    $neptun = "c##d7yp5c";
    $query4 = "SELECT KEPEKID FROM $neptun.KEDVELI WHERE felhasznalonev LIKE ?";
    $stmt4 = $conn->prepare($query4);
    $stmt4->bindParam(1, $username);
    $stmt4->execute();

    $bennevan = FALSE;
    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {

        if (in_array($pic_id, $row4)) {
            $bennevan = TRUE;
        }
    }
    if ($bennevan) {

        echo "<form method='POST' class='like-button-form'>";
        echo "<input type='hidden' name='id' value='" . $pic_id . "'>";
        echo "<input type='hidden' name='liked' value='" . $pic_id . "'>";
        echo "<button type='submit' class = 'like-button'><img class='like-button liked' src='img/icons/like.svg' alt='liked'></button>";
        echo "<p class='like_count'>" . $like_count . "</p>";
        echo "</form>";
    } else {

        echo "<form method='POST' class='like-button-form'>";
        echo "<input type='hidden' name='id' value='" . $pic_id . "'>";
        echo "<input type='hidden' name='not_liked' value='" . $pic_id . "'>";
        echo "<button type='submit' class = 'like-button'><img class='like-button' src='img/icons/like.svg' alt='liked'></button>";
        echo "<p class='like_count'>" . $like_count . "</p>";
        echo "</form>";
    }
}

?>