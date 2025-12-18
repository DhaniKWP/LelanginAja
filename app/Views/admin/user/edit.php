<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Edit User
    </h2>
    <p class="text-sm text-gray-500">
        Perbarui data akun pengguna
    </p>
</div>

<!-- FORM -->
<div class="bg-white border rounded-lg p-6 max-w-xl">

<form action="<?= base_url('admin/user/update/'.$user['id_user']) ?>" method="POST" class="space-y-4">

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Nama Lengkap
        </label>
        <input type="text" name="nama"
               value="<?= esc($user['nama']) ?>" required
               class="w-full border rounded px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Email
        </label>
        <input type="email" name="email"
               value="<?= esc($user['email']) ?>" required
               class="w-full border rounded px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Password
        </label>
        <input type="password" name="password"
               placeholder="Kosongkan jika tidak diubah"
               class="w-full border rounded px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
        <p class="text-xs text-gray-400 mt-1">
            Biarkan kosong jika tidak ingin mengganti password
        </p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Role
        </label>
        <select name="role"
                class="w-full border rounded px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
            <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
        </select>
    </div>

    <!-- ACTION -->
    <div class="flex gap-4 pt-2">
        <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
            Update
        </button>

        <a href="<?= base_url('admin/user') ?>"
           class="px-5 py-2 border text-sm rounded hover:bg-gray-50">
            Batal
        </a>
    </div>

</form>
</div>

<?= $this->endSection() ?>
