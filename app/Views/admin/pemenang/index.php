<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Daftar Pemenang Lelang
        </h2>
        <p class="text-sm text-gray-500">
            Rekap pemenang dari setiap lelang yang telah selesai
        </p>
    </div>

    <?php if (empty($pemenang)): ?>

        <!-- EMPTY STATE -->
        <div class="bg-white border rounded-lg p-8 text-center text-gray-500">
            Belum ada data pemenang lelang.
        </div>

    <?php else: ?>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach($pemenang as $p): ?>
        <div class="bg-white border rounded-xl overflow-hidden hover:shadow-md transition">

            <!-- FOTO -->
            <?php if (!empty($p['foto'])): ?>
                <img src="/uploads/barang/<?= esc($p['foto']) ?>"
                     class="w-full h-40 object-cover">
            <?php else: ?>
                <div class="w-full h-40 flex items-center justify-center bg-gray-100 text-gray-400 text-sm">
                    Tidak ada foto
                </div>
            <?php endif; ?>

            <!-- BODY -->
            <div class="p-4 space-y-2">

                <h3 class="font-semibold text-gray-800 text-lg">
                    <?= esc($p['nama_barang']) ?>
                </h3>

                <p class="text-sm text-gray-600">
                    Pemenang:
                    <span class="font-semibold text-green-700">
                        <?= esc($p['nama']) ?>
                    </span>
                </p>

                <p class="text-sm text-gray-600">
                    Harga Menang:
                    <span class="font-semibold text-blue-600">
                        Rp <?= number_format($p['harga_menang'], 0, ',', '.') ?>
                    </span>
                </p>

                <!-- AKSI -->
                <a href="<?= base_url('admin/pemenang/detail/'.$p['id_lelang']) ?>"
                   class="block mt-3 text-center px-4 py-2
                          bg-blue-600 hover:bg-blue-700
                          text-white text-sm font-semibold rounded">
                    Lihat Detail
                </a>

            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
