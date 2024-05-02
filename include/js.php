<?php
$data = [];
$batch = [];
$student = [];
for ($i = 1; $i <= 12; $i++){
    if($i<9){
        $month = '0'.$i;
    }
    $fetch_student = $db_handle->numRows("select * from admission where MONTH(inserted_at) = '$month' and YEAR(inserted_at) = YEAR(CURDATE())");
    array_push($data, $fetch_student);
}
$json_values = json_encode($data);

$query = $db_handle->runQuery("SELECT batch_id, batch_name FROM `batch` where status != 2");
if($query){
    for ($a=0; $a<count($query); $a++){
        $stu = $db_handle->numRows("select * from admission where batch_id = '".$query[$a]['batch_id']."'");
        array_push($batch, $query[$a]['batch_name']);
        array_push($student, $stu);
    }
}
$json_batch = json_encode($batch);
$json_students = json_encode($student);
?>

<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="vendor/chart.js/Chart.bundle.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="vendor/owl-carousel/owl.carousel.js"></script>

<!-- Chart piety plugin files -->
<script src="vendor/peity/jquery.peity.min.js"></script>

<!-- Apex Chart -->
<script src="vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="js/dashboard/dashboard-1.js"></script>

<!-- Toastr -->
<script src="vendor/toastr/js/toastr.min.js"></script>

<!-- All init script -->
<script src="js/plugins-init/toastr-init.js"></script>
<!-- Datatable -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>

<script src="js/plugins-init/datatables.init.js"></script>


<script>
    function carouselReview() {
        /*  testimonial one function by = owl.carousel.js */
        /*  testimonial one function by = owl.carousel.js */
        jQuery('.testimonial-one').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            center: true,
            dots: false,
            navText: ['<i class="fa fa-caret-left"></i>', '<i class="fa fa-caret-right"></i>'],
            responsive: {
                0: {
                    items: 2
                },
                400: {
                    items: 3
                },
                700: {
                    items: 5
                },
                991: {
                    items: 6
                },

                1200: {
                    items: 4
                },
                1600: {
                    items: 5
                }
            }
        })
    }

    jQuery(window).on('load', function () {
        setTimeout(function () {
            carouselReview();
        }, 1000);
    });

    (function($) {
        var dzSparkLine = function(){
            let draw = Chart.controllers.line.__super__.draw; //draw shadow

            var screenWidth = $(window).width();

            var barChart2 = function(){
                if(jQuery('#barChart_2').length > 0 ){

                    //gradient bar chart
                    const barChart_2 = document.getElementById("barChart_2").getContext('2d');
                    //generate gradient
                    const barChart_2gradientStroke = barChart_2.createLinearGradient(0, 0, 0, 250);
                    barChart_2gradientStroke.addColorStop(0, "rgba(30, 170, 231, 1)");
                    barChart_2gradientStroke.addColorStop(1, "rgba(30, 170, 231, 0.5)");

                    barChart_2.height = 100;

                    new Chart(barChart_2, {
                        type: 'bar',
                        data: {
                            defaultFontFamily: 'Poppins',
                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sep","Oct","Nov","Dec"],
                            datasets: [
                                {
                                    label: "Admitted Students",
                                    data: <?php echo $json_values; ?>,
                                    borderColor: barChart_2gradientStroke,
                                    borderWidth: "0",
                                    backgroundColor: barChart_2gradientStroke,
                                    hoverBackgroundColor: barChart_2gradientStroke
                                }
                            ]
                        },
                        options: {
                            legend: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    // Change here
                                    barPercentage: 0.5
                                }]
                            }
                        }
                    });
                }
            }

            var barChart3 = function(){
                if(jQuery('#barChart_3').length > 0 ){

                    //gradient bar chart
                    const barChart_3 = document.getElementById("barChart_3").getContext('2d');
                    //generate gradient
                    const barChart_3gradientStroke = barChart_3.createLinearGradient(0, 0, 0, 250);
                    barChart_3gradientStroke.addColorStop(0, "rgba(30, 170, 231, 1)");
                    barChart_3gradientStroke.addColorStop(1, "rgba(30, 170, 231, 0.5)");

                    barChart_3.height = 100;

                    new Chart(barChart_3, {
                        type: 'bar',
                        data: {
                            defaultFontFamily: 'Poppins',
                            labels: <?php echo $json_batch;?>,
                            datasets: [
                                {
                                    label: "No of Students",
                                    data: <?php echo $json_students; ?>,
                                    borderColor: barChart_3gradientStroke,
                                    borderWidth: "0",
                                    backgroundColor: barChart_3gradientStroke,
                                    hoverBackgroundColor: barChart_3gradientStroke
                                }
                            ]
                        },
                        options: {
                            legend: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                xAxes: [{
                                    // Change here
                                    barPercentage: 0.5
                                }]
                            }
                        }
                    });
                }
            }




            /* Function ============ */
            return {
                init:function(){
                },


                load:function(){
                    barChart2();
                    barChart3();
                },

                resize:function(){
                    barChart2();
                    barChart3();
                }
            }

        }();

        jQuery(document).ready(function(){
        });

        jQuery(window).on('load',function(){
            dzSparkLine.load();
        });

        jQuery(window).on('resize',function(){
            dzSparkLine.resize();

        });

    })(jQuery);
</script>
