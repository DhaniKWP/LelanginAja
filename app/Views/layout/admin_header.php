<!-- Admin Navbar -->
<nav class="bg-white fixed top-0 left-0 w-full z-50 border-b border-gray-200 shadow-sm">
    <div class="px-6 h-16 flex justify-between items-center">

        <!-- ================= BRAND ================= -->
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white shadow">
                <i class="fas fa-gavel"></i>
            </div>

            <div class="leading-tight">
                <p class="text-lg font-extrabold text-blue-700 tracking-wide">
                    LelanginAja
                </p>
                <span class="text-xs text-gray-400">
                    Admin Panel
                </span>
            </div>
        </div>

        <!-- ================= RIGHT MENU ================= -->
        <div class="flex items-center gap-6">

            <!-- Dashboard Shortcut -->
            <a href="<?= base_url('admin/dashboard') ?>"
               class="hidden md:flex items-center gap-2 px-3 py-2 rounded-lg
                      text-sm font-medium text-gray-600
                      hover:bg-blue-50 hover:text-blue-600 transition">
                <i class="fas fa-home"></i>
                Dashboard
            </a>

            <!-- Divider -->
            <div class="hidden md:block h-6 w-px bg-gray-200"></div>

            <!-- ================= PROFILE ================= -->
            <div class="relative group">

                <button class="flex items-center gap-3 px-3 py-2 rounded-lg
                               hover:bg-blue-50 transition focus:outline-none">

                    <div class="w-9 h-9 rounded-full bg-gradient-to-br
                                from-blue-600 to-blue-500
                                flex items-center justify-center
                                text-white font-bold shadow">
                        <?= strtoupper(substr(session()->get('nama_admin') ?? 'A', 0, 1)) ?>
                    </div>

                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-700">
                            <?= session()->get('nama_admin') ?? 'Administrator' ?>
                        </p>
                        <span class="text-xs text-gray-400">
                            Admin
                        </span>
                    </div>

                    <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block"></i>
                </button>

                <!-- ================= DROPDOWN ================= -->
                <div class="hidden group-hover:block absolute right-0 mt-3 w-60
                            bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">

                    <!-- User Info -->
                    <div class="px-4 py-3 bg-gray-50 border-b">
                        <p class="text-sm font-semibold text-gray-700">
                            <?= session()->get('nama_admin') ?? 'Administrator' ?>
                        </p>
                        <p class="text-xs text-gray-400">
                            <?= session()->get('email_admin') ?? 'admin@lelang.com' ?>
                        </p>
                    </div>

                    <!-- Menu -->

                    <hr>

                    <a href="javascript:void(0)"
                    onclick="confirmLogout('<?= base_url('logout') ?>')"
                    class="flex items-center gap-3 px-4 py-2.5
                            text-sm text-red-600 font-medium
                            hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </div>

        </div>
    </div>
</nav>
