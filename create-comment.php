<?php
    include_once "partials/testbaseconnection.php";
?>


<?php
    $post_id = $_POST['post_id'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];

    var_dump($post_id);
    var_dump($author);
    var_dump($comment);
/*
    $sqlInsert = "INSERT INTO comments (author, text, post_id) VALUES ('$author', '$comment', '$post_id')";
    $statementInsert = $connection->prepare($sqlInsert);
    // izvrsavamo upit
    $statementInsert->execute();
*/
?>

<?php
//header("Location: single-post.php?post_id=$post_id"); 
?>
