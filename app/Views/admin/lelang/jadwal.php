<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h3 class="mb-3">📅 Jadwal Lelang</h3>

    <a href="/admin/lelang/create" class="btn btn-primary mb-3">+ Buat Jadwal Lelang</a>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Tgl Mulai</th>
            <th>Tgl Selesai</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; foreach($lelang as $l): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $l['nama_barang'] ?></td>
            <td><?= date('d-m-Y H:i', strtotime($l['tanggal_mulai'])) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($l['tanggal_selesai'])) ?></td>
            <td>
                <span class="badge bg-<?= $l['status']=='aktif'?'success':'secondary' ?>">
                    <?= $l['status'] ?>
                </span>
            </td>
            <td>
                <a href="#" class="btn btn-info btn-sm">Detail</a>
                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm"
                   onclick="return confirm('Hapus jadwal lelang ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?= $this->endSection() ?>
