<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- BACK -->
<div class="mb-4">
    <a href="<?= base_url('admin/lelang/aktif') ?>" 
       class="text-sm text-blue-600 hover:underline">
        ← Kembali ke Lelang Aktif
    </a>
</div>

<?php if (!$lelang): ?>

    <div class="bg-white border rounded-lg p-6 text-center text-gray-500">
        Data lelang tidak ditemukan.
    </div>

<?php else: ?>

<!-- HEADER -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Monitoring Lelang
    </h2>
    <p class="text-sm text-gray-500">
        Pantauan real-time aktivitas penawaran lelang
    </p>
</div>

<!-- INFO GRID -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

    <!-- INFO BARANG -->
    <div class="lg:col-span-2 bg-white border rounded-lg p-5 flex gap-4">

        <?php if (!empty($lelang['foto'])): ?>
            <img src="/uploads/barang/<?= esc($lelang['foto']) ?>"
                 class="w-32 h-32 object-cover rounded border">
        <?php else: ?>
            <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded text-xs text-gray-400">
                Tidak ada foto
            </div>
        <?php endif; ?>

        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                <?= esc($lelang['nama_barang']) ?>
            </h3>

            <p class="text-sm text-gray-600">
                ID Lelang: <span class="font-mono"><?= esc($lelang['id_lelang']) ?></span>
            </p>

            <p class="text-sm text-gray-600 mt-1">
                Periode:
                <span class="font-medium">
                    <?= date('d M Y H:i', strtotime($lelang['tanggal_mulai'])) ?>
                    –
                    <?= date('d M Y H:i', strtotime($lelang['tanggal_selesai'])) ?>
                </span>
            </p>

            <?php
                $highest = $penawaran[0]['harga_penawaran'] ?? null;
                $total   = count($penawaran);
            ?>

            <div class="mt-3 text-sm space-y-1">
                <p>
                    Penawaran Tertinggi:
                    <span class="font-semibold text-green-600">
                        <?= $highest ? 'Rp '.number_format($highest,0,',','.') : '-' ?>
                    </span>
                </p>
                <p class="text-gray-600">
                    Total Penawaran:
                    <span class="font-semibold"><?= $total ?></span>
                </p>
            </div>
        </div>
    </div>

    <!-- STATUS -->
    <div class="bg-white border rounded-lg p-5">
        <h4 class="font-semibold text-gray-700 mb-3">
            Status Lelang
        </h4>

        <p class="text-sm mb-3">
            Status:
            <?php if ($lelang['status'] === 'aktif'): ?>
                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700 font-semibold">
                    Aktif
                </span>
            <?php elseif ($lelang['status'] === 'selesai'): ?>
                <span class="px-2 py-1 text-xs rounded bg-gray-200 text-gray-700 font-semibold">
                    Selesai
                </span>
            <?php else: ?>
                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700 font-semibold">
                    <?= esc($lelang['status']) ?>
                </span>
            <?php endif; ?>
        </p>

        <div class="text-sm text-gray-600 bg-gray-50 border-l-4 border-blue-500 p-3 rounded mb-4">
            Riwayat penawaran akan diperbarui secara real-time.
        </div>

        <?php if ($lelang['status'] === 'aktif'): ?>
            <a href="<?= base_url('admin/lelang/stop/'.$lelang['id_lelang']) ?>"
               onclick="return confirm('Yakin ingin menghentikan lelang ini?')"
               class="block w-full text-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                Hentikan Lelang
            </a>
        <?php endif; ?>
    </div>

</div>

<!-- RIWAYAT -->
<div class="bg-white border rounded-lg p-5">

    <div class="flex justify-between items-center mb-4">
        <h4 class="font-semibold text-gray-800">
            Riwayat Penawaran
        </h4>
        <button onclick="location.reload()"
                class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
            Refresh
        </button>
    </div>

    <?php if (empty($penawaran)): ?>
        <p class="text-sm text-gray-500">
            Belum ada penawaran pada lelang ini.
        </p>
    <?php else: ?>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-200">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-3 py-2 border text-center">No</th>
                    <th class="px-3 py-2 border text-left">User</th>
                    <th class="px-3 py-2 border text-left">Nominal</th>
                    <th class="px-3 py-2 border text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($penawaran as $p): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-3 py-2 border text-center"><?= $no++ ?></td>
                    <td class="px-3 py-2 border">
                        <?= isset($p['nama']) ? esc($p['nama']) : 'User #'.$p['id_user'] ?>
                    </td>
                    <td class="px-3 py-2 border font-semibold text-green-700">
                        Rp <?= number_format($p['harga_penawaran'],0,',','.') ?>
                    </td>
                    <td class="px-3 py-2 border text-gray-600">
                        <?= date('d M Y H:i:s', strtotime($p['waktu_penawaran'])) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php endif; ?>
</div>

<?php endif; ?>

<?= $this->endSection() ?>
