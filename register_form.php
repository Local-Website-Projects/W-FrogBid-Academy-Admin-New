<?php
session_start();
if(!isset($_SESSION['user'])){
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();
if(isset($_GET['id'])){
    $admission_id = $_GET['id'];
    $fetch_admission = $db_handle->runQuery("select * from admission where admission_id = '$admission_id'");
    $student = $fetch_admission[0]['student_id'];
    $batch = $fetch_admission[0]['batch_id'];

    $fetch_student = $db_handle->runQuery("select * from student where student_id = '$student'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Registration Copy - FrogBid Academy</title>
    <?php require_once('include/css.php'); ?>
    <style>
        .photo{
            border: 1px solid black;
            height: 250px;
            width: 230px;
        }
        h6,h5,h4 {
            font-weight: 900;
            color: #000;
        }
        p{
            color: #000000;
        }
        table, tr, td, th{
            border: 1px solid black;
            padding: 10px;
            color: black;
            font-weight: bold;
        }
        .heading_title{
            font-weight: 900;
        }
    </style>
</head>
<body>

<!--*******************
    Preloader start
********************-->
<?php require_once('include/preloader.php'); ?>
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper" style="background-color: #fff; height: 1500px;">
    <!--**********************************
        Content body start
    ***********************************-->
        <!-- row -->
        <div class="container">
            <!--main body content-->
            <header style="height: 250px;margin-top: 20px;">
                <div class="row">
                    <div class="col-4">
                        <img src="images/logo_color.png" style="height: 200px; width: auto;">
                    </div>
                    <div class="col-4 text-center my-auto">
                        <h4>Student Registration Data</h4>
                        <h6>Student Name: <?php echo $fetch_student[0]['student_name'];?></h6>
                        <h6>Student ID: <?php echo $fetch_student[0]['unique_id'];?></h6>
                        <h6>Date: <?php echo $inserted_at = date("d F Y");?></h6>
                    </div>
                    <div class="col-4 d-flex align-items-end justify-content-end">
                        <div class="photo d-flex align-items-center justify-content-center"><p>Photo</p></div>
                    </div>
                </div>
            </header>
            <div class="row mt-3">
                <div class="col-12">
                    <u><h5>Student Information:</h5></u>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Age</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['age'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Class</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['class'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <p class="heading_title">Institution</p>
                        </div>
                        <div class="col-9">
                            <p>: <?php echo $fetch_student[0]['institution'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Date of Birth</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php $dob = $fetch_student[0]['dob'];
                                $formatted_dob = date('d F y', strtotime($dob));
                                echo $formatted_dob;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Gender</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['gender'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Birth Certificate/NID</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['nid'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Birth Place</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['birth_place'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Blood Group</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['blood_group'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Address</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_student[0]['present_address'];?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <h5><u>Parent's Information: </u></h5>
                </div>
                <?php
                $fetch_parent = $db_handle->runQuery("select * from parents where student_id = '$student'");
                ?>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Father's Name</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['father_name'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Mother's Name</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['mother_name'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Father's Contact No</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['father_contact'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Mother's Contact No</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['mother_contact'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Father's Occupation</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['father_occupation'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Mother's Occupation</p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_parent[0]['mother_occupation'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <h5><u>Emergency Contact Person</u></h5>
                </div>
                <?php
                $fetch_emergency = $db_handle->runQuery("select * from emergency_contact where student_id = '$student'");
                ?>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Contact Person Name </p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_emergency[0]['contact_name'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Contact Person Number </p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_emergency[0]['emergency_contact'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Relation with Student </p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_emergency[0]['relation_student'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <p class="heading_title">Address </p>
                        </div>
                        <div class="col-6">
                            <p>: <?php echo $fetch_emergency[0]['address'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $fetch_batch = $db_handle->runQuery("select * from batch where batch_id = '$batch'");
            ?>
            <div class="row mt-3">
                <div class="col-12">
                    <h5><u>Class Time:</u></h5>
                    <p class="heading_title">Batch Name: <?php echo $fetch_batch[0]['batch_name'];?></p>
                </div>
                <div class="col-12">
                    <table style="width: 100%">
                        <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Day</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>01</th>
                            <td><?php echo $fetch_batch[0]['day_one'];?></td>
                            <td><?php $time_one = $fetch_batch[0]['time_one'];
                                // Convert to 12-hour format
                                $formatted_time = date('h:i A', strtotime($time_one));
                                echo $formatted_time;?></td>
                        </tr>
                        <tr>
                            <th>02</th>
                            <td><?php echo $fetch_batch[0]['day_two'];?></td>
                            <td><?php $time_one = $fetch_batch[0]['time_two'];
                                // Convert to 12-hour format
                                $formatted_time = date('h:i A', strtotime($time_one));
                                echo $formatted_time;?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-3 d-flex align-items-end justify-content-end">
                <div class="col-4 mt-5 text-end">
                    <p class="mt-5 heading_title"">Official's Signature & Date</p>
                </div>
            </div>
            <div class="row" style="position: relative; margin-top: 20px">
                <div class="col-12">
                    <hr style="border: 2px solid black">
                </div>
                <div class="col-4">
                    <p class="heading_title">www.frogbidacademy.com</p>
                </div>
                <div class="col-3 col-3 d-flex align-items-center justify-content-center">
                    <p class="heading_title">contact@frogbidacademy.com</p>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center">
                    <p class="heading_title">01729-277765</p>
                </div>
                <div class="col-2 d-flex align-items-end justify-content-end">
                    <p class="heading_title">01729-277768</p>
                </div>
                <div class="col-12 text-center">
                    <p class="heading_title">16, K D A Avenue Moylapota (Ikbalnagar), Khulna-9100</p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <?php

                    $admin = $db_handle->runQuery("select * from employee where e_id = {$fetch_admission[0]['employee_id']}");
                    ?>
                    <p>Prepared By: <b><?php echo $admin[0]['full_name'];?></b></p>
                </div>
                <div class="col-6 d-flex align-items-end justify-content-end">
                    <p>Software Developed With: <b>FrogBid</b></p>
                </div>
            </div>
        </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<?php require_once('include/js.php'); ?>
</body>

</html>