<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-2xl font-semibold text-blue-700 mb-4">👤 Status Peserta Lelang</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border p-3 rounded text-green-700 mb-3">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(!$peserta): ?>
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded mb-4">
            <p class="text-gray-700">Kamu belum terdaftar sebagai peserta.</p>
        </div>

        <a href="/user/peserta/daftar" 
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Daftar Sekarang</a>

    <?php else: ?>
        <div class="bg-white p-5 rounded shadow">
            <p><b>Alamat:</b> <?= $peserta['alamat'] ?></p>
            <p><b>No HP:</b> <?= $peserta['no_hp'] ?></p>
            <p class="text-green-600 font-semibold mt-2">✔ Kamu bisa ikut lelang sekarang!</p>
        </div>
    <?php endif ?>

</div>

<?= $this->endSection() ?>
