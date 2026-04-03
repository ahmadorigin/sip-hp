<?php
    session_start();
    require '../src/php/functions.php'; 

    $id = $_GET['id'];

    $peminjam = s_query("GET", "/rest/v1/tb_peminjaman?id=eq." . $id);

    if (isset($_POST["submit"])) {
        if (count(ubahData($id, $_POST)) > 0) {
            echo "
                    <script>
                        alert('Berhasil meng-ubah!');
                        document.location.href = './users/dashboard.php';
                    </script>
                ";
            } else {
                echo "
                    <script>
                        alert('Gagal meng-ubah!');
                        document.location.href = './users/dashboard.php';
                    </script>
                ";
        }
    }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Ubah Data | SIP-HP</title>
    <link rel="stylesheet" href="../src/css/output.css">
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

<body class="bg-gray-950 font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-6">

    <div id="card-data" class="max-w-2xl w-full mx-auto">
        <!-- header / brand section - dark theme -->
        <div class="text-center mb-8 md:mb-10">
            <div
                class="inline-flex items-center justify-center bg-linear-to-r from-indigo-600 to-indigo-500 text-white rounded-2xl px-6 py-3 shadow-lg mb-4">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-2xl md:text-3xl font-extrabold tracking-tight">SIP-HP</span>
            </div>
            <p
                class="text-gray-400 text-lg md:text-xl font-medium bg-gray-800/60 backdrop-blur-sm inline-block px-5 py-1.5 rounded-full shadow-sm border border-gray-700">
                Sistem Izin Pinjaman HP
            </p>
        </div>

        <!-- main form card - dark theme glassmorphism -->
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
                    <h2 class="text-xl font-bold text-gray-100">Ubah Data Peminjaman</h2>
                </div>
            </div>

            <?php foreach($peminjam as $row) : ?>
            <form action="" method="post" class="p-6 md:p-8 space-y-6">
                <input type="hidden" name="user_id" id="id" value="<?= $_SESSION["id"]; ?>">
                <input type="hidden" name="status" value="<?= $row["status"]; ?>">
                <input type="hidden" name="approved" value="<?= $row["approved"]; ?>">

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
                        value="<?= $_SESSION["username"] ?>">
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
                        value="<?= htmlspecialchars($row["durasi"]); ?>">
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
                    <?php if(isset($_SESSION["admin"])) : ?>
                    <input type="text" name="alasan" id="alasan" readonly
                        class="w-full px-5 py-3 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 bg-gray-800/50 hover:bg-gray-800 text-gray-100 placeholder-gray-500"
                        value="<?= htmlspecialchars($row["alasan"]); ?>">
                    <?php else : ?>

                    <input type="text" name="alasan" id="alasan" required
                        class="w-full px-5 py-3 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all duration-200 bg-gray-800/50 hover:bg-gray-800 text-gray-100 placeholder-gray-500"
                        value="<?= htmlspecialchars($row["alasan"]); ?>">
                    <?php endif; ?>
                </div>

                <!-- Tombol submit dengan efek modern -->
                <div class="pt-4">
                    <button type="submit" name="submit"
                        class="group relative w-full flex items-center justify-center gap-2 bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold py-3.5 px-6 rounded-xl shadow-lg hover:shadow-indigo-500/25 transition-all duration-300 transform hover:scale-[1.01] focus:ring-4 focus:ring-indigo-500/50">
                        <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Ubah Informasi Data
                    </button>
                </div>
            </form>
            <?php endforeach; ?>

            <!-- subtle footer note -->
            <div class="bg-gray-800/50 px-6 py-3 text-center text-xs text-gray-500 border-t border-gray-800">
                <span>📱 dengan mengubah data izin, anda setuju dengan kebijakan peminjaman HP</span>
            </div>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="mt-6 text-center">
            <a href="./users/dashboard.php"
                class="inline-flex items-center gap-2 text-gray-400 hover:text-gray-300 text-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>

</html>