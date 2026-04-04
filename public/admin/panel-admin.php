    <?php
    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"]) || $_SESSION["username"] !== 'admin') {
        header("Location: ../../index.php");
        exit;
    }

    $peminjam = s_query("GET", "/rest/v1/tb_peminjaman?select=*&order=created_at.desc");
    $page_title = "panel-admin";

?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | Peminjaman HP</title>
        <link rel="stylesheet" href="../../src/css/output.css">
    </head>

    <body class="bg-gray-950">
        <!-- Header Minimalis - Dark Mode (se-tema dengan desain sebelumnya) -->
        <?php include("../../src/include/header.php"); ?>

        <!-- Main Content dengan card data yang sudah ditheme ulang -->
        <div class="max-w-2xl w-full mx-auto">
            <div id="card-data" class="max-w-4xl w-full mx-auto">
                <!-- Header Panel -->
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6 pb-3 border-b border-gray-800">
                </div>

                <?php if(!empty($peminjam)): ?>
                <?php foreach($peminjam as $row) : ?>
                <?php include("../../src/include/card-peminjaman.php"); ?>
                <?php endforeach; ?>
                <?php else: ?>
                <!-- Empty State -->
                <?php include("../../src/include/empty-state.php"); ?>
                <?php endif; ?>
            </div>
        </div>

        <?php include("../../src/include/footer.php"); ?>

        <script src="../../src/js/navbar.js"></script>
    </body>

    </html>