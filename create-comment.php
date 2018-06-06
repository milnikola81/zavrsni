<?php
	session_start();
?>

<?php
    include_once "partials/dbconnection.php";
?>


<?php

    $post_id = intval($_GET['post_id']);
    $author = $_SESSION['author'];
    $comment = $_SESSION['comment'];
/*
    var_dump($post_id);
    var_dump($author);
    var_dump($comment);
*/


    $sqlInsert = "INSERT INTO comments (author, text, post_id) VALUES ('$author', '$comment', '$post_id')";
    $statementInsert = $connection->prepare($sqlInsert);


    // izvrsavamo upit
    $statementInsert->execute();

    session_unset(); 

// destroy the session 
    session_destroy(); 

    
?>

<?php

header("location: single-post.php?id=$post_id");

?>