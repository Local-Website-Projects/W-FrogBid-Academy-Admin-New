<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Receive Money - FrogBid Academy</title>
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
            <h1>FrogBid</h1>
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
                <h2 class="text-black font-w600 mb-0">Receive Payment</h2>
            </div>
            <!--main body content-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Batch History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th class="width80"><strong>#</strong></th>
                                        <th><strong>Student Name</strong></th>
                                        <th><strong>Batch Name</strong></th>
                                        <th><strong>Batch Start Date</strong></th>
                                        <th><strong>Total Fee</strong></th>
                                        <th><strong>Paid Amount</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetch_data = $db_handle->runQuery("SELECT student.student_name,batch.batch_name,batch.start_date,batch.batch_id,course.course_fee from student, batch, course, admission WHERE admission.student_id = student.student_id and admission.batch_id = batch.batch_id and batch.course_id = course.course_id and student.unique_id = '$student_id'");
                                    for ($i = 0; $i < count($fetch_data); $i++) {
                                        ?>
                                        <tr>
                                            <td><strong><?php echo $i + 1; ?></strong></td>
                                            <td><?php echo $fetch_data[$i]['student_name']; ?></td>
                                            <td><?php echo $fetch_data[$i]['batch_name']; ?></td>
                                            <td><?php $date = $fetch_data[$i]['start_date'];
                                                echo $formatted_date = date("d F, Y", strtotime($date)); ?></td>
                                            <td><?php echo $fetch_data[$i]['course_fee']; ?></td>
                                            <?php
                                            $batch_id = $fetch_data[$i]['batch_id'];
                                            $amount = $db_handle->runQuery("select SUM(paid_amount) as am from receive_money where student_unique_id = '$student_id' and batch_id = '$batch_id'");
                                            ?>
                                            <td><?php
                                                if ($amount[0]['am'] != null) {
                                                    echo $amount[0]['am'];
                                                } else {
                                                    echo '00';
                                                }
                                                ?></td>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Receive Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="Insert" method="post">
                                    <?php
                                    $fetch_data = $db_handle->runQuery("select * from student where unique_id  = '$student_id'");
                                    ?>
                                    <div class="row">
                                        <input type="hidden" class="form-control"
                                               value="<?php echo $fetch_data[0]['student_id']; ?>" name="student_id">
                                        <div class="col-sm-6">
                                            <lable>Student ID</lable>
                                            <input type="text" class="form-control"
                                                   value="<?php echo $fetch_data[0]['unique_id']; ?>" name="unique_id"
                                                   readonly>
                                        </div>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <lable>Student Name</lable>
                                            <input type="text" class="form-control"
                                                   value="<?php echo $fetch_data[0]['student_name']; ?>" readonly>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0">
                                            <lable>Select Batch</lable>
                                            <select class="form-control default-select" name="batch_id" required>
                                                <?php
                                                $fetch_batch = $db_handle->runQuery("select * from admission, batch where admission.batch_id = batch.batch_id and admission.unique_id = '$student_id'");
                                                for ($j = 0; $j < count($fetch_batch); $j++) {
                                                    ?>
                                                    <option value="<?php echo $fetch_batch[$j]['batch_id']; ?>"><?php echo $fetch_batch[$j]['batch_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0">
                                            <lable>Enter Amount</lable>
                                            <input type="number" class="form-control" placeholder="Enter Amount"
                                                   name="amount" required>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0">
                                            <lable>Note</lable>
                                            <input type="text" class="form-control" placeholder="Enter Note" name="note"
                                                   required>
                                        </div>
                                        <div class="col-sm-6 mt-sm-0">
                                            <lable>Payment Method</lable>
                                            <select class="form-control default-select" name="payment_method" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Bkash">Bkash</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" name="receive_money" class="btn btn-primary mt-3">Receive
                                        Money
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Payment History</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th class="width80"><strong>#</strong></th>
                                        <th><strong>Note</strong></th>
                                        <th><strong>Date</strong></th>
                                        <th><strong>Amount</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetch_data = $db_handle->runQuery("select * from receive_money where student_unique_id = '$student_id'");
                                    $fetch_data_no = $db_handle->numRows("select * from receive_money where student_unique_id = '$student_id'");
                                    for ($k = 0; $k < $fetch_data_no; $k++) {
                                        if($fetch_data_no > 0){
                                            ?>
                                            <tr>
                                                <td><strong><?php echo $k + 1; ?></strong></td>
                                                <td><?php echo $fetch_data[$k]['purpose']; ?></td>
                                                <td><?php echo $fetch_data[$k]['date']; ?></td>
                                                <td><?php echo $fetch_data[$k]['paid_amount']; ?></td>
                                            </tr>
                                            <?php
                                        } else {
                                            echo 'No data found';
                                        }
                                        ?>
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