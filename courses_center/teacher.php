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
            if (isset($_SESSION['logged']) && $_SESSION['type'] == 't') { ?>
        <?php
                // require connection file with some helpful functions to deal with DB
                require 'connect.php';
        ?>
                <!-- page content here -->
                <section class="content">
                    <div class="container">
                        <!-- get teacher email from login.php page -->
                        <?php
                            $email = $_SESSION['userEmail'];
                            $userId = getSingleValue('users', 'user_email', $email, 'user_id', $conn);
                            $teacherId = getSingleValue('teacher', 'user_id', $userId, 'teacher_id', $conn);
                            $teacherName = getSingleValue('users', 'user_id', $userId, 'user_name', $conn);
                            $teacherPhone = getSingleValue('users', 'user_id', $userId, 'user_phone', $conn);
                            $teacherEarnings = getSingleValue('teacher', 'user_id', $userId, 'teacher_earnings', $conn);
                        ?>

                        <h2 class="welcome">welcome <span><?php print $teacherName; ?></span></h2>
                        
                        <div class="row">
                            <!-- teacher info -->
                            <div class="col-lg-6 offset-lg-3 part">
                                <div class="panel">
                                    <h3>Teacher information</h3>
                                    <p>Teacher name: <span><?php print $teacherName; ?></span></p>
                                    <p>Teacher ID: <span><?php print $teacherId; ?></span></p>
                                    <p>Teacher email: <span class="email"><?php print $email; ?></span></p>
                                    <p>Teacher phone: <span ><?php print $teacherPhone; ?></span></p>
                                    <p>Teacher Earnings: <span ><?php print $teacherEarnings; ?></span></p>
                                </div>
                            </div>
                            
                            <!-- your courses -->
                            <div class="col-lg-12 part">
                                <div class="panel">
                                    <h3>Courses you are teaching</h3>
                                    
                                    <div class="row">
                                        <!-- course name column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">course name</h6>
                                            <?php
                                                // get courses Ids into array
                                                $courseId = array();
                                                $courseId = getAllValues('teacher_enrollment', 'teacher_id', $teacherId, 'course_id', $conn);
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
                                        
                                        <!-- number of students column -->
                                        <div class="col-md-2 column">
                                            <h6 class="title">students</h6>
                                            <?php
                                                // get end date values
                                                $studentsCounter = array();
                                                $studentsCounter = getAllValues('teacher_enrollment', 'teacher_id', $teacherId, 'course_students', $conn);
                                                $arrayLength = count($studentsCounter);
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    echo '<p>'.$studentsCounter[$i].'</p>';
                                                }
                                            ?>
                                        </div>

                                        
                                    </div>
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            
                            <div class="part col-lg-6 offset-lg-3">
                                <div class="panel">
                                    <div class="row">
                                        
                                        <!-- course name column -->
                                        <div class="col-md-4 column">
                                            <h6 class="title">course name</h6>
                                            <?php
                                                // get courses Ids into array
                                                $courseId = array();
                                                $courseId = getAllValues('teacher_enrollment', 'teacher_id', $teacherId, 'course_id', $conn);
                                                $arrayLength = count($courseId);
                                                $currentCourseName;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseName = getSingleValue('course', 'course_id', $courseId[$i], 'course_name', $conn);
                                                    echo '<p>'.$currentCourseName.'</p>';
                                                }
                                            ?>
                                        </div>
                                        
                                        <div class="col-md-4 column">
                                            <h6 class="title">status</h6>
                                            <?php
                                            	$currentCourseStartDate;
                                                $currentCourseEndDate;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseStartDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_start_date', $conn);
                                                    $currentCourseEndDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_end_date', $conn);
                                                    if(date("Y-m-d") < $currentCourseStartDate)
                                                    	echo '<p>'."Starting soon".'</p>';
                                                    else if (date("Y-m-d") < $currentCourseEndDate)
                                                    	echo '<p>'."In progress".'</p>';
                                                    else
                                                    	echo '<p>'."Finished".'</p>';
                                                }
                                            ?>
                                        </div>

                                        <div class="col-md-4 column">
                                            <h6 class="title">action</h6>
                                            <?php
                                            	$currentCourseStartDate;
                                                $currentCourseEndDate;
                                                for ($i = 0; $i<$arrayLength; $i++) {
                                                    $currentCourseStartDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_start_date', $conn);
                                                    $currentCourseEndDate = getSingleValue('course', 'course_id', $courseId[$i], 'course_end_date', $conn);
                                                    
                                                    if(date("Y-m-d") < $currentCourseStartDate){
                                                        //can be removed because it didn't start yet
                                                        echo '<input type="button" value="remove course" class="remove-b custom-button" />';
                                                        
                                                    }
                                                    	
                                                    else {
                                                        // can't be removed
                                                        echo '<input type="button" value="cant be removed" class="remove-b no-remove custom-button" disabled />';
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
                
        
                <!-- add new course -->
                <section class="new-course">
                    <div class="container">
                        <button id="add-new-course-button" class="custom-button">add new course</button>
                        
                        <!-- course form -->
                    <form id="course-form" class="sign-up-form" name="courseForm" action="?new-course" method="post">
                        <!-- email, Phone -->
                        <div class="input-o">
                            <input type="text" class="custom-input" name="student-name" id="student-name" placeholder="NAME" />
                            <input type="text" class="custom-input" name="student-email" id="student-email" placeholder="EMAIL" />
                        </div>
                        
                        <!-- signup -->
                        <div class="input-o">
                            <input type="submit" class="custom-button" id="register-button" value="register course" />
                        </div>
                        <p id="student-result" class="result"> </p>
                    </form>
                    </div>
                </section>
        
                <script src="assets/js/jquery-3.2.1.min.js"></script>
                <script src="assets/js/teacher.js"></script>
        <?php    
        } else {
                echo "Please log in first to see this page.";
            }
        ?>
    </body>
</html>
