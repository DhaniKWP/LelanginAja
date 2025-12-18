<aside class="w-64 bg-white h-screen fixed shadow-lg overflow-y-auto">
    <div class="p-6">
        <ul class="space-y-2">
            
            <!-- Dashboard -->
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-500 text-white">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Master Data -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('master')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-database w-5"></i>
                        <span>Master Data</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="master-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/user') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Manage User</a></li>
                    <li><a href="<?= base_url('admin/kondisi') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Manage Kondisi</a></li>
                    <li><a href="<?= base_url('admin/barang') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Manage Barang</a></li>
                    <li><a href="<?= base_url('admin/peserta') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Manage Peserta</a></li>
                </ul>
            </li>

            <!-- Pengajuan Barang -->
            <li>
                <a href="<?= base_url('admin/pengajuanbarang') ?>" class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                    <i class="fas fa-inbox w-5 mr-3"></i> Pengajuan Barang
                </a>
            </li>

            <!-- Proses Lelang -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('lelang')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-gavel w-5"></i>
                        <span>Lelang</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="lelang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/lelang/jadwal') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Jadwal Lelang</a></li>
                    <li><a href="<?= base_url('admin/lelang/aktif') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Lelang Aktif</a></li>
                </ul>
            </li>

            <!-- Pemenang -->
            <li>
                <a href="<?= base_url('admin/pemenang') ?>"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                    <i class="fas fa-trophy w-5 mr-3"></i> Pemenang Lelang
                </a>
            </li>

            <!-- Pembayaran -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('pembayaran')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-money-check-alt w-5"></i>
                        <span>Pembayaran</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="pembayaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/pembayaran') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Verifikasi Pembayaran</a></li>
                </ul>
            </li>

            <!-- Laporan -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('laporan')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chart-bar w-5"></i>
                        <span>Laporan</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="laporan-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/lap-barang') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Laporan Barang</a></li>
                    <li><a href="<?= base_url('admin/lap-pemenang') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Laporan Pemenang</a></li>
                    <li><a href="<?= base_url('admin/lap-transaksi') ?>" class="block px-4 py-2 hover:bg-gray-100 text-gray-600 text-sm">Laporan Transaksi</a></li>
                </ul>
            </li>
            <li class="pt-4"><hr class="border-gray-200"></li>
        </ul>
    </div>
</aside>
