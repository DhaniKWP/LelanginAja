<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3>Data Kondisi Barang</h3>
<a href="/admin/kondisi/create" class="btn btn-primary my-3">+ Tambah Kondisi</a>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table table-bordered table-striped">
    <tr>
        <th>#</th>
        <th>Nama Kondisi</th>
        <th width="150">Aksi</th>
    </tr>
    <?php $no=1; foreach($kondisi as $k): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $k['nama_kondisi'] ?></td>
        <td>
            <a href="/admin/kondisi/edit/<?= $k['id_kondisi'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="/admin/kondisi/delete/<?= $k['id_kondisi'] ?>" onclick="return confirm('Hapus kondisi ini?')" class="btn btn-danger btn-sm">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?= $this->endSection() ?>
