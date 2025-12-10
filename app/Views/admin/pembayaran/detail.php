<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">📄 Detail Pembayaran</h2>

    <div class="bg-white shadow rounded p-5 space-y-3">

        <p><b>Barang:</b> <?= $bayar['nama_barang'] ?></p>
        <p><b>Total Dibayar:</b> Rp <?= number_format($bayar['harga_menang']) ?></p>
        <p><b>Metode:</b> <?= $bayar['metode'] ?></p>
        <p><b>Status:</b> <?= $bayar['status'] ?></p>

        <hr>

        <p><b>Bukti Transfer:</b></p>
        <img src="/uploads/bukti/<?= $bayar['bukti_transfer'] ?>" class="w-72 rounded shadow">

        <div class="mt-5 flex gap-4">
            <a href="/admin/pembayaran/verifikasi/<?= $bayar['id_bayar'] ?>/paid"
               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Approve</a>

            <a href="/admin/pembayaran/verifikasi/<?= $bayar['id_bayar'] ?>/rejected"
               class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Reject</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
