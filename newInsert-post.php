<?php
    include_once "partials/testbaseconnection.php";
?>

<?php
    $title = $_POST['title'];
    $author = $_POST['author'];
    $text = $_POST['post'];
    $sqlInsert = "INSERT INTO posts (title, body, author, created_at) VALUES ('$title', '$text', '$author', NOW())";
    $statementInsert = $connection->prepare($sqlInsert);
    // izvrsavamo upit
    $statementInsert->execute();
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);           
    header("Location: newPosts.php");
?>