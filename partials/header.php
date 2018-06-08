<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">


</head>

<body>

    <header>
        <div class="blog-masthead" id="navbarContainer">
            <div class="container">
                <nav class="nav" id="myNavbar">
                    <a class="nav-link" id="nav-home" href="../index.php">Home</a>
                    <a class="nav-link" id="nav-create" href="../create-post.php">Create</a>
                    <a class="nav-link" id="nav-login" href="../login.php">Login</a>
                    <a class="nav-link" id="nav-signup" href="../signup.php">Sign up</a>
                    <?php
                        if(isset($_SESSION['user_id'])) {
                    ?>
                        <a class="nav-link" id="nav-logout" href="../logout.php">Log out (<?php echo $_SESSION['username'] ?>)</a>
                    <?php
                        }
                    ?>
                </nav>
            </div>
        </div>

        <div class="blog-header">
            <div class="container">
                <h1 class="blog-title">The Bootstrap Blog</h1>
                <p class="lead blog-description">An example blog template built with Bootstrap.</p>
            </div>
        </div>
    </header>