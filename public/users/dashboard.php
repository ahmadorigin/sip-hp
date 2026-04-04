<?php
    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php");
    }

    $peminjam = s_query("GET", "/rest/v1/tb_peminjaman?user_id=eq." . $_SESSION["id"]);
    $page_title = "dashboard-users";

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Sistem Peminjaman HP | SIP-HP</title>
    <link rel="stylesheet" href="../../src/css/output.css">
</head>

<body class="bg-gray-950 ">

    <?php include("../../src/include/header.php"); ?>

    <!-- main container -->
    <div id="card-data" class="max-w-2xl w-full mx-auto">
        <div class="text-center mb-8 md:mb-10"></div>
        <div class="px-4 mb-6">
            <h1 class="text-2xl font-bold text-white">Halo, <?= ucwords($_SESSION["username"]); ?>!</h1>
            <p class="text-gray-400 text-sm mt-1">
                Cek status peminjaman HP kamu di bawah ini.
            </p>
        </div>
        <hr class="border-gray-800 mx-4 mb-6">

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