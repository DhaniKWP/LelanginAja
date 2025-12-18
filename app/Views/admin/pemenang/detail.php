<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- BACK -->
    <a href="<?= base_url('admin/pemenang') ?>"
       class="inline-flex items-center text-sm text-blue-600 hover:underline">
        ← Kembali ke Daftar Pemenang
    </a>

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Pemenang Lelang
        </h2>
        <p class="text-sm text-gray-500">
            Informasi barang, pemenang, dan status pembayaran
        </p>
    </div>

    <!-- INFO BARANG -->
    <div class="bg-white border rounded-xl p-6 grid md:grid-cols-2 gap-6">

        <!-- FOTO -->
        <?php if (!empty($pemenang['foto'])): ?>
            <img src="/uploads/barang/<?= esc($pemenang['foto']) ?>"
                 class="w-full h-64 object-cover rounded-lg border">
        <?php else: ?>
            <div class="w-full h-64 flex items-center justify-center bg-gray-100 text-gray-400 text-sm rounded-lg">
                Tidak ada foto
            </div>
        <?php endif; ?>

        <!-- INFO -->
        <div class="space-y-3">
            <h3 class="text-xl font-semibold text-gray-800">
                <?= esc($pemenang['nama_barang']) ?>
            </h3>

            <p class="text-sm text-gray-600">
                Harga Awal:
                <span class="font-semibold">
                    Rp <?= number_format($pemenang['harga_awal'], 0, ',', '.') ?>
                </span>
            </p>

            <p class="text-sm text-gray-600">
                Harga Menang:
                <span class="font-semibold text-green-600">
                    Rp <?= number_format($pemenang['harga_menang'], 0, ',', '.') ?>
                </span>
            </p>

            <p class="text-xs text-gray-500">
                Lelang selesai pada
                <?= date('d M Y H:i', strtotime($pemenang['tanggal_selesai'])) ?>
            </p>
        </div>
    </div>

    <!-- DATA PEMENANG -->
    <div class="bg-white border rounded-xl p-6">
        <h3 class="font-semibold text-gray-800 mb-4">
            Data Pemenang
        </h3>

        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-2 w-1/3 text-gray-500">Nama</td>
                <td class="py-2 font-medium"><?= esc($pemenang['nama']) ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 text-gray-500">Email</td>
                <td class="py-2"><?= esc($pemenang['email']) ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 text-gray-500">No. HP</td>
                <td class="py-2"><?= esc($pemenang['no_hp']) ?></td>
            </tr>
            <tr>
                <td class="py-2 text-gray-500">Alamat</td>
                <td class="py-2"><?= esc($pemenang['alamat']) ?></td>
            </tr>
        </table>
    </div>

    <!-- STATUS PEMBAYARAN -->
    <div class="bg-white border rounded-xl p-6">
        <h3 class="font-semibold text-gray-800 mb-4">
            Status Pembayaran
        </h3>

        <?php if ($pemenang['status_bayar'] === 'paid'): ?>

            <div class="p-4 bg-green-50 border border-green-200 rounded-lg space-y-2">
                <p class="text-sm">
                    Status:
                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-xs">
                        LUNAS
                    </span>
                </p>

                <p class="text-sm">
                    Metode:
                    <span class="font-medium"><?= esc($pemenang['metode']) ?></span>
                </p>

                <p class="text-sm">
                    Tanggal Bayar:
                    <?= date('d M Y H:i', strtotime($pemenang['tanggal_bayar'])) ?>
                </p>

                <?php if (!empty($pemenang['bukti_transfer'])): ?>
                    <div class="pt-3">
                        <p class="text-sm font-medium mb-2">Bukti Transfer</p>
                        <img src="/uploads/bukti/<?= esc($pemenang['bukti_transfer']) ?>"
                             class="w-64 rounded border shadow">
                    </div>
                <?php endif; ?>
            </div>

        <?php elseif ($pemenang['status_bayar'] === 'pending'): ?>

            <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-xs">
                    MENUNGGU VERIFIKASI
                </span>
                <p class="text-sm text-gray-600 mt-2">
                    Bukti pembayaran telah dikirim dan menunggu persetujuan admin.
                </p>
            </div>

        <?php else: ?>

            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold text-xs">
                    BELUM DIBAYAR
                </span>
                <p class="text-sm text-gray-600 mt-2">
                    Pemenang belum melakukan pembayaran.
                </p>
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
