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
$fetch_data = $db_handle->runQuery("select * from receive_money where money_id = '".$_GET['id']."'");
$student_id = $fetch_data[0]["student_id"];
$batch_id = $fetch_data[0]["batch_id"];
$today = date("d M, Y");
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
<div id="main-wrapper" style="background-color: #fff; height: 725px;">
    <!--**********************************
        Content body start
    ***********************************-->
    <!-- row -->
    <div class="container">
        <!--main body content-->
        <header style="height: 200px;margin-top: 20px;">
            <div class="row">
                <div class="col-4">
                    <img src="images/logo_color.png" style="height: 200px; width: auto;">
                </div>
                <div class="col-8 d-flex flex-column align-items-end justify-content-end my-auto">
                    <h4 class="text-right">Money Slip</h4>
                    <?php
                    $fetch_student_data = $db_handle->runQuery("select * from student where student_id = '".$student_id."'");
                    ?>
                    <h6 class="text-right">Student Name: <?php echo $fetch_student_data[0]['student_name'];?></h6>
                    <h6 class="text-right">Student ID: <?php echo $fetch_student_data[0]['unique_id'];?></h6>
                    <h6 class="text-right">Date: <?php echo $today; ?></h6>
                </div>
            </div>
        </header>

        <div class="row mt-3">
            <?php
            $fetch_batch = $db_handle->runQuery("select batch_name from batch where batch_id = '".$batch_id."'");
            ?>
            <div class="col-12">
                <p class="heading_title">Batch Name: <?php echo $fetch_batch[0]['batch_name'];?></p>
            </div>
            <div class="col-12">
                <table style="width: 100%">
                    <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Note</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>01</th>
                        <td><?php echo $fetch_data[0]['purpose'];?></td>
                        <td><?php echo $fetch_data[0]['paid_amount'];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td><?php echo $fetch_data[0]['paid_amount'];?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row d-flex align-items-end justify-content-end">
            <div class="col-4 mt-5 text-end">
                <p class="mt-5 heading_title"">Official's Signature & Date</p>
            </div>
        </div>
        <div class="row" style="position: relative;">
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
                $id = $fetch_data[0]['receiver'];
                $fetch_employee = $db_handle->runQuery("select full_name from employee where e_id = '".$id."'");
                ?>
                <p>Prepared By: <b><?php echo $fetch_employee[0]['full_name'];?></b></p>
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