<?php
    include_once "partials/header.php";
?>


<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
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

            <?php
                if(!isset($_SESSION['user_id'])) {
                ?>
                    <p>You must be logged in to create new posts.</p>
                    <p>Have an account? <a href="login.php">Log in here</a>!</p>

                <?php
                }
                else if(isset($_SESSION['user_id'])) {
                ?>

                <form method="POST" action="insert-post.php" onsubmit="return validateForm()"> <!-- redirecting after submit if true -->
                    <h5>Create new post...</h5>

                    <br>
                    <input type="text" name="title" id="title" placeholder="Title for your post here..." value="<?php if(isset($_POST['title'])) { echo $_POST['title']; }?>" />
                    <br>             

                    <br>
                    <textarea rows="12" cols="70" name="post" id="post" placeholder="Text for your post here..."><?php if(!empty($_POST['post'])) { echo $_POST['post']; }?></textarea>

                    <br><br>
                    <input type="submit" name="submit" id="submit" value="Submit post"/>

                </form>


                <script>

                    function validateForm() {

                        var title = document.getElementById("title").value;
                        var post = document.getElementById("post").value;
                        
                        if(title === "") {
                            alert('You are missing title for yor post!');
                            return false;
                        }
                        else if(post === "") {
                            alert('You are missing post text!');
                            return false;
                        }
                        else if(title != "" && post != "") {
                            return true;
                        }
                    }

                </script>

                <?php

                }

                ?>

        </div> <!-- /.blog main -->


        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>

<?php
include_once "partials/footer.php";
?>