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
            $sql = "SELECT id, title, body, author, created_at FROM posts WHERE id=$id";
            $statement = $connection->prepare($sql);

            // izvrsavamo upit
            $statement->execute();

            // zelimo da se rezultat vrati kao asocijativni niz.
            // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
            //$statement->setFetchMode(PDO::FETCH_ASSOC);

            // punimo promenjivu sa rezultatom upita
            $post = $statement->fetch();

            // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                /*
                echo '<pre>';
                var_dump($post);
                echo '</pre>';
                */

            ?>

            <div class="blog-post">

                <h2 class="blog-post-title"><?php echo($post['title'])?></h2>
                <p class="blog-post-meta"><?php echo($post['created_at'])?> by <a href="#"><?php echo($post['author'])?></a></p>

                <p><?php echo($post['body'])?></p>

            </div><!-- /.blog-post -->
        </div>

        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>


<?php
    include_once "partials/footer.php";
?>