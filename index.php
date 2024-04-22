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
    <title>Dashboard - FrogBid Academy</title>
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
                <h2 class="text-black font-w600 mb-0">Dashboard</h2>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Daily Fees Collection</p>
                                        <?php
                                        $daily_income = $db_handle->runQuery("select SUM(paid_amount) as d_income from receive_money WHERE DATE(date) = CURDATE()");
                                        ?>
                                        <span class="fs-24 text-black font-w600"><?php
                                            if($daily_income[0]['d_income']!= null){
                                                echo $daily_income[0]['d_income'].' BDT';
                                            } else {
                                                echo "00 BDT";
                                            }
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Monthly Fees Collection</p>
                                        <?php
                                        $monthly_income = $db_handle->runQuery("SELECT SUM(paid_amount) AS m_income FROM receive_money WHERE MONTH(date) = MONTH(CURDATE())");
                                        ?>
                                        <span class="fs-24 text-black font-w600"><?php
                                            if($monthly_income[0]['m_income']!= null){
                                                echo $monthly_income[0]['m_income'].' BDT';
                                            } else {
                                                echo "00 BDT";
                                            }
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Daily Expense</p>
                                        <?php
                                        $daily_expense = $db_handle->runQuery("SELECT SUM(amount) AS d_expense FROM expense WHERE date(date) = CURDATE()");
                                        ?>
                                        <span class="fs-24 text-black font-w600"><?php
                                            if($daily_expense[0]['d_expense']!= null){
                                                echo $daily_expense[0]['d_expense'].' BDT';
                                            } else {
                                                echo "00 BDT";
                                            }
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Monthly Expense</p>
                                        <?php
                                        $monthly_expense = $db_handle->runQuery("SELECT SUM(amount) AS m_expense FROM expense WHERE MONTH(date) = MONTH(CURDATE())");
                                        ?>
                                        <span class="fs-24 text-black font-w600"><?php
                                            if($monthly_expense[0]['m_expense']!= null){
                                                echo $monthly_expense[0]['m_expense'].' BDT';
                                            } else {
                                                echo "00 BDT";
                                            }
                                            ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Number of Admitted Students</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="barChart_2"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Art & Programming Student</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="pie_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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