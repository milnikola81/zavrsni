<script>
    window.onload = function() {
        var navHome = document.getElementById('nav-home');
        var navCreate = document.getElementById('nav-create');
        navHome.classList.remove('active');
        navCreate.classList.add('active');
    }
</script>

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
                <textarea rows="12" cols="50" name="post" placeholder="Text for your post here..."></textarea>

                <?php
                if(isset($_POST['submit']) && empty($_POST['post'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Text required.</p>";
                    echo '<br>';
                }

                else if(isset($_POST['submit']) && isset($_POST['title']) && isset($_POST['author']) && isset($_POST['comment'])) {
                    include_once "partials/dbconnection.php";
                    $sqlInsert = "INSERT INTO posts (title, body, author, created_at) VALUES ('$_POST['author'], '$_POST['title']', '$_POST['post']', 'NOW()')";
                    $statementInsert = $connection->prepare($sqlInsert);
                    // izvrsavamo upit
                    $statementInsert->execute();
                    /*
                    $_SESSION['title'] = $_POST['title'];
                    $_SESSION['author'] = $_POST['author'];
                    $_SESSION['comment'] = $_POST['post'];
                    */
                    error_reporting(E_ALL);
                    ini_set('display_errors', TRUE);           
                    header("Location: posts.php");
                    //exit();
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