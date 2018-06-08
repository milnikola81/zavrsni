<?php
    include_once "partials/dbconnection.php";
?>

<?php
    $post_id = intval($_GET['post_id']);

    //var_dump($comment_id);
    $sqlDeleteComments = "DELETE FROM comments WHERE post_id = $post_id";
    $sqlDeletePost = "DELETE FROM posts WHERE id = $post_id";
    
    $statementDeleteComments = $connection->prepare($sqlDeleteComments);
    $statementDeletePost = $connection->prepare($sqlDeletePost);
    // izvrsavamo upit
    $statementDeleteComments->execute();
    $statementDeletePost->execute();

?>

<?php
header("location: posts.php");
?>
