<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="px-8 py-6">

    <h2 class="text-3xl font-semibold text-blue-700 mb-6 border-b pb-2">📝 Ajukan Barang Lelang</h2>

    <form action="/user/barang/store" method="post" enctype="multipart/form-data" class="space-y-5">

        <div>
            <label class="font-medium text-gray-800">Nama Barang</label>
            <input type="text" name="nama_barang" required
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-medium text-gray-800">Kategori Barang</label>
            <select name="kategori_id" required
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500">
                <?php foreach($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="font-medium text-gray-800">Kondisi Barang</label>
            <select name="kondisi_id" required
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500">
                <?php foreach($kondisi as $ko): ?>
                    <option value="<?= $ko['id_kondisi'] ?>"><?= $ko['nama_kondisi'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="font-medium text-gray-800">Harga Awal</label>
            <input type="number" name="harga_awal" required
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-medium text-gray-800">Deskripsi Barang</label>
            <textarea name="deskripsi" rows="5"
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500"
                placeholder="Tulis detail kondisi, kelengkapan, garansi, alasan jual, dll..."></textarea>
        </div>

        <div>
            <label class="font-medium text-gray-800">Foto Barang</label>
            <input type="file" name="foto" required
                class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-500">

            <span class="block text-sm text-gray-500 mt-1">Format JPG/PNG — maksimal 2MB</span>
        </div>

        <div class="flex gap-4 pt-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                Ajukan Barang
            </button>

            <a href="/user/barang" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded shadow">
               Kembali
            </a>
        </div>

    </form>

</div>

<?= $this->endSection() ?>
