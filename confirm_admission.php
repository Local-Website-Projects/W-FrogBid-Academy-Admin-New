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
    $id = $_GET['id'];
    $fetch_details = $db_handle->runQuery("select * from student where unique_id='$id'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assign Batch - FrogBid Academy</title>
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
                <h2 class="text-black font-w600 mb-0">Assign Batch</h2>
            </div>
            <!--main body content-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Assign Batch</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="Insert" method="post">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <lable>Student ID</lable>
                                            <input type="text" class="form-control input-default" name="unique_id" value="<?php echo $fetch_details[0]['unique_id'];?>"  readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <lable>Student Name</lable>
                                            <input type="text" class="form-control input-default" value="<?php echo $fetch_details[0]['student_name'];?>"  readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Batch *</label>
                                            <select class="form-control default-select form-control-lg" name="batch_id" id="batchSelect" required>
                                                <option>Select Batch</option>
                                                <?php
                                                $fetch_batch = $db_handle->runQuery("select * from batch where status != '2'");
                                                for ($i=0; $i < count($fetch_batch); $i++) {
                                                    ?>
                                                    <option value="<?php echo $fetch_batch[$i]['batch_id'];?>"><?php echo $fetch_batch[$i]['batch_name'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Course Name</label>
                                            <input type="text" class="form-control input-default" id="courseName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Course Duration</label>
                                            <input type="text" class="form-control input-default" id="courseDuration">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Course Fee</label>
                                            <input type="text" class="form-control input-default" id="courseFee">
                                        </div>
                                        <button type="submit" name="confirm_admission" class="btn btn-primary">Confirm Admission</button>
                                    </div>
                                </form>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('batchSelect').addEventListener('change', function() {
            var batchId = this.value;
            // AJAX call to fetch course details
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        var courseDetails = JSON.parse(xhr.responseText);
                        console.log(courseDetails); // Log the courseDetails object

                        // Set values of input fields
                        document.getElementById('courseName').value = courseDetails[0].course_name;
                        document.getElementById('courseDuration').value = courseDetails[0].duration;
                        document.getElementById('courseFee').value = courseDetails[0].course_fee;
                    } else {
                        console.log('Error: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'fetch_course_details.php?batch_id=' + batchId, true);
            xhr.send();
        });
    });
</script>
</body>

</html>