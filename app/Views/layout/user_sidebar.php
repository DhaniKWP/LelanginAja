<!-- User Sidebar Component -->
<aside class="w-64 bg-white h-screen fixed shadow-xl overflow-y-auto border-r border-gray-200">
    <div class="p-6">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="<?= base_url('user/dashboard') ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl <?= uri_string() == 'user/dashboard' ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'hover:bg-blue-50 text-gray-700' ?> transition">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Barang Saya -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" 
                        onclick="toggleSubmenu('barang')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-box w-5 text-blue-500"></i>
                        <span>Barang Saya</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm transition-transform" id="barang-icon"></i>
                </button>
                <ul id="barang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li>
                        <a href="<?= base_url('user/ajukan-barang') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Ajukan Barang
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/barang-saya') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Status Barang
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Lelang -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" 
                        onclick="toggleSubmenu('lelang')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-gavel w-5 text-blue-500"></i>
                        <span>Lelang</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm transition-transform" id="lelang-icon"></i>
                </button>
                <ul id="lelang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li>
                        <a href="<?= base_url('user/lelang-aktif') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Lelang Aktif
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/riwayat-penawaran') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Riwayat Penawaran
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/status-pemenang') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Status Pemenang
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pembayaran -->
            <li>
                <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" 
                        onclick="toggleSubmenu('pembayaran')">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-credit-card w-5 text-blue-500"></i>
                        <span>Pembayaran</span>
                    </div>
                    <i class="fas fa-chevron-down text-sm transition-transform" id="pembayaran-icon"></i>
                </button>
                <ul id="pembayaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                    <li>
                        <a href="<?= base_url('user/pembayaran') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Upload Bukti
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/status-pembayaran') ?>" 
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">
                            Status Pembayaran
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="pt-4">
                <hr class="border-gray-200">
            </li>

        </ul>
    </div>
</aside>

<script>
function toggleSubmenu(id) {
    const submenu = document.getElementById(id + '-submenu');
    const icon = document.getElementById(id + '-icon');
    
    submenu.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>