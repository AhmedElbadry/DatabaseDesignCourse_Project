<?php
    $tFName = $_POST["teacher-fname"];
    $tLName = $_POST["teacher-lname"];
    $tEmail = $_POST["teacher-email"];
    $tPass = $_POST["teacher-pass"];
    $tPhone = $_POST["teacher-phone"];
    
    // require connection file with some helpful functions to deal with DB
    require 'connect.php';
    if ( !isUnique('users', 'user_email', $tEmail, 'user_email', $conn) ){
        echo '<p class="res">This email is already registered before!</p>';
    } else if ( !isUnique('users', 'user_phone', $tPhone, 'user_phone', $conn) ) {
        echo '<p class="res">This phone number is already registered before!</p>';
    } else {
        insertUser($tEmail, $tPass, $tFName, $tLName, $tPhone, 't', $conn);
        $uId = getSingleValue('users', 'user_email', $tEmail, 'user_id', $conn);
        insertType('teacher', $uId, $conn);
        session_start();
        header("Location:index.php?signed=true");
    }