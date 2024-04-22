<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");
$today = date("Y-m-d");
$user = $_SESSION['user'];


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

if (isset($_POST['course_add'])) {
    $course_name = $db_handle->checkValue($_POST['course_name']);
    $duration = $db_handle->checkValue($_POST['duration']);
    $age = $db_handle->checkValue($_POST['age']);
    $program = $db_handle->checkValue($_POST['program']);
    $course_fee = $db_handle->checkValue($_POST['course_fee']);

    if (empty($course_name) || empty($duration) || empty($age) || empty($program) || empty($course_fee)) {
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Course';
</script>";
    } else {
        $add_course = $db_handle->insertQuery("INSERT INTO `course`(`program`, `age`, `course_name`, `duration`, `inserted_at`,`course_fee`) VALUES ('$program','$age','$course_name','$duration','$inserted_at','$course_fee')");
        if ($add_course) {
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Course';
</script>";
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Course';
</script>";
        }
    }
}

if (isset($_POST['batch_add'])) {
    $batch_name = $db_handle->checkValue($_POST['batch_name']);
    $course = $db_handle->checkValue($_POST['course']);
    $day_one = $db_handle->checkValue($_POST['day_one']);
    $time_one = $db_handle->checkValue($_POST['time_one']);
    $day_two = $db_handle->checkValue($_POST['day_two']);
    $time_two = $db_handle->checkValue($_POST['time_two']);
    $start_date = $db_handle->checkValue($_POST['start_date']);


    if (empty($day_one) || empty($time_one) || empty($day_two) || empty($time_two) || empty($start_date) || empty($course) || empty($batch_name)) {
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Course';
</script>";
    } else {
        $add_batch = $db_handle->insertQuery("INSERT INTO `batch` (`batch_name`, `day_one`, `time_one`, `day_two`, `time_two`, `start_date`, `inserted_at`,`course_id`) VALUES ('$batch_name','$day_one','$time_one','$day_two','$time_two','$start_date','$inserted_at','$course')");
        if ($add_batch) {
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Batch';
</script>";
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Batch';
</script>";
        }
    }
}


