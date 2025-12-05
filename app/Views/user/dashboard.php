<?= $this->extend('layout/user_main') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h2>
    <p class="text-gray-600">
        Selamat datang kembali, 
        <span class="font-semibold text-blue-600">
            <?= esc($user['nama'] ?? 'John Doe') ?>
        </span>!
    </p>
</div>

<!-- Search Bar -->
<div class="mb-8">
    <div class="relative">
        <input type="text" 
               placeholder="Cari barang lelang..." 
               class="w-full px-6 py-4 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pl-14 shadow-sm"
               id="searchInput">
        <i class="fas fa-search absolute left-5 top-5 text-gray-400"></i>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Card 1: Total Barang -->
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Barang</p>
                <h3 class="text-4xl font-bold mt-2"><?= $stats['total_barang'] ?? 0 ?></h3>
                <p class="text-blue-100 text-xs mt-2">
                    <i class="fas fa-arrow-up"></i> +<?= $stats['barang_bulan_ini'] ?? 0 ?> bulan ini
                </p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                <i class="fas fa-box text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Card 2: Barang Aktif -->
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Barang Aktif</p>
                <h3 class="text-4xl font-bold mt-2"><?= $stats['barang_aktif'] ?? 0 ?></h3>
                <p class="text-green-100 text-xs mt-2">
                    <i class="fas fa-check-circle"></i> Sedang lelang
                </p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                <i class="fas fa-check-circle text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Card 3: Lelang Dimenangkan -->
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm font-medium">Lelang Dimenangkan</p>
                <h3 class="text-4xl font-bold mt-2"><?= $stats['total_menang'] ?? 0 ?></h3>
                <p class="text-yellow-100 text-xs mt-2">
                    <i class="fas fa-trophy"></i> Total kemenangan
                </p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                <i class="fas fa-trophy text-3xl"></i>
            </div>
        </div>
    </div>

    <!-- Card 4: Total Penawaran -->
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Total Penawaran</p>
                <h3 class="text-4xl font-bold mt-2"><?= $stats['total_penawaran'] ?? 0 ?></h3>
                <p class="text-purple-100 text-xs mt-2">
                    <i class="fas fa-hand-holding-usd"></i> Bid aktif
                </p>
            </div>
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                <i class="fas fa-hand-holding-usd text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Barang Lelang Populer -->
<div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-fire text-orange-500"></i> Barang Lelang Populer
        </h3>
        <a href="<?= base_url('user/lelang-aktif') ?>" 
           class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-2 hover:gap-3 transition-all">
            Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <?php if (!empty($barang_populer)): ?>
            <?php foreach ($barang_populer as $barang): ?>
                <!-- Item Card -->
                <div class="border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 bg-white">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                        <?php if (!empty($barang['foto'])): ?>
                            <img src="<?= base_url('uploads/barang/' . $barang['foto']) ?>" 
                                 alt="<?= esc($barang['nama']) ?>"
                                 class="w-full h-full object-cover">
                        <?php else: ?>
                            <i class="fas fa-box text-blue-500 text-6xl"></i>
                        <?php endif; ?>
                    </div>
                    <div class="p-5">
                        <h4 class="font-bold text-gray-800 mb-2 text-lg">
                            <?= esc($barang['nama']) ?>
                        </h4>
                        <p class="text-sm text-gray-500 mb-4">
                            <?= esc($barang['kategori']) ?> • Kondisi: <?= esc($barang['kondisi']) ?>
                        </p>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Harga Saat Ini</p>
                                <p class="text-xl font-bold text-blue-600">
                                    Rp <?= number_format($barang['harga_saat_ini'], 0, ',', '.') ?>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 mb-1">Total Bid</p>
                                <p class="text-xl font-bold text-gray-800">
                                    <?= $barang['total_bid'] ?? 0 ?>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-orange-600 mb-4 bg-orange-50 px-3 py-2 rounded-lg">
                            <i class="fas fa-clock"></i>
                            <span class="font-medium"><?= $barang['waktu_tersisa'] ?></span>
                        </div>
                        <a href="<?= base_url('user/lelang-detail/' . $barang['id']) ?>" 
                           class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl text-center">
                            <i class="fas fa-gavel"></i> Ikut Lelang
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada barang lelang populer</p>
            </div>
        <?php endif; ?>
        
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Search functionality
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    // Implement search logic here
    console.log('Searching for:', searchTerm);
});
</script>
<?= $this->endSection() ?>