<link rel="stylesheet" href="style.css">
<div class="container">
    <?php
    require("includes/dbconnect.php");
    require("includes/func.php");
    $neptun = "c##d7yp5c";

    $query = "SELECT * FROM " . $neptun . ".kepek";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>

        <p id="username"> <?php print_r($row['FELHASZNALONEV']); ?> </p>
        <img src="img/<?php print_r($row['KEP']); ?>" alt="<?php print_r($row['KEP']); ?>">
        <p id="imgtitle"> <?php print_r($row['NEV']); ?> </p>
        <p id="imgdesc"> <?php print_r($row['LEIRAS']); ?> </p>

        <?php allCommentList($conn, $row['ID']); ?>

    <?php endwhile ?>

    <?php setComment($conn,  $_POST['comment_hidden']); ?>
</div>