<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
        console.log(navlinks);
        for (var i = 0; i < navlinks.length; i++) {
            navlinks[i].classList.remove('active');
        }
        var navCreate = document.getElementById('nav-create');
        navCreate.classList.add('active');
    }
</script>

<?php
    include_once "partials/dbconnection.php";
?>

<?php
    include_once "partials/header.php";
?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <form method="POST" action="">
                <h5>Create new post...</h5>

                <br>
                <input type="text" name="title" placeholder="Title for your post here..." value="<?php if(isset($_POST['title'])) { echo $_POST['title']; }?>" />
                <br>
                <?php
                if(isset($_POST['submit']) && empty($_POST['title'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Title required.</p>";
                    echo '<br>';
                }
                ?>

                <br>
                <input type="text" name="author" placeholder="Your name here..." value="<?php if(isset($_POST['author'])) { echo $_POST['author']; }?>" />
                <br>                
                <?php
                if(isset($_POST['submit']) && empty($_POST['author'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Name required.</p>";
                    echo '<br>';
                }
                ?>

                <br>
                <textarea rows="12" cols="70" name="post" placeholder="Text for your post here..."><?php if(!empty($_POST['post'])) { echo $_POST['post']; }?></textarea>

                
                <?php
                if(isset($_POST['submit']) && empty($_POST['post'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Text required.</p>";
                    echo '<br>';
                }
                else if(isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['post'])) {
                    $title = $_POST['title'];
                    $author = $_POST['author'];
                    $text = $_POST['post'];
                    $sqlInsert = "INSERT INTO posts (title, body, author, created_at) VALUES ('$title', '$text', '$author', NOW())";
                    $statementInsert = $connection->prepare($sqlInsert);
                    // izvrsavamo upit
                    $statementInsert->execute();
                    error_reporting(E_ALL);
                    ini_set('display_errors', TRUE);           
                    header("Location: posts.php");
                }
                ?>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Submit post" />

            </form>

        </div> <!-- /.blog main -->


        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>

<?php
include_once "partials/footer.php";
?>