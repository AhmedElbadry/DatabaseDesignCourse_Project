<?php


require 'connect.php';

if($_POST['ID'] && $_POST['table'] == "student" || $_POST['table'] == "teacher"){

	$ID = $_POST['ID'];
	$table = $_POST['table'];




	$allInfo = getInfoByID($table, 'user_id', $ID, $conn);


/*
SELECT * FROM users INNER JOIN student ON users.user_id = student.user_id

INNER JOIN student_enrollment ON student.student_id = student_enrollment.student_id

...

SELECT * FROM users U INNER JOIN student S ON U.user_id = S.user_id

INNER JOIN student_enrollment SI ON S.student_id = SI.student_id

----

SELECT C.course_id, C.course_name, C.course_start_date, C.course_end_date FROM users U INNER JOIN student S ON U.user_id = S.user_id

INNER JOIN student_enrollment SI ON S.student_id = SI.student_id

INNER JOIN course C on SI.course_id = C.course_id


----

SELECT C.course_id, C.course_name, C.course_start_date, C.course_end_date FROM student S

INNER JOIN student_enrollment SI ON S.student_id = SI.student_id

INNER JOIN course C on SI.course_id = C.course_id
*/

	


	$uID = $allInfo[$table . '_id'];
	$uEmail = $allInfo['user_email'];
	$uFirstName = $allInfo['first_name'];
	$uSecondName = $allInfo['last_name'];
	$uPhone = $allInfo['user_phone'];

	echo "<h2 class='serverRes__title'>$table Infromation</h2>";
	echo "<p> $table ID: $uID</p>";
	echo "<p>Email: $uEmail</p>";
	echo "<p>First Name: $uFirstName</p>";
	echo "<p>Second Name: $uSecondName </p>";
	echo "<p>Phone: $uPhone</p>";

	$qs = "
		SELECT C.course_id, C.course_name, C.course_start_date, C.course_end_date FROM ".$table."_enrollment SI

		INNER JOIN course C on SI.course_id = C.course_id

		WHERE SI.".$table."_id=".$uID
	;

	$q = $conn-> query($qs);

	$allCourse = $q -> fetchAll(PDO::FETCH_ASSOC);


	if($allCourse){
		echo "<h3 class='serverRes__title'>all courses</h3>";

		foreach ($allCourse as $row) {
			echo "<p>Course ID: ".$row['course_id']."</p>";
			echo "<p>Course Name: ".$row['course_name']."</p>";
			echo "<p>Course Start Date: ".$row['course_start_date']."</p>";
			echo "<p>Course End Date: ".$row['course_end_date']."</p>";
		}
	}else{
		echo "<h4 class='serverRes__title'>$table didn't enroll in any courses yet</h4>";
	}
	




?>

<?php
/*
	echo "<pre class='res'>";

	print_r($allCourse);

	echo "</pre>";*/

	/*
CREATE TABLE Hotel (
	hotelNo int PRIMARY KEY NOT NULL,
	name varchar(50) NOT NULL,
	address varchar(150) NOT NULL
);

CREATE TABLE Room(
	roomNo int PRIMARY KEY NOT NULL,
	hotelNo int NOT NULL,
	type varchar(50),
	price int NOT NULL,
    
    FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo)

);
	*/
/*
	"




	"
*/
}

?>
