<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3>Edit Kondisi</h3>
<form method="post" action="/admin/kondisi/update/<?= $kondisi['id_kondisi'] ?>" style="max-width:400px" class="mt-3">
    <label>Nama Kondisi</label>
    <input class="form-control" name="nama_kondisi" value="<?= $kondisi['nama_kondisi'] ?>" required>
    <button class="btn btn-success mt-3">Update</button>
    <a href="/admin/kondisi" class="btn btn-secondary mt-3">Batal</a>
</form>

<?= $this->endSection() ?>
