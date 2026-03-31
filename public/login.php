<?php

    session_start();
    require '../src/php/functions.php';

    // Cetak: Apakah user sudah login? Kalau belum, cek cookie-nya
    if (isset($_COOKIE["login"])) {

        if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
            $id = $_COOKIE["id"];
            $key = $_COOKIE["key"];

            // ambil username dari id 
            $result = s_query("GET", "/rest/v1/tb_admin?id=eq." . $id);

            if (!empty($result)) {
                $row = $result[0];

                // cek cookie dan username
                if ($key === hash('sha256', $row["username"])) {
                    $_SESSION["login"] = true;
                }
            }
        }
    }
    
    if (isset($_SESSION["login"])) {
        if (isset($_SESSION["admin"])) {
            header("Location: ./admin/dashboard.php");
        } else {
            header("Location: ./users/dashboard.php");
        }
        exit;
    }

    if (isset($_POST["login"])) {
        $result = login($_POST);
        if ($result) {
            // SETELAH BERHASIL, LANGSUNG PINDAH!
            if ($result["role"] === "admin") {
                header("Location: ./admin/dashboard.php"); 
            } else {
                header("Location: ./users/dashboard.php"); 
            }
            exit;
        } else {
            $error = true;
        }
    }
 
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIP-HP</title>
    <link rel="stylesheet" href="../src/css/output.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }
    </style>
</head>

<body class="bg-gray-950 text-gray-200">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <!-- Brand -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center bg-linear-to-r from-indigo-600 to-indigo-500 rounded-2xl px-6 py-3 shadow-lg mb-4">
                    <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="text-2xl font-bold">SIP-HP</span>
                </div>
                <p class="text-gray-400">Sistem Izin Pinjaman HP</p>
            </div>

            <!-- Form Login -->
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6 md:p-8">
                <h2 class="text-2xl font-bold text-center mb-6">Masuk ke Akun</h2>

                <form action="" method="post" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                        <input type="text" name="username" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-gray-100"
                            placeholder="Ahmad Fauzan">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 text-gray-100"
                            placeholder="••••••••">
                    </div>

                    <div class="flex items-center gap-2 mt-4">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-indigo-500">
                        <label for="remember" class="text-sm text-gray-400">Ingat Saya, agar tidak bolak balik
                            login!</label>
                    </div>

                    <?php if(isset($error)) : ?>
                    <p class="text-red-500 font-bold text-center italic">username / password salah</p>
                    <?php endif; ?>

                    <button type="submit" name="login"
                        class="w-full bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold py-3 rounded-xl transition-all">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-gray-400 text-sm mt-6">
                    Belum punya akun?
                    <a href="regis.php" class="text-indigo-400 hover:text-indigo-300">Ndamel rumiyen!!</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>