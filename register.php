<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Register - FrogBid Academy</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Toastr -->
    <link rel="stylesheet" href="vendor/toastr/css/toastr.min.css">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
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
                                <h4 class="text-center mb-4 text-white">Register</h4>
                                <form action="Insert" method="post">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Full Name *</strong></label>
                                        <input type="text" name="full_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Department *</strong></label>
                                        <select class="form-control default-select form-control-lg" name="department" required>
                                            <option value="Software">Software</option>
                                            <option value="Graphics">Graphics</option>
                                            <option value="Academy">Academy</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Join Date *</strong></label>
                                        <input type="date" name="join_date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>NID Card No *</strong></label>
                                        <input type="text" name="nid" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Contact No *</strong></label>
                                        <input type="text" name="phone" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email *</strong></label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password *</strong></label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="register" class="btn bg-white text-primary btn-block">Register</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">Already have an Account? <a class="text-white" href="Login">Login</a></p>
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