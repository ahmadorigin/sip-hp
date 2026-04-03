<?php
    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php");
    }

    $peminjam = s_query("GET", "/rest/v1/tb_peminjaman?select=*");

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Sistem Peminjaman HP | SIP-HP</title>
    <link rel="stylesheet" href="../../src/css/output.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap');

    * {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    input:focus,
    button:focus {
        outline: none;
        ring: 2px solid #6366f1;
    }

    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fade-in 0.4s ease-out forwards;
    }

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 0.5;
    }
    </style>
</head>

<body class="bg-gray-950 ">

    <!-- main container -->
    <header class="border-b border-gray-800 bg-gray-900/95 rounded-b-2xl backdrop-blur-sm sticky top-0 z-50">
        <div class="px-4 sm:px-6 lg:px-8">
            <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Logo -->
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center">
                                <span class="text-white text-sm font-bold">H</span>
                            </div>
                            <span class="text-gray-100 font-semibold">SIP-HP</span>
                        </div>

                        <!-- Desktop Menu (hidden on mobile) -->
                        <div class="hidden md:flex items-center gap-4 row-gap-2">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                    <span class="text-indigo-400 text-xs font-medium">
                                        <?= substr($_SESSION['username'], 0, 2) ?>
                                    </span>
                                </div>
                                <span
                                    class="text-gray-300 text-sm"><?= htmlspecialchars($_SESSION['username']) ?></span>
                                <a href="../logout.php"
                                    class="text-red-400 hover:text-red-300 text-sm transition">Logout</a>
                                <a href="panel-admin.php"
                                    class="text-indigo-400 hover:bg-indigo-300 text-sm transition">
                                    Panel Izin
                                </a>
                            </div>
                        </div>

                        <!-- Mobile Menu Button (Hamburger) -->
                        <button id="mobileMenuButton"
                            class="md:hidden text-gray-300 hover:text-white focus:outline-none p-2 rounded-lg hover:bg-gray-800 transition">
                            <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Dropdown Menu (hidden by default) -->
                    <div id="mobileMenu"
                        class="hidden md:hidden border-t border-gray-800 py-4 space-y-3 transition-all duration-300">
                        <!-- User Info Mobile -->
                        <div class="flex items-center gap-3 px-2 py-2 bg-gray-800/50 rounded-lg">
                            <div class="w-10 h-10 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                <span class="text-indigo-400 text-sm font-medium">
                                    <?= substr($_SESSION['username'], 0, 2) ?>
                                </span>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-200 text-sm font-medium">
                                    <?= htmlspecialchars($_SESSION['username']) ?>
                                </p>
                                <p class="text-gray-500 text-xs">Online</p>
                            </div>
                        </div>

                        <!-- Menu Items Mobile -->
                        <a href="panel-admin.php"
                            class="flex items-center gap-3 px-4 py-3 text-indigo-400 hover:bg-gray-800 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Panel Admin</span>
                        </a>
                        <a href="../logout.php"
                            class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-gray-800 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <div id="card-data" class="max-w-2xl w-full mx-auto">

        <!-- header / brand section - dark mode version -->
        <div class="text-center mb-8 md:mb-10"></div>

        <!-- Daftar Peminjaman -->
        <?php if(!empty($peminjam)): ?>
        <?php foreach($peminjam as $row) : ?>
        <div class="mt-5 transition-all duration-500 animate-fade-in">
            <div class="bg-gray-900 border-l-4 rounded-xl shadow-lg overflow-hidden border border-gray-800 relative ">

                <div class="p-5">
                    <!-- Header Card dengan Avatar -->
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
                                <h3 class="text-gray-100 font-semibold text-lg">
                                    <?= htmlspecialchars($row["peminjam"]) ?></h3>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <!-- Badge Status yang Lebih Menonjol - Diposisikan di pojok kanan -->
                            <?php if($row["approved"]) : ?>
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
                            <!-- Tombol Hapus -->
                            <a href="./src/php/hapus.php?id=<?= $row["id"]; ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="text-gray-500 hover:text-red-400 transition p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </a>
                        </div>
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
                        <a href="../ubah.php?id=<?= $row["id"]; ?>">
                            <button
                                class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-3 rounded-lg shadow-md ">
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
        <?php endif; ?>
    </div>~

    <script src="../../src/js/navbar.js"></script>
    <script src="../../src/js/script.js"></script>
</body>

</html>