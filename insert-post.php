<?php
    include_once "partials/header.php";
?>


<?php
    include_once "partials/dbconnection.php";
?>

<?php
    $title = $_POST['title'];
    $author = $_SESSION['user_id'];
    $text = $_POST['post'];
    //var_dump($author);

    $sqlInsert = "INSERT INTO posts (title, body, author, created_at) VALUES ('$title', '$text', '$author', NOW())";
    $statementInsert = $connection->prepare($sqlInsert);
    // izvrsavamo upit
    $statementInsert->execute();
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);           
    header("Location: index.php");
?>