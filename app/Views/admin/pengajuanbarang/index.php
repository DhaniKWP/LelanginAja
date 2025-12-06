<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Pengajuan Barang Lelang (Pending)</h3>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<table class="table table-bordered table-striped">
<tr>
    <th>Foto</th><th>Nama</th><th>Harga Awal</th><th>Status</th><th>Aksi</th>
</tr>

<?php foreach($barang as $b): ?>
<tr>
    <td><img src="/uploads/barang/<?= $b['foto'] ?>" width="70"></td>
    <td><?= $b['nama_barang'] ?></td>
    <td>Rp <?= number_format($b['harga_awal']) ?></td>
    <td><span class="badge bg-warning"><?= $b['status_pengajuan'] ?></span></td>
    <td>
        <a href="/admin/pengajuanbarang/approve/<?= $b['id_barang'] ?>" class="btn btn-success btn-sm">Approve</a>
        <a href="/admin/pengajuanbarang/reject/<?= $b['id_barang'] ?>" class="btn btn-danger btn-sm">Reject</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>
