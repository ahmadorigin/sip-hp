<?php

    session_start();
  
    require './src/php/functions.php';
    $users = s_query("GET", "/rest/v1/tb_users?select=*");

    if (isset($_POST["submit"])) {
        
        if (verify($_POST)) {
            
            $_SESSION["login"] = true;
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = $_POST["id"];
            
            $users = s_query("POST", "/rest/v1/tb_users?select=*");
            header("Location: ./public/users/dashboard.php");
        } else {
            $error = true;
        }
    }

    $nonAdminUsers = array_filter($users, function($user) {
        return $user['role'] !== 'admin'; 
    });

    $page_title = "index";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Sistem Peminjaman HP | SIP-HP</title>
    <link rel="stylesheet" href="./src/css/output.css">
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

    <?php include("./src/include/header.php"); ?>

    <div class="container max-w-2xl w-full mx-auto">

        <h1 class="text-white text-center text-2xl mb-8 mt-4">Siapa yang mau pinjam?</h1>
        <!-- Tambahkan di dalam div id="card-data" sebelum akhir </div> -->
        <?php if(!empty($nonAdminUsers)) : ?>
        <?php foreach($users as $row) : ?>
        <?php if($row["role"] !== "admin") : ?>
        <div class="profileCard max-w-xs mx-auto mb-4 bg-gray-900 hover:bg-gray-800 rounded-lg shadow-lg cursor-pointer animate-fade-in"
            onclick="openModal('<?= $row['id']; ?>', '<?= $row['username']; ?>')">
            <div class="p-4 flex items-center space-x-4 gap-2">
                <div
                    class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                    H
                </div>
                <div>
                    <h2 class="text-white font-semibold text-base"><?= $row["username"]; ?></h2>
                    <p class="text-gray-400 text-xs"><?= $row["role"]; ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php else : ?>
        <div
            class="rounded-2xl backdrop-blur-xl bg-white/5 border border-white/20 p-8 md:p-12 text-center animate-fade-in">
            <!-- Ilustrasi / Icon Animasi -->
            <div class="relative w-28 h-28 mx-auto mb-6">
                <div
                    class="absolute inset-0 bg-linear-to-r from-indigo-500/30 to-purple-500/30 rounded-full blur-xl animate-pulse">
                </div>
                <div
                    class="relative w-28 h-28 rounded-full bg-linear-to-br from-indigo-500/20 to-purple-500/20 backdrop-blur border border-white/20 flex items-center justify-center">
                    <svg class="w-14 h-14 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Teks Empty State -->
            <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">
                Belum Ada yang Meminjam
            </h3>
            <p class="text-gray-400 text-base md:text-lg mb-6 max-w-md mx-auto">
                Saat ini belum ada data peminjaman HP. Silakan daftar atau login untuk mulai menggunakan layanan ini.
            </p>

            <!-- Tombol ke Halaman Registrasi -->
            <a href="./public/regis.php"
                class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-indigo-500/25">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Daftar Sekarang
            </a>

            <!-- Informasi Tambahan -->
            <div class="mt-6 flex flex-wrap justify-center gap-3 text-xs text-gray-500">
                <span class="px-3 py-1 rounded-full bg-white/5 backdrop-blur border border-white/10">
                    📱 2 Unit Tersedia
                </span>
                <span class="px-3 py-1 rounded-full bg-white/5 backdrop-blur border border-white/10">
                    ⏱️ Maksimal 30 menit
                </span>
                <span class="px-3 py-1 rounded-full bg-white/5 backdrop-blur border border-white/10">
                    ✅ Persetujuan Cepat
                </span>
            </div>
        </div>
        <?php endif; ?>
        <!-- Overlay untuk form verifikasi password -->
        <div id="passwordOverlay"
            class="hidden flex fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 animate-fade-in">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
                <div class="flex items-center justify-between w-full mb-4">
                    <h3 class="text-xl text-white font-semibold">Verifikasi Password</h3>
                    <h2 id="displayUserName"
                        class="text-sm text-white font-semibold bg-indigo-600 hover:bg-indigo-500 px-3 py-2 rounded-xl">
                    </h2>
                    <button onclick="closeModal()"
                        class="text-2xl leading-none text-gray-500 hover:text-black transition-colors">
                        &times;
                    </button>
                </div>

                <?php if(isset($error)) : ?>
                <p class="text-red-500 font-bold text-center italic">username / password salah</p>
                <?php endif; ?>

                <form method="post" class="passwordForm flex flex-col gap-4">
                    <label for="password" class="text-gray-300">Password</label>
                    <input type="hidden" name="id" id="modalInputId">
                    <input type="hidden" name="username" id="modalInputUsername">

                    <input type="password" name="password"
                        class="border text-white border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required>
                    <button type="submit" name="submit"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg">Verifikasi</button>
                </form>
            </div>
        </div>
    </div>

    <?php include("./src/include/footer.php"); ?>

    <script src="./src/js/verify.js"></script>
    <script src="./src/js/navbar.js"></script>
    <script src="./src/js/script.js"></script>
</body>

</html>