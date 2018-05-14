<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- website title -->
        <title>Courses Center | Sign Up</title>
        <!-- stylesheets -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/global.css" />
        <link rel="stylesheet" href="assets/css/login.css" />
        <link rel="stylesheet" href="assets/css/sign-up.css" />
    </head>

    <body>
        <section id="sign-up-section">
            <div class="container">
                <div class="content">
                    <h2>sign up now</h2>
                    <div class="type">
                        <input type="button" id="show-student-form" class="custom-button" value="sign up as a student" />
                        <input type="button" id="show-teacher-form" class="custom-button" value="sign up as a teacher" />
                    </div>
                    
                    <!-- form php validation -->
                    <?php
                        if(isset($_GET['sign-up1'])){
                            require 'student-signup.php';
                        }
                    
                    
                        if(isset($_GET['sign-up2'])){
                            require 'teacher-signup.php';
                        }
                    ?>
                    <!-- student form -->
                    <form id="student-signup-form" class="sign-up-form" name="studentForm" action="?sign-up1" method="post">
                        <!-- name -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="student-fname" id="student-fname" placeholder="FIRST NAME" />
                            <input type="text" class="custom-input" name="student-lname" id="student-lname" placeholder="LAST NAME" />
                        </div>
                        <!-- email -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="student-email" id="student-email" placeholder="EMAIL" />
                        </div>
                        <!-- password -->
                        <div class="input-o">
                            <input type="password" class="custom-input" name="student-pass" id="student-pass" placeholder="PASSWORD" />
                        </div>
                        <!-- phone -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="student-phone" id="student-phone" placeholder="PHONE" />
                        </div>
                        <!-- signup -->
                        <div class="input-o">
                            <input type="submit" class="custom-button" id="student-submit-button" value="sign up" />
                        </div>
                        <p id="student-result" class="result"> </p>
                    </form>
                    
                    <!-- teacher form -->
                    <form id="teacher-signup-form" class="sign-up-form" name="teacherForm" action="?sign-up2" method="post">
                        <!-- name, email -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="teacher-fname" id="teacher-fname" placeholder="FIRST NAME" />
                            <input type="text" class="custom-input" name="teacher-lname" id="teacher-lname" placeholder="LAST NAME" />
                        </div>
                        <!-- email -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="teacher-email" id="teacher-email" placeholder="EMAIL" />
                        </div>
                        <!-- password -->
                        <div class="input-o">
                            <input type="password" class="custom-input" name="teacher-pass" id="teacher-pass" placeholder="PASSWORD" />
                        </div>
                        <!-- phone -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="teacher-phone" id="teacher-phone" placeholder="PHONE" />
                        </div>
                        <!-- login -->
                        <div class="input-o">
                            <input type="submit" class="custom-button" id="teacher-submit-button" value="sign up" />
                        </div>
                        <p id="teacher-result" class="result"> </p>
                    </form>
                    
                </div>
            </div>
        </section>
        
        <!-- JQUERY -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/signup.js"></script>
    </body>

</html>
