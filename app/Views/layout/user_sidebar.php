<aside class="w-64 bg-white h-screen fixed shadow-xl overflow-y-auto border-r border-gray-200">
    <div class="p-6">
        <ul class="space-y-2">

            <!-- Dashboard -->
            <li>
                <a href="<?= base_url('user/dashboard') ?>" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl 
                   <?= uri_string()=='user/dashboard'
                        ? 'bg-blue-600 text-white shadow'
                        : 'hover:bg-blue-50 text-gray-700' ?>">
                    <i class="fas fa-home w-5"></i> <span>Dashboard</span>
                </a>
            </li> 

            <?php
            $isLelangActive     = str_contains(uri_string(), 'user/lelang');
            $isBarangActive     = str_contains(uri_string(), 'user/barang');
            $isPembayaranActive = str_contains(uri_string(), 'user/pembayaran');
            ?>

            <!-- Lelang -->
            <li>
                <button onclick="toggleSubmenu('lelang')" 
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                    <?= $isLelangActive ? 'bg-blue-50 text-blue-600' : 'hover:bg-blue-50 text-gray-700' ?>">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-gavel w-5"></i><span>Lelang</span>
                    </div>
                    <i id="lelang-icon"
                       class="fas fa-chevron-down text-sm transition-transform
                       <?= $isLelangActive ? 'rotate-180' : '' ?>"></i>
                </button>

                <ul id="lelang-submenu"
                    class="ml-8 mt-2 space-y-1 <?= $isLelangActive ? '' : 'hidden' ?>">
                    <li>
                        <a href="<?= base_url('user/lelang/aktif') ?>"
                           class="block px-4 py-2 rounded-lg text-sm
                           <?= uri_string()=='user/lelang/aktif'
                                ? 'bg-blue-100 text-blue-700 font-medium'
                                : 'hover:bg-blue-50 text-gray-600' ?>">
                            Lelang Aktif
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/lelang/riwayat') ?>"
                           class="block px-4 py-2 rounded-lg text-sm
                           <?= uri_string()=='user/lelang/riwayat'
                                ? 'bg-blue-100 text-blue-700 font-medium'
                                : 'hover:bg-blue-50 text-gray-600' ?>">
                            Riwayat Penawaran
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/lelang/pemenang') ?>"
                           class="block px-4 py-2 rounded-lg text-sm
                           <?= uri_string()=='user/lelang/pemenang'
                                ? 'bg-blue-100 text-blue-700 font-medium'
                                : 'hover:bg-blue-50 text-gray-600' ?>">
                            Status Pemenang
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Barang Saya -->
            <li>
                <button onclick="toggleSubmenu('barang')" 
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                    <?= $isBarangActive ? 'bg-blue-50 text-blue-600' : 'hover:bg-blue-50 text-gray-700' ?>">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-box w-5"></i><span>Barang Saya</span>
                    </div>
                    <i id="barang-icon"
                       class="fas fa-chevron-down text-sm transition-transform
                       <?= $isBarangActive ? 'rotate-180' : '' ?>"></i>
                </button>

                <ul id="barang-submenu"
                    class="ml-8 mt-2 space-y-1 <?= $isBarangActive ? '' : 'hidden' ?>">
                    <li><a href="<?= base_url('user/barang/create') ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm">Ajukan Barang</a></li>
                    <li><a href="<?= base_url('user/barang') ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm">Barang Saya</a></li>
                    <li><a href="<?= base_url('user/barang/hasil') ?>" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm">Hasil Lelang</a></li>
                </ul>
            </li>

            <!-- Pembayaran -->
            <li>
                <button onclick="toggleSubmenu('pembayaran')" 
                    class="w-full flex items-center justify-between px-4 py-3 rounded-xl
                    <?= $isPembayaranActive ? 'bg-blue-50 text-blue-600' : 'hover:bg-blue-50 text-gray-700' ?>">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-credit-card w-5"></i><span>Pembayaran</span>
                    </div>
                    <i id="pembayaran-icon"
                       class="fas fa-chevron-down text-sm transition-transform
                       <?= $isPembayaranActive ? 'rotate-180' : '' ?>"></i>
                </button>

                <ul id="pembayaran-submenu"
                    class="ml-8 mt-2 space-y-1 <?= $isPembayaranActive ? '' : 'hidden' ?>">
                    <li>
                        <a href="<?= base_url('user/pembayaran/history') ?>"
                           class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm">
                            History Pembayaran
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>

<script>
function toggleSubmenu(id) {
    const menu = document.getElementById(id + '-submenu');
    const icon = document.getElementById(id + '-icon');
    menu.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
