<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Manajemen Kondisi Barang
    </h2>
    <p class="text-sm text-gray-500">
        Daftar kondisi barang yang tersedia pada sistem lelang
    </p>
</div>

<div class="flex justify-end mb-4">
    <a href="<?= base_url('admin/kondisi/create') ?>"
       class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
        + Tambah Kondisi
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="mb-4 text-sm text-green-600">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<!-- TABLE -->
<div class="bg-white border rounded-lg overflow-hidden">
<table class="w-full text-sm border-collapse">

    <thead class="bg-gray-50 text-gray-700">
        <tr>
            <th class="p-3 border">No</th>
            <th class="p-3 border">ID</th>
            <th class="p-3 border text-left">Nama Kondisi</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($kondisi)): ?>
        <tr>
            <td colspan="4" class="p-4 text-center text-gray-500">
                Data kondisi belum tersedia
            </td>
        </tr>
    <?php else: ?>

        <?php $no=1; foreach($kondisi as $k): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center"><?= $no++ ?></td>

            <td class="p-3 border text-center text-gray-500">
                <?= esc($k['id_kondisi']) ?>
            </td>

            <td class="p-3 border font-medium">
                <?= esc($k['nama_kondisi']) ?>
            </td>

            <td class="p-3 border text-center space-x-3">
                <a href="<?= base_url('admin/kondisi/edit/'.$k['id_kondisi']) ?>"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>

                <a href="<?= base_url('admin/kondisi/delete/'.$k['id_kondisi']) ?>"
                   onclick="return confirm('Yakin ingin menghapus kondisi ini?')"
                   class="text-red-600 hover:underline">
                    Hapus
                </a>
            </td>

        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
</div>

<?= $this->endSection() ?>
