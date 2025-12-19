<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Laporan Data Lelang</h2>
        <p class="text-sm text-gray-500">
            Rekap data lelang barang pada sistem LelanginAja
        </p>
    </div>

    <!-- FILTER -->
    <form method="get" class="bg-white p-4 rounded-xl shadow space-y-4">
        <div class="grid md:grid-cols-4 gap-4">

            <div>
                <label class="text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="start_date"
                       value="<?= $filter['start_date'] ?? '' ?>"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="end_date"
                       value="<?= $filter['end_date'] ?? '' ?>"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Status Lelang</label>
                <select name="status"
                        class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="aktif"
                        <?= ($filter['status'] ?? '')=='aktif'?'selected':'' ?>>
                        Aktif
                    </option>
                    <option value="selesai"
                        <?= ($filter['status'] ?? '')=='selesai'?'selected':'' ?>>
                        Selesai
                    </option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Filter
                </button>
                <a href="<?= base_url('admin/laporan/lelang') ?>"
                   class="px-4 py-2 bg-gray-200 rounded-lg">
                    Reset
                </a>
            </div>

        </div>
    </form>

    <!-- ACTION EXPORT -->
    <div class="flex gap-3">
        <a href="<?= base_url('admin/laporan/lelang/pdf?'.http_build_query($_GET)) ?>"
           target="_blank"
           class="px-4 py-2 bg-red-600 text-white rounded-lg">
            Export PDF
        </a>

        <a href="<?= base_url('admin/laporan/lelang/excel?'.http_build_query($_GET)) ?>"
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
                    <th class="border p-3">Pemilik</th>
                    <th class="border p-3 text-right">Harga Awal</th>
                    <th class="border p-3 text-right">Harga Tertinggi</th>
                    <th class="border p-3 text-center">Total Bid</th>
                    <th class="border p-3 text-center">Status</th>
                    <th class="border p-3 text-center">Mulai</th>
                    <th class="border p-3 text-center">Selesai</th>
                </tr>
            </thead>
            <tbody>

                <?php if($lelang): $no=1; foreach($lelang as $l): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-3 text-center"><?= $no++ ?></td>
                    <td class="border p-3"><?= esc($l['nama_barang']) ?></td>
                    <td class="border p-3"><?= esc($l['pemilik']) ?></td>
                    <td class="border p-3 text-right">
                        Rp <?= number_format($l['harga_awal'],0,',','.') ?>
                    </td>
                    <td class="border p-3 text-right">
                        <?= $l['harga_tertinggi']
                            ? 'Rp '.number_format($l['harga_tertinggi'],0,',','.')
                            : '-' ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= $l['total_penawaran'] ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= ucfirst($l['status']) ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= date('d-m-Y', strtotime($l['tanggal_mulai'])) ?>
                    </td>
                    <td class="border p-3 text-center">
                        <?= date('d-m-Y', strtotime($l['tanggal_selesai'])) ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="9" class="p-4 text-center text-gray-500">
                        Tidak ada data lelang
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>
        </table>

    </div>

    <!-- FOOTER INFO -->
    <div class="text-sm text-gray-500">
        Total data: <b><?= count($lelang) ?></b> lelang
    </div>

</div>

<?= $this->endSection() ?>
