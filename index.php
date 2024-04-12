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
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header d-sm-flex d-block border-0 pb-0">
                                    <div class="pr-3 mr-auto mb-sm-0 mb-3">
                                        <h4 class="fs-20 text-black mb-1">Transaction Overview</h4>
                                        <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0)" class="btn btn-rounded btn-light mr-3"
                                           data-toggle="modal" data-target="#DownloadReport"><i
                                                    class="las la-download text-primary scale5 mr-3"></i>Download Report</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="DownloadReport">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                            odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                            risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger light"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="button" class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <div class="btn-link" data-toggle="dropdown">
                                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartBar"></div>
                                    <div class="d-flex">
                                        <div class="custom-control custom-switch toggle-switch text-right mr-4 mb-2">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch11">
                                            <label class="custom-control-label fs-14 text-black pr-2"
                                                   for="customSwitch11">Number</label>
                                        </div>
                                        <div class="custom-control custom-switch toggle-switch text-right mr-4 mb-2">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch12">
                                            <label class="custom-control-label fs-14 text-black pr-2"
                                                   for="customSwitch12">Analytics</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Income</p>
                                        <span class="fs-24 text-black font-w600">$65,123</span>
                                    </div>
                                    <span class="fs-12 mb-2">
										<svg width="21" height="15" viewBox="0 0 21 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
											<path d="M0.999939 13.5C1.91791 12.4157 4.89722 9.22772 6.49994 7.5L12.4999 10.5L19.4999 1.5"
                                                  stroke="#2BC155" stroke-width="2"/>
											<path d="M6.49994 7.5C4.89722 9.22772 1.91791 12.4157 0.999939 13.5H19.4999V1.5L12.4999 10.5L6.49994 7.5Z"
                                                  fill="url(#paint0_linear)"/>
											<defs>
											<linearGradient id="paint0_linear" x1="10.2499" y1="3" x2="10.9999"
                                                            y2="13.5" gradientUnits="userSpaceOnUse">
											<stop offset="0" stop-color="#2BC155" stop-opacity="0.73"/>
											<stop offset="1" stop-color="#2BC155" stop-opacity="0"/>
											</linearGradient>
											</defs>
										</svg>
										4% (30 days)</span>
                                </div>
                                <div class="card-body p-0">
                                    <canvas id="widgetChart1" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6">
                            <div class="card">
                                <div class="card-header flex-wrap border-0 pb-0">
                                    <div class="mr-3 mb-2">
                                        <p class="fs-14 mb-1">Outome</p>
                                        <span class="fs-24 text-black font-w600">$24,551</span>
                                    </div>
                                    <span class="fs-12 mb-2">
										<svg width="21" height="15" viewBox="0 0 21 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
											<path d="M14.3514 7.5C15.9974 9.37169 19.0572 12.8253 20 14H1V1L8.18919 10.75L14.3514 7.5Z"
                                                  fill="url(#paint0_linear1)"/>
											<path d="M19.5 13.5C18.582 12.4157 15.6027 9.22772 14 7.5L8 10.5L1 1.5"
                                                  stroke="#FF2E2E" stroke-width="2" stroke-linecap="round"/>
											<defs>
											<linearGradient id="paint0_linear1" x1="10.5" y1="2.625" x2="9.64345"
                                                            y2="13.9935" gradientUnits="userSpaceOnUse">
											<stop offset="0" stop-color="#FF2E2E"/>
											<stop offset="1" stop-color="#FF2E2E" stop-opacity="0.03"/>
											</linearGradient>
											</defs>
										</svg>
										4% (30 days)</span>
                                </div>
                                <div class="card-body p-0">
                                    <canvas id="widgetChart2" height="80"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="card overflow-hidden">
                                <div class="card-header d-sm-flex d-block border-0 pb-0">
                                    <div class="mb-sm-0 mb-2">
                                        <p class="fs-14 mb-1">Weekly Wallet Usage</p>
                                        <span class="mb-0">
											<svg width="12" height="6" viewBox="0 0 12 6" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
												<path d="M11.9999 6L5.99994 -2.62268e-07L-6.10352e-05 6"
                                                      fill="#2BC155"/>
											</svg>
											<strong class="fs-24 text-black ml-2 mr-3">43%</strong>Than last week</span>
                                    </div>
                                    <span class="fs-12">
										<svg width="21" height="15" viewBox="0 0 21 15" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
											<path d="M0.999939 13.5C1.91791 12.4157 4.89722 9.22772 6.49994 7.5L12.4999 10.5L19.4999 1.5"
                                                  stroke="#2BC155" stroke-width="2"/>
											<path d="M6.49994 7.5C4.89722 9.22772 1.91791 12.4157 0.999939 13.5H19.4999V1.5L12.4999 10.5L6.49994 7.5Z"
                                                  fill="url(#paint0_linear2)"/>
											<defs>
											<linearGradient id="paint0_linear2" x1="10.2499" y1="3" x2="10.9999"
                                                            y2="13.5" gradientUnits="userSpaceOnUse">
											<stop offset="0" stop-color="#2BC155" stop-opacity="0.73"/>
											<stop offset="1" stop-color="#2BC155" stop-opacity="0"/>
											</linearGradient>
											</defs>
										</svg>
										4% (30 days)</span>
                                </div>
                                <div class="card-body p-0">
                                    <canvas id="widgetChart3" height="80"></canvas>
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