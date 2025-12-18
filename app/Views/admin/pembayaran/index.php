<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Verifikasi Pembayaran
    </h2>
    <p class="text-sm text-gray-500">
        Daftar pembayaran dari pemenang lelang yang menunggu verifikasi
    </p>
</div>

<!-- TABLE -->
<div class="bg-white border rounded-lg overflow-hidden">
<table class="w-full text-sm border-collapse">

    <thead class="bg-gray-50 text-gray-700">
        <tr>
            <th class="p-3 border text-left">Barang</th>
            <th class="p-3 border text-right">Total Bayar</th>
            <th class="p-3 border text-center">Metode</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($bayar)): ?>
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                Belum ada pembayaran masuk
            </td>
        </tr>
    <?php else: ?>

        <?php foreach($bayar as $b): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border font-medium">
                <?= esc($b['nama_barang']) ?>
            </td>

            <td class="p-3 border text-right text-blue-600 font-semibold">
                Rp <?= number_format($b['harga_menang']) ?>
            </td>

            <td class="p-3 border text-center text-gray-600">
                <?= esc($b['metode']) ?>
            </td>

            <td class="p-3 border text-center">
                <?php if($b['status'] === 'pending'): ?>
                    <span class="text-yellow-600 font-medium">Pending</span>
                <?php elseif($b['status'] === 'paid'): ?>
                    <span class="text-green-600 font-medium">Disetujui</span>
                <?php else: ?>
                    <span class="text-red-600 font-medium">Ditolak</span>
                <?php endif; ?>
            </td>

            <td class="p-3 border text-center">
                <a href="<?= base_url('admin/pembayaran/detail/'.$b['id_bayar']) ?>"
                   class="text-blue-600 hover:underline">
                    Detail
                </a>
            </td>

        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
</div>

<?= $this->endSection() ?>
