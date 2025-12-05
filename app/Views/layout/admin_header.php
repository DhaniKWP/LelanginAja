<!-- Admin Header Component -->
<nav class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white fixed w-full top-0 z-50 shadow-2xl border-b border-gray-700">
    <div class="px-6 py-4 flex justify-between items-center">
        <!-- Brand -->
        <div class="flex items-center gap-4">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                <i class="fas fa-shield-alt text-blue-400"></i> LelanginAja Admin
            </h1>
            <span class="hidden md:block text-xs text-gray-400 bg-gray-800 px-3 py-1 rounded-full">
                Administrator
            </span>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-6">
            
            <!-- Quick Actions -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="<?= base_url('admin/dashboard') ?>" 
                   class="text-gray-300 hover:text-white transition flex items-center gap-2 text-sm">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= base_url('admin/laporan') ?>" 
                   class="text-gray-300 hover:text-white transition flex items-center gap-2 text-sm">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan</span>
                </a>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block h-8 w-px bg-gray-700"></div>

            <!-- Notifications -->
            <div class="relative cursor-pointer hover:text-blue-400 transition group">
                <i class="fas fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                    5
                </span>
                
                <!-- Notification Dropdown (optional) -->
                <div class="hidden group-hover:block absolute right-0 mt-4 w-80 bg-white rounded-xl shadow-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-3">
                        <h3 class="font-semibold text-white">Notifikasi</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Notification items -->
                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 cursor-pointer transition">
                            <p class="text-sm text-gray-800 font-medium">Barang baru menunggu approval</p>
                            <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 cursor-pointer transition">
                            <p class="text-sm text-gray-800 font-medium">Pembayaran perlu diverifikasi</p>
                            <p class="text-xs text-gray-500 mt-1">15 menit yang lalu</p>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer transition">
                            <p class="text-sm text-gray-800 font-medium">User baru mendaftar</p>
                            <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-center">
                        <a href="<?= base_url('admin/notifikasi') ?>" 
                           class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua Notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Admin Profile -->
            <div class="relative group">
                <div class="flex items-center gap-3 cursor-pointer hover:bg-gray-800 px-3 py-2 rounded-lg transition">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center font-bold shadow-lg">
                        <?= strtoupper(substr(session()->get('nama_admin') ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium"><?= session()->get('nama_admin') ?? 'Administrator' ?></p>
                        <p class="text-xs text-gray-400">Super Admin</p>
                    </div>
                    <i class="fas fa-chevron-down text-sm hidden md:block"></i>
                </div>

                <!-- Profile Dropdown -->
                <div class="hidden group-hover:block absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl overflow-hidden">
                    <div class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <p class="font-semibold"><?= session()->get('nama_admin') ?? 'Administrator' ?></p>
                        <p class="text-xs text-blue-100"><?= session()->get('email_admin') ?? 'admin@lelanginaja.com' ?></p>
                    </div>
                    <div class="py-2">
                        <a href="<?= base_url('admin/profil') ?>" 
                           class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-user-circle w-5"></i>
                            <span class="text-sm">Profil Saya</span>
                        </a>
                        <a href="<?= base_url('admin/pengaturan') ?>" 
                           class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-cog w-5"></i>
                            <span class="text-sm">Pengaturan</span>
                        </a>
                        <hr class="my-2 border-gray-200">
                        <a href="<?= base_url('auth/logout') ?>" 
                           class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 transition"
                           onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="text-sm font-medium">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Custom scrollbar for dropdown */
    .group:hover .max-h-96::-webkit-scrollbar {
        width: 6px;
    }
    .group:hover .max-h-96::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .group:hover .max-h-96::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .group:hover .max-h-96::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>