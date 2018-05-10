<?php
    $dsn = 'mysql:host=localhost;dbname=courses_center';
    $user = 'root';
    $pass = '';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    
    // start new connection
    try{
        $conn = new PDO($dsn, $user, $pass, $options);
    }
    catch(PDOException $e){
        echo 'failed' . $e->getMessage();
    }

    // function to get value from DB
    function getSingleValue($tableName, $prop, $value, $columnName, $conn) {
        $q = $conn->query("SELECT `$columnName` FROM `$tableName` WHERE $prop='".$value."'");
        $f = $q->fetchColumn();
        $result = $f;
        return $result;
    }
    
    // function to get array of values from DB
    function getAllValues($tableName, $prop, $value, $columnName, $conn) {
        $q = $conn->query("SELECT `$columnName` FROM `$tableName` WHERE $prop='".$value."'");
        $f = $q->fetchAll();
        $result = array();
        $counter = 0;
        foreach($f as $row){
            $result[$counter] = $row[$columnName];
            $counter++;
        }
        return $result;
    }

    function getAllInfoByID($tableName, $conn){
        $allInfo = $conn->query("SELECT * FROM users INNER JOIN ".$tableName." ON users.user_id = ".$tableName.".user_id");

        $allInfo = $allInfo -> fetchAll(PDO::FETCH_ASSOC);

        return $allInfo;
    }

    function getInfoByID($tableName, $prop, $value, $conn){
        $q = "SELECT * FROM users INNER JOIN ".$tableName." ON users.user_id = ".$tableName.".user_id WHERE users." .$prop. " = '" .$value. "'";
        $allInfo = $conn->query($q);

        $allInfo = $allInfo -> fetch(PDO::FETCH_ASSOC);

        return $allInfo;
    }



    // get all values with no condition
    function getAllValuesNoCondition($tableName, $columnName, $conn) {
        $q = $conn->query("SELECT `$columnName` FROM `$tableName`");
        $f = $q->fetchAll();
        $result = array();
        $counter = 0;
        foreach($f as $row){
            $result[$counter] = $row[$columnName];
            $counter++;
        }
        return $result;
    }

    // function to check if value is unique
    function isUnique($tableName, $prop, $value, $columnName, $conn) {
        $q = $conn->query("SELECT `$columnName` FROM `$tableName` WHERE $prop='".$value."'");
        $f = $q->fetch(PDO::FETCH_ASSOC);
        if(is_array($f)){
            return false;
        } else {
            return true;
        }
    }

    // function to insert user
    function insertUser($email, $pass, $name, $phone, $type, $conn) {
        $q = $conn->prepare("INSERT INTO users (user_email, user_password, user_name, user_phone, user_type)
        VALUES (?,?,?,?,?)" );
        $q->execute([$email, $pass, $name, $phone, $type]);
    }

    // insert student or teacher
    function insertType($table, $id, $conn) {
        $q = $conn->prepare("INSERT INTO $table (user_id)
        VALUES (?)" );
        $q->execute([$id]);
    }

    // insert student enrollment
    function insertStuEnrollment($stId, $courseId, $teacherId, $conn) {
        $q = $conn->prepare("INSERT INTO student_enrollment (student_id, course_id, teacher_id)
        VALUES (?,?,?)" );
        $q->execute([$stId, $courseId, $teacherId]);
    }