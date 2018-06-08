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

            <form method="POST" action="log-user.php" onsubmit="return validateForm()"> <!-- redirecting after submit if true -->
                <h5>Login...</h5>

                <br>
                <input type="text" name="username" id="username" placeholder="Enter your username..." />
                <br>

                <br>
                <input type="password" name="password" id="password" placeholder="Enter your password..." />
                <br>               

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