if (isset($_POST['register_student'])) {
    $student_name = $db_handle->checkValue($_POST['student_name']);
    $class = $db_handle->checkValue($_POST['class']);
    $dob = $db_handle->checkValue($_POST['dob']);
    $age = $db_handle->checkValue($_POST['age']);
    $birth_place = $db_handle->checkValue($_POST['birth_place']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $nid = $db_handle->checkValue($_POST['nid']);
    $present_address = $db_handle->checkValue($_POST['present_address']);
    $permanent_address = $db_handle->checkValue($_POST['permanent_address']);
    $blood_group = $db_handle->checkValue($_POST['blood_group']);
    $hobby = $db_handle->checkValue($_POST['hobby']);
    $institution = $db_handle->checkValue($_POST['institution']);

    if (empty($student_name) || empty($class) || empty($dob) || empty($age) || empty($gender) || empty($nid) || empty($present_address) || empty($permanent_address) || empty($blood_group) || empty($institution)) {
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Admission';
</script>";
    } else {
        function generateUniqueId() {
            $group = chr(rand(65, 90));
            $timestamp = time();
            $randomPart = substr(md5($timestamp), 0, 6);
            $r_id = $group . '-' . $randomPart;
            return $r_id;
        }
        $uniqueId = generateUniqueId();
        $checksum = 0;

        while ($checksum == 0){
            $check_unique_id = $db_handle->numRows("SELECT * FROM student WHERE unique_id = '$uniqueId'");
            if($check_unique_id > 0){
                $uniqueId = generateUniqueId();
            } else {
                $checksum = 1;
            }
        }

        $register_student = $db_handle->insertQuery("INSERT INTO `student`(`student_name`, `class`, `dob`, `age`, `birth_place`, `gender`, `nid`, `present_address`, `permanent_address`, `blood_group`, `hobby`, `inserted_at`,`unique_id`,`institution`) VALUES ('$student_name','$class','$dob','$age','$birth_place','$gender','$nid','$present_address','$permanent_address','$blood_group','$hobby','$inserted_at','$uniqueId','$institution')");
        if ($register_student) {
            $father_name = $db_handle->checkValue($_POST['father_name']);
            $mother_name = $db_handle->checkValue($_POST['mother_name']);
            $father_contact_no = $db_handle->checkValue($_POST['father_contact_no']);
            $mother_contact_no = $db_handle->checkValue($_POST['mother_contact_no']);
            $father_occupation = $db_handle->checkValue($_POST['father_occupation']);
            $mother_occupation = $db_handle->checkValue($_POST['mother_occupation']);
            if (empty($father_name) || empty($mother_contact_no) || empty($mother_occupation) || empty($father_occupation) || empty($mother_name) || empty($father_contact_no)) {
                echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Admission';
</script>";
            } else {
                $last_student_fetch = $db_handle->runQuery("select student_id from student order by student_id desc limit 1");
                $last_student = $last_student_fetch[0]['student_id'];
                $add_parent = $db_handle->insertQuery("INSERT INTO `parents`(`student_id`, `father_name`, `mother_name`, `father_occupation`, `mother_occupation`, `father_contact`, `mother_contact`, `inserted_at`) VALUES ('$last_student','$father_name','$mother_name','$father_occupation','$mother_occupation','$father_contact_no','$mother_contact_no','$inserted_at')");
                if ($add_parent) {
                    $emergency_name = $db_handle->checkValue($_POST['emergency_name']);
                    $emergency_relation = $db_handle->checkValue($_POST['emergency_relation']);
                    $emergency_contact_no = $db_handle->checkValue($_POST['emergency_contact_no']);
                    $emergency_address = $db_handle->checkValue($_POST['emergency_address']);
                    if (empty($emergency_name) || empty($emergency_contact_no) || empty($emergency_address) || empty($emergency_relation)) {
                        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Admission';
</script>";
                    } else {
                        $insert_emergency_data = $db_handle->insertQuery("INSERT INTO `emergency_contact`(`student_id`, `contact_name`, `relation_student`, `emergency_contact`, `address`, `inserted_at`) VALUES ('$last_student','$emergency_name','$emergency_relation','$emergency_contact_no','$emergency_address','$inserted_at')");
                        if($insert_emergency_data){
                            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Confirm-Admission?id=$uniqueId';
</script>";
                        }
                    }
                } else {
                    echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Admission';
</script>";
                }
            }
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Admission';
</script>";
        }
    }
}


if (isset($_POST['confirm_admission'])){
    $unique_id = $db_handle->checkValue($_POST['unique_id']);
    $batch_id = $db_handle->checkValue($_POST['batch_id']);

    $fetch_student_id = $db_handle->runQuery("select student_id from student where unique_id='$unique_id'");
    $student_id = $fetch_student_id[0]['student_id'];
    $employee_id = $_SESSION['user'];
    if(empty($batch_id)) {
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Admission';
</script>";
    } else {
        $insert_admission = $db_handle->insertQuery("INSERT INTO `admission`(`student_id`, `unique_id`, `batch_id`, `inserted_at`,`employee_id`) VALUES ('$student_id','$unique_id','$batch_id','$inserted_at','$employee_id')");
        if($insert_admission){
            $fetch_admission = $db_handle->runQuery("select * from admission order by admission_id desc limit 1");
            $admission_id = $fetch_admission[0]['admission_id'];
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Registration-Form?id=$admission_id';
</script>";
        }
    }

}


if(isset($_POST['receive_money'])){
    $unique_id = $db_handle->checkValue($_POST['unique_id']);
    $batch_id = $db_handle->checkValue($_POST['batch_id']);
    $amount = $db_handle->checkValue($_POST['amount']);
    $note = $db_handle->checkValue($_POST['note']);
    $payment_method = $db_handle->checkValue($_POST['payment_method']);
    $student_id = $db_handle->checkValue($_POST['student_id']);

    if(empty($batch_id) || empty($amount) || empty($unique_id) || empty($payment_method)){
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Admission';
</script>";
    } else {
        $receive_money = $db_handle->insertQuery("INSERT INTO `receive_money`(`student_id`, `student_unique_id`, `batch_id`, `paid_amount`, `purpose`, `payment_method`, `receiver`, `date`, `inserted_at`) VALUES ('$student_id','$unique_id','$batch_id','$amount','$note','$payment_method','$user','$today','$inserted_at')");
        $last = $db_handle->runQuery("select * from receive_money order by money_id desc limit 1");
        $l = $last[0]['money_id'];
        if($receive_money){
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Money-Slip.php?id=$l';
</script>";
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Student-List';
</script>";
        }
    }
}

if(isset($_POST['add_expense'])){
    $expense_amount = $db_handle->checkValue($_POST['expense_amount']);
    $note = $db_handle->checkValue($_POST['note']);
    $date = $db_handle->checkValue($_POST['date']);
    $employee_id = $_SESSION['user'];

    if(empty($expense_amount) || empty($note) || empty($date)){
        echo "<script>
document.cookie = 'alert = 6;';
                window.location.href='Expense';
</script>";
    } else{
        $insert_expense = $db_handle->insertQuery("INSERT INTO `expense`(`note`, `amount`, `date`, `operator`, `inserted_at`) VALUES ('$note','$expense_amount','$date','$employee_id','$inserted_at')");
        if($insert_expense){
            echo "<script>
document.cookie = 'alert = 4;';
                window.location.href='Expense';
</script>";
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
                window.location.href='Expense';
</script>";
        }
    }
}