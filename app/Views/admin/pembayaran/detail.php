<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Detail Pembayaran
    </h2>
    <p class="text-sm text-gray-500">
        Informasi pembayaran dari pemenang lelang
    </p>
</div>

<!-- CONTENT -->
<div class="bg-white border rounded-lg p-6 max-w-3xl">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

        <div class="space-y-2">
            <p><span class="text-gray-500">Barang</span></p>
            <p class="font-semibold text-gray-800">
                <?= esc($bayar['nama_barang']) ?>
            </p>
        </div>

        <div class="space-y-2">
            <p><span class="text-gray-500">Total Dibayar</span></p>
            <p class="font-semibold text-blue-600">
                Rp <?= number_format($bayar['harga_menang']) ?>
            </p>
        </div>

        <div class="space-y-2">
            <p><span class="text-gray-500">Metode Pembayaran</span></p>
            <p class="font-medium">
                <?= esc($bayar['metode']) ?>
            </p>
        </div>

        <div class="space-y-2">
            <p><span class="text-gray-500">Status</span></p>
            <p class="font-medium">
                <?php if($bayar['status'] === 'pending'): ?>
                    <span class="text-yellow-600">Pending</span>
                <?php elseif($bayar['status'] === 'paid'): ?>
                    <span class="text-green-600">Disetujui</span>
                <?php else: ?>
                    <span class="text-red-600">Ditolak</span>
                <?php endif; ?>
            </p>
        </div>

    </div>

    <!-- BUKTI -->
    <div class="mt-6">
        <p class="text-sm text-gray-500 mb-2">Bukti Transfer</p>
        <img src="/uploads/bukti/<?= esc($bayar['bukti_transfer']) ?>"
             class="w-80 border rounded shadow-sm">
    </div>

    <!-- ACTION -->
    <?php if($bayar['status'] === 'pending'): ?>
    <div class="flex gap-6 mt-6 text-sm">

        <a href="<?= base_url('admin/pembayaran/verifikasi/'.$bayar['id_bayar'].'/paid') ?>"
           onclick="return confirm('Setujui pembayaran ini?')"
           class="text-green-600 hover:underline font-medium">
            Setujui Pembayaran
        </a>

        <a href="<?= base_url('admin/pembayaran/verifikasi/'.$bayar['id_bayar'].'/rejected') ?>"
           onclick="return confirm('Tolak pembayaran ini?')"
           class="text-red-600 hover:underline font-medium">
            Tolak Pembayaran
        </a>

    </div>
    <?php endif; ?>

    <!-- BACK -->
    <div class="mt-8">
        <a href="<?= base_url('admin/pembayaran') ?>"
           class="text-sm text-gray-600 hover:underline">
            ← Kembali ke daftar pembayaran
        </a>
    </div>

</div>

<?= $this->endSection() ?>
