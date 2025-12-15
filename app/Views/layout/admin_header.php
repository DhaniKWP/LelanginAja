<!-- Admin Navbar -->
<nav class="bg-gray-900 text-white fixed top-0 left-0 w-full z-50 shadow-xl border-b border-gray-700">
    <div class="px-6 py-4 flex justify-between items-center">

        <!-- Brand -->
        <div class="flex items-center gap-3">
            <div class="text-2xl font-extrabold tracking-wide bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
                <i class="fas fa-gavel text-blue-400"></i> LelanginAja <span class="text-gray-300 font-normal">| Admin</span>
            </div>
        </div>

        <div class="flex items-center gap-6">

            <!-- Quick Action (desktop only) -->
            <div class="hidden lg:flex items-center gap-6 text-sm">
                <a href="<?= base_url('admin/dashboard') ?>" 
                    class="flex items-center gap-2 hover:text-blue-400 transition"><i class="fas fa-home"></i> Dashboard</a>

                <a href="<?= base_url('admin/pemenang') ?>" 
                    class="flex items-center gap-2 hover:text-blue-400 transition"><i class="fas fa-trophy"></i> Pemenang</a>

                <a href="<?= base_url('admin/verifikasi') ?>" 
                    class="flex items-center gap-2 hover:text-blue-400 transition"><i class="fas fa-money-check-alt"></i> Pembayaran</a>

                <a href="<?= base_url('admin/lap-transaksi') ?>" 
                    class="flex items-center gap-2 hover:text-blue-400 transition"><i class="fas fa-chart-line"></i> Laporan</a>
            </div>

            <!-- Notification -->
            <div class="relative group">
                <div class="cursor-pointer hover:text-blue-400 transition relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">
                        5
                    </span>
                </div>

                <!-- Dropdown -->
                <div class="hidden group-hover:block absolute right-0 mt-4 w-80 bg-white rounded-xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-4 py-3 text-white font-semibold">
                        Notifikasi
                    </div>

                    <div class="max-h-72 overflow-y-auto divide-y">
                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                            <p class="font-medium text-gray-800 text-sm">Barang baru menunggu approval</p>
                            <p class="text-xs text-gray-500">2 menit lalu</p>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                            <p class="font-medium text-gray-800 text-sm">Pembayaran menunggu verifikasi</p>
                            <p class="text-xs text-gray-500">15 menit lalu</p>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                            <p class="font-medium text-gray-800 text-sm">User baru mendaftar</p>
                            <p class="text-xs text-gray-500">1 jam lalu</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-2 text-center">
                        <a href="<?= base_url('admin/notifikasi') ?>" class="text-blue-600 text-sm font-medium hover:text-blue-700">
                            Lihat semua
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <div class="relative group">
                <div class="flex items-center gap-3 cursor-pointer hover:bg-gray-800 py-2 px-3 rounded-lg transition">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center font-bold shadow">
                        <?= strtoupper(substr(session()->get('nama_admin') ?? 'A', 0, 1)) ?>
                    </div>
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold"><?= session()->get('nama_admin') ?? 'Administrator' ?></p>
                        <span class="text-xs text-gray-400">Super Admin</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs hidden md:block"></i>
                </div>

                <!-- Dropdown -->
                <div class="hidden group-hover:block absolute right-0 mt-2 w-56 bg-white text-gray-700 rounded-xl shadow-xl overflow-hidden">
                    <div class="px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <p class="font-semibold"><?= session()->get('nama_admin') ?? 'Administrator' ?></p>
                        <p class="text-xs"><?= session()->get('email_admin') ?? 'admin@lelang.com' ?></p>
                    </div>

                    <a href="<?= base_url('admin/profil') ?>" 
                        class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 text-sm"><i class="fas fa-user-circle"></i> Profil</a>

                    <a href="<?= base_url('admin/pengaturan') ?>" 
                        class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 text-sm"><i class="fas fa-cog"></i> Pengaturan</a>

                    <hr>

                    <a href="<?= base_url('logout') ?>" 
                        onclick="return confirm('Yakin ingin logout?')"
                        class="flex items-center gap-3 px-4 py-2 hover:bg-red-50 text-red-600 font-medium text-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    .group:hover .max-h-72::-webkit-scrollbar{width:6px}
    .group:hover .max-h-72::-webkit-scrollbar-thumb{background:#888;border-radius:10px}
    .group:hover .max-h-72::-webkit-scrollbar-thumb:hover{background:#555}
</style>
