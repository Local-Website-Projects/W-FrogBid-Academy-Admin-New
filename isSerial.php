<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ID Verify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .mb-50{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <?php
        $fetch_data = $db_handle->runQuery("SELECT * FROM `contest_data` WHERE status=1 order by `result` desc, `institution` asc, `student_name` asc;");
        for ($k = 348; $k < 349; $k++) {
            // Determine if the current element is the 24th
            $additional_class = ($k + 1) % 24 == 0 ? ' mb-50' : '';
            ?>
            <div class="col-4 mt-3<?php echo $additional_class; ?>">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo 150; ?> <span style="margin-left: 50%"><?php echo strtoupper($fetch_data[$k]['unique_id']); ?></span></h5>
                        <p class="card-text"><?php echo $fetch_data[$k]['student_name']; ?></p>
                        <p class="card-text"><?php echo $fetch_data[$k]['institution']; ?></p>
                        <p class="card-text"><?php echo $fetch_data[$k]['phone']; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
