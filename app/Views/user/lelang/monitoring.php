<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-8 space-y-8">

    <!-- BACK -->
    <a href="<?= base_url('user/barang') ?>"
       class="inline-flex items-center gap-2 text-sm text-blue-600 hover:underline">
        ← Kembali ke Barang Saya
    </a>

    <!-- ================= INFO BARANG ================= -->
    <div class="bg-white rounded-2xl shadow p-6 flex gap-6 items-center">

        <?php if(!empty($lelang['foto'])): ?>
            <img src="/uploads/barang/<?= esc($lelang['foto']) ?>"
                 class="w-36 h-36 object-cover rounded-xl border">
        <?php endif; ?>

        <div class="flex-1 space-y-2">
            <h2 class="text-2xl font-bold text-gray-800">
                <?= esc($lelang['nama_barang']) ?>
            </h2>

            <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                <span>
                    Status Lelang:
                    <span class="ml-1 px-3 py-1 rounded-full font-semibold
                        <?= $lelang['status']=='aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-gray-200 text-gray-700' ?>">
                        <?= strtoupper($lelang['status']) ?>
                    </span>
                </span>
            </div>

            <?php if($lelang['status']=='aktif'): ?>
                <p class="text-sm text-green-700">
                    🔴 Lelang sedang berlangsung — penawaran diperbarui realtime
                </p>
            <?php else: ?>
                <p class="text-sm text-gray-600">
                    🏁 Lelang telah selesai
                </p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================= RIWAYAT PENAWARAN ================= -->
    <div class="bg-white rounded-2xl shadow p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Riwayat Penawaran
            </h3>

            <span class="text-sm text-gray-500">
                Total Penawaran: <?= count($penawaran) ?>
            </span>
        </div>

        <?php if(empty($penawaran)): ?>
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center">
                <p class="font-medium text-gray-700">
                    Belum Ada Penawaran
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Tunggu peserta lain melakukan penawaran
                </p>
            </div>
        <?php else: ?>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="p-3 border text-center w-12">#</th>
                        <th class="p-3 border text-left">Nama Peserta</th>
                        <th class="p-3 border text-left">Nominal Penawaran</th>
                        <th class="p-3 border text-left">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($penawaran as $i => $p): ?>
                    <tr class="<?= $i==0 ? 'bg-green-50' : 'hover:bg-gray-50' ?>">
                        <td class="p-3 border text-center">
                            <?= $no++ ?>
                        </td>
                        <td class="p-3 border font-medium">
                            <?= esc($p['nama']) ?>
                            <?php if($i==0): ?>
                                <span class="ml-2 text-xs bg-green-600 text-white px-2 py-0.5 rounded-full">
                                    TERTINGGI
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="p-3 border font-semibold text-green-700">
                            Rp <?= number_format($p['harga_penawaran']) ?>
                        </td>
                        <td class="p-3 border text-gray-600">
                            <?= date('d M Y H:i', strtotime($p['waktu_penawaran'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php endif; ?>
    </div>

    <!-- ================= CATATAN ================= -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 text-sm text-blue-800">
        <p class="font-semibold mb-1">Catatan:</p>
        <ul class="list-disc ml-5 space-y-1">
            <li>Penawaran tertinggi otomatis menjadi pemenang saat lelang berakhir</li>
            <li>Admin akan memverifikasi hasil dan pembayaran pemenang</li>
            <li>Status pembayaran dapat dilihat di halaman <b>Hasil Lelang</b></li>
        </ul>
    </div>

</div>

<?= $this->endSection() ?>
