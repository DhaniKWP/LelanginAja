<!-- User Navbar Component -->
<nav class="gradient-blue text-white fixed w-full top-0 z-50 shadow-xl">
    <div class="px-6 py-4 flex justify-between items-center">
        <!-- Brand -->
        <div class="flex items-center gap-4">
            <h1 class="text-2xl font-bold">
                <i class="fas fa-gavel mr-2"></i> LelanginAja
            </h1>
            <span class="hidden md:block text-xs text-blue-100 bg-blue-600 bg-opacity-30 px-3 py-1 rounded-full">
                User Portal
            </span>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-6">
            
            <!-- Quick Actions -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="<?= base_url('user/dashboard') ?>" 
                   class="text-blue-100 hover:text-white transition flex items-center gap-2 text-sm">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= base_url('user/lelang/aktif') ?>" 
                   class="text-blue-100 hover:text-white transition flex items-center gap-2 text-sm">
                    <i class="fas fa-gavel"></i>
                    <span>Lelang Aktif</span>
                </a>
            </div>

            <!-- Divider -->
            <div class="hidden lg:block h-8 w-px bg-blue-400 opacity-30"></div>

            <!-- User Profile -->
            <div class="relative group">
                <div class="flex items-center gap-3 cursor-pointer hover:bg-blue-600 hover:bg-opacity-30 px-3 py-2 rounded-lg transition">
                    <div class="w-9 h-9 bg-white text-blue-600 rounded-full flex items-center justify-center font-bold shadow-lg">
                        <?= strtoupper(substr(session()->get('nama') ?? 'U', 0, 2)) ?>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium"><?= session()->get('nama') ?? 'User' ?></p>
                        <p class="text-xs text-blue-100">Member</p>
                    </div>
                    <i class="fas fa-chevron-down text-sm hidden md:block"></i>
                </div>

                <!-- Profile Dropdown -->
                <div class="hidden group-hover:block absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl overflow-hidden">
    
    <!-- User Info -->
        <div class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <p class="font-semibold"><?= session()->get('nama') ?: 'Pengguna' ?></p>
            <p class="text-xs text-blue-100"><?= session()->get('email') ?: '-' ?></p>
        </div>

        <div class="py-2">
            <a href="<?= base_url('user/profil') ?>"
            class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 transition text-gray-700">
                <i class="fas fa-user-circle w-5 text-blue-500"></i>
                <span class="text-sm">Profil Saya</span>
            </a>

            <a href="<?= base_url('user/barang-saya') ?>" 
            class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 transition text-gray-700">
                <i class="fas fa-box w-5 text-blue-500"></i>
                <span class="text-sm">Barang Saya</span>
            </a>

            <a href="<?= base_url('user/riwayat-penawaran') ?>"
            class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 transition text-gray-700">
                <i class="fas fa-history w-5 text-blue-500"></i>
                <span class="text-sm">Riwayat Penawaran</span>
            </a>

            <a href="<?= base_url('user/status-pemenang') ?>"
            class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 transition text-gray-700">
                <i class="fas fa-trophy w-5 text-yellow-500"></i>
                <span class="text-sm">Status Pemenang</span>
            </a>

            <hr class="my-2 border-gray-200">

            <a href="<?= base_url('/logout') ?>"
            onclick="return confirm('Yakin ingin logout?')"
            class="flex items-center gap-3 px-4 py-2 text-red-600 hover:bg-red-50 transition">
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
    .gradient-blue {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    }
    
    /* Custom scrollbar for notification dropdown */
    .group:hover .max-h-96::-webkit-scrollbar {
        width: 6px;
    }
    .group:hover .max-h-96::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .group:hover .max-h-96::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    .group:hover .max-h-96::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>