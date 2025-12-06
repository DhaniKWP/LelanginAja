<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-4xl mx-auto">

    <h2 class="text-2xl font-semibold text-gray-800 mb-5 flex items-center gap-2">
        ✏ Edit Barang Lelang
    </h2>

    <form action="/admin/barang/update/<?= $barang['id_barang']; ?>" method="POST" 
          enctype="multipart/form-data"
          class="bg-white rounded-lg shadow p-6 space-y-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="space-y-3">

                <div>
                    <label class="font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="nama_barang"
                        value="<?= $barang['nama_barang']; ?>"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-medium text-gray-700">Kategori</label>
                    <select name="kategori_id" class="w-full border rounded px-3 py-2">
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['id_kategori']; ?>"
                                <?= $barang['kategori_id']==$k['id_kategori']?'selected':''; ?>>
                                <?= $k['nama_kategori']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="font-medium text-gray-700">Kondisi Barang</label>
                    <select name="kondisi_id" class="w-full border rounded px-3 py-2">
                        <?php foreach($kondisi as $c): ?>
                            <option value="<?= $c['id_kondisi']; ?>"
                                <?= $barang['kondisi_id']==$c['id_kondisi']?'selected':''; ?>>
                                <?= $c['nama_kondisi']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="font-medium text-gray-700">Harga Awal</label>
                    <input type="number" name="harga_awal"
                        value="<?= $barang['harga_awal']; ?>"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-medium text-gray-700">Deskripsi Barang</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"><?= $barang['deskripsi']; ?></textarea>
                </div>
            </div>

            <div class="space-y-4">

                <div>
                    <label class="font-medium text-gray-700">Foto Barang</label><br>
                    <img src="/uploads/barang/<?= $barang['foto']; ?>" 
                         class="w-32 h-32 object-cover rounded shadow mb-2">
                    
                    <input type="file" name="foto" class="w-full border rounded px-3 py-2">
                    <input type="hidden" name="foto_lama" value="<?= $barang['foto']; ?>">
                </div>

                <div>
                    <label class="font-medium text-gray-700">Status Pengajuan</label>
                    <select name="status_pengajuan" class="w-full border rounded px-3 py-2">
                        <option value="pending"  <?= $barang['status_pengajuan']=='pending'?'selected':''; ?>>Pending</option>
                        <option value="approved" <?= $barang['status_pengajuan']=='approved'?'selected':''; ?>>Approved</option>
                        <option value="rejected" <?= $barang['status_pengajuan']=='rejected'?'selected':''; ?>>Rejected</option>
                    </select>
                </div>

            </div>

        </div>

        <div class="flex gap-3 pt-3">
            <button class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                Simpan Perubahan
            </button>
            <a href="/admin/barang" 
               class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded shadow">
               Kembali
            </a>
        </div>

    </form>
</div>

<?= $this->endSection() ?>
