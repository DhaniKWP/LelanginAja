<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">🏆 Status Pemenang Lelang</h2>

    <?php if(empty($pemenang)): ?>
        <div class="p-4 bg-gray-100 text-gray-600 rounded text-center">
            Kamu belum memenangkan lelang manapun.
        </div>
    <?php else: ?>
        <table class="min-w-full text-sm bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3 text-left">Barang</th>
                    <th class="p-3">Harga Menang</th>
                    <th class="p-3">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pemenang as $pm): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?= $pm['nama_barang'] ?></td>
                    <td class="p-3 font-bold text-blue-600">Rp <?= number_format($pm['harga_menang']) ?></td>
                    <td class="p-3">
                        <?php if($pm['status']=='pending' || $pm['status']==null): ?>
                            <a href="/user/pembayaran/<?= $pm['id_pemenang'] ?>" 
                            class="text-blue-600 underline font-semibold">Bayar Sekarang</a>
                        <?php elseif($pm['status']=='paid'): ?>
                            <span class="text-green-600 font-semibold">Sudah Dibayar</span>
                        <?php else: ?>
                            <span class="text-red-600 font-semibold">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>

<?= $this->endSection() ?>
