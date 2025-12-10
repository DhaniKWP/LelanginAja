<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-xl mx-auto">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">💸 Pembayaran Lelang</h2>

    <div class="bg-white shadow rounded p-5 space-y-4">
        <p><b>Barang:</b> <?= $pemenang['nama_barang'] ?? 'Barang Lelang' ?></p>
        <p><b>Total Bayar:</b> Rp <?= number_format($pemenang['harga_menang']) ?></p>

        <form action="/user/pembayaran/submit/<?= $pemenang['id_pemenang'] ?>" method="POST" enctype="multipart/form-data" class="space-y-4">

            <div>
                <label class="font-medium">Metode Pembayaran</label>
                <select name="metode" class="w-full border rounded px-3 py-2 mt-1">
                    <option hidden>Pilih Metode</option>
                    <option>Transfer Bank</option>
                    <option>QRIS</option>
                    <option>E-Wallet</option>
                </select>
            </div>

            <div>
                <label>Upload Bukti Transfer</label>
                <input type="file" name="bukti_transfer" class="w-full border px-3 py-2 rounded" required>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded w-full">
                Kirim Pembayaran
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
