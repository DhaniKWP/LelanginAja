<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<h3>Ajukan Barang Lelang</h3>

<form action="/user/barang/store" method="post" enctype="multipart/form-data" style="max-width:500px">

<label>Nama Barang</label>
<input class="form-control" name="nama_barang" required>

<label>Kategori</label>
<select class="form-control" name="kategori_id" required>
    <?php foreach($kategori as $k): ?>
        <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
    <?php endforeach; ?>
</select>

<label>Kondisi</label>
<select class="form-control" name="kondisi_id" required>
    <?php foreach($kondisi as $ko): ?>
        <option value="<?= $ko['id_kondisi'] ?>"><?= $ko['nama_kondisi'] ?></option>
    <?php endforeach; ?>
</select>

<label>Harga Awal</label>
<input class="form-control" type="number" name="harga_awal" required>

<label>Deskripsi</label>
<textarea class="form-control" name="deskripsi"></textarea>

<label>Foto Barang</label>
<input type="file" class="form-control" name="foto" required>

<button class="btn btn-success mt-3">Ajukan Barang</button>
<a href="/user/barang" class="btn btn-secondary mt-3">Kembali</a>

</form>

<?= $this->endSection() ?>
