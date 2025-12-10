<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">💰 Verifikasi Pembayaran</h2>

    <div class="bg-white shadow rounded p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3">Barang</th>
                    <th class="p-3">Total Bayar</th>
                    <th class="p-3">Metode</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bayar as $b): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?= $b['nama_barang'] ?></td>
                    <td class="p-3 text-blue-600 font-semibold">Rp <?= number_format($b['harga_menang']) ?></td>
                    <td class="p-3"><?= $b['metode'] ?></td>
                    <td class="p-3">
                        <?php if($b['status']=='pending'): ?>
                            <span class="text-yellow-600 font-semibold">Pending</span>
                        <?php elseif($b['status']=='paid'): ?>
                            <span class="text-green-600 font-semibold">Approved</span>
                        <?php else: ?>
                            <span class="text-red-600 font-semibold">Rejected</span>
                        <?php endif ?>
                    </td>
                    <td class="text-center p-3">
                        <a href="/admin/pembayaran/detail/<?= $b['id_bayar'] ?>" 
                           class="px-3 py-1 bg-blue-600 text-white rounded">Detail</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
