<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-6xl mx-auto p-6 space-y-6">

    <a href="<?= base_url('user/barang/') ?>"
       class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Jadwal Lelang
    </a>

    <!-- INFO BARANG -->
    <div class="bg-white rounded-xl shadow p-5 flex gap-4">

        <?php if(!empty($lelang['foto'])): ?>
            <img src="/uploads/barang/<?= esc($lelang['foto']) ?>"
                 class="w-32 h-32 object-cover rounded-lg border">
        <?php endif; ?>

        <div>
            <h2 class="text-xl font-bold text-gray-800">
                <?= esc($lelang['nama_barang']) ?>
            </h2>

            <p class="text-sm text-gray-600 mt-1">
                Status:
                <span class="px-2 py-1 rounded text-xs font-semibold
                    <?= $lelang['status']=='aktif'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-700' ?>">
                    <?= ucfirst($lelang['status']) ?>
                </span>
            </p>
        </div>
    </div>

    <!-- RIWAYAT PENAWARAN -->
    <div class="bg-white rounded-xl shadow p-5">

        <h3 class="font-semibold text-gray-800 mb-4">
            Riwayat Penawaran
        </h3>

        <?php if(empty($penawaran)): ?>
            <p class="text-sm text-gray-500">
                Belum ada penawaran untuk barang ini.
            </p>
        <?php else: ?>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="p-3 border text-left">#</th>
                        <th class="p-3 border text-left">Nama User</th>
                        <th class="p-3 border text-left">Nominal</th>
                        <th class="p-3 border text-left">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($penawaran as $p): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 border"><?= $no++ ?></td>
                        <td class="p-3 border"><?= esc($p['nama']) ?></td>
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

</div>

<?= $this->endSection() ?>
