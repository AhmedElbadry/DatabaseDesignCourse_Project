<?php
    $stFName = $_POST["student-fname"];
    $stLName = $_POST["student-lname"];
    $stEmail = $_POST["student-email"];
    $stPass = $_POST["student-pass"];
    $stPhone = $_POST["student-phone"];
    $stResult = " ";
    
    // require connection file with some helpful functions to deal with DB
    require 'connect.php';
    if ( !isUnique('users', 'user_email', $stEmail, 'user_email', $conn) ){
        echo '<p class="res">This email is already registered before!</p>';
    } else if ( !isUnique('users', 'user_phone', $stPhone, 'user_phone', $conn) ) {
        echo '<p class="res">This phone number is already registered before!</p>';
    } else {
        insertUser($stEmail, $stPass, $stFName, $stLName, $stPhone, 's', $conn);
        $uId = getSingleValue('users', 'user_email', $stEmail, 'user_id', $conn);
        insertType('student', $uId, $conn);
        session_start();
        header("Location:index.php?signed=true");
    }