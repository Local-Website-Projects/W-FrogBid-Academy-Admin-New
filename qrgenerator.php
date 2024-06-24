<?php
require_once('config/dbConfig.php');
$db_handle = new DBController();
require 'vendor/qr/qrlib.php'; // Adjust the path to where you have the PHP QR Code library

// Function to generate unique 5-digit codes
function generateUniqueCodes($quantity) {
    $codes = [];
    while (count($codes) < $quantity) {
        $code = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $codes[$code] = true; // Using associative array to ensure uniqueness
    }
    return array_keys($codes);
}

// Create directory to save QR codes if it doesn't exist
$dir = 'qrcodes';
if (!file_exists($dir)) {
    mkdir($dir, 0755, true);
}

// Generate 50 unique 5-digit codes
$codes = generateUniqueCodes(50);

// Generate QR codes and save them as images
foreach ($codes as $code) {
    $filePath = $dir . '/' . $code . '.png';
    $link = 'https://frogbidacademy.com/admin/ID-Verify?id='.$code;
    QRcode::png($link, $filePath, QR_ECLEVEL_L, 10);

    $insert_code_data = $db_handle->insertQuery("INSERT INTO `id_card_data`(`card_no`, `image`) VALUES ('$code','$filePath')");
    if($insert_code_data) {
        echo "Generated QR code for: $code\n";
    } else {
        echo "Something went wrong for: $code\n";
    }

}

