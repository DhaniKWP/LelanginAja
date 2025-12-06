<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3>Edit Barang Lelang</h3>

<form action="/admin/barang/update/<?= $barang['id_barang']; ?>" method="POST" enctype="multipart/form-data">

<div class="row">

    <div class="col-md-6">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="<?= $barang['nama_barang']; ?>" required>

        <label class="mt-2">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            <?php foreach($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>" 
                    <?= $barang['kategori_id']==$k['id_kategori']?'selected':''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="mt-2">Kondisi Barang</label>
        <select name="kondisi_id" class="form-control" required>
            <?php foreach($kondisi as $c): ?>
                <option value="<?= $c['id_kondisi']; ?>" 
                    <?= $barang['kondisi_id']==$c['id_kondisi']?'selected':''; ?>>
                    <?= $c['nama_kondisi']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="mt-2">Harga Awal</label>
        <input type="number" name="harga_awal" class="form-control" value="<?= $barang['harga_awal']; ?>" required>

        <label class="mt-2">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="4"><?= $barang['deskripsi']; ?></textarea>
    </div>

    <div class="col-md-6">
        <label>Foto Barang</label><br>
        <img src="/uploads/barang/<?= $barang['foto']; ?>" width="120" class="mb-2 rounded"><br>
        <input type="file" name="foto" class="form-control">
        <input type="hidden" name="foto_lama" value="<?= $barang['foto']; ?>">

        <label class="mt-2">Status Pengajuan</label>
        <select name="status_pengajuan" class="form-control">
            <option value="pending"  <?= $barang['status_pengajuan']=='pending'?'selected':''; ?>>Pending</option>
            <option value="approved" <?= $barang['status_pengajuan']=='approved'?'selected':''; ?>>Approved</option>
            <option value="rejected" <?= $barang['status_pengajuan']=='rejected'?'selected':''; ?>>Rejected</option>
        </select>

        <button class="btn btn-primary mt-3" type="submit">Simpan Perubahan</button>
        <a href="/admin/barang" class="btn btn-secondary mt-3">Kembali</a>
    </div>

</div>
</form>

<?= $this->endSection() ?>
