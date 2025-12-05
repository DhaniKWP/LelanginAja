<?= $this->extend('layout/admin_main') ?>

<?= $this->section('title') ?>
Dashboard Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin</h2>
    <p class="text-gray-600 mt-1">Selamat datang kembali, Admin!</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Total User -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total User</p>
                <h3 class="text-3xl font-bold mt-2">248</h3>
                <p class="text-blue-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +12 minggu ini</p>
            </div>
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Barang Aktif -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Barang Aktif</p>
                <h3 class="text-3xl font-bold mt-2">45</h3>
                <p class="text-green-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +5 hari ini</p>
            </div>
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-box text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Pending Approval -->
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-orange-100 text-sm font-medium">Pending Approval</p>
                <h3 class="text-3xl font-bold mt-2">12</h3>
                <p class="text-orange-100 text-xs mt-2"><i class="fas fa-clock"></i> Perlu review</p>
            </div>
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-inbox text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Total Transaksi</p>
                <h3 class="text-3xl font-bold mt-2">Rp 2.8M</h3>
                <p class="text-purple-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +18% bulan ini</p>
            </div>
            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <h3 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-bolt text-yellow-500"></i> Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition">
            <i class="fas fa-check-circle text-blue-500 text-3xl"></i>
            <span class="text-sm font-medium text-gray-700">Approve Barang</span>
        </button>
        <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-green-500 hover:bg-green-50 transition">
            <i class="fas fa-play-circle text-green-500 text-3xl"></i>
            <span class="text-sm font-medium text-gray-700">Mulai Lelang</span>
        </button>
        <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition">
            <i class="fas fa-file-invoice text-purple-500 text-3xl"></i>
            <span class="text-sm font-medium text-gray-700">Verifikasi Bayar</span>
        </button>
        <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-50 transition">
            <i class="fas fa-download text-orange-500 text-3xl"></i>
            <span class="text-sm font-medium text-gray-700">Export Laporan</span>
        </button>
    </div>
</div>

<!-- Two Column Layout -->
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    
    <!-- Pending Approval -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-clock text-orange-500"></i> Pending Approval</h3>
            <a href="<?= base_url('admin/pengajuan') ?>" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-laptop text-blue-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">Laptop Gaming ASUS ROG</h5>
                    <p class="text-xs text-gray-500">User: John Doe • 2 jam lalu</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-mobile-alt text-green-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">iPhone 15 Pro Max</h5>
                    <p class="text-xs text-gray-500">User: Jane Smith • 4 jam lalu</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-motorcycle text-purple-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">Honda Vario 160</h5>
                    <p class="text-xs text-gray-500">User: Ahmad Ali • 1 hari lalu</p>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lelang Berakhir Hari Ini -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-hourglass-end text-red-500"></i> Lelang Berakhir Hari Ini</h3>
            <a href="<?= base_url('admin/aktif') ?>" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-car text-red-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">Toyota Avanza 2020</h5>
                    <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 2 jam</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-blue-600">Rp 150jt</p>
                    <p class="text-xs text-gray-500">18 bid</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-camera text-orange-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">Kamera Canon EOS R6</h5>
                    <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 5 jam</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-blue-600">Rp 28jt</p>
                    <p class="text-xs text-gray-500">25 bid</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-watch text-yellow-500 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h5 class="font-semibold text-gray-800">Apple Watch Ultra 2</h5>
                    <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 8 jam</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-bold text-blue-600">Rp 12jt</p>
                    <p class="text-xs text-gray-500">32 bid</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Aktivitas Terbaru -->
<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-history text-blue-500"></i> Aktivitas Terbaru</h3>
    <div class="space-y-4">
        <div class="flex items-start gap-4 pb-4 border-b">
            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-check text-green-500"></i>
            </div>
            <div class="flex-1">
                <p class="text-gray-800 font-medium">Barang "MacBook Pro M2" telah disetujui</p>
                <p class="text-xs text-gray-500">5 menit yang lalu</p>
            </div>
        </div>
        <div class="flex items-start gap-4 pb-4 border-b">
            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-gavel text-blue-500"></i>
            </div>
            <div class="flex-1">
                <p class="text-gray-800 font-medium">Lelang "iPhone 15 Pro" dimulai</p>
                <p class="text-xs text-gray-500">15 menit yang lalu</p>
            </div>
        </div>
        <div class="flex items-start gap-4 pb-4 border-b">
            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-money-check-alt text-purple-500"></i>
            </div>
            <div class="flex-1">
                <p class="text-gray-800 font-medium">Pembayaran "Honda Vario 160" telah diverifikasi</p>
                <p class="text-xs text-gray-500">1 jam yang lalu</p>
            </div>
        </div>
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-user-plus text-orange-500"></i>
            </div>
            <div class="flex-1">
                <p class="text-gray-800 font-medium">User baru "Sarah Williams" terdaftar</p>
                <p class="text-xs text-gray-500">2 jam yang lalu</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>