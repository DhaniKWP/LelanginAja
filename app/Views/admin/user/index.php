<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-bold text-blue-700">👥 Manajemen User</h2>
    <a href="/admin/user/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">+ Tambah User</a>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-3">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<div class="bg-white shadow rounded p-4">
<table class="w-full text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">#</th>
            <th class="p-2">Nama</th>
            <th class="p-2">Username</th>
            <th class="p-2">Email</th>
            <th class="p-2">Role</th>
            <th class="p-2" width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no=1; foreach($users as $u): ?>
        <tr class="border-b">
            <td class="p-2"><?= $no++ ?></td>
            <td class="p-2"><?= $u['nama'] ?></td>
            <td class="p-2"><?= $u['username'] ?></td>
            <td class="p-2"><?= $u['email'] ?></td>
            <td class="p-2">
                <span class="px-2 py-1 text-xs rounded 
                <?= $u['role']=='admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' ?>">
                    <?= $u['role'] ?>
                </span>
            </td>
            <td class="p-2">
                <a href="/admin/user/edit/<?= $u['id_user'] ?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                <a href="/admin/user/delete/<?= $u['id_user'] ?>" onclick="return confirm('Hapus user ini?')" class="text-red-600 hover:underline">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?= $this->endSection() ?>
