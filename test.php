<?php
session_start();
if(!isset($_SESSION['user'])){
    echo "
    <script>window.location.href = 'Login';</script>
    ";
}
require_once('config/dbConfig.php');
$db_handle = new DBController();

$query = $db_handle->runQuery("SELECT batch_id FROM `batch`");
if($query){
    for ($a=0; $a<count($query); $a++){
        $student = $db_handle->numRows("select * from admission where batch_id = '".$query[$a]['batch_id']."'");
        echo $student;
    }
}
