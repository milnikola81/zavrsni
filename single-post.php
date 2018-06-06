<?php
    session_start();
?>

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

            //uzimamo id iz url-a
            $id = intval($_GET['id']);
            //var_dump($id);

            // pripremamo upit
            /*
            $sqlPost = "SELECT * FROM posts WHERE id=$id";
            $sqlComment = "SELECT * FROM comments WHERE post_id=$id";
            $statementPost = $connection->prepare($sqlPost);
            $statementComment = $connection->prepare($sqlComment);
            */

            $sqlJoin = "SELECT posts.id, posts.title, posts.body, posts.author as postAuthor, posts.created_at, comments.id, comments.author as commentAuthor, comments.text, comments.post_id
            FROM posts LEFT JOIN comments
            ON posts.id = comments.post_id
            WHERE posts.id = $id";
            $statementJoin = $connection->prepare($sqlJoin);

            // izvrsavamo upit
            $statementJoin->execute();
            /*
            $statementPost->execute();
            $statementComment->execute();
            */
            // zelimo da se rezultat vrati kao asocijativni niz.
            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz

            //$statementComment->setFetchMode(PDO::FETCH_ASSOC);
            $statementJoin->setFetchMode(PDO::FETCH_ASSOC);

            // punimo promenjivu sa rezultatom upita
            $join = $statementJoin->fetchAll();
            /*
            $post = $statementPost->fetch();
            $comments = $statementComment->fetchAll();
            */
            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                /*
                echo '<pre>';
                var_dump($join);
                echo '</pre>';
                */
            ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><?php echo($join[0]['title'])?></h2>
                <p class="blog-post-meta"><?php echo($join[0]['created_at'])?> by <a href="#"><?php echo($join[0]['postAuthor'])?></a></p>
                <p><?php echo($join[0]['body'])?></p>
            </div><!-- /.blog-post -->

            <form method="POST" action="">
                <h5>Leave a comment...</h5>
                <br>
                <input type="text" name="author" placeholder="Enter your name..." value="<?php if(isset($_POST['author'])) { echo $_POST['author']; }?>" />
                <br>
                
                <?php
                if(isset($_POST['submit']) && empty($_POST['author'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Name required.</p>";
                    echo '<br>';
                }
                ?>
                <br>
                <textarea rows="4" cols="50" name="comment" placeholder="Enter your comment..." value="<?php if(isset($_POST['comment'])) {echo $_POST['comment'];}?>"></textarea>
                
                <?php
                if(isset($_POST['submit']) && empty($_POST['comment'])) {
                    echo "<p class='alert-danger' style='display: inline-block'>* Comment required.</p>";
                    echo '<br>';
                }
                ?>

                <?php
                if(isset($_POST['submit']) && !empty($_POST['author']) && !empty($_POST['comment'])) {
                    error_reporting(E_ALL);
                    ini_set('display_errors', TRUE);                   
                    header("Location: create-comment.php?post_id=$id");
                    $_SESSION['author'] = $_POST['author'];
                    $_SESSION['comment'] = $_POST['comment'];
                }
                ?>
                <br><br>
                <input type="submit" name="submit" id="submit" value="Submit comment" />

            </form>

            <?php
                $comments = [];
                foreach($join as $comment) {
                    if($comment['commentAuthor'] != null && $comment['text'] != null) {
                        $single = array('id' => $comment['id'], 'author' => $comment['commentAuthor'], 'text' => $comment['text']);
                        array_push($comments, $single);
                    }
                }
                /*
                echo '<pre>';
                var_dump($comments);
                echo '</pre>';
                */
            ?>

            <?php
                if(count($comments) > 0) {
            ?>
                <div>
                    <button class="btn-default" id="toggleButton" onclick="toggleFunction()" style="margin-bottom: 2rem">Hide comments</button>
                </div>
                <hr>
            <?php
                    $_SESSION['post_id'] = $id;
                    foreach ($comments as $comment) {
            ?>
                <div class="comment-wrapper">
                    <ul class="comment" style='width: 70%; display: inline-block; color: #969696; list-style-type: none'>
                        <li style='margin-bottom: 1rem'><strong><em><?php echo($comment['author'])?></em></strong></li>
                        <li><em><?php echo($comment['text'])?></em></li>
                    </ul>
                    <button class="btn" onclick='document.location.href="delete-comment.php?comment_id=<?php echo $comment['id']?>"'>Delete comment</button>
                </div>
                <hr class="comment-line">


            <?php
                    }
                }
            ?>


        </div>

        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>


<?php
    include_once "partials/footer.php";
?>