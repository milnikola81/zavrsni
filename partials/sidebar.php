<aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4 style='margin-bottom: 2rem'>Latest posts</h4>
        <ol class="list-unstyled">
            <?php
                $sql = "SELECT id, title, body, author, created_at FROM posts ORDER BY created_at DESC LIMIT 5";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $posts = $statement->fetchAll();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    /*
                    echo '<pre>';
                    var_dump($posts);
                    echo '</pre>'                  
                    */
            ?>
            <?php
                foreach ($posts as $post) {
            ?>
                <li style="margin-top: 0.8rem"><a href = "single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></li>

            <?php
                }
            ?>
        </ol>
        <!--<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>-->
    </div>
    <!--
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
    </div>
    -->
    <div class="sidebar-module sidebar-module-inset" style="margin-top: 2rem">
        <h4 style='margin-bottom: 2rem'>Check out other</h4>
        <ol class="list-unstyled">
            <li style="margin-top: 0.8rem"><a href="#">Mozzartsport</a></li>
            <li style="margin-top: 0.8rem"><a href="#">Sport Klub</a></li>
            <li style="margin-top: 0.8rem"><a href="#">Sportske</a></li>
        </ol>
    </div>
</aside>