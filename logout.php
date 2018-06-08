<?php
    include_once "partials/header.php";
?>


<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
        for (var i = 0; i < navlinks.length; i++) {
            navlinks[i].classList.remove('active');
        }
        var navLogin = document.getElementById('nav-login');
        navLogin.classList.add('active');
    }
</script>

<?php
    include_once "partials/dbconnection.php";
?>

<?php
    session_unset();
    session_destroy();
?>

<?php
    header("Location: index.php");
?>