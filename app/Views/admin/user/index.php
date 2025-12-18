<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Manajemen User
    </h2>
    <p class="text-sm text-gray-500">
        Daftar pengguna yang terdaftar pada sistem lelang
    </p>
</div>

<div class="flex justify-end mb-4">
    <a href="<?= base_url('admin/user/create') ?>"
       class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
        + Tambah User
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
            <th class="p-3 border text-left">Nama</th>
            <th class="p-3 border text-left">Username</th>
            <th class="p-3 border text-left">Email</th>
            <th class="p-3 border text-center">Role</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($users)): ?>
        <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">
                Data user belum tersedia
            </td>
        </tr>
    <?php else: ?>

        <?php $no=1; foreach($users as $u): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center"><?= $no++ ?></td>

            <td class="p-3 border"><?= esc($u['nama']) ?></td>

            <td class="p-3 border"><?= esc($u['username']) ?></td>

            <td class="p-3 border"><?= esc($u['email']) ?></td>

            <td class="p-3 border text-center">
                <?= ucfirst($u['role']) ?>
            </td>

            <td class="p-3 border text-center space-x-3">
                <a href="<?= base_url('admin/user/edit/'.$u['id_user']) ?>"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>

                <a href="<?= base_url('admin/user/delete/'.$u['id_user']) ?>"
                   onclick="return confirm('Yakin ingin menghapus user ini?')"
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
