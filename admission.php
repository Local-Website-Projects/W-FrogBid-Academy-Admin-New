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
    <title>Admission - FrogBid Academy</title>
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
                <h2 class="text-black font-w600 mb-0">Admission</h2>
            </div>
            <!--main body content-->
            <div class="card-body">
                <div class="basic-form">
                    <form method="post" action="Insert">
                        <h3 class="mb-3">Student's Data</h3>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Student Name *</label>
                                <input type="text" class="form-control" placeholder="Student Name" name="student_name"
                                       autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Class *</label>
                                <input type="text" class="form-control" placeholder="Class" name="class" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date of Birth *</label>
                                <input type="date" class="form-control" name="dob" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Age *</label>
                                <input type="text" class="form-control" placeholder="Age" name="age" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Birth Place</label>
                                <input type="text" class="form-control" placeholder="Birth Place" autocomplete="off" name="birth_place">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gender *</label>
                                <select class="form-control default-select form-control-lg" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Birth Certificate No / NID *</label>
                                <input type="text" class="form-control" placeholder="Birth Certificate No / NID"
                                       name="nid" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Present Address *</label>
                                <input type="text" class="form-control" placeholder="Present Address"
                                       name="present_address" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Permanent Address *</label>
                                <input type="text" class="form-control" placeholder="Permanent Address"
                                       name="permanent_address" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Blood Group *</label>
                                <select class="form-control default-select form-control-lg" name="blood_group" required>
                                    <option value="A+">A+</option>
                                    <option value="B+">B+</option>
                                    <option value="O+">O+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="A-">A-</option>
                                    <option value="B-">B-</option>
                                    <option value="O-">O-</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Interest / Hobby</label>
                                <input type="text" class="form-control" placeholder="Interest / Hobby" name="hobby" autocomplete="off">
                            </div>
                        </div>
                        <h3 class="mt-5 mb-3">Parent's Data</h3>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Father's Name *</label>
                                <input type="text" class="form-control" placeholder="Father's Name" name="father_name" autocomplete="off"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mother's Name *</label>
                                <input type="text" class="form-control" placeholder="Mother's Name" name="mother_name" autocomplete="off"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Father's Contact No *</label>
                                <input type="text" class="form-control" placeholder="Father's Contact No"
                                       name="father_contact_no" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mother's Contact No *</label>
                                <input type="text" class="form-control" placeholder="Mother's Contact No"
                                       name="mother_contact_no" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Father's Occupation *</label>
                                <input type="text" class="form-control" placeholder="Father's Occupation"
                                       name="father_occupation" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mother's Occupation *</label>
                                <input type="text" class="form-control" placeholder="Mother's Occupation"
                                       name="mother_occupation" autocomplete="off" required>
                            </div>
                        </div>
                        <h3 class="mt-5 mb-3">Emergency Contact Person</h3>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Emergency Contact Person Name *</label>
                                <input type="text" class="form-control" placeholder="Emergency Contact Person Name"
                                       name="emergency_name" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Relation With Student *</label>
                                <input type="text" class="form-control" placeholder="Relation With Student"
                                       name="emergency_relation" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contact No *</label>
                                <input type="text" class="form-control" placeholder="Contact No"
                                       name="emergency_contact_no" autocomplete="off" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Address *</label>
                                <input type="text" class="form-control" placeholder="Address"
                                       name="emergency_address" autocomplete="off" required>
                            </div>
                        </div>
                        <button type="submit" name="register_student" class="btn btn-primary">Register Student</button>
                    </form>
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