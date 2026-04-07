<?php

    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php");
    }

    $peminjam = s_query("GET", "/rest/v1/tb_peminjaman?select=*");
    $page_title = "dashboard-admin";

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Sistem Peminjaman HP | SIP-HP</title>
    <link rel="stylesheet" href="../../src/css/output.css">
    <link href="../../src/css/styles.css" rel="stylesheet">
</head>

<body class="bg-gray-950 ">

    <?php include("../../src/include/header.php"); ?>

    <!-- main container -->
    <div id="card-data" class="max-w-2xl w-full mx-auto">

        <!-- header / brand section - dark mode version -->
        <div class="text-center mb-8 md:mb-10"></div>

        <!-- Daftar Peminjaman -->
        <?php if(!empty($peminjam)): ?>
        <?php foreach($peminjam as $row) : ?>

        <?php include("../../src/include/card-peminjaman.php"); ?>
        <?php endforeach; ?>
        <?php else : ?>
        <?php include("../../src/include/empty-state.php"); ?>

        <?php endif; ?>
    </div>

    <?php include("../../src/include/footer.php"); ?>

    <script src="../../src/js/navbar.js"></script>
    <script src="../../src/js/script.js"></script>
</body>

</html>