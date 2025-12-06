<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="container mt-4" style="max-width:600px">
    <h3 class="mb-3">Tambah Jadwal Lelang</h3>

    <form action="/admin/lelang/store" method="POST">

        <label class="form-label">Pilih Barang</label>
        <select name="id_barang" class="form-select mb-3" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach($barang as $b): ?>
            <option value="<?= $b['id_barang'] ?>">
                <?= $b['nama_barang'] ?> - Rp<?= number_format($b['harga_awal']) ?>
            </option>
            <?php endforeach; ?>
        </select>

        <label class="form-label">Tanggal Mulai</label>
        <input type="datetime-local" name="tanggal_mulai" class="form-control mb-3" required>

        <label class="form-label">Tanggal Selesai</label>
        <input type="datetime-local" name="tanggal_selesai" class="form-control mb-3" required>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/lelang/jadwal" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= $this->endSection() ?>
