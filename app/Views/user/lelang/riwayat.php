<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">📊 Riwayat Penawaran Saya</h2>

    <?php if(empty($riwayat)): ?>
        <div class="p-4 bg-gray-100 text-gray-600 rounded text-center">
            Belum ada riwayat penawaran yang dilakukan.
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow p-5 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b bg-gray-50">
                        <th class="p-3 text-left">Barang</th>
                        <th class="p-3">Penawaran</th>
                        <th class="p-3">Waktu</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($riwayat as $r): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3"><?= $r['nama_barang'] ?></td>
                        <td class="p-3 font-semibold text-blue-600">Rp <?= number_format($r['harga_penawaran']) ?></td>
                        <td class="p-3"><?= date('d M Y H:i', strtotime($r['waktu_penawaran'])) ?></td>
                        <td class="p-3">
                            <?php if(!empty($r['is_highest']) && $r['is_highest'] == 1): ?>
                                <span class="text-green-600 font-semibold">Tertinggi</span>
                            <?php else: ?>
                                <span class="text-gray-500">Bid Lain Lebih Tinggi</span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
