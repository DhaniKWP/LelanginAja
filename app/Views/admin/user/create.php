<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h2 class="text-xl font-bold mb-4 text-blue-700">➕ Tambah User</h2>

<form action="/admin/user/store" method="POST" class="space-y-3 bg-white p-5 rounded shadow">
    <input type="text" name="nama" placeholder="Nama Lengkap" required class="form-control">
    <input type="text" name="username" placeholder="Username" required class="form-control">
    <input type="email" name="email" placeholder="Email" required class="form-control">
    <input type="password" name="password" placeholder="Password" required class="form-control">

    <select name="role" class="form-control" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
</form>

<?= $this->endSection() ?>
