<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-3xl">

    <!-- HEADER -->
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">
            Edit Jadwal Lelang
        </h2>
        <p class="text-sm text-gray-500">
            Ubah barang, waktu, atau status lelang
        </p>
    </div>

    <!-- FORM -->
    <form action="<?= base_url('admin/lelang/update/'.$lelang['id_lelang']) ?>"
          method="POST"
          class="bg-white border rounded-lg p-6 space-y-5">

        <!-- BARANG -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Barang Lelang
            </label>
            <select name="id_barang"
                    class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    required>
                <?php foreach($barang as $b): ?>
                    <option value="<?= $b['id_barang'] ?>"
                        <?= $b['id_barang'] == $lelang['id_barang'] ? 'selected' : '' ?>>
                        <?= esc($b['nama_barang']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- TANGGAL MULAI -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tanggal Mulai
            </label>
            <input type="datetime-local"
                   name="tanggal_mulai"
                   value="<?= date('Y-m-d\TH:i', strtotime($lelang['tanggal_mulai'])) ?>"
                   class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <!-- TANGGAL SELESAI -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tanggal Selesai
            </label>
            <input type="datetime-local"
                   name="tanggal_selesai"
                   value="<?= date('Y-m-d\TH:i', strtotime($lelang['tanggal_selesai'])) ?>"
                   class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <!-- STATUS -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Status Lelang
            </label>
            <select name="status"
                    class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="aktif" <?= $lelang['status']=='aktif'?'selected':'' ?>>
                    Aktif
                </option>
                <option value="selesai" <?= $lelang['status']=='selesai'?'selected':'' ?>>
                    Selesai
                </option>
            </select>
        </div>

        <!-- ACTION -->
        <div class="flex gap-4 pt-3">
            <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>

            <a href="<?= base_url('admin/lelang/jadwal') ?>"
               class="px-5 py-2 text-gray-600 hover:underline">
                Kembali
            </a>
        </div>

    </form>
</div>

<?= $this->endSection() ?>
