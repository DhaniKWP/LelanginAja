<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Laporan Data Pembayaran</h2>
        <p class="text-sm text-gray-500">
            Rekap transaksi pembayaran pemenang lelang
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
                <label class="text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Status</option>
                    <option value="pending"  <?= ($filter['status'] ?? '')=='pending'?'selected':'' ?>>Pending</option>
                    <option value="paid"     <?= ($filter['status'] ?? '')=='paid'?'selected':'' ?>>Paid</option>
                    <option value="rejected" <?= ($filter['status'] ?? '')=='rejected'?'selected':'' ?>>Rejected</option>
                </select>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Metode</label>
                <select name="metode" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Semua Metode</option>
                    <option value="QRIS" <?= ($filter['metode'] ?? '')=='QRIS'?'selected':'' ?>>QRIS</option>
                    <option value="Transfer Bank" <?= ($filter['metode'] ?? '')=='Transfer Bank'?'selected':'' ?>>Transfer Bank</option>
                    <option value="E-Wallet" <?= ($filter['metode'] ?? '')=='E-Wallet'?'selected':'' ?>>E-Wallet</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    Filter
                </button>
                <a href="<?= base_url('admin/laporan/pembayaran') ?>"
                   class="px-4 py-2 bg-gray-200 rounded-lg">
                    Reset
                </a>
            </div>

        </div>
    </form>

    <!-- EXPORT -->
    <div class="flex gap-3">
        <a href="<?= base_url('admin/laporan/pembayaran/pdf?'.http_build_query($_GET)) ?>"
           target="_blank"
           class="px-4 py-2 bg-red-600 text-white rounded-lg">
            Export PDF
        </a>

        <a href="<?= base_url('admin/laporan/pembayaran/excel?'.http_build_query($_GET)) ?>"
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
                    <th class="border p-3 text-center">Metode</th>
                    <th class="border p-3 text-center">Status</th>
                    <th class="border p-3 text-center">Tanggal Bayar</th>
                </tr>
            </thead>
            <tbody>

            <?php if($pembayaran): $no=1; foreach($pembayaran as $p): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-3 text-center"><?= $no++ ?></td>
                    <td class="border p-3"><?= esc($p['nama_barang']) ?></td>
                    <td class="border p-3"><?= esc($p['nama_pemenang']) ?></td>
                    <td class="border p-3 text-right">
                        Rp <?= number_format($p['harga_menang'],0,',','.') ?>
                    </td>
                    <td class="border p-3 text-center"><?= strtoupper($p['metode']) ?></td>
                    <td class="border p-3 text-center"><?= ucfirst($p['status']) ?></td>
                    <td class="border p-3 text-center">
                        <?= date('d-m-Y', strtotime($p['tanggal_bayar'])) ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        Tidak ada data pembayaran
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
<!-- FOOTER INFO -->
    <div class="text-sm text-gray-500">
        Total data: <b><?= count($pembayaran) ?></b> pembayaran
    </div>

</div>

<?= $this->endSection() ?>
