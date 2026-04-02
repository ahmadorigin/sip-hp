<?php
    session_start();
    require '../../src/php/functions.php';

    if (!isset($_SESSION["login"])) {
        header("Location: ../login.php");
    }
    
    if(isset($_POST["submit"])) {
        tambah($_POST);
        
        // 3. REDIRECT ke halaman yang sama (ini kuncinya!)
        header("Location: dashboard.php"); 
        exit; // Wajib pakai exit setelah header location       
    }
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

    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.3);
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
                                <a href="dashboard.php" class="text-indigo-400 hover:bg-indigo-300 text-sm transition">
                                    Kembali
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
                        <a href="dashboard.php"
                            class="flex items-center gap-3 px-4 py-3 text-indigo-500 hover:bg-gray-800 rounded-lg transition">
                            <svg class="w-6 h-6" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5" />
                            </svg>
                            <span>Kembali</span>
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

        <!-- main form card - dark theme -->
        <div
            class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden card-hover transition-all duration-300 border border-gray-800">
            <div class="bg-linear-to-r from-indigo-950/50 to-blue-950/50 px-6 py-4 border-b border-gray-800">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-100">Form Peminjaman</h2>
                    <span
                        class="text-xs bg-indigo-500/20 text-indigo-300 px-2 py-0.5 rounded-full ml-auto border border-indigo-500/30">Wajib
                        diisi</span>
                </div>
            </div>

            <form action="" method="post" class="p-6 md:p-8 space-y-6">
                <input type="hidden" name="user_id" id="id" value="<?= $_SESSION["id"]; ?>">
                <!-- Nama Peminjam field -->
                <div class="space-y-2">
                    <label for="peminjam"
                        class="flex items-center text-sm font-semibold text-gray-300 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Peminjam
                    </label>
                    <input type="text" name="peminjam" id="peminjam" readonly
                        class="w-full px-5 py-3 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 bg-gray-800/50 hover:bg-gray-800 text-gray-100 placeholder-gray-500"
                        value="<?= $_SESSION['username']; ?>">
                    <p class="text-xs text-gray-500 mt-1">*Otomatis sesuai akun login</p>
                </div>

                <!-- Durasi pinjam (menit) -->
                <div class="space-y-2">
                    <label for="durasi-pinjam"
                        class="flex items-center text-sm font-semibold text-gray-300 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Durasi pinjam (menit)
                    </label>
                    <input type="number" name="durasi-pinjam" id="durasi-pinjam" required min="1" max="30" step="1"
                        class="w-full px-5 py-3 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 bg-gray-800/50 hover:bg-gray-800 text-gray-100 placeholder-gray-500"
                        placeholder="menit (maksimal 30 menit)">
                    <p class="text-xs text-gray-500 ml-1">*maksimal 30 menit untuk kenyamanan bersama</p>
                </div>

                <!-- Alasan Peminjaman -->
                <div class="space-y-2">
                    <label for="alasan"
                        class="flex items-center text-sm font-semibold text-gray-300 uppercase tracking-wide">
                        <svg class="w-4 h-4 mr-1.5 text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Alasan peminjaman
                    </label>
                    <input type="text" name="alasan" id="alasan" required
                        class="w-full px-5 py-3 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 bg-gray-800/50 hover:bg-gray-800 text-gray-100 placeholder-gray-500"
                        placeholder="contoh: mengerjakan tugas, kebutuhan komunikasi darurat">
                </div>

                <!-- Tombol submit -->
                <div class="pt-4">
                    <button type="submit" name="submit"
                        class="group relative w-full flex items-center justify-center gap-2 bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-indigo-500/25 transition-all duration-300 transform hover:scale-[1.01] focus:ring-4 focus:ring-indigo-500/50">
                        <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        AJUKAN IZIN PEMINJAMAN
                    </button>
                </div>
            </form>

            <!-- subtle footer note -->
            <div class="bg-gray-800/50 px-6 py-3 text-center text-xs text-gray-500 border-t border-gray-800">
                <span>📱 dengan mengajukan izin, anda setuju dengan kebijakan peminjaman HP</span>
            </div>
        </div>

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

    <script src="../../src/js/navbar.js"></script>
    <script src="../../src/js/script.js"></script>
</body>

</html>