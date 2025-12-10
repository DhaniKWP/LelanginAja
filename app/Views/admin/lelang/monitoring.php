<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<a href="<?= base_url('admin/lelang/aktif') ?>" 
   class="inline-flex items-center text-sm text-blue-600 mb-4 hover:underline">
    ← Kembali ke Lelang Aktif
</a>

<?php if (!$lelang): ?>
    <div class="p-6 bg-white rounded-xl shadow text-center text-gray-500">
        Data lelang tidak ditemukan.
    </div>
<?php else: ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
    <!-- Info Barang -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow p-4 flex gap-4">
        <?php if (!empty($lelang['foto'])): ?>
            <img src="/uploads/barang/<?= esc($lelang['foto']) ?>" 
                 class="w-32 h-32 object-cover rounded-lg border">
        <?php else: ?>
            <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-lg text-gray-400 text-xs">
                Tidak ada foto
            </div>
        <?php endif; ?>

        <div class="flex-1">
            <h2 class="text-xl font-bold text-gray-800 mb-1">
                Monitoring: <?= esc($lelang['nama_barang']) ?>
            </h2>

            <p class="text-sm text-gray-600">
                ID Lelang: <span class="font-mono"><?= esc($lelang['id_lelang']) ?></span>
            </p>

            <p class="text-sm text-gray-600 mt-1">
                Periode:
                <span class="font-semibold">
                    <?= date('d M Y H:i', strtotime($lelang['tanggal_mulai'])) ?>
                    —
                    <?= date('d M Y H:i', strtotime($lelang['tanggal_selesai'])) ?>
                </span>
            </p>

            <div class="mt-3">
                <?php 
                    $highest = $penawaran[0]['harga_penawaran'] ?? null;
                    $total   = count($penawaran);
                ?>
                <p class="text-sm">
                    Highest Bid: 
                    <span class="text-green-600 font-bold">
                        <?= $highest ? 'Rp ' . number_format($highest, 0, ',', '.') : '-' ?>
                    </span>
                </p>
                <p class="text-sm text-gray-600">
                    Total Penawaran: <span class="font-semibold"><?= $total ?></span>
                </p>
            </div>
        </div>
    </div>

    <!-- Box status / action -->
    <div class="bg-white rounded-xl shadow p-4">
        <h3 class="font-semibold text-gray-700 mb-2">Status Lelang</h3>

        <p class="text-sm text-gray-600 mb-2">
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

        <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded text-sm text-blue-800 mb-3">
            Pantau riwayat penawaran secara langsung di bawah.  
        </div>

        <a href="<?= base_url('admin/lelang/stop/'.$lelang['id_lelang']) ?>"
           onclick="return confirm('Yakin ingin menghentikan lelang ini sekarang?')"
           class="block text-center w-full px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
            Stop Lelang Sekarang
        </a>
    </div>
</div>

<!-- Tabel Riwayat Penawaran -->
<div class="bg-white rounded-xl shadow p-4">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-semibold text-gray-800">Riwayat Penawaran</h3>
        <button onclick="location.reload()" 
                class="px-3 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-700">
            Refresh
        </button>
    </div>

    <?php if (empty($penawaran)): ?>
        <p class="text-sm text-gray-500">Belum ada penawaran untuk lelang ini.</p>
    <?php else: ?>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-3 py-2 text-left">#</th>
                    <th class="px-3 py-2 text-left">User</th>
                    <th class="px-3 py-2 text-left">Nominal</th>
                    <th class="px-3 py-2 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($penawaran as $p): ?>
                <tr class="border-b">
                    <td class="px-3 py-2"><?= $no++ ?></td>
                    <td class="px-3 py-2">
                        <?= isset($p['nama']) ? esc($p['nama']) : 'User #'.$p['id_user'] ?>
                    </td>
                    <td class="px-3 py-2 font-semibold text-green-700">
                        Rp <?= number_format($p['harga_penawaran'], 0, ',', '.') ?>
                    </td>
                    <td class="px-3 py-2 text-gray-600">
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
