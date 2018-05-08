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
        <link rel="stylesheet" href="assets/css/page.css" />
    </head>
    <body>
        <?php
            session_start();
            if (isset($_SESSION['logged']) && $_SESSION['type'] == 's') { ?>
        <?php
                // require connection file with some helpful functions to deal with DB
                require 'connect.php';
        ?>
        
        
                <!-- page content here -->
                <section class="content">
                    <div class="container">
                        <!-- get student email from login.php page -->
                        <?php
                            $email = $_SESSION['userEmail'];
                            $userId = getSingleValue('users', 'user_email', $email, 'user_id', $conn);
                            $studentId = getSingleValue('student', 'user_id', $userId, 'student_id', $conn);
                            $studentName = getSingleValue('users', 'user_id', $userId, 'user_name', $conn);
                            $studentPhone = getSingleValue('users', 'user_id', $userId, 'user_phone', $conn);
                        ?>
                        
                        <?php
                            // when student join course
                                if (isset($_GET['join'])){
                                    $joinCourseId = $_POST['joinid'];
                                    $joinTeacherId = $_POST['jointeacher'];
                                    insertStuEnrollment($studentId, $joinCourseId, $joinTeacherId, $conn);
                                    header("Location:student.php");
                                } 

                        ?>
                        <h2 class="welcome">welcome <span><?php print $studentName; ?></span></h2>
                        
                        
                        <div class="row">
                            <!-- student info -->
                            <div class="col-lg-6 offset-lg-3 part">
                                <div class="panel">
                                    <h3>student information</h3>
                                    <p>student name: <span><?php print $studentName; ?></span></p>
                                    <p>student ID: <span><?php print $studentId; ?></span></p>
                                    <p>student email: <span class="email"><?php print $email; ?></span></p>
                                    <p>student phone: <span ><?php print $studentPhone; ?></span></p>
                                </div>
                            </div>
                            
                            <!-- your courses -->
                            <div class="col-lg-12 part">
                                <div class="panel">
                                    <h3>your courses</h3>
                                    
                                    <div class="row">
                                        <!-- course name column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course name</h6>
                                            <?php
                                                // get courses Ids into array
                                                $courseId = array();
                                                $courseId = getAllValues('student_enrollment', 'student_id', $studentId, 'course_id', $conn);
                                                $arrayLength = count($courseId);
                                                $currentCourseName;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseName = getSingleValue('course', 'course_id', $courseId[$i], 'course_name', $conn);
                                                    echo '<p>'.$currentCourseName.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- course price column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course price</h6>
                                            <?php
                                                // get all prices
                                                $currentCoursePrice;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCoursePrice = getSingleValue('course', 'course_id', $courseId[$i], 'course_price', $conn);
                                                    echo '<p>'.$currentCoursePrice.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- course sessions column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course sessions</h6>
                                            <?php
                                                // get all sessions num
                                                $currentCourseSessions;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseSessions = getSingleValue('course', 'course_id', $courseId[$i], 'course_sessions', $conn);
                                                    echo '<p>'.$currentCourseSessions.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- course start date column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">start date</h6>
                                            <?php
                                                // get start date values
                                                $currentCourseStartDate;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseStartDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_start_date', $conn);
                                                    echo '<p>'.$currentCourseStartDate.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- course end date column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">end date</h6>
                                            <?php
                                                // get end date values
                                                $currentCourseEndDate;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseEndDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_end_date', $conn);
                                                    echo '<p>'.$currentCourseEndDate.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <!-- teacher column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">teacher</h6>
                                            <?php
                                                // get end date values
                                                $teacherId = array();
                                                $teacherId = getAllValues('student_enrollment', 'student_id', $studentId, 'teacher_id', $conn);
                                                $teacherArrayLength = count($teacherId);
                                                $currentTeacherId;
                                                $currentTeacher;
                                                for ($i = 0; $i<$teacherArrayLength; $i++) {
                                                    $currentTeacherId = getSingleValue('teacher', 'teacher_id', $teacherId[$i], 'user_id', $conn);
                                                    $currentTeacher = getSingleValue('users', 'user_id', $currentTeacherId, 'user_name', $conn);
                                                    echo '<p>'.$currentTeacher.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- available courses -->
                            <div class="col-lg-12 part">
                                <div class="panel">
                                    <h3>available courses</h3>
                                    
                                    <div class="row">
                                        <!-- course name column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course name</h6>
                                            <?php
                                                // get courses Ids into array
                                                $allCoursesId = getAllValuesNoCondition('course', 'course_id', $conn);
                                                $coursesNum = count($allCoursesId);
                                                $found = false;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentCourseName = getSingleValue('course', 'course_id', $allCoursesId[$i], 'course_name', $conn);
                                                        echo '<p>'.$currentCourseName.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- price -->
                                        <div class="col-md-1 column">
                                            <h6 class="title">price</h6>
                                            <?php
                                                $currentCPrice;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentCPrice = getSingleValue('course', 'course_id', $allCoursesId[$i], 'course_price', $conn);
                                                        echo '<p>'.$currentCPrice.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- sessions -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course sessions</h6>
                                            <?php
                                                $currentCSessions;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentCSessions = getSingleValue('course', 'course_id', $allCoursesId[$i], 'course_sessions', $conn);
                                                        echo '<p>'.$currentCSessions.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- start date -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">start date</h6>
                                            <?php
                                                $currentCStart;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentCStart = getSingleValue('course', 'course_id', $allCoursesId[$i], 'course_start_date', $conn);
                                                        echo '<p>'.$currentCStart.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- end date -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">start date</h6>
                                            <?php
                                                $currentCStart;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentCStart = getSingleValue('course', 'course_id', $allCoursesId[$i], 'course_end_date', $conn);
                                                        echo '<p>'.$currentCStart.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- teacher name -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">teacher name</h6>
                                            <?php
                                                $currentTId;
                                                $currentUId;
                                                $currentTName;
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){
                                                        $currentTId = getSingleValue('teacher_enrollment', 'course_id', $allCoursesId[$i], 'teacher_id', $conn);
                                                        $currentUId = getSingleValue('teacher', 'teacher_id', $currentTId, 'user_id', $conn);
                                                        $currentTName = getSingleValue('users', 'user_id', $currentUId, 'user_name', $conn);
                                                        echo '<p>'.$currentTName.'</p>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                        <!-- join button -->
                                        <div class="col-md-1 column">
                                            <h6 class="title">action</h6>
                                            <?php
                                                for ($i = 0; $i<$coursesNum; $i++) {
                                                    $found = false;
                                                    for ($j = 0; $j<$arrayLength; $j++) {
                                                        if ($allCoursesId[$i] == $courseId[$j]){
                                                            $found = true;
                                                        }
                                                    }
                                                    if (!$found){ 
                                                        $tetId = getSingleValue('teacher_enrollment', 'course_id', $allCoursesId[$i], 'teacher_id', $conn);
                                                        echo '<form action="?join" method="post">
                                                            <input type="hidden" name="joinid" value="'.$allCoursesId[$i].'" />
                                                            <input type="hidden" name="jointeacher" value="'.$tetId.'" />
                                                            <input class="custom-button join-button" type="submit" value="join" />
                                                        </form>';
                                                    }
                                                }
                                                
                                            ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </section>        
        
        <?php    
        } else {
                echo "Please log in first to see this page.";
            }
        ?>
    </body>
</html>
