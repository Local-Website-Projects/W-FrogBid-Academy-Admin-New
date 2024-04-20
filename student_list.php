<?php
session_start();
if(!isset($_SESSION['user'])){
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student List - FrogBid Academy</title>
    <?php require_once('include/css.php'); ?>

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
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="index.html" class="brand-logo">
            <h1>Student List</h1>
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->


    <!--**********************************
        Header start
    ***********************************-->
    <?php require_once('include/header.php'); ?>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <?php require_once('include/sidebar.php'); ?>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="form-head mb-4">
                <h2 class="text-black font-w600 mb-0">Student List</h2>
            </div>
            <!--main body content-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Student List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>View</th>
                                    <th>Unique Id</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Batch</th>
                                    <th>Contact No</th>
                                    <th>Official Person</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $fetch_student = $db_handle->runQuery("SELECT student_name, admission_id, full_name, class, present_address, father_name, mother_name, mother_contact, batch_name,student.unique_id FROM `student`, `parents`,`admission`,`batch`,`employee` WHERE student.student_id = parents.student_id and student.student_id = admission.student_id and admission.batch_id = batch.batch_id and admission.employee_id = employee.e_id order by admission.admission_id desc");
                                for ($i=0; $i < count($fetch_student); $i++) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="Registration-Form?id=<?php echo $fetch_student[$i]['admission_id'];?>" target="_blank" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-print"></i></a>
                                        </td>
                                        <td><?php echo $fetch_student[0]['unique_id'];?></td>
                                        <td><?php echo $fetch_student[0]['student_name'];?></td>
                                        <td><?php echo $fetch_student[0]['class'];?></td>
                                        <td><?php echo $fetch_student[0]['batch_name'];?></td>
                                        <td><?php echo $fetch_student[0]['mother_contact'];?></td>
                                        <td><?php echo $fetch_student[0]['full_name'];?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->

    <!--**********************************
        Footer start
    ***********************************-->
    <?php require_once('include/footer.php'); ?>
    <!--**********************************
        Footer end
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