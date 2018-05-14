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
	            $allStudentsInfo = $conn->query("SELECT * FROM users INNER JOIN student ON users.user_id = student.user_id ");
	            $allStudentsInfo = $allStudentsInfo -> fetchAll(PDO::FETCH_ASSOC);




	            echo "<pre class='res'>";

	            print_r($allEmployeeInfo);

	            echo "</pre>";
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
	        <h2 class="welcome">welcome <span><?php print $allEmployeeInfo['user_name']; ?></span></h2>
	        
	        
	        <div class="row">
	            <!-- employee info -->
	            <div class="col-lg-6 offset-lg-3 part">
	                <div class="panel">
	                    <h3>employee information</h3>
	                    <p>employee name: <span><?php print $allEmployeeInfo['user_name']; ?></span></p>
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
							<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Students</a>
							<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Teachers</a>
							<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Courses</a>

							<?php if($allEmployeeInfo['is_manager']){ ?>

							<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Employees</a>

							<?php } ?>
						</div>
						<!-- end side buttons -->

					</div>
					<div class="col-md-9">
						<!-- start tabs contents -->
						<div class="tab-content" id="v-pills-tabContent">

							<!-- start students controls -->
							<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
											<td><?php echo $row['user_name'] ?></td>
											<td><?php echo $row['user_email'] ?></td>
											<td>
												<!--
												<form method="post" action="?studentPage">
													<input type="text" name="student_id"
													 value="<?php echo $row['user_id'] ?>"
													 style="display: none;" />
													<input type="submit" name="" value="Full Page" />
												</form>
											-->

												<button class="fullPageBtn" data-id="<?php echo $row['user_id'] ?>"> Full Page</button>
										</tr>

										<?php
										}
										?>




									</table>
								</div>
							</div>
							<!-- end students controls -->

							<!-- start teachers controls -->
							<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							Teachers
							</div>
							<!-- end teachers controls -->

							<!-- start courses controls -->
							<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							Courses
							</div>
							<!-- end courses controls -->



							<?php if($allEmployeeInfo['is_manager']){ ?>
							<!-- start employees controls -->
							<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
							Employees
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
			$(".fullPageBtn").on('click', function(event) {
				event.preventDefault();
				console.log("ID=" +$(this).attr("data-id"));
				$.ajax({
					url: 'employeeController.php',
					type: 'POST',
					//dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: "ID=" +$(this).attr("data-id"),
				})
				.done(function(data) {
					console.log("success");
					$(".serverRes").html(data);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});

			});
			
			
		</script>
    </body>
</html>
