<script>
    window.onload = function() {
        var navlinks = document.getElementsByClassName("nav-link");
        for (var i = 0; i < navlinks.length; i++) {
            navlinks[i].classList.remove('active');
        }
        var navSignup = document.getElementById('nav-signup');
        navSignup.classList.add('active');
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

            <form method="POST" action="insert-user.php" onsubmit="return validateForm()"> <!-- redirecting after submit if true -->
                <h5>Sign up...</h5>

                <br>
                <input type="text" name="firstname" id="firstname" placeholder="Enter your firstname..." value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; }?>" />
                <br>

                <br>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your lastname..." value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; }?>" />
                <br>

                <br>
                <input type="text" name="username" id="username" placeholder="Enter your username..." value="<?php if(isset($_POST['username'])) { echo $_POST['username']; }?>" />
                <br>

                <br>
                <input type="password" name="password" id="password" placeholder="Enter your password..." value="<?php if(isset($_POST['password'])) { echo $_POST['password']; }?>" />
                <br>               

                <br><br>
                <input type="submit" name="submit" id="submit" value="Sign up"/>

            </form>


            <script>

                function validateForm() {
                    
                    var firstname = document.getElementById("firstname").value;
                    var lastname = document.getElementById("lastname").value;
                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;
                    
                    if(firstname === "") {
                        alert('Enter your first name!');
                        return false;
                    }
                    else if(lastname === "") {
                        alert('Enter your last name!');
                        return false;
                    }
                    else if(username === "") {
                        alert('Enter your username!');
                        return false;
                    }
                    else if(password === "") {
                        alert('Enter your password!');
                        return false;

                    }
                    else if(firstname != "" && lastname != "" && username != "" && password != "") {
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