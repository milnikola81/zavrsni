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
            $post_id = intval($_GET['post_id']);
            //var_dump($id);

            // pripremamo upit
            /*
            $sqlPost = "SELECT * FROM posts WHERE id=$id";
            $sqlComment = "SELECT * FROM comments WHERE post_id=$id";
            $statementPost = $connection->prepare($sqlPost);
            $statementComment = $connection->prepare($sqlComment);
            */

            $sqlJoin = "SELECT users.id as userId, users.first_name, users.last_name, 
            posts.id as postId, posts.author, posts.title, posts.body, posts.created_at, 
            comments.id as commentId, comments.post_id, comments.text as commentText, comments.author as commentAuthor
            FROM users RIGHT JOIN posts ON users.id = posts.author 
            LEFT JOIN comments ON posts.id = comments.post_id 
            WHERE posts.id=$post_id;";
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
                //var_dump($id);
            $fullName = $join[0]['first_name']." ".$join[0]['last_name'];

            ?>

            <div class="blog-post">
                <h2 class="blog-post-title"><?php echo($join[0]['title'])?></h2>
                <p class="blog-post-meta"><?php echo($join[0]['created_at'])?> by <a href="#"><?php echo($fullName)?></a></p>
                <p><?php echo($join[0]['body'])?></p>
            </div><!-- /.blog-post -->

            <form method="POST" action="create-comment.php?post_id="<?php $post_id ?>"" onsubmit="return validateForm()">
                <h5>Leave a comment...</h5>
                <br>
                <input type="text" name="author" id="author" placeholder="Your name here..." value="<?php if(isset($_POST['author'])) { echo $_POST['author']; }?>" />
                <br>

                <br>
                <textarea rows="4" cols="60" name="comment" id="comment" placeholder="Your comment here..."><?php if(!empty($_POST['comment'])) { echo $_POST['comment']; }?></textarea>

                <br><br>

                <input type="hidden" name="post_id" value="<?php echo($post_id)?>" />

                <input type="submit" name="submit" id="submit" value="Submit comment" />

            </form>

            <script>

                function validateForm() {

                    var author = document.getElementById("author").value;
                    var comment = document.getElementById("comment").value;
                    
                    if(author === "") {
                        alert('You are missing author name!');
                        return false;
                    }
                    else if(comment === "") {
                        alert('You are missing comment text!');
                        return false;
                    }
                    else if(author != "" && comment != "") {
                        return true;
                    }
                }

            </script>

            <?php //ispisuje sve do tog trenutka kreirane komentare
                $comments = [];
                foreach($join as $comment) {
                    if($comment['commentAuthor'] != null && $comment['commentText'] != null) {
                        $single = array('id' => $comment['commentId'], 'author' => $comment['commentAuthor'], 'text' => $comment['commentText'], 'post_id' => $comment['postId']);
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
                <div id="toggleBtnDiv">
                    <button class="btn-default" id="toggleButton" onclick="toggleFunction()" style="margin-bottom: 2rem">Hide comments</button>
                </div>
                <hr>
            <?php
                    foreach ($comments as $comment) {
            ?>
                <div class="comment-wrapper">
                    <ul class="comment" style='width: 70%; display: inline-block; color: #969696; list-style-type: none'>
                        <li style='margin-bottom: 1rem'><strong><em><?php echo($comment['author'])?></em></strong></li>
                        <li><em><?php echo($comment['text'])?></em></li>
                    </ul>
                    <button class="btn" onclick='document.location.href="delete-comment.php?comment_id=<?php echo $comment['id']?>&post_id=<?php echo $comment['post_id']?>"'>Delete comment</button>
                </div>
                <hr class="comment-line">


            <?php
                    }
                }
            ?>


        </div> <!---blog main ---->

        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>


<?php
    include_once "partials/footer.php";
?>