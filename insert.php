<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");


if (isset($_POST['register'])) {
    $full_name = $db_handle->checkValue($_POST['full_name']);
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $phone = $db_handle->checkValue($_POST['phone']);
    $nid = $db_handle->checkValue($_POST['nid']);
    $join_date = $db_handle->checkValue($_POST['join_date']);
    $department = $db_handle->checkValue($_POST['department']);
    if (empty($full_name) || empty($email) || empty($password) || empty($phone) || empty($nid) || empty($join_date) || empty($department)) {
        echo "<script>
                document.cookie = 'alert = 6;';
                window.location.href='Register';
</script>";
    } else {
        $check_email = $db_handle->numRows("select * from employee where email='$email'");
        if ($check_email > 0) {
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='Register';
</script>";
        } else {
            $register_employee = $db_handle->insertQuery("INSERT INTO `employee`(`full_name`, `department`, `join_date`, `nid_no`, `contact_no`, `email`, `password`,`inserted_at`) VALUES ('$full_name','$department','$join_date','$nid','$phone','$email','$hashed_password','$inserted_at')");
            if ($register_employee) {
                echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Register';
</script>";
            } else {
                echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Register';
</script>";
            }
        }
    }
}

if(isset($_POST['course_add'])){
    $course_name = $db_handle->checkValue($_POST['course_name']);
    $duration = $db_handle->checkValue($_POST['duration']);
    $age = $db_handle->checkValue($_POST['age']);
    $program = $db_handle->checkValue($_POST['program']);

    if (empty($course_name) || empty($duration) || empty($age) || empty($program)) {
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Course';
</script>";
    } else {
        $add_course = $db_handle->insertQuery("INSERT INTO `course`(`program`, `age`, `course_name`, `duration`, `inserted_at`) VALUES ('$program','$age','$course_name','$duration','$inserted_at')");
        if ($add_course) {
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Course';
</script>";
        } else{
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Course';
</script>";
        }
    }
}