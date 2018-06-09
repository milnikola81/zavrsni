<?php
    include_once "partials/header.php";
?>


<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
        for (var i = 0; i < navlinks.length; i++) {
            navlinks[i].classList.remove('active');
        }
        var navLogin = document.getElementById('nav-login');
        navLogin.classList.add('active');
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

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()"> <!-- redirecting after submit if true -->
                <h5>Login...</h5>

                <br>
                <input type="text" name="username" id="username" placeholder="Enter your username..." />
                <br>

                <br>
                <input type="password" name="password" id="password" placeholder="Enter your password..." />
                <br>

                <?php

                if(isset($_POST['submit'])) {

                    function query($sql, $conn){
                        $statement = $conn->prepare($sql);
                        $statement->execute();
                        $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                        return $statement->fetchAll();
                    }

                    $username = $_POST['username'];
                    //$password = $_POST['password'];

                    $sqlSelect = "SELECT id, username, password FROM users WHERE '$username' = username";

                    $array = query($sqlSelect, $connection);
                    
                    if (count($array) > 0) {                   
                        if (crypt($_POST['password'], $array[0]['password']) == $array[0]['password']) {
                            $_SESSION['user_id'] = $array[0]['id'];
                            $_SESSION['username'] = $array[0]['username'];
                            header("Location: index.php");
                        }
                        else if (crypt($_POST['password'], $array[0]['password']) != $array[0]['password']) {
                            ?>
                            <p style="margin-top: 1rem">Wrong username or password.</p>
                            <p>Don't have an account yet? Please <a href="signup.php">Sign up</a>!</p>
                            <?php
                        }
                    }

                    else if (count($array) === 0) {
                        ?>
                        <p style="margin-top: 1rem">Wrong username or password.</p>
                        <p>Don't have an account yet? Please <a href="signup.php">Sign up</a>!</p>
                        <?php
                    }

                }
                //var_dump($_SESSION['username']);
                ?>      

                <br><br>
                <input type="submit" name="submit" id="submit" value="Login"/>

            </form>


            <script>

                function validateForm() {

                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;
                    
                    if(username === "") {
                        alert('Enter your username!');
                        return false;
                    }
                    else if(password === "") {
                        alert('Enter your password!');
                        return false;

                    }
                    else if(username != "" && password != "") {
                        return true;
                    }
                }

            </script>

        </div> <!-- /.blog main -->


        <?php
            include_once "partials/sidebar.php";
        ?>

    </div>

</main>

<?php
include_once "partials/footer.php";
?>