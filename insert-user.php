<?php
    include_once "partials/dbconnection.php";
?>

<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = crypt($_POST['password'], $_POST['password']);
    $sqlInsert = "INSERT INTO users (first_name, last_name, username, password) VALUES ('$firstname', '$lastname', '$username', '$password')";
    $statementInsert = $connection->prepare($sqlInsert);
    // izvrsavamo upit
    $statementInsert->execute();
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);           
    header("Location: index.php");
?>