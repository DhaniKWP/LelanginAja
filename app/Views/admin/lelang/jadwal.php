<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">⏳ Jadwal Lelang</h2>
        <a href="/admin/lelang/create" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow transition">
            + Buat Jadwal Lelang
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full border-collapse text-left">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Barang</th>
                    <th class="px-4 py-3">Mulai</th>
                    <th class="px-4 py-3">Selesai</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($lelang as $l): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3"><?= $no++ ?></td>
                    <td class="px-4 py-3 font-medium text-blue-700"><?= $l['nama_barang'] ?></td>
                    <td class="px-4 py-3"><?= date('d M Y H:i', strtotime($l['tanggal_mulai'])) ?></td>
                    <td class="px-4 py-3"><?= date('d M Y H:i', strtotime($l['tanggal_selesai'])) ?></td>
                    <td class="px-4 py-3">
                        <?php if($l['status']=="aktif"): ?>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded text-sm">Aktif</span>
                        <?php elseif($l['status']=="selesai"): ?>
                            <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm">Selesai</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded text-sm">Dibatalkan</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="/admin/lelang/edit/<?= $l['id_lelang'] ?>" 
                           class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Edit</a>

                        <a href="/admin/lelang/delete/<?= $l['id_lelang'] ?>" 
                           onclick="return confirm('Hapus jadwal lelang ini?')" 
                           class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
