<?php
session_start();
if (!isset($_GET['id'])) {
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();
$id = $_GET['id'];
$fetch_data = $db_handle->runQuery("select father_name, mother_name, father_contact, mother_contact, student_name from student,parents where student.student_id = parents.student_id and student.id_card_no='$id'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Id Verify</title>
    <style>
        .body {
            display: flex;
            justify-content: center;
            height: 100vh; /* Make sure the body takes the full height of the viewport */
        }
        .front{
            margin-top: 100px;
            width: 400px;
            background-image: url("images/id/FA-Id-card.png");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 635px;
        }
        .profile-image{
            height: 150px;
            width: 150px;
            border: 4px solid black;
            border-radius: 50%;
            margin-top: 42%;
            margin-left: 29%;
            overflow: hidden;
        }
        .profile-image img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
        .student-info{
            text-align: center;
            color: black;
        }
        .student-info h3{
            margin: 20px 0 0 0;
            font-size: 24px;
        }
        .student-info h4{
            margin: 10px 0 0 0;
            font-size: 20px;
        }
        .student-info p{
            font-weight: bold;
        }
        .details {
            margin: 20px 25px;
        }
        .details p{
            font-weight: bold;
            margin: 10px;
        }
        .back{
            margin-top: 100px;
            margin-left: 20px;
            width: 400px;
            background-image: url("images/id/FA-Id-card-back.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 635px;
        }
    </style>
</head>
<body>
<div class="body">
    <div class="front">
        <div class="profile-image">
            <img src="images/id/profile.jpg" alt="image">
        </div>
        <div class="student-info">
            <h3><?php echo $fetch_data[0]['student_name'];?></h3>
            <h4>Art</h4>
        </div>
        <div class="details">
            <p>Father's Name : <?php echo $fetch_data[0]['father_name'];?></p>
            <p>Mother's Name : <?php echo $fetch_data[0]['mother_name'];?></p>
            <p>Contact Number : <?php echo $fetch_data[0]['father_contact'];?></p>
            <p>Contact Number : <?php echo $fetch_data[0]['mother_contact'];?></p>
        </div>
        <div class="student-info">
            <p>www.frogbidacademy.com</p>
        </div>
    </div>
    <div class="back"></div>
</div>


</body>
</html>
