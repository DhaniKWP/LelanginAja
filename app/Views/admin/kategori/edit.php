<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3>Edit Kategori</h3>

    <form action="/admin/kategori/update/<?= $kategori['id_kategori'] ?>" method="POST" class="mt-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" value="<?= $kategori['nama_kategori'] ?>" class="form-control" required>

        <button class="btn btn-primary mt-3">Update</button>
        <a href="/admin/kategori" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
