<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Riwayat Pembayaran
        </h2>
        <p class="text-sm text-gray-600">
            Daftar pembayaran lelang yang telah berhasil diselesaikan.
        </p>
    </div>

    <?php if (empty($history)): ?>
        <div class="bg-white border rounded-xl p-6 text-center text-gray-500">
            Belum ada pembayaran yang selesai.
        </div>
    <?php else: ?>

    <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="p-3 border text-center">No</th>
                    <th class="p-3 border text-left">Metode</th>
                    <th class="p-3 border text-center">Status</th>
                    <th class="p-3 border text-left">Tanggal Bayar</th>
                    <th class="p-3 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php $no = 1; foreach ($history as $h): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border text-center"><?= $no++ ?></td>

                    <td class="p-3 border font-medium text-gray-800">
                        <?= strtoupper(esc($h['metode'])) ?>
                    </td>

                    <td class="p-3 border text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            <?= $h['status'] === 'paid'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-100 text-gray-600' ?>">
                            <?= strtoupper($h['status']) ?>
                        </span>
                    </td>

                    <td class="p-3 border text-gray-700">
                        <?= date('d M Y H:i', strtotime($h['tanggal_bayar'])) ?>
                    </td>

                    <td class="p-3 border text-center">
                        <a href="<?= base_url('user/pembayaran/detail/'.$h['id_bayar']) ?>"
                           class="text-blue-600 hover:underline font-medium">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- NOTE -->
    <div class="text-xs text-gray-500">
        * Detail barang dan nominal pembayaran akan ditampilkan setelah sistem penentuan pemenang lelang diaktifkan.
    </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
