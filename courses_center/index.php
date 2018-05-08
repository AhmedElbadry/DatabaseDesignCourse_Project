<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- website title -->
        <title>Courses Center</title>
        <!-- stylesheets -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/global.css" />
        <link rel="stylesheet" href="assets/css/login.css" />
    </head>

    <body>
        <?php
            $logged = false;
            if( isset($_GET['login'] )){
                include 'login.php';
                $va = $_SESSION['$valResult'];
                $logged = true;
            }
        ?>
        <section id="login-section">
            <div class="container">
                <h1>welcome to <span>courses center</span></h1>
                <?php
                    if (isset($_GET["signed"])) { ?>
                        <h4 class="signed">you signed up successfully, you can login now</h4>
                <?php    }
                ?>
                <form id="login-form" name="loginForm" action="?login" method="post">
                    <!-- EMAIL -->
                    <div class="input-o">
                        <span>
                            <img src="assets/images/email.png" />
                        </span>
                        <input type="text" name="email" id="email" placeholder="EMAIL" />
                    </div>
                    <!-- Pass -->
                    <div class="input-o">
                        <span>
                            <img src="assets/images/lock.png" />
                        </span>
                        <input type="password" name="password" id="pass" placeholder="PASSWORD" />
                    </div>
                    <!-- login -->
                    <div class="login-o">
                        <input type="submit" id="login-button" value="login" />
                    </div>
                </form>
                <p class="sign-up">not a user? <a href="sign-up.php">sign up</a></p>
                <div class="form-result">
                    <?php 
                        if ($logged) {
                            echo $va;
                        }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- JQUERY -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/login.js"></script>
    </body>

</html>
