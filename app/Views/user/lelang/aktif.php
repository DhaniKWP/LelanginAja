<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-2xl font-semibold text-blue-700 mb-5">🔔 Lelang Aktif</h2>

    <?php if(empty($lelang)): ?>
        <div class="text-center p-6 bg-white shadow rounded">
            <p class="text-gray-600">Belum ada lelang yang berlangsung saat ini.</p>
        </div>
    <?php endif; ?>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">

        <?php foreach($lelang as $l): ?>
        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">

            <!-- Foto -->
            <img src="/uploads/barang/<?= $l['foto'] ?>" 
                 class="w-full h-40 object-cover">

            <div class="p-4 space-y-2">
                <h3 class="font-semibold text-lg text-gray-800"><?= $l['nama_barang'] ?></h3>

                <p class="text-gray-500 text-sm">Harga Awal:</p>
                <p class="text-blue-700 font-bold text-lg">Rp <?= number_format($l['harga_awal']) ?></p>

                <p class="text-gray-600 text-sm"><b>Mulai:</b> <?= date("d M Y H:i", strtotime($l['tanggal_mulai'])) ?></p>
                <p class="text-gray-600 text-sm"><b>Selesai:</b> <?= date("d M Y H:i", strtotime($l['tanggal_selesai'])) ?></p>

                <span class="inline-block px-3 py-1 bg-green-600 text-white rounded text-sm">
                    🔥 Aktif
                </span>
            </div>

            <div class="p-4 border-t flex gap-2">
                <a href="<?= base_url('user/lelang/detail/'.$l['id_lelang']) ?>"
                   class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                   Ikut Lelang
                </a>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>
