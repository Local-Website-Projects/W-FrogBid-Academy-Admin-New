<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();

if (isset($_GET['batch_id']) && !empty($_GET['batch_id'])) {
    $batch_id = $_GET['batch_id'];

    // Fetch course details from the database based on the batch_id
    $query1 = $db_handle->runQuery("SELECT course_id FROM batch WHERE batch_id = '$batch_id'");
    if ($query1) {
        $course_id = $query1[0]['course_id'];
        $query = $db_handle->runQuery("SELECT * FROM course WHERE course_id = '$course_id'");
        $no_query = $db_handle->numRows("SELECT * FROM course WHERE course_id = '$course_id'");

        // Check if there are any results
        if ($no_query > 0) {
            // Fetch the course details
            $course_details = $query;

            // Output the course details as JSON
            echo json_encode($course_details);
        } else {
            // No course details found for the given batch_id
            echo json_encode(array('error' => 'No course details found for the given batch.'));
        }
    } else {
        // Error retrieving course_id for the given batch_id
        echo json_encode(array('error' => 'Error retrieving course details.'));
    }
} else {
    // batch_id is not set or empty
    echo json_encode(array('error' => 'No batch ID provided.'));
}