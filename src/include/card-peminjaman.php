<?php 
    $borderColor = '';
    $statusText = "";
    $statusColor = "";
    switch ($row["status"]) {
        case "pending":
            $borderColor = "border-indigo-500";
            $statusText = "Menunggu";
            $statusColor = "bg-amber-500/20 text-amber-400 border-amber-500/30";
            break;
        case "approved":
            $borderColor = "border-emerald-500";
            $statusText = "Disetujui";
            $statusColor = "bg-emerald-500/20 text-emerald-400 border-emerald-500/30";
            break;
        case "active":
            $borderColor = "border-indigo-500";
            $statusText = "Berjalan";
            $statusColor = "bg-lime-500/20 text-lime-400 border-lime-500/30";
            break;
        case "completed":
            $borderColor = "border-indigo-500";
            $statusText = "Selesai";
            $statusColor = "bg-indigo-500/20 text-indigo-400 border-indigo-500/30";
            break;
        case "rejected":
            $borderColor = "border-red-500";
            $statusText = "Ditolak";
            $statusColor = "bg-rose-500/20 text-rose-400 border-rose-500/30";
            break;
    }
?>

<div class="mt-5 transition-all duration-500 animate-fade-in">
    <div class="<?= $borderColor; ?> bg-gray-900 border-l-4 rounded-xl shadow-lg overflow-hidden relative ">

        <div class="p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-indigo-500/20 flex items-center justify-center ">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <?php if($page_title === "dashboard-admin") : ?>
                    <div>
                        <h3 class="text-gray-100 font-semibold text-lg">
                            <?= ucwords(htmlspecialchars($row["peminjam"])) ?></h3>
                    </div>
                    <?php elseif($page_title === "dashboard-users" || $page_title === "panel-admin") : ?>
                    <div>
                        <?php if($page_title === "panel-admin") : ?>
                        <h3 class="text-gray-100 font-semibold text-lg">
                            <?= ucwords(htmlspecialchars($row["peminjam"])) ?></h3>
                        <?php elseif($page_title === "dashboard-users") : ?>
                        <h3 class="text-gray-100 font-bold text-base leading-tight">
                            Peminjaman Aktif
                        </h3>
                        <?php endif; ?>
                        <p class="text-gray-500 text-xs mt-1">
                            <?= date('d M Y', strtotime($row["created_at"])) ?> •
                            <?= date('H:i', strtotime($row["created_at"])) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if($page_title === "panel-admin") : ?>
                <a href="../../src/php/hapus.php?id=<?= $row["id"]; ?>"
                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                    class="text-gray-500 hover:text-red-400 transition p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </a>
                <?php elseif($page_title === "dashboard-admin") : ?>
                <div class="flex gap-2">
                    <!-- Badge Status yang Lebih Menonjol - Diposisikan di pojok kanan -->
                    <?php if($row["status"] === "rejected") : ?>
                    <div class="relative">
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-rose-500 shadow-lg backdrop-blur-sm">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-500 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                            </span>
                            <span class="text-rose-400">DITOLAK</span>
                        </div>
                    </div>
                    <?php elseif($row["status"] === "active") : ?>
                    <div class="relative">
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-lime-500 shadow-lg backdrop-blur-sm">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-lime-500 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5 bg-lime-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                            </span>
                            <span class="text-lime-400">BERJALAN</span>
                        </div>
                    </div>
                    <?php elseif($row["status"] === "approved") : ?>
                    <div class="relative">
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-emerald-500 shadow-lg backdrop-blur-sm">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                            </span>
                            <span class="text-emerald-400">DISETUJUI</span>
                        </div>
                    </div>
                    <?php elseif($row["status"] === "completed") : ?>
                    <div class="relative">
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold  border border-indigo-500 shadow-lg backdrop-blur-sm">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-500 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                            </span>
                            <span class="text-indigo-400">SELESAI</span>
                        </div>
                    </div>
                    <?php elseif($row["status"] === "pending") : ?>
                    <div class="relative">
                        <div
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold  border border-amber-500 shadow-lg backdrop-blur-sm">
                            <span class="relative flex h-2.5 w-2.5">
                                <span
                                    class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span
                                    class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                            </span>
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
                <?php elseif($page_title === "dashboard-users") : ?>
                <?php if($row["status"] === "rejected") : ?>
                <div class="relative">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-red-500 shadow-lg backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                        </span>
                        <span class="text-red-400">DITOLAK</span>
                    </div>
                </div>
                <?php elseif($row["status"] === "active") : ?>
                <div class="relative">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-lime-500 shadow-lg backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-lime-500 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2.5 w-2.5 bg-lime-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                        </span>
                        <span class="text-lime-400">BERJALAN</span>
                    </div>
                </div>
                <?php elseif($row["status"] === "approved") : ?>
                <div class="relative">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold border border-emerald-500 shadow-lg backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-500 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                        </span>
                        <span class="text-emerald-400">DISETUJUI</span>
                    </div>
                </div>
                <?php elseif($row["status"] === "completed") : ?>
                <div class="relative">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold  border border-indigo-500 shadow-lg backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-500 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                        </span>
                        <span class="text-indigo-400">SELESAI</span>
                    </div>
                </div>
                <?php elseif($row["status"] === "pending") : ?>
                <div class="relative">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-bold  border border-amber-500 shadow-lg backdrop-blur-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span
                                class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.8)]"></span>
                        </span>
                        <span class="text-amber-400">MENUNGGU</span>
                    </div>
                </div>
                <?php endif; ?>
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
            <?php if($page_title === "panel-admin") : ?>
            <div class="flex flex-col items-start md:items-end justify-between">
                <?php if($row["status"] === "approved") : ?>
                <span
                    class="flex items-center justify-center gap-2 bg-emerald-500/10 text-emerald-400 text-xs font-semibold py-2 px-4 rounded-lg border border-emerald-500/30 w-full md:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Selesai Disetujui
                </span>
                <?php elseif($row["status"] === "rejected") : ?>
                <span
                    class="flex items-center justify-center gap-2 bg-red-500/10 text-red-400 text-xs font-semibold py-2 px-4 rounded-lg border border-red-500/30 w-full md:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Telah Ditolak
                </span>
                <?php elseif($row["status"] === "pending") : ?>
                <div class="flex gap-2 w-full justify-center items-center">
                    <a href="../../src/php/approve.php?id=<?= $row["id"]; ?>" class="w-full md:w-auto">
                        <button
                            class="cursor-pointer flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold py-1 px-2 rounded-lg shadow-md transition-all active:scale-95 w-full md:w-auto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Setujui
                        </button>
                    </a>
                    <button onclick="openModal('<?= $row['id']; ?>', '<?= $row['peminjam']; ?>')"
                        class="cursor-pointer flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-2 rounded-lg shadow-md transition-all active:scale-95 w-full md:w-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Tolak
                    </button>
                    <a href="../ubah.php?id=<?= $row["id"]; ?>" class="w-full">
                        <button
                            class="cursor-pointer flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-2 rounded-lg shadow-md w-full md:w-auto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Ubah
                        </button>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php elseif($page_title === "dashboard-admin" || $page_title === "dashboard-users") : ?>
            <div class="flex flex-wrap gap-2 items-center justify-center">
                <?php if($page_title === "dashboard-admin") : ?>

                <?php if($row["status"] === "pending") : ?>

                <?php elseif($row["status"] === "rejected") : ?>
                <div class="mt-2 p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <p class="text-xs text-red-400 font-semibold uppercase tracking-wider">Pesan Admin:</p>
                    <p class="text-sm text-gray-300 italic"><?= $row["pesan_admin"]; ?></p>
                </div>
                <?php endif; ?>
                <?php elseif($page_title === "dashboard-users") : ?>
                <?php if($row["status"] === "rejected") : ?>
                <button
                    class="tolak-btn cursor-pointer flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md">
                    Kenapa ditolak?
                </button>
                <div class="hidden mt-4 p-3 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <p class="text-xs text-red-400 font-semibold uppercase tracking-wider">Pesan Admin:</p>
                    <p class="pesan-admin text-sm text-gray-300 italic"><?= $row["pesan_admin"]; ?></p>
                </div>
                <?php elseif($row["status"] === "pending") : ?>
                <a href="../ubah.php?id=<?= $row["id"]; ?>">
                    <button
                        class="cursor-pointer flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded-lg shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Ubah
                    </button>
                </a>
                <?php elseif($row["status"] === "approved") : ?>
                <button data-id="<?= $row["id"] ?>" data-durasi="<?= $row['durasi'] ?>"
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
                <span data-id="<?= $row["id"] ?>" data-start="<?= $row['start_time'] ?>"
                    class="display-timer text-lg font-mono font-bold text-lime-400 hidden"></span>
                <?php elseif($row["status"] === "active") : 
                    // Hitung sisa waktu di sisi server (dalam detik)
                    
                    $sekarang = time(); // Waktu sekarang (timestamp)
                    $waktu_mulai = strtotime($row['start_time']);
                    $durasi_detik = $row['durasi'] * 60;
                    
                    $sudah_berjalan = $sekarang - $waktu_mulai;
                    $sisa_detik_server = $durasi_detik - $sudah_berjalan;
                ?>
                <span data-id="<?= $row['id'] ?>" data-sisa="<?= $sisa_detik_server ?>"
                    class="display-timer text-lg font-mono font-bold text-lime-400 hidden"></span>
                <?php elseif($row["status"] === "completed") : ?>
                <span
                    class="flex items-center justify-center gap-2 bg-emerald-500/10 text-indigo-400 text-xs font-semibold py-2 px-4 rounded-lg border border-indigo-500/30 w-full md:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Izin telah digunakan
                </span>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>