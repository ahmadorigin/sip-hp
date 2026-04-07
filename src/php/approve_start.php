<?php
require 'functions.php'; // Pastikan koneksi DB ada di sini

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    date_default_timezone_set('UTC');
    
    $id = $_POST['id'];
    $startTime = date('Y-m-d H:i:s');

    // Update start_time di tabel tb_peminjaman
    // Karena kamu pakai Supabase/Rest API, sesuaikan query-nya
    $result = s_query("PATCH", "/rest/v1/tb_peminjaman?id=eq.$id", [
        "start_time" => $startTime,
        "status" => "active" // Opsional: ubah status agar admin tahu HP sedang dipakai
    ]);

    // Ambil durasi dari DB untuk dikirim balik ke JS
    $data = s_query("GET", "/rest/v1/tb_peminjaman?id=eq.$id");
    $durasi_menit = $data[0]["durasi"];
    
    echo json_encode([
        "success" => true,
        "sisa_detik" => $durasi_menit * 60 // Contoh: 20 menit dalam detik
    ]);
}