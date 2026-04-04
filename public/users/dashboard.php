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

        <!-- header / brand section - dark mode version -->
        <div class="text-center mb-8 md:mb-10"></div>

        <hr class="border-gray-800 mx-4 mb-6">
        <!-- Daftar Peminjaman -->
        <?php if(!empty($peminjam)): ?>
        <?php foreach($peminjam as $row) : ?>
        <?php $borderColor = $row["status"] === "approved" ? 'border-indigo-500' : 'border-amber-500'; ?>
        <div class="mt-5 transition-all duration-500 animate-fade-in">
            <div class="<?= $borderColor; ?> bg-gray-900 border-l-4 rounded-xl shadow-lg overflow-hidden relative ">

                <div class="p-5">

                    <!-- Header Card dengan Avatar dan Badge Status yang Lebih Menonjol -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-indigo-500/20 flex items-center justify-center ">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-gray-100 font-bold text-base leading-tight">
                                    Peminjaman Aktif
                                </h3>
                                <p class="text-gray-500 text-xs mt-1">
                                    <?= date('d M Y', strtotime($row["created_at"])) ?> •
                                    <?= date('H:i', strtotime($row["created_at"])) ?>
                                </p>
                            </div>
                        </div>

                        <!-- Badge Status yang Lebih Menonjol - Diposisikan di pojok kanan -->
                        <?php if($row["status"] === "approved") : ?>
                        <div class="relative">
                            <div
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-emerald-500 shadow-lg backdrop-blur-sm">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                                    <span
                                        class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                                </span>
                                <span class="text-emerald-400">✓</span>
                                <span class="text-emerald-400">DISETUJUI</span>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="relative">
                            <div
                                class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold  border border-amber-500 shadow-lg backdrop-blur-sm">
                                <span class="relative flex h-2.5 w-2.5">
                                    <span
                                        class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                                </span>
                                <span class="text-amber-400">⏳</span>
                                <span class="text-amber-400">MENUNGGU</span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Box Inner untuk Detail Peminjaman -->
                    <div class="bg-gray-800/50 rounded-lg p-4 mb-4 border border-gray-700/50 ">
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
                                        <p class="text-sm text-gray-300"><?= htmlspecialchars($row["durasi"]) ?> menit
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
                                        <p class="text-sm text-gray-300"><?= htmlspecialchars($row["alasan"]) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap gap-2 items-center justify-center">
                        <?php if($row["status"] === "approved") : ?>
                        <button data-menit="<?= $row["durasi"] ?>"
                            class="start-timer-btn cursor-pointer flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-2 px-3 rounded-lg shadow-md transition-all duration-300 active:scale-95 hover:scale-105 hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mulai Timer
                        </button>
                        <span class="display-timer text-lg font-mono font-bold text-indigo-400 hidden"></span>
                        <?php endif; ?>

                        <a href="../ubah.php?id=<?= $row["id"]; ?>">
                            <button
                                class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-3 rounded-lg shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Ubah
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <!-- Empty State - Belum Pernah Meminjam -->
        <div class="rounded-2xl backdrop-blur-xl bg-white/5 border border-white/20 p-8 md:p-12 text-center">
            <!-- Ilustrasi / Icon Animasi -->
            <div class="relative w-24 h-24 mx-auto mb-6">
                <div
                    class="absolute inset-0 bg-linear-to-r from-indigo-500/20 to-purple-500/20 rounded-full blur-xl animate-pulse">
                </div>
                <div
                    class="relative w-24 h-24 rounded-full bg-linear-to-br from-indigo-500/30 to-purple-500/30 backdrop-blur border border-white/20 flex items-center justify-center">
                    <svg class="w-12 h-12 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 10h18M6 14h6m-6 4h12M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Teks Empty State -->
            <h3 class="text-xl md:text-2xl font-bold text-white mb-2">
                Belum Ada Peminjaman
            </h3>
            <p class="text-gray-400 text-sm md:text-base mb-6 max-w-md mx-auto">
                Anda belum pernah melakukan perizinan HP. Silakan ajukan perizinan sekarang untuk menggunakan
                fasilitas ini.
            </p>

            <!-- Tombol ke Form Peminjaman -->
            <a href="form-izin.php"
                class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-indigo-500/25">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Izin Sekarang
            </a>

            <!-- Informasi Tambahan -->
            <div class="mt-8 mb-8 text-center text-sm text-gray-500 flex flex-wrap justify-center gap-3">
                <div
                    class="bg-gray-800/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1 border border-gray-700">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span> Tersedia 2 unit HP
                </div>
                <div
                    class="bg-gray-800/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1 border border-gray-700">
                    <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span> Max 30 menit
                </div>
                <div
                    class="bg-gray-800/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1 border border-gray-700">
                    <span class="inline-block w-2 h-2 rounded-full bg-amber-500"></span> Pengembalian tepat waktu
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php include("../../src/include/footer.php"); ?>

    <script src="../../src/js/navbar.js"></script>
    <script src="../../src/js/script.js"></script>
</body>

</html>