<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
        for (var i = 0; i < navlinks.length; i++) {
            navlinks[i].classList.remove('active');
        }
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

                //uzimamo id iz url-a
                $user_id = intval($_GET['user_id']);

                $post_order = $_GET['order'];

                if(!isset($post_order)) {
                    $post_order = 'DESC';
                }

                // pripremamo upit
                $sql = "SELECT users.id, users.first_name, users.last_name, posts.id as postId, posts.title, posts.body, posts.created_at FROM users RIGHT JOIN posts ON users.id = posts.author WHERE users.id=$user_id ORDER BY created_at $post_order";
                $statement = $connection->prepare($sql);

                // izvrsavamo upit
                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $posts = $statement->fetchAll();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    /*
                    echo '<pre>';
                    var_dump($posts);
                    echo '</pre>';
                    */
                $fullName = $posts[0]['first_name']." ".$posts[0]['last_name'];

            ?>
            <p class="blog-post-meta" style="font-size: 1.1rem"><em>Showing posts by <?php echo($fullName) ?> . . .</em></p>
            <hr>

            <?php
                foreach ($posts as $post) {
            ?>
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href = "single-post.php?post_id=<?php echo($post['postId']) ?>"><?php echo($post['title']) ?></a></h2>
                    <p class="blog-post-meta"><?php echo ($post['created_at']) ?> by <a href="user-posts.php?user_id=<?php echo($post['id']) ?>"><?php echo($fullName) ?></a></p>
                    <p><?php echo ($post['body']) ?></p>
                    <?php
                        if(isset($_SESSION['user_id'])) {
                    ?>
                        <button class="btn-primary" onclick="deleteFunction(<?php echo($post['postId'])?>)">Delete this post</button>
                    <?php
                        }
                    ?>
                </div>
                

            <?php
                }
            ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="user-posts.php?user_id=<?php echo $user_id ?>&order=ASC">Older first</a>
                <a class="btn btn-outline-primary" href="user-posts.php?user_id=<?php echo $user_id ?>">Newer first</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php
            include_once "partials/sidebar.php";
        ?>
        <!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->

<?php
    include_once "partials/footer.php";
?>
