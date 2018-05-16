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

<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['type'] == 'e') {
    // put structure here
	require 'connect.php';
   
    ?>

	<!-- page content here -->
	<section class="content">
	    <div class="container">
	        <!-- get employee email from login.php page -->
	        <?php
	            $email = $_SESSION['userEmail'];



	            //get all employee info
	            $allEmployeeInfo = $conn->query("SELECT * FROM users INNER JOIN employee ON users.user_id = employee.user_id WHERE '".$email."' = users.user_email");

	            $allEmployeeInfo = $allEmployeeInfo -> fetch(PDO::FETCH_ASSOC);



	            //get all students info
	            $allStudentsInfo = getAllInfoByID('student', $conn);

	            //get all teachers info
	            $allTeachersInfo = getAllInfoByID('teacher', $conn);

	            //get all courses info
	            $qs = "
	            		SELECT * FROM course


	            ";

	            $allCoursesInfo = $conn->query($qs);

	            $allCoursesInfo = $allCoursesInfo -> fetchAll(PDO::FETCH_ASSOC);



	            //scheduled courses
	            $qs = "
	            		SELECT * FROM course
	            		LEFT OUTER JOIN teacher_enrollment
	            		ON course.course_id = teacher_enrollment.course_id
	            		LEFT OUTER JOIN teacher
	            		ON teacher_enrollment.teacher_id = teacher.teacher_id
	            		LEFT OUTER JOIN users
	            		ON teacher.user_id = users.user_id
	            ";

	            $allScheduledCourses = $conn->query($qs);
	            $allScheduledCourses = $allScheduledCourses -> fetchAll(PDO::FETCH_ASSOC);





/*
	            echo "<pre class='res'>";

	            print_r($allScheduledCourses);

	            echo "</pre>";*/
	        ?>
	        
	        <?php
	            // when employee join course
	                if (isset($_GET['join'])){
	                    $joinCourseId = $_POST['joinid'];
	                    $joinTeacherId = $_POST['jointeacher'];
	                    insertStuEnrollment($employeeId, $joinCourseId, $joinTeacherId, $conn);
	                    header("Location:employee.php");
	                } 

	        ?>
	        <h2 class="welcome">welcome <span><?php echo $allEmployeeInfo['first_name']; ?></span></h2>
	        
	        
	        <div class="row">
	            <!-- employee info -->
	            <div class="col-lg-6 offset-lg-3 part">
	                <div class="panel">
	                    <h3>employee information</h3>
	                    <p>employee name: <span><?php echo $allEmployeeInfo['first_name']." ".$allEmployeeInfo['last_name'] ; ?></span></p>
	                    <p>employee ID: <span><?php print $allEmployeeInfo['employee_id']; ?></span></p>
	                    <p>employee email: <span class="email"><?php print $allEmployeeInfo['user_email']; ?></span></p>
	                    <p>employee phone: <span ><?php print $allEmployeeInfo['user_phone']; ?></span></p>
	                </div>
	            </div>
	            
	        </div>


	        <!-- controls -->
			<div class="panel">
				<div class="row">

					<!-- start side buttons -->
					<div class="col-md-3">
						<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link active" id="studentsTab" data-toggle="pill" href="#studentsTab_" role="tab" aria-controls="studentsTab_" aria-selected="true">Students</a>

							<a class="nav-link" id="teachersTab" data-toggle="pill" href="#teachersTab_" role="tab" aria-controls="teachersTab_" aria-selected="false">Teachers</a>

							<a class="nav-link" id="coursesTab" data-toggle="pill" href="#coursesTab_" role="tab" aria-controls="coursesTab_" aria-selected="false">Courses</a>

							<a class="nav-link" id="scheduledCoursesTab" data-toggle="pill" href="#scheduledCoursesTab_" role="tab" aria-controls="coursesTab_" aria-selected="false">Scheduled Courses</a>

							<?php if($allEmployeeInfo['is_manager']){ ?>

							<a class="nav-link" id="employeeTap" data-toggle="pill" href="#employeeTap_" role="tab" aria-controls="employeeTap_" aria-selected="false">Employees</a>

							<?php } ?>
						</div>
						<!-- end side buttons -->

					</div>
					<div class="col-md-9">
						<!-- start tabs contents -->
						<div class="tab-content" id="v-pills-tabContent">

							<!-- start students controls -->
							<div class="tab-pane fade show active" id="studentsTab_" role="tabpanel" aria-labelledby="studentsTab">
								<div class="infoTable">
									<table>
										<tr>
											<td>Student ID</td>
											<td>Student name</td>
											<td>Student Email</td>
											<td>&nbsp;</td>
										</tr>

										<?php
										foreach ($allStudentsInfo as $row) {
										?>

										<tr>
											<td><?php echo $row['student_id'] ?></td>
											<td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
											<td><?php echo $row['user_email'] ?></td>
											<td>

												<button
												class="fullPageBtn"
												data-id="<?php echo $row['user_id'] ?>"
												data-table="student"
												 > Full Info</button>
										</tr>

										<?php
										}
										?>




									</table>
								</div>
							</div>
							<!-- end students controls -->

							<!-- start teachers controls -->
							<div class="tab-pane fade" id="teachersTab_" role="tabpanel" aria-labelledby="teachersTab">
								<div class="infoTable">
									<table>
										<tr>
											<td>Teacher ID</td>
											<td>Teacher name</td>
											<td>Teacher Email</td>
											<td>&nbsp;</td>
										</tr>

										<?php
										foreach ($allTeachersInfo as $row) {
										?>

										<tr>
											<td><?php echo $row['teacher_id'] ?></td>
											<td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
											<td><?php echo $row['user_email'] ?></td>
											<td>

												<button
												class="fullPageBtn"
												data-id="<?php echo $row['user_id'] ?>"
												data-table="teacher"
												 > Full Info</button>
										</tr>

										<?php
										}
										?>




									</table>
								</div>
							</div>
							<!-- end teachers controls -->

							<!-- start courses controls -->
							<div class="tab-pane fade" id="coursesTab_" role="tabpanel" aria-labelledby="coursesTab">
								<div class="infoTable">
									<table>
										<tr>
											<td>Course ID</td>
											<td>Course name</td>
											<td>Course Price</td>
											<td>Course Session</td>
											<td>&nbsp;</td>
										</tr>

										<?php
										foreach ($allCoursesInfo as $row) {
										?>

										<tr>
											<td><?php echo $row['course_id'] ?></td>
											<td><?php echo $row['course_name'] ?></td>
											<td><?php echo $row['course_price'] ?></td>
											<td><?php echo $row['course_sessions'] ?></td>
											<td>

												<button
												class="fullPageBtn"
												data-id="<?php echo $row['course_id'] ?>"
												data-table="course"
												data-action="delete"
												 > DELETE</button>
										</tr>

										<?php
										}
										?>




									</table>

									<button class="fullPageBtn custom-button addCourseBn"
									data-action="addCf"
									>
										Add new course
									</button>
								</div>
							</div>
							<!-- end courses controls -->

							<!-- start scheduled courses controls -->
							<div class="tab-pane fade" id="scheduledCoursesTab_" role="tabpanel" aria-labelledby="scheduledCoursesTab">
								<div class="infoTable">
									<table>
										<tr>
											<td>Course ID</td>
											<td>Course name</td>
											<td>Teacher Name</td>
											<td>Course Price</td>
											<td>Course Session</td>
										</tr>

										<?php
										foreach ($allScheduledCourses as $row) {
										?>

										<tr>
											<td><?php echo $row['course_id'] ?></td>
											<td><?php echo $row['course_name'] ?></td>
											<td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
											<td><?php echo $row['course_price'] ?></td>
											<td><?php echo $row['course_sessions'] ?></td>
											<td>

										</tr>

										<?php
										}
										?>




									</table>
								</div>
							</div>
							<!-- end scheduled courses controls -->



							<?php if($allEmployeeInfo['is_manager']){

								$qs = "
									SELECT * FROM employee
									INNER JOIN users ON employee.user_id = users.user_id
								";

								$allEmployeesInfo = $conn -> query($qs);

								$allEmployeesInfo = $allEmployeesInfo -> fetchAll(PDO::FETCH_ASSOC);

							 ?>
							<!-- start employees controls -->
							<div class="tab-pane fade" id="employeeTap_" role="tabpanel" aria-labelledby="employeeTap">
								<div class="infoTable">
									<table>
										<tr>
											<td>Employee ID</td>
											<td>Employee name</td>
											<td>Employee Email</td>
											<td>Employee Phone</td>
											<td>Is Admin</td>
											<td>&nbsp;</td>
										</tr>

										<?php
										foreach ($allEmployeesInfo as $row) {
										?>

										<tr>
											<td><?php echo $row['employee_id'] ?></td>
											<td><?php echo $row['first_name']." ".$row['last_name'] ?></td>
											<td><?php echo $row['user_email'] ?></td>
											<td><?php echo $row['user_phone'] ?></td>
											<td><?php echo $row['is_manager'] ?></td>
											<td>

												<button
												class="fullPageBtn"
												data-id="<?php echo $row['user_id'] ?>"
												data-table="employee"
												 > Full Info</button>
										</tr>

										<?php
										}
										?>




									</table>
								</div>
							</div>
							<!-- end employees controls -->
							<?php } ?>
						</div>
						<!-- end tabs contents -->

						<!-- start server response -->
						<div class="serverRes">

							
						</div>
						<!-- end server response -->


		        	</div>
		        </div>
			</div>
			<!-- end controls -->

	    </div>

	</section> 




<?php
} else {
    echo "Please log in first to see this page.";
}
?>

		<script src="assets/js/jquery-3.2.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script>
			function myAction(){
				console.log("ccc");
				var data = "";
				if($(this).hasClass("addCourseBnSubmit")){

					data = "courseName=" +$("#courseName").val() +
					"&coursePrice=" + $("#coursePrice").val() +
					"&courseSessions=" + $("#courseSessions").val() +
					"&ID="+
					"&table="

					+ "&action=addC" ;
					console.log(data);
				}else{
					data = "ID=" +$(this).attr("data-id") + "&table=" + $(this).attr("data-table") 
					+ "&action=" + $(this).attr("data-action");
				}

				event.preventDefault();
				console.log("ID=" +$(this).attr("data-id"));
				$.ajax({
					url: 'employeeController.php',
					type: 'POST',
					//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: data,
				})
				.done(function(data) {
					console.log("success");
					$(".serverRes").html(data);
					console.log(data);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}
			$(".fullPageBtn").on('click', myAction);

			$(".nav-link").on("click", function(){
				$(".serverRes").html("");
			});
			
			
		</script>
    </body>
</html>
