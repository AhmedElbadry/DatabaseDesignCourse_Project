<?php
session_start();
if (isset($_SESSION['logged'])) {
	require 'connect.php';
	echo "yes";
}else{
	echo "no";
}

?>