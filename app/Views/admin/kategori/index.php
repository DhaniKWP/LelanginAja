<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <div class="flex items-center justify-between mb-5">
        <h2 class="text-2xl font-semibold text-gray-800">📁 Data Kategori Barang</h2>
        <a href="/admin/kategori/create" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow">
           + Tambah Kategori
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="overflow-auto bg-white rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Nama Kategori</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($kategori as $k): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3"><?= $no++ ?></td>
                    <td class="px-4 py-3 font-semibold text-blue-700"><?= $k['id_kategori'] ?></td>
                    <td class="px-4 py-3"><?= $k['nama_kategori'] ?></td>
                    <td class="px-4 py-3 flex justify-center gap-2">
                        <a href="/admin/kategori/edit/<?= $k['id_kategori'] ?>" 
                           class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">Edit</a>

                        <a href="/admin/kategori/delete/<?= $k['id_kategori'] ?>" 
                           onclick="return confirm('Hapus kategori ini?')"
                           class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
