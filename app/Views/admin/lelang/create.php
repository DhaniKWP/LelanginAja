<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-xl mx-auto">

    <h2 class="text-2xl font-semibold text-gray-800 mb-4">🗓 Buat Jadwal Lelang</h2>

    <form action="/admin/lelang/store" method="POST" 
          class="bg-white shadow-md rounded-lg p-5 space-y-4">

        <div>
            <label class="block font-medium text-gray-700">Pilih Barang</label>
            <select name="id_barang" required
                class="w-full border rounded px-3 py-2 focus:ring-blue-500">
                <option value="">-- Pilih Barang --</option>
                <?php foreach($barang as $b): ?>
                    <option value="<?= $b['id_barang'] ?>"><?= $b['nama_barang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-700">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" required
                   class="w-full border rounded px-3 py-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block font-medium text-gray-700">Tanggal Selesai</label>
            <input type="datetime-local" name="tanggal_selesai" required
                   class="w-full border rounded px-3 py-2 focus:ring-blue-500">
        </div>

        <div class="flex gap-3 pt-2">
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                Simpan Jadwal
            </button>
            <a href="/admin/lelang/jadwal" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Kembali</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
