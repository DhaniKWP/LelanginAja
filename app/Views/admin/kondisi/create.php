<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-xl">

    <h2 class="text-2xl font-semibold text-gray-800 mb-1">
        Tambah Kondisi Barang
    </h2>
    <p class="text-sm text-gray-500 mb-6">
        Masukkan nama kondisi barang
    </p>

    <div class="bg-white rounded-lg shadow-sm p-6 border">
        <form action="<?= base_url('admin/kondisi/store') ?>" method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kondisi
                </label>
                <input type="text" name="nama_kondisi" required
                       class="w-full border rounded px-3 py-2 text-sm
                              focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="flex gap-3 pt-3">
                <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                    Simpan
                </button>
                <a href="<?= base_url('admin/kondisi') ?>"
                   class="px-4 py-2 border rounded text-sm hover:bg-gray-50">
                    Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<?= $this->endSection() ?>
