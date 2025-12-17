<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-8">

    <!-- HEADER -->
    <div>
        <a href="<?= base_url('admin/pemenang') ?>"
           class="text-sm text-blue-600 hover:underline flex items-center gap-1 mb-2">
            <i class="fas fa-chevron-left text-xs"></i> Kembali ke Daftar Pemenang
        </a>

        <h2 class="text-3xl font-bold text-blue-700">
            🏆 Detail Pemenang Lelang
        </h2>
    </div>

    <!-- ================= INFO BARANG ================= -->
    <div class="bg-white shadow rounded-xl p-6 grid md:grid-cols-2 gap-6">

        <img src="/uploads/barang/<?= esc($pemenang['foto']) ?>"
             class="w-full h-64 object-cover rounded-lg shadow">

        <div class="space-y-3">
            <h3 class="text-2xl font-semibold">
                <?= esc($pemenang['nama_barang']) ?>
            </h3>

            <p class="text-gray-600">
                Harga Awal:
                <b class="text-blue-600">
                    Rp <?= number_format($pemenang['harga_awal']) ?>
                </b>
            </p>

            <p class="text-gray-600">
                Harga Menang:
                <b class="text-green-600 text-xl">
                    Rp <?= number_format($pemenang['harga_menang']) ?>
                </b>
            </p>

            <p class="text-sm text-gray-500">
                Lelang selesai:
                <?= date('d M Y H:i', strtotime($pemenang['tanggal_selesai'])) ?>
            </p>
        </div>
    </div>

    <!-- ================= DATA PEMENANG ================= -->
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-4">👤 Data Pemenang</h3>

        <table class="w-full text-sm">
            <tr class="border-b">
                <td class="py-2 w-1/3 font-medium">Nama</td>
                <td><?= esc($pemenang['nama']) ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 font-medium">Email</td>
                <td><?= esc($pemenang['email']) ?></td>
            </tr>
            <tr class="border-b">
                <td class="py-2 font-medium">No. HP</td>
                <td><?= esc($pemenang['no_hp']) ?></td>
            </tr>
            <tr>
                <td class="py-2 font-medium">Alamat</td>
                <td><?= esc($pemenang['alamat']) ?></td>
            </tr>
        </table>
    </div>

    <!-- ================= PEMBAYARAN ================= -->
    <div class="bg-white shadow rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-4">💳 Status Pembayaran</h3>

        <?php if (!empty($pemenang['status_bayar'])): ?>

        <div class="p-4 bg-green-50 border border-green-200 rounded-lg space-y-2">
            <p>
                Status:
                <span class="px-3 py-1 rounded bg-green-100 text-green-700 font-semibold">
                    LUNAS
                </span>
            </p>

            <p>
                Metode Pembayaran:
                <b><?= esc($pemenang['metode']) ?></b>
            </p>

            <p>
                Tanggal Bayar:
                <?= date('d M Y H:i', strtotime($pemenang['tanggal_bayar'])) ?>
            </p>

            <?php if (!empty($pemenang['bukti_transfer'])): ?>
                <div class="mt-3">
                    <p class="font-medium mb-2">Bukti Transfer:</p>
                    <img src="/uploads/bukti/<?= esc($pemenang['bukti_transfer']) ?>"
                        class="w-64 rounded shadow cursor-pointer">
                </div>
            <?php endif; ?>
        </div>

    <?php else: ?>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p>
                Status:
                <span class="px-3 py-1 rounded bg-yellow-100 text-yellow-700 font-semibold">
                    BELUM DIBAYAR
                </span>
            </p>
            <p class="text-sm text-gray-600 mt-1">
                Menunggu pembayaran dari pemenang.
            </p>
        </div>

    <?php endif; ?>
    </div>


</div>

<?= $this->endSection() ?>
