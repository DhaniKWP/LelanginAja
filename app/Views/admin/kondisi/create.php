<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="flex justify-center items-center min-h-[75vh] p-6">

    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold text-gray-800 mb-5 text-center">➕ Tambah Kondisi Barang</h2>

        <form action="/admin/kondisi/store" method="POST" class="space-y-4">

            <div>
                <label class="block mb-1 font-medium text-gray-700">Nama Kondisi</label>
                <input type="text" name="nama_kondisi" required
                    class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="flex gap-3 justify-center pt-3">
                <button class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow">
                    Simpan
                </button>
                <a href="/admin/kondisi" 
                    class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<?= $this->endSection() ?>
