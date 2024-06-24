<?php
session_start();
if (!isset($_SESSION['user'])) {
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
    <style>
        table, th, tr, td {
            border: 1px solid #eee;
            align-items: center;
            justify-content: center;
            padding: 20px;
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
                                            if ($daily_income[0]['d_income'] != null) {
                                                echo $daily_income[0]['d_income'] . ' BDT';
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
                                            if ($monthly_income[0]['m_income'] != null) {
                                                echo $monthly_income[0]['m_income'] . ' BDT';
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
                                            if ($daily_expense[0]['d_expense'] != null) {
                                                echo $daily_expense[0]['d_expense'] . ' BDT';
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
                                            if ($monthly_expense[0]['m_expense'] != null) {
                                                echo $monthly_expense[0]['m_expense'] . ' BDT';
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
                                        <div class="col-xl-6 col-lg-6 col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Number of Students Per Batch</h4>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="barChart_3"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <table style="width: 100%;">
                                        <thead>
                                        <th>Time/Day</th>
                                        <th>Sat</th>
                                        <th>Sun</th>
                                        <th>Mon</th>
                                        <th>Tues</th>
                                        <th>Wed</th>
                                        <th>Thus</th>
                                        <th>Fri</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>09:00AM - 10:30AM</td>
                                            <?php
                                            $query_one = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '09:00:00') OR (day_two = 'Saturday' AND time_two = '09:00:00')");
                                            $query_one_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '09:00:00') OR (day_two = 'Saturday' AND time_two = '09:00:00')");
                                            ?>
                                            <td><?php
                                                if ($query_one_no > 0)
                                                {
                                                    for ($i=0;$i<$query_one_no;$i++){
                                                        echo $query_one[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <?php
                                            $query_three = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '09:00:00') OR (day_two = 'Sunday' AND time_two = '09:00:00')");
                                            $query_three_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '09:00:00') OR (day_two = 'Sunday' AND time_two = '09:00:00')");
                                            ?>
                                            <td><?php
                                                if ($query_three_no > 0)
                                                {
                                                    for ($i=0;$i<$query_three_no;$i++){
                                                        echo $query_three[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td>
                                                <?php
                                                $query_two = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '09:00:00') OR (day_two = 'Monday' AND time_two = '09:00:00')");
                                                $query_two_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '09:00:00') OR (day_two = 'Monday' AND time_two = '09:00:00')");
                                                if ($query_two_no > 0)
                                                {
                                                    for ($i=0;$i<$query_two_no;$i++){
                                                        echo $query_two[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $query_four = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '09:00:00') OR (day_two = 'Tuesday' AND time_two = '09:00:00')");
                                                $query_four_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '09:00:00') OR (day_two = 'Tuesday' AND time_two = '09:00:00')");
                                                if ($query_four_no > 0)
                                                {
                                                    for ($i=0;$i<$query_four_no;$i++){
                                                        echo $query_four[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $query_five = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '09:00:00') OR (day_two = 'Wednesday' AND time_two = '09:00:00')");
                                                $query_five_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '09:00:00') OR (day_two = 'Wednesday' AND time_two = '09:00:00')");
                                                if ($query_five_no > 0)
                                                {
                                                    for ($i=0;$i<$query_five_no;$i++){
                                                        echo $query_five[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td><?php
                                                $query_six = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Thrusday' AND time_one = '09:00:00') OR (day_two = 'Thrusday' AND time_two = '09:00:00')");
                                                $query_six_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Thrusday' AND time_one = '09:00:00') OR (day_two = 'Thrusday' AND time_two = '09:00:00')");
                                                if ($query_six_no > 0)
                                                {
                                                    for ($i=0;$i<$query_six_no;$i++){
                                                        echo $query_six[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_seven = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '09:00:00') OR (day_two = 'Friday' AND time_two = '09:00:00')");
                                                $query_seven_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '09:00:00') OR (day_two = 'Friday' AND time_two = '09:00:00')");
                                                if ($query_seven_no > 0)
                                                {
                                                    for ($i=0;$i<$query_seven_no;$i++){
                                                        echo $query_seven[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>10:30AM - 12.00AM</td>
                                            <td><?php
                                                $query_eight = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '10:30:00') OR (day_two = 'Saturday' AND time_two = '10:30:00')");
                                                $query_eight_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '10:30:00') OR (day_two = 'Saturday' AND time_two = '10:30:00')");
                                                if ($query_eight_no > 0)
                                                {
                                                    for ($i=0;$i<$query_eight_no;$i++){
                                                        echo $query_eight[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_nine = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '10:30:00') OR (day_two = 'Sunday' AND time_two = '10:30:00')");
                                                $query_nine_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '10:30:00') OR (day_two = 'Sunday' AND time_two = '10:30:00')");
                                                if ($query_nine_no > 0)
                                                {
                                                    for ($i=0;$i<$query_nine_no;$i++){
                                                        echo $query_nine[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td>
                                                <?php
                                                $query_ten = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '10:30:00') OR (day_two = 'Monday' AND time_two = '10:30:00')");
                                                $query_ten_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '10:30:00') OR (day_two = 'Monday' AND time_two = '10:30:00')");
                                                if ($query_ten_no > 0)
                                                {
                                                    for ($i=0;$i<$query_ten_no;$i++){
                                                        echo $query_ten[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td><?php
                                                $query_eleven = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '10:30:00') OR (day_two = 'Tuesday' AND time_two = '10:30:00')");
                                                $query_eleven_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '10:30:00') OR (day_two = 'Tuesday' AND time_two = '10:30:00')");
                                                if ($query_eleven_no > 0)
                                                {
                                                    for ($i=0;$i<$query_eleven_no;$i++){
                                                        echo $query_eleven[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_twelve = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '10:30:00') OR (day_two = 'Wednesday' AND time_two = '10:30:00')");
                                                $query_twelve_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '10:30:00') OR (day_two = 'Wednesday' AND time_two = '10:30:00')");
                                                if ($query_twelve_no > 0)
                                                {
                                                    for ($i=0;$i<$query_twelve_no;$i++){
                                                        echo $query_twelve[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_thirteen = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '10:30:00') OR (day_two = 'Thusday' AND time_two = '10:30:00')");
                                                $query_thirteen_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '10:30:00') OR (day_two = 'Thusday' AND time_two = '10:30:00')");
                                                if ($query_thirteen_no > 0)
                                                    {
                                                        for ($i=0;$i<$query_thirteen_no;$i++){
                                                            echo $query_thirteen[$i]['batch_name']."</br>";
                                                        }
                                                    }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_14 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '10:30:00') OR (day_two = 'Friday' AND time_two = '10:30:00')");
                                                $query_14_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '10:30:00') OR (day_two = 'Friday' AND time_two = '10:30:00')");
                                                if ($query_14_no > 0)
                                                {
                                                    for ($i=0;$i<$query_14_no;$i++){
                                                        echo $query_14[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>12.00PM - 01.30PM</td>
                                            <td><?php
                                                $query_29 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '12:00:00') OR (day_two = 'Saturday' AND time_two = '12:00:00')");
                                                $query_29_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '12:00:00') OR (day_two = 'Saturday' AND time_two = '12:00:00')");
                                                if ($query_29_no > 0)
                                                {
                                                    for ($i=0;$i<$query_29_no;$i++){
                                                        echo $query_29[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_30 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '12:00:00') OR (day_two = 'Sunday' AND time_two = '12:00:00')");
                                                $query_30_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '12:00:00') OR (day_two = 'Sunday' AND time_two = '12:00:00')");
                                                if ($query_30_no > 0)
                                                {
                                                    for ($i=0;$i<$query_30_no;$i++){
                                                        echo $query_30[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_31 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '12:00:00') OR (day_two = 'Monday' AND time_two = '12:00:00')");
                                                $query_31_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '12:00:00') OR (day_two = 'Monday' AND time_two = '12:00:00')");
                                                if ($query_31_no > 0)
                                                {
                                                    for ($i=0;$i<$query_31_no;$i++){
                                                        echo $query_31[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_32 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '12:00:00') OR (day_two = 'Tuesday' AND time_two = '12:00:00')");
                                                $query_32_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '12:00:00') OR (day_two = 'Tuesday' AND time_two = '12:00:00')");
                                                if ($query_32_no > 0)
                                                {
                                                    for ($i=0;$i<$query_32_no;$i++){
                                                        echo $query_32[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td>
                                                <?php
                                                $query_33 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '12:00:00') OR (day_two = 'Wednesday' AND time_two = '12:00:00')");
                                                $query_33_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '12:00:00') OR (day_two = 'Wednesday' AND time_two = '12:00:00')");
                                                if ($query_33_no > 0)
                                                {
                                                    for ($i=0;$i<$query_33_no;$i++){
                                                        echo $query_33[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td><?php
                                                $query_34 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '12:00:00') OR (day_two = 'Thusday' AND time_two = '12:00:00')");
                                                $query_34_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '12:00:00') OR (day_two = 'Thusday' AND time_two = '12:00:00')");
                                                if ($query_34_no > 0)
                                                {
                                                    for ($i=0;$i<$query_34_no;$i++){
                                                        echo $query_34[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_35 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '12:00:00') OR (day_two = 'Friday' AND time_two = '12:00:00')");
                                                $query_35_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '12:00:00') OR (day_two = 'Friday' AND time_two = '12:00:00')");
                                                if ($query_35_no > 0)
                                                {
                                                    for ($i=0;$i<$query_35_no;$i++){
                                                        echo $query_35[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>03:00PM - 04.30PM</td>
                                            <td><?php
                                                $query_15 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '15:00:00') OR (day_two = 'Saturday' AND time_two = '15:00:00')");
                                                $query_15_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '15:00:00') OR (day_two = 'Saturday' AND time_two = '15:00:00')");
                                                if ($query_15_no > 0)
                                                {
                                                    for ($i=0;$i<$query_15_no;$i++){
                                                        echo $query_15[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_16 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '15:00:00') OR (day_two = 'Sunday' AND time_two = '15:00:00')");
                                                $query_16_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '15:00:00') OR (day_two = 'Sunday' AND time_two = '15:00:00')");
                                                if ($query_16_no > 0)
                                                {
                                                    for ($i=0;$i<$query_16_no;$i++){
                                                        echo $query_16[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td>
                                                <?php
                                                $query_17 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '15:00:00') OR (day_two = 'Monday' AND time_two = '15:00:00')");
                                                $query_17_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '15:00:00') OR (day_two = 'Monday' AND time_two = '15:00:00')");
                                                if ($query_17_no > 0)
                                                {
                                                    for ($i=0;$i<$query_17_no;$i++){
                                                        echo $query_17[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?>
                                            </td>
                                            <td><?php
                                                $query_18 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '15:00:00') OR (day_two = 'Tuesday' AND time_two = '15:00:00')");
                                                $query_18_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '15:00:00') OR (day_two = 'Tuesday' AND time_two = '15:00:00')");
                                                if ($query_18_no > 0)
                                                {
                                                    for ($i=0;$i<$query_18_no;$i++){
                                                        echo $query_18[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_19 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '15:00:00') OR (day_two = 'Wednesday' AND time_two = '15:00:00')");
                                                $query_19_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '15:00:00') OR (day_two = 'Wednesday' AND time_two = '15:00:00')");
                                                if ($query_19_no > 0)
                                                {
                                                    for ($i=0;$i<$query_19_no;$i++){
                                                        echo $query_19[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_20 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '15:00:00') OR (day_two = 'Thusday' AND time_two = '15:00:00')");
                                                $query_20_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Thusday' AND time_one = '15:00:00') OR (day_two = 'Thusday' AND time_two = '15:00:00')");
                                                if ($query_20_no > 0)
                                                {
                                                    for ($i=0;$i<$query_20_no;$i++){
                                                        echo $query_20[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_21 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '15:00:00') OR (day_two = 'Friday' AND time_two = '15:00:00')");
                                                $query_21_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '15:00:00') OR (day_two = 'Friday' AND time_two = '15:00:00')");
                                                if ($query_21_no > 0)
                                                {
                                                    for ($i=0;$i<$query_21_no;$i++){
                                                        echo $query_21[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>05.00PM - 06.30PM</td>
                                            <td><?php
                                                $query_22 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '17:00:00') OR (day_two = 'Saturday' AND time_two = '17:00:00')");
                                                $query_22_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Saturday' AND time_one = '17:00:00') OR (day_two = 'Saturday' AND time_two = '17:00:00')");
                                                if ($query_22_no > 0)
                                                {
                                                    for ($i=0;$i<$query_22_no;$i++){
                                                        echo $query_22[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_23 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '17:00:00') OR (day_two = 'Sunday' AND time_two = '17:00:00')");
                                                $query_23_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Sunday' AND time_one = '17:00:00') OR (day_two = 'Sunday' AND time_two = '17:00:00')");
                                                if ($query_23_no > 0)
                                                {
                                                    for ($i=0;$i<$query_23_no;$i++){
                                                        echo $query_23[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_24 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '17:00:00') OR (day_two = 'Monday' AND time_two = '17:00:00')");
                                                $query_24_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Monday' AND time_one = '17:00:00') OR (day_two = 'Monday' AND time_two = '17:00:00')");
                                                if ($query_24_no > 0)
                                                {
                                                    for ($i=0;$i<$query_24_no;$i++){
                                                        echo $query_24[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_25 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '17:00:00') OR (day_two = 'Tuesday' AND time_two = '17:00:00')");
                                                $query_25_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Tuesday' AND time_one = '17:00:00') OR (day_two = 'Tuesday' AND time_two = '17:00:00')");
                                                if ($query_25_no > 0)
                                                {
                                                    for ($i=0;$i<$query_25_no;$i++){
                                                        echo $query_25[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_26 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '17:00:00') OR (day_two = 'Wednesday' AND time_two = '17:00:00')");
                                                $query_26_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Wednesday' AND time_one = '17:00:00') OR (day_two = 'Wednesday' AND time_two = '17:00:00')");
                                                if ($query_26_no > 0)
                                                {
                                                    for ($i=0;$i<$query_26_no;$i++){
                                                        echo $query_26[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_27 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Thrusday' AND time_one = '17:00:00') OR (day_two = 'Thrusday' AND time_two = '17:00:00')");
                                                $query_27_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Thrusday' AND time_one = '17:00:00') OR (day_two = 'Thrusday' AND time_two = '17:00:00')");
                                                if ($query_27_no > 0)
                                                {
                                                    for ($i=0;$i<$query_27_no;$i++){
                                                        echo $query_27[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                            <td><?php
                                                $query_28 = $db_handle->runQuery("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '17:00:00') OR (day_two = 'Friday' AND time_two = '17:00:00')");
                                                $query_28_no = $db_handle->numRows("SELECT * FROM batch WHERE (day_one = 'Friday' AND time_one = '17:00:00') OR (day_two = 'Friday' AND time_two = '17:00:00')");
                                                if ($query_28_no > 0)
                                                {
                                                    for ($i=0;$i<$query_28_no;$i++){
                                                        echo $query_28[$i]['batch_name']."</br>";
                                                    }
                                                }
                                                else echo "N/A";
                                                ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
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