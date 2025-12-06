<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            📦 Pengajuan Barang Pending
        </h2>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="overflow-auto bg-white rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-yellow-500 text-white">
                <tr>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nama Barang</th>
                    <th class="px-4 py-3">Harga Awal</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($barang as $b): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <img src="/uploads/barang/<?= $b['foto'] ?>" class="w-16 h-16 object-cover rounded shadow">
                    </td>

                    <td class="px-4 py-3 font-semibold"><?= $b['nama_barang'] ?></td>
                    <td class="px-4 py-3 text-blue-700 font-medium">Rp <?= number_format($b['harga_awal']) ?></td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-white bg-yellow-500 rounded text-sm">
                            <?= ucfirst($b['status_pengajuan']) ?>
                        </span>
                    </td>

                    <td class="px-4 py-3 flex justify-center gap-2">
                        <a href="/admin/pengajuanbarang/approve/<?= $b['id_barang'] ?>" 
                           class="px-3 py-1 text-white bg-green-600 hover:bg-green-700 rounded text-sm shadow">
                           Approve
                        </a>
                        <a href="/admin/pengajuanbarang/reject/<?= $b['id_barang'] ?>" 
                           onclick="return confirm('Tolak barang ini?')"
                           class="px-3 py-1 text-white bg-red-600 hover:bg-red-700 rounded text-sm shadow">
                           Reject
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>
