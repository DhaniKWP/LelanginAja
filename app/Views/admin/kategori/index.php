<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-3">Data Kategori Barang</h3>

    <a href="/admin/kategori/create" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th width="150px">Aksi</th>
        </tr>

        <?php $no=1; foreach($kategori as $k): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><b><?= $k['id_kategori'] ?></b></td>
            <td><?= $k['nama_kategori'] ?></td>
            <td>
                <a href="/admin/kategori/edit/<?= $k['id_kategori'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/admin/kategori/delete/<?= $k['id_kategori'] ?>" onclick="return confirm('Hapus kategori ini?')" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?= $this->endSection() ?>
