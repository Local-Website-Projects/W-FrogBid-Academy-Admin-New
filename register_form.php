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
        h6 {
            font-weight: 900;
            color: #000;
        }
        p{
            color: #000000;
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
<div id="main-wrapper" style="background-color: rgba(80,199,224,0.22); height: 1403px;">
    <!--**********************************
        Content body start
    ***********************************-->
        <!-- row -->
        <div class="container-fluid">
            <!--main body content-->
            <header style="height: 200px;margin-top: 20px;">
                <div class="row">
                    <div class="col-4">
                        <img src="images/logo_color.png" style="height: 200px; width: auto;">
                    </div>
                    <div class="col-4 text-center my-auto">
                        <h6>Student Name: <?php echo $fetch_student[0]['student_name'];?></h6>
                        <h6>Student ID: <?php echo $fetch_student[0]['unique_id'];?></h6>
                    </div>
                    <div class="col-4 d-flex align-items-end justify-content-end">
                        <div class="photo d-flex align-items-center justify-content-center"><p>Photo</p></div>
                    </div>
                </div>
            </header>

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