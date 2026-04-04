<?php if($page_title === "dashboard-admin" || $page_title === "panel-admin") : ?>
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
<?php elseif($page_title === "dashboard-users") : ?>
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