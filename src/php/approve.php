<?php
    require 'functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }

    $id = $_GET['id'];

    $data = [
        "approved" => true,
        "status" => "Disetujui! Silakan ambil HP,"
    ];

    s_query("PATCH", "/rest/v1/tb_peminjaman?id=eq." . $id, $data);

    // Balikin ke halaman admin
    header("Location: ../../public/admin/panel-admin.php");
    exit;