<?php
    include_once "partials/header.php";
?>


<?php
    include_once "partials/dbconnection.php";
?>


<?php

    function query($sql, $conn){
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
        return $statement->fetchAll();
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqlSelect = "SELECT id, username FROM users WHERE '$username' = username AND '$password' = password";

    $array = query($sqlSelect, $connection);

    if (count($array) > 0) {
        $_SESSION['user_id'] = $array[0]['id'];
        $_SESSION['username'] = $array[0]['username'];
    }
    //var_dump($_SESSION['username']);

?>


<?php
    if(isset($_SESSION['user_id'])) {
        header("Location: index.php");
    }
    else {
        header("Location: login.php");
    }
?>