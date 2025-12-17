<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">🏆 Daftar Pemenang Lelang</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach($pemenang as $p): ?>
        <div class="bg-white shadow rounded-xl p-4">

            <img src="/uploads/barang/<?= $p['foto'] ?>"
                 class="w-full h-40 object-cover rounded-lg mb-3">

            <h3 class="font-semibold text-lg"><?= esc($p['nama_barang']) ?></h3>

            <p class="text-sm text-gray-600">
                Pemenang:
                <b class="text-green-700"><?= esc($p['nama']) ?></b>
            </p>

            <p class="text-sm">
                Harga Menang:
                <b class="text-blue-600">
                    Rp <?= number_format($p['harga_menang']) ?>
                </b>
            </p>

            <a href="<?= base_url('admin/pemenang/detail/'.$p['id_lelang']) ?>"
               class="block mt-4 text-center bg-blue-600 hover:bg-blue-700
                      text-white py-2 rounded-lg font-semibold">
                Lihat Detail
            </a>

        </div>
        <?php endforeach; ?>

        <?php if(empty($pemenang)): ?>
            <p class="text-gray-500">Belum ada pemenang.</p>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>
