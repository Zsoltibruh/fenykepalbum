<link rel="stylesheet" href="style.css">
<div class="container">
    <?php
    require("includes/dbconnect.php");
    $neptun = "c##d7yp5c";

    function bababarat($pic_id)
    {
        require("includes/dbconnect.php");
        $neptun = "c##d7yp5c";
        $query = "SELECT KOMMENTID,FELHASZNALONEV,SZOVEG FROM " . $neptun . ".komment WHERE KEPEKID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $pic_id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

            <p id="commentname"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
            <p id="commenttext"> <?php print_r($row['SZOVEG']); ?> </p>

        <?php endwhile ?>


        <form action="" method="POST">
            <input type="hidden" name="comment_hidden" value="$pic_id">
            <input type="text" name="comment_text" id="" placeholder="Comment...">
            <input type="submit" value="✔" name="comment">
        </form>
    <?php
        if (isset($_POST["comment"])) {
            $comment_query = "SELECT Max(kommentid)+1 AS NEXTID FROM " . $neptun . ".komment";
            $comment_id = $conn->prepare($comment_query);
            $comment_id->execute();

            $row2 = $comment_id->fetch(PDO::FETCH_ASSOC);


            $username = "Brendonvok45";
            $comment_text = $_POST['comment_text'];


            $query2 = "INSERT INTO " . $neptun . ".komment VALUES (?,?,?,?)";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bindParam(1, $row2['NEXTID']);
            $stmt2->bindParam(2, $username);
            $stmt2->bindParam(3, $pic_id);
            $stmt2->bindParam(4, $comment_text);
            $stmt2->execute();

            $query3 = "INSERT INTO " . $neptun . ".MELYIK_KEP VALUES (?,?)";
            $stmt3 = $conn->prepare($query3);
            $stmt3->bindParam(1, $pic_id);
            $stmt3->bindParam(2, $row2['NEXTID']);
            $stmt3->execute();

            header("Refresh:0");
        }
    }
    ?>

    <?php

    $query = "SELECT * FROM " . $neptun . ".kepek";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <p id="username"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
        <img src="img/<?php print_r($row['KEP']); ?>" alt="<?php print_r($row['KEP']); ?>">
        <p id="imgtitle"> <?php print_r($row['NEV']); ?> </p>
        <p id="imgdesc"> <?php print_r($row['LEIRAS']); ?> </p>

        <?php bababarat($row['ID']); ?>

    <?php endwhile ?>
</div>