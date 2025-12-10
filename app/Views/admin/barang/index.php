<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">📦 Manajemen Semua Barang Lelang</h2>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nama Barang</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Kondisi</th>
                    <th class="px-4 py-3">Harga Awal</th>
                    <th class="px-4 py-3">Status Pengajuan</th>
                    <th class="px-4 py-3">Pengajuan</th>
                    <th class="px-4 py-3 text-center w-48">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($barang as $b): ?>
                <tr class="border-b hover:bg-gray-50">

                    <td class="px-4 py-3">
                        <img src="/uploads/barang/<?= $b['foto'] ?>" 
                             class="w-14 h-14 object-cover rounded-md shadow-sm">
                    </td>

                    <td class="px-4 py-3 font-semibold"><?= $b['nama_barang'] ?></td>

                    <!-- GANTI kategori_id -> nama_kategori -->
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs bg-blue-50 text-blue-700 rounded font-medium">
                            <?= $b['kategori_barang'] ?: '-' ?>
                        </span>
                    </td>

                    <!-- Kondisi tampilkan nilai ID atau bisa mapping -->
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs bg-gray-100 text-gray-700">
                            Kondisi ID: <?= $b['kondisi_id'] ?>
                        </span>
                    </td>

                    <td class="px-4 py-3 text-blue-700 font-medium">
                        Rp <?= number_format($b['harga_awal']) ?>
                    </td>

                    <td class="px-4 py-3">
                        <?php if($b['status_pengajuan']=='pending'): ?>
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs font-medium">Pending</span>
                        <?php elseif($b['status_pengajuan']=='approved'): ?>
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs font-medium">Approved</span>
                        <?php else: ?>
                            <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs font-medium">Rejected</span>
                        <?php endif; ?>
                    </td>

                    <td class="px-4 py-3 text-gray-600"><?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?></td>

                    <td class="px-4 py-3 text-center flex justify-center gap-2 flex-wrap">

                        <?php if($b['status_pengajuan']=='pending'): ?>
                            <a href="/admin/barang/approve/<?= $b['id_barang'] ?>" 
                                class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-xs shadow">
                                Approve
                            </a>
                            <a href="/admin/barang/reject/<?= $b['id_barang'] ?>" 
                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs shadow">
                                Reject
                            </a>
                        <?php endif; ?>

                        <a href="/admin/barang/edit/<?= $b['id_barang'] ?>" 
                           class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs shadow">
                           Edit
                        </a>

                        <a href="/admin/barang/delete/<?= $b['id_barang'] ?>" 
                           onclick="return confirm('Hapus barang ini?')" 
                           class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs shadow">
                           Hapus
                        </a>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
