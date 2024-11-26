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
    <title>Batch - FrogBid Academy</title>
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
                <h2 class="text-black font-w600 mb-0">Batch</h2>
            </div>
            <!--main body content-->
            <div class="bootstrap-modal">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_course">Add
                    Batch
                </button>
                <!-- Modal -->
                <div class="modal fade" id="add_course">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Batch</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="Insert" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="batch_name"
                                               placeholder="Batch Name" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control default-select form-control-lg" name="course"
                                                required>
                                            <option value="" selected>Select Option</option>
                                            <?php
                                            $fetch_course = $db_handle->runQuery("SELECT * FROM course order by course_id desc");
                                            for($i = 0; $i < count($fetch_course); $i++){
                                                ?>
                                                <option value="<?php echo $fetch_course[$i]['course_id'];?>"><?php echo $fetch_course[$i]['course_name'];?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="day_one"
                                               placeholder="Day" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="time" class="form-control input-rounded" name="time_one"
                                               placeholder="Time" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="day_two"
                                               placeholder="Day">
                                    </div>
                                    <div class="form-group">
                                        <input type="time" class="form-control input-rounded" name="time_two"
                                               placeholder="Time">
                                    </div>
                                    <div class="form-group">
                                        <input type="date" class="form-control input-rounded" name="start_date"
                                               placeholder="Start Date" required>
                                    </div>
                                    <button type="submit" name="batch_add" class="btn btn-primary">Save changes
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Batch List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Batch Name</th>
                                        <th>Course</th>
                                        <th>Class Day</th>
                                        <th>Start Date</th>
                                        <th>Running Student</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetch_batch = $db_handle->runQuery("select * from batch,course where batch.course_id = course.course_id order by batch_id desc");
                                    for ($i = 0; $i < count($fetch_batch); $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch_batch[$i]['batch_name']; ?></td>
                                            <td><?php echo $fetch_batch[$i]['course_name']; ?></td>
                                            <?php
                                            if ($fetch_batch[$i]['day_two'] != NULL) {
                                                ?>
                                                <td><?php echo date("l g:i A", strtotime($fetch_batch[$i]['day_one'].' '.$fetch_batch[$i]['time_one'])).', '.
                                                        date("l g:i A", strtotime($fetch_batch[$i]['day_two'].' '.$fetch_batch[$i]['time_two']));?></td>
                                                <?php
                                            } else {
                                                ?>
                                                <td><?php echo date("l g:i A", strtotime($fetch_batch[$i]['day_one'].' '.$fetch_batch[$i]['time_one']));?></td>
                                                <?php
                                            }
                                            ?>
                                            <td><?php echo date("d F, y", strtotime($fetch_batch[$i]['start_date'])); ?></td>
                                            <td><?php
                                                $student = $db_handle->numRows("select student_id from admission where batch_id = '".$fetch_batch[$i]['batch_id']."'");
                                                echo $student;
                                                ?></td>
                                            <td><?php if($fetch_batch[$i]['status'] == 0) {?>
                                                    <div class="bootstrap-badge">
                                                        <span class="badge badge-warning">Not Started</span>
                                                    </div>
                                                <?php } elseif ($fetch_batch[$i]['status'] == 1) {?>
                                                    <span class="badge badge-success">Running</span>
                                                    <?php } else {?>
                                                    <span class="badge badge-danger">Finished</span>
                                                    <?php
                                            } ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                                class="fa fa-pencil"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
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