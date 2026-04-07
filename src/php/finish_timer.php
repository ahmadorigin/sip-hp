<?php
require 'functions.php'; // Pastikan koneksi DB ada di sini

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $startTime = date('Y-m-d H:i:s');

    $result = s_query("PATCH", "/rest/v1/tb_peminjaman?id=eq.$id", [
        "status" => "completed" 
    ]);
    
} else {
    echo json_encode([
        "success" => false,
        "message" => "Request tidak valid."
    ]);
}
    exit;