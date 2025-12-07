<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<style>
/* card pilihan barang */
.barang-item { transition:.2s; cursor:pointer; }
.barang-item:hover { transform: scale(1.02); box-shadow:0 4px 10px rgba(0,0,0,.1); }
.barang-selected { border:2px solid #2563eb !important; box-shadow:0 0 8px rgba(37,99,235,.5); }
</style>

<div class="p-6">

    <h2 class="text-3xl font-bold text-blue-700 mb-6">🗓 Buat Jadwal Lelang</h2>

    <form action="/admin/lelang/store" method="POST" class="space-y-6">

        <!-- PILIH BARANG -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-3 text-gray-800">📦 Pilih Barang Lelang</h3>
            <p class="text-gray-500 text-sm mb-4">Klik salah satu barang untuk memilihnya.</p>

            <input type="hidden" name="id_barang" id="id_barang" required>

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-4">
                <?php foreach($barang as $b): ?>
                <div class="border rounded-lg barang-item p-3"
                     onclick="pilihBarang(<?= $b['id_barang']; ?>, this)">
                    
                    <img src="/uploads/barang/<?= $b['foto'] ?>" 
                        class="w-full h-32 object-cover rounded-md">

                    <h4 class="font-semibold text-gray-800 mt-2"><?= $b['nama_barang'] ?></h4>
                    <p class="text-sm text-gray-500">ID: <?= $b['id_barang'] ?></p>
                    <p class="text-sm text-gray-500">Harga Awal: 
                       <b class="text-blue-600">Rp <?= number_format($b['harga_awal']) ?></b>
                    </p>
                    <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded">
                        Approved
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- TANGGAL -->
        <div class="bg-white p-5 rounded-lg shadow-md space-y-4">
            <div>
                <label class="block font-medium mb-1">Tanggal Mulai</label>
                <input type="datetime-local" name="tanggal_mulai"
                       class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Selesai</label>
                <input type="datetime-local" name="tanggal_selesai"
                       class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex gap-2 pt-2">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow">
                ✔ Simpan Jadwal
            </button>
            <a href="/admin/lelang/jadwal" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                Kembali
            </a>
        </div>

    </form>
</div>

<script>
function pilihBarang(id, el){
    document.getElementById('id_barang').value = id;

    // reset all border
    document.querySelectorAll('.barang-item')
            .forEach(x=>x.classList.remove('barang-selected'));

    // active style
    el.classList.add('barang-selected');
}
</script>

<?= $this->endSection() ?>
