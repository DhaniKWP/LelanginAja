<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<h3>Barang Saya</h3>
<a href="/user/barang/create" class="btn btn-primary my-3">+ Ajukan Barang</a>

<table class="table table-bordered">
<tr>
    <th>Foto</th><th>Nama Barang</th><th>Harga</th><th>Status</th>
</tr>
<?php foreach($barang as $b): ?>
<tr>
    <td><img src="/uploads/barang/<?= $b['foto'] ?>" width="80"></td>
    <td><?= $b['nama_barang'] ?></td>
    <td>Rp <?= number_format($b['harga_awal']) ?></td>
    <td>
        <?php if($b['status_pengajuan']=='pending'): ?>
            <span class="badge bg-warning">Pending</span>
        <?php elseif($b['status_pengajuan']=='approved'): ?>
            <span class="badge bg-success">Approved</span>
        <?php else: ?>
            <span class="badge bg-danger">Rejected</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>
