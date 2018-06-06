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

    <script>

    function toggleFunction() { //comments button toggle function
        var myBtn = document.getElementById('toggleButton');
        if (myBtn.innerHTML === 'Hide comments') {
            myBtn.innerHTML = 'Show comments';            
        }
        else if (myBtn.innerHTML === 'Show comments') {
            myBtn.innerHTML = 'Hide comments';            
        }

        var comments = document.getElementsByClassName("comment-wrapper");
        //console.log(comments);
        for (var i = 0; i < comments.length; i++) {
            comments[i].classList.toggle('commentStyle');
        }
        var lines = document.getElementsByClassName("comment-line");
        //console.log(lines);
        for (var i = 0; i < lines.length; i++) {
            lines[i].classList.toggle('commentStyle');
        }

    }

    </script>

</head>

<body>

    <header>
        <div class="blog-masthead" id="navbarContainer">
            <div class="container">
                <nav class="nav" id="myNavbar">
                    <a class="nav-link active" href="../posts.php">Home</a>
                    <a class="nav-link" href="#">New features</a>
                    <a class="nav-link" href="#">Press</a>
                    <a class="nav-link" href="#">New hires</a>
                    <a class="nav-link" href="#">About</a>
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