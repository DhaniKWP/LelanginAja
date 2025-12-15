<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto px-8 py-10">

    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-blue-700 mb-6 flex items-center gap-3">
        <i class="fas fa-box-open text-blue-600"></i> Ajukan Barang Lelang
    </h1>

    <!-- Informasi -->
    <div class="bg-blue-100 border-l-4 border-blue-600 p-5 rounded-md text-sm mb-10">
        <p class="text-gray-700 leading-relaxed">
            Silakan isi form berikut untuk mengajukan barang ke lelang. Pastikan foto jelas dan deskripsi lengkap
            agar admin lebih mudah menilai kelayakan barang.
        </p>
        <ul class="list-disc ml-6 mt-2 text-gray-600">
            <li>Foto jelas (lebih bagus multi angle)</li>
            <li>Tuliskan detail kondisi barang sejujur mungkin</li>
            <li>Produk ilegal / berbahaya tidak diizinkan</li>
        </ul>
    </div>

    <!-- Form -->
    <form action="/user/barang/store" method="post" enctype="multipart/form-data">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Form kiri -->
            <div class="space-y-6">

                <div>
                    <label class="font-semibold text-gray-800">Nama Barang</label>
                    <input type="text" name="nama_barang" required
                        placeholder="Contoh: Kamera Sony A6400..."
                        class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Kategori</label>
                    <select name="nama_kategori" required
                        class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="" hidden>Pilih kategori</option>
                        <?php foreach($kategoriList as $k): ?>
                            <option value="<?= $k ?>"><?= $k ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Kondisi Barang</label>
                    <select name="kondisi_id" required
                        class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <?php foreach($kondisi as $ko): ?>
                            <option value="<?= $ko['id_kondisi'] ?>"><?= $ko['nama_kondisi'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Harga Awal</label>
                    <input type="number" name="harga_awal" min="1000" required
                        placeholder="Harga pembukaan lelang"
                        class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Deskripsi Barang</label>
                    <textarea name="deskripsi" rows="6" required
                        placeholder="Detail pemakaian, minus, kelengkapan, garansi..."
                        class="mt-2 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
                    <span class="text-xs text-gray-500">Deskripsi lengkap membantu cepat diterima admin.</span>
                </div>
            </div>

            <!-- Preview Image kanan -->
            <div class="flex flex-col items-center">

                <label class="font-semibold text-gray-800">Foto Barang</label>

                <div class="mt-4 w-64 h-64 border border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                    <img id="previewImage" class="hidden w-full h-full object-cover"/>
                    <span id="placeholderText" class="text-gray-400 text-sm">Belum ada gambar</span>
                </div>

                <input type="file" name="foto" id="fotoInput" required accept="image/*"
                    class="mt-5 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                <span class="text-xs text-gray-500 mt-1">Format JPG/PNG max 2MB</span>
            </div>
        </div>

        <!-- Button -->
        <div class="flex justify-end gap-4 mt-12">
            <a href="/user/barang" 
               class="px-6 py-2 rounded-lg bg-gray-500 hover:bg-gray-600 text-white shadow">
               Kembali
            </a>

            <button class="px-7 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">
                Ajukan Barang
            </button>
        </div>

    </form>
</div>

<!-- JS Preview -->
<script>
document.getElementById('fotoInput').addEventListener('change', function(e){
    const img = document.getElementById('previewImage');
    const txt = document.getElementById('placeholderText');
    img.src = URL.createObjectURL(e.target.files[0]);
    img.classList.remove('hidden');
    txt.style.display = "none";
});
</script>

<?= $this->endSection() ?>
