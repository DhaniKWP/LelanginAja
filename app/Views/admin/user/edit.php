<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h2 class="text-xl font-bold mb-4 text-blue-700">✏ Edit User</h2>

<form action="/admin/user/update/<?= $user['id_user'] ?>" method="POST" class="space-y-3 bg-white p-5 rounded shadow">
    <input type="text" name="nama" value="<?= $user['nama'] ?>" required class="form-control">
    <input type="email" name="email" value="<?= $user['email'] ?>" required class="form-control">

    <input type="password" name="password" placeholder="Kosongkan jika tidak diganti" class="form-control">

    <select name="role" class="form-control">
        <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
    </select>

    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
</form>

<?= $this->endSection() ?>
