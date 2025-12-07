<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-semibold text-blue-700 mb-4">✏ Edit Jadwal Lelang</h2>

    <form action="/admin/lelang/update/<?= $lelang['id_lelang'] ?>" method="POST" 
          class="bg-white p-6 rounded-lg shadow-md space-y-4">

        <!-- Barang -->
        <div>
            <label class="block font-medium">Pilih Barang</label>
            <select name="id_barang" class="w-full border rounded px-3 py-2" required>
                <?php foreach($barang as $b): ?>
                    <option value="<?= $b['id_barang'] ?>" 
                        <?= $b['id_barang'] == $lelang['id_barang'] ? 'selected' : '' ?>>
                        <?= $b['nama_barang'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block font-medium">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai"
                   value="<?= date('Y-m-d\TH:i', strtotime($lelang['tanggal_mulai'])) ?>"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-medium">Tanggal Selesai</label>
            <input type="datetime-local" name="tanggal_selesai"
                   value="<?= date('Y-m-d\TH:i', strtotime($lelang['tanggal_selesai'])) ?>"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Status -->
        <div>
            <label class="block font-medium">Status Lelang</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="aktif"   <?= $lelang['status']=='aktif'?'selected':'' ?>>Aktif</option>
                <option value="selesai" <?= $lelang['status']=='selesai'?'selected':'' ?>>Selesai</option>
            </select>
        </div>

        <div class="flex gap-2 pt-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">Update</button>
            <a href="/admin/lelang/jadwal" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">Kembali</a>
        </div>

    </form>
</div>

<?= $this->endSection() ?>
