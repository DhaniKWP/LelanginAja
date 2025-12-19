<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Laporan Data Pemenang</h2>
        <p class="text-sm text-gray-500">
            Rekap data pemenang lelang berdasarkan hasil lelang
        </p>
    </div>

    <!-- FILTER -->
    <form method="get" class="bg-white p-4 rounded-xl shadow space-y-4">
        <div class="grid md:grid-cols-5 gap-4">

            <div>
                <label class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="start_date"
                       value="<?= $filter['start'] ?? '' ?>"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="end_date"
                       value="<?= $filter['end'] ?? '' ?>"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Status Lelang</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="aktif"   <?= ($filter['status'] ?? '')=='aktif'?'selected':'' ?>>Aktif</option>
                    <option value="selesai" <?= ($filter['status'] ?? '')=='selesai'?'selected':'' ?>>Selesai</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Filter
                </button>
                <a href="<?= base_url('admin/laporan/pemenang') ?>"
                   class="px-4 py-2 bg-gray-200 rounded-lg">
                    Reset
                </a>
            </div>

        </div>
    </form>

    <!-- EXPORT -->
    <div class="flex gap-3">
        <a href="<?= base_url('admin/laporan/pemenang/pdf?'.http_build_query($_GET)) ?>"
           target="_blank"
           class="px-4 py-2 bg-red-600 text-white rounded-lg">
            Export PDF
        </a>

        <a href="<?= base_url('admin/laporan/pemenang/excel?'.http_build_query($_GET)) ?>"
           class="px-4 py-2 bg-green-600 text-white rounded-lg">
            Export Excel
        </a>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3 text-center">No</th>
                    <th class="border p-3">Nama Barang</th>
                    <th class="border p-3">Pemenang</th>
                    <th class="border p-3 text-right">Harga Menang</th>
                    <th class="border p-3 text-center">Tanggal Menang</th>
                    <th class="border p-3 text-center">Status Lelang</th>
                </tr>
            </thead>
            <tbody>

                <?php if($pemenang): $no=1; foreach($pemenang as $p): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-3 text-center"><?= $no++ ?></td>
                    <td class="border p-3"><?= esc($p['nama_barang']) ?></td>
                    <td class="border p-3"><?= esc($p['nama_pemenang']) ?></td>
                    <td class="border p-3 text-right">
                        Rp <?= number_format($p['harga_menang'],0,',','.') ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= date('d-m-Y', strtotime($p['tanggal_menang'])) ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= ucfirst($p['status_lelang']) ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">
                        Tidak ada data pemenang
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
    <!-- FOOTER INFO -->
    <div class="text-sm text-gray-500">
        Total data: <b><?= count($pemenang) ?></b> lelang
    </div>

</div>

<?= $this->endSection() ?>
