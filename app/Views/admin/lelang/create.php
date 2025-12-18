<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-4xl">

    <!-- HEADER -->
    <div class="mb-5">
        <h2 class="text-2xl font-bold text-gray-800">
            Buat Jadwal Lelang
        </h2>
        <p class="text-sm text-gray-500">
            Pilih barang dan tentukan waktu lelang
        </p>
    </div>

    <form action="<?= base_url('admin/lelang/store') ?>" method="POST" class="space-y-6">

        <input type="hidden" name="id_barang" id="id_barang" required>

        <!-- PILIH BARANG -->
        <div class="bg-white border rounded-lg overflow-hidden">
            <div class="px-4 py-3 border-b bg-gray-50 font-medium text-gray-700">
                Pilih Barang Lelang
            </div>

            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="p-3 border">Foto</th>
                        <th class="p-3 border text-left">Nama Barang</th>
                        <th class="p-3 border text-left">Harga Awal</th>
                        <th class="p-3 border text-center">Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php if(empty($barang)): ?>
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">
                            Tidak ada barang yang siap dilelang
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach($barang as $b): ?>
                    <tr class="hover:bg-blue-50 cursor-pointer barang-row"
                        onclick="pilihBarang(<?= $b['id_barang'] ?>, this)">

                        <td class="p-3 border text-center">
                            <img src="/uploads/barang/<?= esc($b['foto']) ?>"
                                 class="w-14 h-14 object-cover rounded border">
                        </td>

                        <td class="p-3 border font-medium">
                            <?= esc($b['nama_barang']) ?>
                        </td>

                        <td class="p-3 border text-blue-600 font-medium">
                            Rp <?= number_format($b['harga_awal']) ?>
                        </td>

                        <td class="p-3 border text-center">
                            <span class="text-green-600 font-medium">
                                Approved
                            </span>
                        </td>

                    </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- WAKTU -->
        <div class="bg-white border rounded-lg p-4 space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal Mulai
                </label>
                <input type="datetime-local" name="tanggal_mulai"
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal Selesai
                </label>
                <input type="datetime-local" name="tanggal_selesai"
                       class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

        </div>

        <!-- ACTION -->
        <div class="flex gap-4">
            <button class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan Jadwal
            </button>

            <a href="<?= base_url('admin/lelang/jadwal') ?>"
               class="px-5 py-2 text-gray-600 hover:underline">
                Kembali
            </a>
        </div>

    </form>
</div>

<script>
function pilihBarang(id, row){
    document.getElementById('id_barang').value = id;

    document.querySelectorAll('.barang-row')
        .forEach(r => r.classList.remove('bg-blue-100'));

    row.classList.add('bg-blue-100');
}
</script>

<?= $this->endSection() ?>
