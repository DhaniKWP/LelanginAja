<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">
            📊 Riwayat Penawaran
        </h2>
        <p class="text-sm text-gray-500">
            Daftar seluruh penawaran yang pernah Anda ajukan.
        </p>
    </div>

    <?php if(empty($riwayat)): ?>

        <!-- EMPTY STATE -->
        <div class="p-6 bg-white border rounded-lg text-center shadow-sm">
            <p class="text-gray-500">
                Belum ada penawaran yang Anda lakukan.
            </p>
        </div>

    <?php else: ?>

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Barang</th>
                        <th class="px-4 py-3 text-right">Penawaran</th>
                        <th class="px-4 py-3 text-center">Waktu</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($riwayat as $r): ?>
                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- BARANG -->
                        <td class="px-4 py-3 font-medium text-gray-800">
                            <?= esc($r['nama_barang']) ?>
                        </td>

                        <!-- HARGA -->
                        <td class="px-4 py-3 text-right font-semibold text-blue-600">
                            Rp <?= number_format($r['harga_penawaran']) ?>
                        </td>

                        <!-- WAKTU -->
                        <td class="px-4 py-3 text-center text-gray-500 text-xs">
                            <?= date('d M Y H:i', strtotime($r['waktu_penawaran'])) ?>
                        </td>

                        <!-- STATUS -->
                        <td class="px-4 py-3 text-center">
                            <?php if(!empty($r['is_highest']) && $r['is_highest'] == 1): ?>
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                    Tertinggi
                                </span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs">
                                    Terkalahkan
                                </span>
                            <?php endif ?>
                        </td>

                        <!-- AKSI -->
                        <td class="px-4 py-3 text-center">
                            <a href="<?= base_url('user/lelang/detail/'.$r['id_lelang']) ?>"
                               class="inline-flex items-center gap-1 px-3 py-1.5
                                      rounded-md bg-blue-50 text-blue-600
                                      hover:bg-blue-100 text-xs font-semibold transition">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>

                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>
        </div>

        <!-- INFO -->
        <div class="text-xs text-gray-500 mt-2">
            <span class="font-semibold">Catatan:</span>
            Status <b>Tertinggi</b> berarti penawaran Anda saat ini paling tinggi.
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection(); ?>
