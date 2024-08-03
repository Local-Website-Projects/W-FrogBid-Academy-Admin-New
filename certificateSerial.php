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
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Institution Name</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">Result</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $fetch_data = $db_handle->runQuery("SELECT * FROM `contest_data` WHERE status=1 order by `result` desc, `institution` asc, `student_name` asc;");
                for ($k = 0; $k < count($fetch_data); $k++) {
                    // Determine if the current element is the 24th
                    $additional_class = ($k + 1) % 24 == 0 ? ' mb-50' : '';
                    ?>
                    <tr>
                        <th scope="row"><?php echo $k + 1; ?></th>
                        <td><?php echo strtoupper($fetch_data[$k]['unique_id']); ?></td>
                        <td><?php echo $fetch_data[$k]['student_name']; ?></td>
                        <td><?php echo $fetch_data[$k]['institution']; ?></td>
                        <td><?php echo $fetch_data[$k]['phone']; ?></td>
                        <td><?php echo $fetch_data[$k]['result']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
