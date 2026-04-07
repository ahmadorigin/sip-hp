    <?php
    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"]) || $_SESSION["username"] !== 'admin') {
        header("Location: ../../index.php");
        exit;
    }

    if (isset($_POST["submit"])) {
        
        if (postAlasan($_POST)) {
            header("Location: panel-admin.php");
        } else {
            $error = true;
        }
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
        <link href="../../src/css/styles.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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

        <div id="passwordOverlay"
            class="hidden flex fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 animate-fade-in">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
                <div class="flex items-center justify-between w-full mb-4">
                    <h3 class="text-xl text-white font-semibold">Alasan penolakan</h3>
                    <h2 id="displayUserName"
                        class="text-sm text-white font-semibold bg-indigo-600 hover:bg-indigo-500 px-3 py-2 rounded-xl">
                    </h2>
                    <button onclick="closeModal()"
                        class="text-2xl leading-none text-gray-500 hover:text-black transition-colors">
                        &times;
                    </button>
                </div>

                <form method="post" class="passwordForm flex flex-col gap-4">
                    <input type="hidden" name="id" id="modalInputId">
                    <input type="hidden" name="username" id="modalInputUsername">

                    <input type="text" name="alasan"
                        class="border text-white border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required>
                    <button type="submit" name="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>
        </div>

        <?php include("../../src/include/footer.php"); ?>

        <script src="../../src/js/pesan_admin.js"></script>
        <script src="../../src/js/navbar.js"></script>
    </body>

    </html>