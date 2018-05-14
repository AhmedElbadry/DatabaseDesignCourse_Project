<?php


require 'connect.php';

if($_POST['ID']){
	echo "yes";
	$sID =  $_POST['ID'];
	$sInfo = getInfoByID('student', 'user_id', $sID, $conn);



	echo "<pre class='res'>";

	print_r($sInfo);

	echo "</pre>";
}

?>