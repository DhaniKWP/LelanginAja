<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        📊 Laporan Data Barang
    </h2>

    <div class="flex gap-3 mb-5">
        <a href="<?= base_url('admin/laporan/barang/pdf?' . http_build_query($_GET)) ?>"
        class="bg-red-600 text-white px-4 py-2 rounded">
        Export PDF
        </a>

        <a href="<?= base_url('admin/laporan/barang/excel?' . http_build_query($_GET)) ?>"
        class="bg-green-600 text-white px-4 py-2 rounded">
        Export Excel
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <form method="get" class="bg-white p-4 rounded-lg shadow mb-6 grid md:grid-cols-4 gap-4">

        <div>
            <label class="text-sm font-medium">Dari Tanggal</label>
            <input type="date" name="start_date"
                value="<?= $filter['start_date'] ?? '' ?>"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="text-sm font-medium">Sampai Tanggal</label>
            <input type="date" name="end_date"
                value="<?= $filter['end_date'] ?? '' ?>"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="text-sm font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="">Semua</option>
                <option value="pending"  <?= ($filter['status'] ?? '')=='pending'?'selected':'' ?>>Pending</option>
                <option value="approved" <?= ($filter['status'] ?? '')=='approved'?'selected':'' ?>>Approved</option>
                <option value="rejected" <?= ($filter['status'] ?? '')=='rejected'?'selected':'' ?>>Rejected</option>
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
            <a href="<?= base_url('admin/laporan/barang') ?>"
            class="bg-gray-500 text-white px-4 py-2 rounded">
                Reset
            </a>
        </div>

    </form>

        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border">No</th>
                    <th class="p-3 border">Nama Barang</th>
                    <th class="p-3 border">Kategori</th>
                    <th class="p-3 border">Pemilik</th>
                    <th class="p-3 border">Harga Awal</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($barang as $b): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border text-center"><?= $no++ ?></td>
                    <td class="p-3 border"><?= esc($b['nama_barang']) ?></td>
                    <td class="p-3 border"><?= esc($b['nama_kategori']) ?></td>
                    <td class="p-3 border"><?= esc($b['nama_user']) ?></td>
                    <td class="p-3 border">
                        Rp <?= number_format($b['harga_awal']) ?>
                    </td>
                    <td class="p-3 border">
                        <?= ucfirst($b['status_pengajuan']) ?>
                    </td>
                    <td class="p-3 border">
                        <?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>
