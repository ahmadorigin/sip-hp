<?php
 
    if (isset($_POST["btn-izin"])) {

    // input 
    $peminjam = $_POST["peminjam"];
    $durasiPinjam = $_POST["durasi-pinjam"];
    $alasan = $_POST["alasan"];
    
    // filter
    date_default_timezone_set('Asia/Jakarta');
    $output = "";
    $filterKata = ["Ngaji", "Belajar", "Tugas"];
    $filterKataAda = false;

    foreach($filterKata as $kata) {
        if(stripos($alasan, $kata) !== false) {
            $filterKataAda = true;
            break;
        }
    }

    if( intval(date("H")) > 21 ) {
        $output = "ini sudah jam tidur!!!";
    } else if($durasiPinjam > 30) {
        $output = "Durasi pinjam mu kelamaan!!";
    } else if($filterKataAda === true) {
        $output = "Selamat belajar dan ber-ibadah " . $peminjam;
    } else {
        $output = "Pending (menunggu persetujuan...) sabar dulu ya " . $peminjam;
    }

}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman HP</title>
    <link href="./src/output.css" rel="stylesheet">
    <!-- custom config to override/intercept tailwind defaults subtly -->
    <style>
    /* smooth transitions & custom focus ring */
    input:focus,
    button:focus {
        outline: none;
        ring: 2px solid #3b82f6;
        ring-offset: 2px;
    }

    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e6f0fa 100%);
    }

    .card-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    </style>
</head>

<body class="font-sans antialiased min-h-screen flex items-center justify-center p-4 md:p-6">

    <!-- main container with glassmorphism / card effect -->
    <div class="max-w-2xl w-full mx-auto">
        <!-- header / brand section with gradient & shadow -->
        <div class="text-center mb-8 md:mb-10">
            <div
                class="inline-flex items-center justify-center bg-linear-to-r from-indigo-600 to-blue-600 text-white rounded-2xl px-6 py-3 shadow-lg mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-2xl md:text-3xl font-extrabold tracking-tight">SIP-HP</span>
            </div>
            <p
                class="text-gray-600 text-lg md:text-xl font-medium bg-white/60 backdrop-blur-sm inline-block px-5 py-1.5 rounded-full shadow-sm">
                Sistem Izin Pinjaman HP</p>
        </div>

        <!-- main form card : white card with rounded-xl, elevated shadow -->
        <div
            class="bg-white rounded-2xl shadow-2xl overflow-hidden card-hover transition-all duration-300 border border-gray-100">
            <div class="bg-linear-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-indigo-100">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Form Peminjaman</h2>
                    <span class="text-xs bg-indigo-200 text-indigo-800 px-2 py-0.5 rounded-full ml-auto">Wajib
                        diisi</span>
                </div>
            </div>

            <form action="" method="post" class="p-6 md:p-8 space-y-6">
                <!-- Nama Peminjam field -->
                <div class="space-y-2">
                    <label for="peminjam"
                        class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Nama lengkap peminjam
                    </label>
                    <input type="text" name="peminjam" id="peminjam" required
                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 bg-gray-50/50 hover:bg-white"
                        placeholder="contoh: Ahmad Fauzan">
                </div>

                <!-- Durasi pinjam (menit) -->
                <div class="space-y-2">
                    <label for="durasi-pinjam"
                        class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Durasi pinjam (menit)
                    </label>
                    <input type="number" name="durasi-pinjam" id="durasi-pinjam" required min="1" step="1"
                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 bg-gray-50/50 hover:bg-white"
                        placeholder="menit (maksimal 30 menit)">
                    <p class="text-xs text-gray-400 ml-1">*maksimal 30 menit untuk kenyamanan bersama</p>
                </div>

                <!-- Alasan Peminjaman -->
                <div class="space-y-2">
                    <label for="alasan"
                        class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wide">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Alasan peminjaman
                    </label>
                    <input type="text" name="alasan" id="alasan" required
                        class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:border-indigo-400 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 bg-gray-50/50 hover:bg-white"
                        placeholder="contoh: mengerjakan tugas, kebutuhan komunikasi darurat">
                </div>

                <!-- Tombol submit dengan efek modern -->
                <div class="pt-4">
                    <button type="submit" name="btn-izin"
                        class="group relative w-full flex items-center justify-center gap-2 bg-linear-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold py-3.5 px-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-[1.01] focus:ring-4 focus:ring-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:animate-pulse" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        AJUKAN IZIN PEMINJAMAN
                        <span
                            class="absolute inset-0 rounded-xl bg-white opacity-0 group-hover:opacity-10 transition-opacity"></span>
                    </button>
                </div>
            </form>

            <!-- subtle footer note -->
            <div class="bg-gray-50 px-6 py-3 text-center text-xs text-gray-500 border-t border-gray-100">
                <span>📱 dengan mengajukan izin, anda setuju dengan kebijakan peminjaman HP</span>
            </div>
        </div>

        <!-- output message section : dynamic result with Tailwind styling (<?= $output ?>) -->
        <?php if (isset($output) && !empty($output)): ?>
        <div class="mt-8 transition-all duration-500 animate-fade-in">
            <div
                class="bg-white/90 backdrop-blur-sm border-l-4 border-indigo-500 rounded-xl shadow-lg p-5 flex items-start gap-4">
                <div class="shrink-0">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="text-md font-bold text-gray-800">Status Peminjaman</h4>
                    <p class="text-gray-700 text-base mt-1"><?= htmlspecialchars($output) ?></p>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'"
                    class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <?php endif; ?>

        <!-- simple decorative card: ringkasan informasi tambahan (opsional) -->
        <div class="mt-8 text-center text-sm text-gray-500 flex flex-wrap justify-center gap-4">
            <div class="bg-white/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1">
                <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span> Tersedia 2 unit HP
            </div>
            <div class="bg-white/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1">
                <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span> Max 30 menit
            </div>
            <div class="bg-white/60 rounded-full px-4 py-1.5 shadow-sm inline-flex items-center gap-1">
                <span class="inline-block w-2 h-2 rounded-full bg-amber-500"></span> Pengembalian tepat waktu
            </div>
        </div>
    </div>

    <!-- custom keyframe for fade-in animation -->
    <style>
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

    /* custom scroll & smooth */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        opacity: 0.5;
    }
    </style>
</body>

</html>