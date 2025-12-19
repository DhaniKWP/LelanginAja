<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
        <p class="text-sm text-gray-500">
            Ringkasan aktivitas sistem LelanginAja
        </p>
    </div>

    <!-- SUMMARY CARD -->
    <div class="grid md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Barang</p>
            <h3 class="text-2xl font-bold text-blue-600"><?= $totalBarang ?></h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Lelang Aktif</p>
            <h3 class="text-2xl font-bold text-yellow-500"><?= $lelangAktif ?></h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Total Pemenang</p>
            <h3 class="text-2xl font-bold text-green-600"><?= $totalPemenang ?></h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-sm text-gray-500">Pembayaran Lunas</p>
            <h3 class="text-2xl font-bold text-indigo-600"><?= $totalPembayaran ?></h3>
        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <div class="p-4 border-b">
            <h3 class="font-semibold text-gray-700">Pembayaran Terbaru</h3>
        </div>

        <table class="w-full text-sm border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3 text-center">No</th>
                    <th class="border p-3">Barang</th>
                    <th class="border p-3">Pemenang</th>
                    <th class="border p-3 text-right">Harga</th>
                    <th class="border p-3 text-center">Metode</th>
                    <th class="border p-3 text-center">Status</th>
                    <th class="border p-3 text-center">Tanggal</th>
                </tr>
            </thead>
            <tbody>

                <?php if($pembayaranTerbaru): $no=1; foreach($pembayaranTerbaru as $p): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-3 text-center"><?= $no++ ?></td>
                    <td class="border p-3"><?= esc($p['nama_barang']) ?></td>
                    <td class="border p-3"><?= esc($p['nama_pemenang']) ?></td>
                    <td class="border p-3 text-right">
                        Rp <?= number_format($p['harga_menang'],0,',','.') ?>
                    </td>
                    <td class="border p-3 text-center"><?= esc($p['metode']) ?></td>
                    <td class="border p-3 text-center"><?= ucfirst($p['status']) ?></td>
                    <td class="border p-3 text-center">
                        <?= date('d-m-Y', strtotime($p['tanggal_bayar'])) ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-500">
                        Belum ada transaksi pembayaran
                    </td>
                </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>
