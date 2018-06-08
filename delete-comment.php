<?php
    include_once "partials/dbconnection.php";
?>


<?php
    $post_id = intval($_GET['post_id']);
    //var_dump($post_id);
?>

<?php
    $comment_id = intval($_GET['comment_id']);

    //var_dump($comment_id);

    $sqlDelete = "DELETE FROM comments WHERE id = $comment_id";
    $statementDelete = $connection->prepare($sqlDelete);
    // izvrsavamo upit
    $statementDelete->execute();

?>

<?php
header("location: single-post.php?post_id=$post_id");
?>
