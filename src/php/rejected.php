<?php
    require 'functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../../index.php");
    }

    $id = $_POST['id'];

    $data = [
        "pesan_admin" => $_POST["alasan"],
        "status" => "rejected"
    ];

    s_query("PATCH", "/rest/v1/tb_peminjaman?id=eq." . $id, $data);

    // Balikin ke halaman admin
    header("Location: ../../public/admin/panel-admin.php");
    exit;