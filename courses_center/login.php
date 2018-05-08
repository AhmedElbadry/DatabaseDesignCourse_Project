<?php
    $logEmail = $_POST["email"];
    $logPassword = $_POST["password"];
    $valResult = " ";

    // require connection file with some helpful functions to deal with DB
    require 'connect.php';

    // get the password for that email
    $realPass = getSingleValue('users', 'user_email', $logEmail, 'user_password', $conn);
    
    if ($realPass){
        if ($logPassword == $realPass) {
            $type = getSingleValue('users', 'user_email', $logEmail, 'user_type', $conn);
            
            session_start();
            $_SESSION["logged"] = true;
            $_SESSION["type"] = $type;
            $_SESSION["userEmail"] = $logEmail;
            switch($type){
                case 's':
                    header("Location:student.php");
                    break;
                case 'e':
                    header("Location:employee.php");
                    break;
                case 't':
                    header("Location:teacher.php");
                    break;
            }
            
            
        } else {
            $_SESSION['$valResult'] = 'Wrong Password';
        }
    } else {
        $_SESSION['$valResult'] = 'Not Registered';
    }
?>
