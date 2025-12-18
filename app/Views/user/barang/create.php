<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto px-8 py-10">

    <!-- TITLE -->
    <h1 class="text-4xl font-extrabold text-blue-700 mb-6 flex items-center gap-3">
        <i class="fas fa-box-open"></i>
        <?= $mode=='edit' ? 'Ajukan Ulang Barang Lelang' : 'Ajukan Barang Lelang' ?>
    </h1>

    <!-- INFO BOX -->
    <div class="bg-blue-50 border border-blue-200 p-5 rounded-lg text-sm mb-10">
        <p class="text-gray-700 leading-relaxed">
            Lengkapi data barang dengan jujur dan detail.  
            Barang yang informasinya jelas akan lebih cepat diverifikasi admin.
        </p>
        <ul class="list-disc ml-6 mt-2 text-gray-600">
            <li>Foto jelas & tidak blur</li>
            <li>Jelaskan kondisi apa adanya</li>
            <li>Barang ilegal / berbahaya tidak diperbolehkan</li>
        </ul>
    </div>

    <!-- FORM -->
    <form 
        action="<?= $mode=='edit'
            ? base_url('/user/barang/update/'.$barang['id_barang'])
            : base_url('/user/barang/store') ?>"
        method="post" enctype="multipart/form-data">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- LEFT -->
            <div class="space-y-6">

                <div>
                    <label class="font-semibold text-gray-800">Nama Barang</label>
                    <input type="text" name="nama_barang" required
                        value="<?= $barang['nama_barang'] ?? '' ?>"
                        placeholder="Contoh: Kamera Sony A6400"
                        class="mt-2 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Kategori</label>
                    <select name="nama_kategori" required
                        class="mt-2 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="" hidden>Pilih kategori</option>
                        <?php foreach($kategoriList as $k): ?>
                            <option value="<?= $k ?>"
                                <?= isset($barang) && $barang['nama_kategori']==$k ? 'selected':'' ?>>
                                <?= $k ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Kondisi Barang</label>
                    <select name="kondisi_id" required
                        class="mt-2 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <?php foreach($kondisi as $ko): ?>
                            <option value="<?= $ko['id_kondisi'] ?>"
                                <?= isset($barang) && $barang['kondisi_id']==$ko['id_kondisi'] ? 'selected':'' ?>>
                                <?= $ko['nama_kondisi'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Harga Awal</label>
                    <input type="number" name="harga_awal" min="1000" required
                        value="<?= $barang['harga_awal'] ?? '' ?>"
                        placeholder="Harga pembukaan lelang"
                        class="mt-2 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="font-semibold text-gray-800">Deskripsi Barang</label>
                    <textarea name="deskripsi" rows="6" required
                        class="mt-2 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="Detail pemakaian, minus, kelengkapan..."><?= $barang['deskripsi'] ?? '' ?></textarea>
                    <span class="text-xs text-gray-500">
                        Deskripsi lengkap mempercepat proses verifikasi
                    </span>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex flex-col items-center">

                <label class="font-semibold text-gray-800">Foto Barang</label>

                <div class="mt-4 w-64 h-64 border rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                    <?php if($mode=='edit'): ?>
                        <img src="/uploads/barang/<?= $barang['foto'] ?>"
                             class="w-full h-full object-cover">
                    <?php else: ?>
                        <img id="previewImage" class="hidden w-full h-full object-cover"/>
                        <span id="placeholderText" class="text-gray-400 text-sm">
                            Belum ada gambar
                        </span>
                    <?php endif; ?>
                </div>

                <input type="file" name="foto" id="fotoInput"
                    <?= $mode=='edit' ? '' : 'required' ?>
                    accept="image/*"
                    class="mt-5 w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                <?php if($mode=='edit'): ?>
                    <span class="text-xs text-gray-500 mt-2">
                        Kosongkan jika tidak ingin mengganti foto
                    </span>
                <?php else: ?>
                    <span class="text-xs text-gray-500 mt-2">
                        JPG / PNG • max 2MB
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- ACTION -->
        <div class="flex justify-end gap-4 mt-12">
            <a href="/user/barang"
               class="px-6 py-2 rounded-lg bg-gray-500 hover:bg-gray-600 text-white">
               Kembali
            </a>

            <button class="px-7 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                <?= $mode=='edit' ? 'Ajukan Ulang Barang' : 'Ajukan Barang' ?>
            </button>
        </div>

    </form>
</div>

<!-- PREVIEW -->
<script>
document.getElementById('fotoInput')?.addEventListener('change', function(e){
    const img = document.getElementById('previewImage');
    const txt = document.getElementById('placeholderText');
    if(img){
        img.src = URL.createObjectURL(e.target.files[0]);
        img.classList.remove('hidden');
        if(txt) txt.style.display = "none";
    }
});
</script>

<?= $this->endSection() ?>
