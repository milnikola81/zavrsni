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

                // pripremamo upit
                $sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC";
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

            ?>

            <?php
                foreach ($posts as $post) {
            ?>
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href = "single-post.php?id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
                    <p class="blog-post-meta"><?php echo ($post['created_at']) ?> by <a href="#"><?php echo($post['author']) ?></a></p>
                    <p><?php echo ($post['body']) ?></p>
                </div>

            <?php
                }
            ?>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
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
