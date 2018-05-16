<?php


require 'connect.php';

if(isset($_POST['ID'])
	&& ($_POST['table']  == "student" 
	|| $_POST['table'] == "teacher" 
	|| $_POST['table'] == "employee")){

	$ID = $_POST['ID'];
	$table = $_POST['table'];
	$allInfo = getInfoByID($table, 'user_id', $ID, $conn);



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


	if($_POST['table'] != "employee"){
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
	}
} else if(isset($_POST['ID']) && $_POST['action'] == "delete"){

	$qs = "
	DELETE FROM course
	WHERE course.course_id = '". $_POST['ID'] ."'
	";

	$res = $conn -> query($qs);

	if($res){
		echo "Course deleted successfully";
	}else{
		echo "You can't delete this cousre because it is aleady scheduled.";
	}
}else if ($_POST['action'] == "addCf"){
	echo "
	<div>
		<input class='custom-input' placeholder='Course Name'  type='text' value='' id='courseName' />
	</div>
	<div>
		<input class='custom-input' placeholder='Course Price'  type='text' value='' id='coursePrice' />
	</div>
	<div>
		<input class='custom-input' placeholder='Course Sessions'  type='text' value='' id='courseSessions' />
	</div>

	<div>
		<input class='custom-button fullPageBtn addCourseBnSubmit' type='submit' />
	</div>

	<script> $('.fullPageBtn').on('click', myAction);</script>
	";
}else if($_POST['action'] == "addC"){

	$courseName = $_POST['courseName'];
	$coursePrice = $_POST['coursePrice'];
	$courseSessions = $_POST['courseSessions'];

	$qs = "
		INSERT INTO course(course_name, course_price, course_sessions)
		VALUES ('".$courseName."','".$coursePrice."', '".$courseSessions."')
	";

	echo $qs;
	$res = $conn -> query($qs);


	if($res){
		echo "Course was added successfully.";
	}else{
		echo "Course wasn't added.";
	}


}

/*


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


	/*
CREATE TABLE Hotel (
	hotelNo int PRIMARY KEY NOT NULL,
	name varchar(50) NOT NULL,
	address varchar(150) NOT NULL
);
CREATE TABLE Guest (
	guestNo int PRIMARY KEY NOT NULL,
	name varchar(50) NOT NULL,
	address varchar(150) NOT NULL
);

CREATE TABLE booking(
    bookingNo int PRIMARY KEY NOT NULL,
    hotelNo int NOT NULL,
    guestNo int NOT NULL,
    roomNo int NOT NULL,
    dataFrom DATE,
    dataTo DATE,
    
    FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo),
    FOREIGN KEY (guestNo) REFERENCES guest(guestNo),
    FOREIGN KEY (roomNo) REFERENCES Room(roomNo)

);



--a)
CREATE TABLE Room(
	roomNo int PRIMARY KEY NOT NULL,
	hotelNo int NOT NULL,
	type varchar(50),
	price int NOT NULL,
    
    FOREIGN KEY (hotelNo) REFERENCES Hotel(hotelNo)

);

--b)
INSERT INTO Hotel(hotelNo, name, address) values (250, 'Sheraton', 'Cairo') 

--c)
SELECT name, address FROM Guest WHERE address = 'Cairo' ORDER BY name ASC

--d)
SELECT * FROM Room WHERE (type = 'D' OR type = 'F') AND (price < 100) ORDER BY price ASC

--e)
SELECT AVG(PRICE) FROM Room WHERE type = 'D'

--f)
SELECT * FROM booking
INNER JOIN Hotel ON booking.hotelNo = Hotel.hotelNo AND Hotel.name = 'Sheraton'
WHERE booking.dataFrom = CURRENT_DATE

--g)
SELECT price, type FROM Room
inner JOIN Hotel ON Room.hotelNo = Hotel.hotelNo AND Hotel.name = 'Sheraton'

--h)
SELECT type, COUNT(type) FROM Room GROUP BY type ORDER BY COUNT(type) DESC LIMIT 1

--i)
SELECT * FROM Guest
INNER JOIN booking ON Guest.guestNo = booking.hotelNo AND (CURRENT_DATE BETWEEN booking.dataFrom AND booking.dataTo) 
inner JOIN Hotel ON booking.hotelNo = Hotel.hotelNo AND Hotel.name = 'Sheraton'

--j)
SELECT SUM(price) FROM Room
INNER JOIN booking ON Room.hotelNo = booking.hotelNo AND Room.roomNo = booking.roomNo
INNER JOIN Hotel ON booking.hotelNo = Hotel.hotelNo AND Hotel.name = 'Sheraton'
WHERE booking.dataFrom = CURRENT_DATE


SELECT * FROM Guest
INNER JOIN booking ON Guest.guestNo = booking.hotelNo AND (CURRENT_DATE BETWEEN booking.dataFrom AND booking.dataTo) 
inner JOIN Hotel ON booking.hotelNo = Hotel.hotelNo AND Hotel.name = 'Sheraton'

	*/
?>


