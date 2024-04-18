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
    <title>Course - FrogBid Academy</title>
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
                <h2 class="text-black font-w600 mb-0">Course</h2>
            </div>
            <!--main body content-->
            <div class="bootstrap-modal">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#add_course">Add Course</button>
                <!-- Modal -->
                <div class="modal fade" id="add_course">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Course</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="Insert" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="course_name" placeholder="Course Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="duration" placeholder="Course Duration" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control input-rounded" name="age" placeholder="Age/Class Group" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control default-select form-control-lg" name="program" required>
                                            <option value="Art">Art</option>
                                            <option value="Programming">Programming</option>
                                            <option value="Graphics">Graphics</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control input-rounded" name="course_fee" placeholder="Course Fee" required>
                                    </div>
                                    <button type="submit" name="course_add" class="btn btn-primary">Save changes</button>
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
                            <h4 class="card-title">Course List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display min-w850">
                                    <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Program</th>
                                        <th>Age/Class</th>
                                        <th>Duration</th>
                                        <th>Course Fee</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $fetch_course = $db_handle->runQuery("SELECT * FROM course order by course_id desc");
                                    $fetch_course_no = $db_handle->numRows("SELECT * FROM course order by course_id desc");
                                    for ($i=0; $i<$fetch_course_no;$i++){
                                        ?>
                                        <tr>
                                            <td><?php echo $fetch_course[$i]['course_name'];?></td>
                                            <td><?php echo $fetch_course[$i]['program'];?></td>
                                            <td><?php echo $fetch_course[$i]['age'];?></td>
                                            <td><?php echo $fetch_course[$i]['duration'];?></td>
                                            <td><?php echo $fetch_course[$i]['course_fee'];?></td>
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