<?php
    session_start();
?>

<?php
    include_once "partials/dbconnection.php";
?>


<?php
    $post_id = $_SESSION['post_id'];
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
header("location: single-post.php?id=$post_id");
// remove stored variables from session
session_unset(); 
// destroy the session 
session_destroy();
?>
