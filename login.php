<?php
session_start();
if(isset($_SESSION['user'])){
    echo "
    <script>window.location.href = 'Home';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();
if (isset($_POST['login'])) {
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);
    if (empty($email) || empty($password)) {
        echo "<script>document.cookie = 'alert = 6;';</script>";
    }else {
        $user = $db_handle->runQuery("SELECT * FROM employee WHERE email = '$email'");
        $no = $db_handle->numRows("SELECT * FROM employee WHERE email = '$email'");
        if($no == 1){
            if (password_verify($password, $user[0]['password'])) {
                $_SESSION['user'] = $user[0]['e_id'];
                echo "<script>
document.cookie = 'alert = 1;';
                window.location.href='Home';
</script>";
            } else {
                echo "<script>
document.cookie = 'alert = 5;';
</script>";
            }
        } else {
            echo "<script>
document.cookie = 'alert = 5;';
</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - FrogBid Academy</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Toastr -->
    <link rel="stylesheet" href="vendor/toastr/css/toastr.min.css">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <h1>FrogBid</h1>
                                </div>
                                <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email *</strong></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password *</strong></label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="login" class="btn bg-white text-primary btn-block">Sign Me In</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">New here? <a class="text-white" href="Register">Register Yourself as an Employee</a></p>
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
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<!-- Toastr -->
<script src="vendor/toastr/js/toastr.min.js"></script>

<!-- All init script -->
<script src="js/plugins-init/toastr-init.js"></script>

</body>

</html>