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

            // pripremamo upit
            $sqlPost = "SELECT * FROM posts WHERE id=$id";
            $sqlComment = "SELECT * FROM comments WHERE post_id=$id";
            $statementPost = $connection->prepare($sqlPost);
            $statementComment = $connection->prepare($sqlComment);


            // izvrsavamo upit
            $statementPost->execute();
            $statementComment->execute();

            // zelimo da se rezultat vrati kao asocijativni niz.
            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
            $statementComment->setFetchMode(PDO::FETCH_ASSOC);

            // punimo promenjivu sa rezultatom upita
            $post = $statementPost->fetch();
            $comments = $statementComment->fetchAll();

            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                /*
                echo '<pre>';
                var_dump($comments);
                echo '</pre>';
                */

            ?>

            <div class="blog-post">

                <h2 class="blog-post-title"><?php echo($post['title'])?></h2>
                <p class="blog-post-meta"><?php echo($post['created_at'])?> by <a href="#"><?php echo($post['author'])?></a></p>

                <p><?php echo($post['body'])?></p>

            </div><!-- /.blog-post -->

            <?php
                foreach ($comments as $comment) {
            ?>
                <ul class="comment" style='color: #969696; list-style-type: none'>
                    <li style='margin-bottom: 1rem'><strong><em><?php echo($comment['author']) ?></em></strong></li>
                    <li><em><?php echo($comment['text']) ?></em></li>
                    <hr>
                </ul>

            <?php
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