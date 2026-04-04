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
                <?php 
                    $borderColor = $row["status"] === "approved" ? 'border-emerald-500' : 'border-amber-500';
                    $statusText = $row["status"] === "approved" ? 'Disetujui' : 'Menunggu';
                    $statusColor = $row["status"] === "approved" ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : 'bg-amber-500/20 text-amber-400 border-amber-500/30';
            ?>
                <div class="mt-5 transition-all duration-500 animate-fade-in">
                    <div
                        class="<?= $borderColor ?> bg-gray-900 border-l-4 border-indigo-500 rounded-xl shadow-lg overflow-hidden">

                        <div class="p-5">
                            <!-- Header Card dengan Avatar -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-100 font-semibold text-lg">
                                            <?= htmlspecialchars($row["peminjam"]) ?></h3>
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium <?= $statusColor ?> border mt-1">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full <?= $row["status"] === "approved" ? 'bg-emerald-400' : 'bg-amber-400' ?>"></span>
                                            <?= $statusText ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Tombol Hapus (Icon) -->
                                <a href="../../src/php/hapus.php?id=<?= $row["id"]; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="text-gray-500 hover:text-red-400 transition p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </a>
                            </div>

                            <!-- Box Inner untuk Detail Peminjaman -->
                            <div class="bg-gray-800/50 rounded-lg p-4 mb-4 border border-gray-700/50">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-gray-500 mt-0.5 shrink-0 transition-colors duration-300 group-hover:text-indigo-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <p
                                                    class="text-xs text-gray-500 transition-colors duration-300 group-hover:text-gray-400">
                                                    Durasi</p>
                                                <p class="text-sm text-gray-300"><?= htmlspecialchars($row["durasi"]) ?>
                                                    menit
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-4 h-4 text-gray-500 mt-0.5 shrink-0 transition-colors duration-300 group-hover:text-indigo-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            <div>
                                                <p
                                                    class="text-xs text-gray-500 transition-colors duration-300 group-hover:text-gray-400">
                                                    Alasan</p>
                                                <p class="text-sm text-gray-300"><?= htmlspecialchars($row["alasan"]) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status & Aksi Area -->
                            <div class="flex flex-col items-start md:items-end justify-between">
                                <?php if(!$row["status"] === "approved") : ?>
                                <a href="../../src/php/approve.php?id=<?= $row["id"]; ?>" class="w-full md:w-auto">
                                    <button
                                        class="cursor-pointer flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md transition-all active:scale-95 w-full md:w-auto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Setujui
                                    </button>
                                </a>
                                <?php else : ?>
                                <span
                                    class="flex items-center justify-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold py-2 px-4 rounded-lg border border-emerald-500/30 w-full md:w-auto">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Selesai Disetujui
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <!-- Empty State -->
                <div class="bg-gray-900 border border-gray-800 rounded-xl p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-base">Belum ada data peminjam</p>
                    <p class="text-gray-600 text-sm mt-2">Silakan tunggu peminjaman baru</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php include("../../src/include/footer.php"); ?>

        <script src="../../src/js/navbar.js"></script>
    </body>

    </html>