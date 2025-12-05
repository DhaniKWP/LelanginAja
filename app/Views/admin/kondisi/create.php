<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3>Tambah Kondisi Barang</h3>
<form method="post" action="/admin/kondisi/store" style="max-width:400px" class="mt-3">
    <label>Nama Kondisi</label>
    <input class="form-control" name="nama_kondisi" required>
    <button class="btn btn-success mt-3">Simpan</button>
    <a href="/admin/kondisi" class="btn btn-secondary mt-3">Kembali</a>
</form>

<?= $this->endSection() ?>
