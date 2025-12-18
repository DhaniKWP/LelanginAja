<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Edit Barang Lelang
    </h2>
    <p class="text-sm text-gray-500">
        Perbarui informasi barang lelang
    </p>
</div>

<form action="<?= base_url('admin/barang/update/'.$barang['id_barang']) ?>"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white border rounded-lg p-6 max-w-4xl">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- KOLOM KIRI -->
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Barang
                </label>
                <input type="text" name="nama_barang"
                       value="<?= esc($barang['nama_barang']) ?>"
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori
                </label>
                <select name="nama_kategori"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                    <?php foreach($kategoriList as $k): ?>
                        <option value="<?= esc($k) ?>"
                            <?= $k === $barang['nama_kategori'] ? 'selected' : '' ?>>
                            <?= esc($k) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kondisi Barang
                </label>
                <select name="kondisi_id"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                        required>
                    <?php foreach($kondisi as $c): ?>
                        <option value="<?= $c['id_kondisi'] ?>"
                            <?= $barang['kondisi_id'] == $c['id_kondisi'] ? 'selected' : '' ?>>
                            <?= esc($c['nama_kondisi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Harga Awal
                </label>
                <input type="number" name="harga_awal"
                       value="<?= esc($barang['harga_awal']) ?>"
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea name="deskripsi" rows="4"
                          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none"><?= esc($barang['deskripsi']) ?></textarea>
            </div>

        </div>

        <!-- KOLOM KANAN -->
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Foto Barang
                </label>

                <img src="/uploads/barang/<?= esc($barang['foto']) ?>"
                     class="w-32 h-32 object-cover rounded border mb-2">

                <input type="file" name="foto"
                       class="w-full border rounded px-3 py-2">
                <input type="hidden" name="foto_lama" value="<?= esc($barang['foto']) ?>">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status Pengajuan
                </label>
                <select name="status_pengajuan"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="pending"  <?= $barang['status_pengajuan']=='pending'?'selected':'' ?>>Pending</option>
                    <option value="approved" <?= $barang['status_pengajuan']=='approved'?'selected':'' ?>>Approved</option>
                    <option value="rejected" <?= $barang['status_pengajuan']=='rejected'?'selected':'' ?>>Rejected</option>
                </select>
            </div>

        </div>
    </div>

    <!-- ACTION -->
    <div class="flex gap-3 mt-6">
        <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            Simpan
        </button>

        <a href="<?= base_url('admin/barang') ?>"
           class="px-5 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 text-sm">
            Kembali
        </a>
    </div>

</form>

<?= $this->endSection() ?>
<?= $this->extend('layout/admin_main') ?>