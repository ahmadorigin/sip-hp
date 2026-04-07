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


<?php if (isset($page_title)) : ?>
<?php if($page_title === "form-izin") : ?>
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
                            <span class="text-gray-300 text-sm"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <a href="../logout.php"
                                class="text-red-400 hover:text-red-300 text-sm transition">Logout</a>
                            <a href="dashboard.php" class="text-indigo-400 hover:text-indigo-300 text-sm transition">
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
<?php elseif($page_title === "panel-admin") : ?>
<header class="border-b border-gray-800 bg-gray-900/95 rounded-b-2xl backdrop-blur-sm sticky top-0 z-50">
    <div class="px-4 sm:px-6 lg:px-8">
        <!-- Navbar dengan Mobile Menu -->
        <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>

                        <div class="flex items-center gap-2">
                            <h1 class="text-lg sm:text-2xl font-bold text-gray-100">Panel Admin 🛡️</h1>
                        </div>
                    </div>

                    <div class="flex items-center justify-between ">
                        <!-- Search Bar (Desktop) -->
                        <div class="hidden md:flex items-center max-w-md flex-1 mx-8">
                            <div class="relative w-full">
                                <input type="text" placeholder="Cari peminjam..."
                                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                                <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Menu (hidden on mobile) -->
                    <div class="hidden md:flex items-center gap-4">
                        <?php if(isset($_SESSION['login'])): ?>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                <span class="text-indigo-400 text-xs font-medium">
                                    <?= substr($_SESSION['username'], 0, 2) ?>
                                </span>
                            </div>
                            <span class="text-gray-300 text-sm"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <a href="../logout.php"
                                class="text-red-400 hover:text-red-300 text-sm transition">Logout</a>

                            <a href="dashboard.php" class="text-indigo-400 hover:text-indigo-300 text-sm transition">
                                Kembali
                            </a>
                        </div>
                        <?php endif; ?>
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
                                <?= htmlspecialchars($_SESSION['username']) ?></p>
                            <p class="text-gray-500 text-xs">Online</p>
                        </div>
                    </div>

                    <!-- Menu Items Mobile -->
                    <a href="dashboard.php"
                        class="flex items-center gap-3 px-4 py-3 text-indigo-400 hover:bg-gray-800 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span>Dashboard</span>
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
                    <a href="dashboard.php"
                        class="flex items-center gap-3 px-4 py-3 text-indigo-500 hover:bg-gray-800 rounded-lg transition">
                        <svg class="w-6 h-6" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Search Bar (Mobile) -->
        <div class="md:hidden pb-3">
            <div class="relative">
                <input type="text" placeholder="Cari peminjam..."
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</header>
<?php else : ?>
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

                            <?php if($page_title === "dashboard-admin") : ?>
                            <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                <span class="text-indigo-400 text-xs font-medium">
                                    <?= substr($_SESSION['username'], 0, 2) ?>
                                </span>
                            </div>
                            <span class="text-gray-300 text-sm"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <a href="../logout.php"
                                class="text-red-400 hover:text-red-300 text-sm transition">Logout</a>
                            <a href="panel-admin.php" class="text-indigo-400 hover:text-indigo-300 text-sm transition">
                                Panel Izin
                            </a>
                            <?php elseif($page_title === "dashboard-users") : ?>
                            <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center">
                                <span class="text-indigo-400 text-xs font-medium">
                                    <?= substr($_SESSION['username'], 0, 2) ?>
                                </span>
                            </div>
                            <span class="text-gray-300 text-sm"><?= htmlspecialchars($_SESSION['username']) ?></span>
                            <a href="../logout.php"
                                class="text-red-400 hover:text-red-300 text-sm transition">Logout</a>
                            <a href="form-izin.php" class="text-indigo-400 hover:text-indigo-300 text-sm transition">
                                Form Izin
                            </a>
                            <?php elseif($page_title === "panel-admin") : ?>

                            <?php else : ?>
                            <a href="./public/login.php"
                                class="text-indigo-400 hover:text-indigo-300 text-sm transition">Login</a>
                            <a href="./public/regis.php"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm transition">
                                Daftar
                            </a>
                            <?php endif; ?>
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
                    class="hidden md:hidden border-t border-gray-800 py-4 space-y-3 animate-fade-in transition-all duration-300">

                    <!-- Menu Items Mobile -->
                    <?php if($page_title === "dashboard-admin") : ?>
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
                    <?php elseif($page_title === "dashboard-users") : ?>
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
                    <a href="form-izin.php"
                        class="flex items-center gap-3 px-4 py-3 text-indigo-400 hover:bg-gray-800 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span>Form Izin</span>
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
                    <?php else : ?>
                    <a href="./public/login.php"
                        class="flex mb-2 items-center justify-center gap-2 px-4 py-3 text-indigo-400 border border-indigo-500/30 rounded-lg hover:bg-indigo-500/10 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span>Login</span>
                    </a>
                    <a href="./public/regis.php"
                        class="flex items-center justify-center gap-2 px-4 py-3 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                        <span>Daftar</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</header>
<?php endif; ?>

<?php endif; ?>