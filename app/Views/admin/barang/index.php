<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Manajemen Semua Barang Lelang</h3>

<table class="table table-bordered table-striped">
<tr>
    <th>Foto</th>
    <th>Nama Barang</th>
    <th>Kategori</th>
    <th>Kondisi</th>
    <th>Harga Awal</th>
    <th>Status Pengajuan</th>
    <th>Status Lelang</th>
    <th>Tgl Pengajuan</th>
    <th>Tgl Mulai</th>
    <th>Tgl Selesai</th>
    <th>Aksi</th>
</tr>

<?php foreach($barang as $b): ?>
<tr>
    <td><img src="/uploads/barang/<?= $b['foto'] ?>" width="60" style="border-radius:5px;"></td>

    <td><?= $b['nama_barang'] ?></td>
    <td><?= $b['kategori_id'] ?></td>
    <td><?= $b['kondisi_id'] ?></td>
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

    <td><?= $b['status'] ?></td>
    <td><?= $b['tanggal_pengajuan'] ?></td>
    <td><?= $b['tanggal_mulai'] ?></td>
    <td><?= $b['tanggal_selesai'] ?></td>

    <td>
        <!-- Approve Reject -->
        <?php if($b['status_pengajuan']=='pending'): ?>
            <a href="/admin/barang/approve/<?= $b['id_barang'] ?>" class="btn btn-success btn-sm">Approve</a>
            <a href="/admin/barang/reject/<?= $b['id_barang'] ?>" class="btn btn-warning btn-sm">Reject</a>
        <?php endif; ?>

        <a href="/admin/barang/edit/<?= $b['id_barang'] ?>" class="btn btn-primary btn-sm mt-1">Edit</a>
        <a href="/admin/barang/delete/<?= $b['id_barang'] ?>" 
           onclick="return confirm('Hapus barang ini?')" 
           class="btn btn-danger btn-sm mt-1">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>
