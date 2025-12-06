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
                    <li><a href="<?= base_url('admin/users') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage User</a></li>
                    <li><a href="<?= base_url('admin/kategori') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Kategori</a></li>
                    <li><a href="<?= base_url('admin/kondisi') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Kondisi</a></li>
                    <li><a href="<?= base_url('admin/barang') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Barang</a></li>
                    <li><a href="<?= base_url('admin/peserta') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Peserta</a></li>
                </ul>
            </li>

            <!-- Pengajuan Barang -->
            <li>
                <a href="<?= base_url('admin/pengajuanbarang') ?>" class="flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-inbox w-5"></i>
                        <span>Pengajuan Barang</span>
                    </div>
                </a>
            </li>

            <!-- Proses Lelang -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('lelang')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-gavel w-5"></i>
                        <span>Proses Lelang</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="lelang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/jadwal') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Jadwal Lelang</a></li>
                    <li><a href="<?= base_url('admin/aktif') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Lelang Aktif</a></li>
                    <li><a href="<?= base_url('admin/monitoring') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Monitoring Real-time</a></li>
                </ul>
            </li>

            <!-- Penawaran & Pemenang -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('penawaran')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-trophy w-5"></i>
                        <span>Penawaran</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="penawaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/penawaran-list') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Daftar Penawaran</a></li>
                    <li><a href="<?= base_url('admin/pemenang') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Tentukan Pemenang</a></li>
                    <li><a href="<?= base_url('admin/transaksi-pemenang') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Transaksi Pemenang</a></li>
                </ul>
            </li>

            <!-- Pembayaran -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('pembayaran')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-money-check-alt w-5"></i>
                        <span>Pembayaran</span>
                    </div>
                    <span class="bg-orange-500 text-white text-xs rounded-full px-2 py-1">8</span>
                </button>
                <ul id="pembayaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li><a href="<?= base_url('admin/verifikasi') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Verifikasi Pembayaran</a></li>
                    <li><a href="<?= base_url('admin/riwayat-bayar') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Riwayat Pembayaran</a></li>
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
                    <li><a href="<?= base_url('admin/lap-barang') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Barang</a></li>
                    <li><a href="<?= base_url('admin/lap-pemenang') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Pemenang</a></li>
                    <li><a href="<?= base_url('admin/lap-transaksi') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Transaksi</a></li>
                    <li><a href="<?= base_url('admin/lap-export') ?>" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Export Data</a></li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="pt-4">
                <hr class="border-gray-200">
            </li>

        </ul>
    </div>
</aside>