<?php
 
     require '../src/php/functions.php';

     if(isset($_POST["register"])) {
        if (registrasi($_POST) === true) {
            header("Location: login.php"); 
        } else {
            header("Location: ../index.php"); 
        }
        exit;
    }
 
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | SIP-HP</title>
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
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span class="text-2xl font-bold">Daftar</span>
                </div>
            </div>

            <!-- Form Register -->
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6 md:p-8">
                <h2 class="text-2xl font-bold text-center mb-6">Buat Akun Baru</h2>

                <form action="" method="post" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="username" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:border-indigo-500"
                            placeholder="Ahmad Fauzan">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:border-indigo-500"
                            placeholder="minimal 6 karakter">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password2" required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-xl focus:border-indigo-500"
                            placeholder="ulangi password">
                    </div>

                    <button type="submit" name="register"
                        class="w-full bg-linear-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold py-3 rounded-xl transition-all mt-4">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="text-center text-gray-400 text-sm mt-6">
                    Sudah punya akun?
                    <a href="login.php" class="text-indigo-400 hover:text-indigo-300">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>