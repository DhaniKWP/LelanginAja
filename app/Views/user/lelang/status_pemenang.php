<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            🏆 Status Pemenang Lelang
        </h2>
        <p class="text-gray-500 text-sm">
            Informasi lelang yang berhasil kamu menangkan dan status pembayarannya
        </p>
    </div>

    <?php if (empty($pemenang)): ?>

        <!-- EMPTY STATE -->
        <div class="bg-white rounded-xl shadow p-8 text-center">
            <p class="text-gray-600">
                Kamu belum memenangkan lelang manapun.
            </p>
            <a href="<?= base_url('user/lelang/aktif') ?>"
               class="inline-block mt-4 text-blue-600 font-semibold hover:underline text-sm">
                Lihat Lelang Aktif →
            </a>
        </div>

    <?php else: ?>

        <?php foreach ($pemenang as $p): ?>

        <?php
            // NORMALISASI STATUS
            $status = $p['status_bayar'] ?? 'unpaid';
        ?>

        <div class="bg-white rounded-xl shadow p-6 border-l-4
            <?= ($status === 'paid') ? 'border-green-500' 
                : (($status === 'pending') ? 'border-blue-400' : 'border-yellow-400') ?>">

            <!-- UCAPAN -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800">
                    🎉 Selamat! Kamu memenangkan lelang
                </h3>
                <p class="text-sm text-gray-600">
                    Barang <b><?= esc($p['nama_barang']) ?></b> berhasil kamu menangkan.
                </p>
            </div>

            <!-- INFO -->
            <div class="grid md:grid-cols-3 gap-4 text-sm mb-4">

                <div>
                    <p class="text-gray-500">Harga Menang</p>
                    <p class="font-semibold text-blue-600">
                        Rp <?= number_format($p['harga_menang']) ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Metode Pembayaran</p>
                    <p class="font-medium">
                        <?= $p['metode'] ?? '-' ?>
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Status Pembayaran</p>

                    <?php if ($status === 'paid'): ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">
                            LUNAS
                        </span>

                    <?php elseif ($status === 'pending'): ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">
                            MENUNGGU VERIFIKASI ADMIN
                        </span>

                    <?php elseif ($status === 'rejected'): ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 font-semibold">
                            DITOLAK
                        </span>

                    <?php else: ?>
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                            BELUM DIBAYAR
                        </span>
                    <?php endif; ?>

                </div>
            </div>

            <!-- AKSI -->
            <div class="flex gap-3">

                <?php if ($status === 'paid'): ?>

                    <span class="px-4 py-2 rounded-lg bg-green-100
                                text-green-700 text-sm font-semibold">
                        ✅ Pembayaran telah diverifikasi
                    </span>

                <?php elseif ($status === 'rejected'): ?>

                    <a href="<?= base_url('user/pembayaran/'.$p['id_lelang']) ?>"
                       class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700
                              text-white text-sm font-semibold">
                        🔄 Upload Ulang Bukti
                    </a>

                <?php elseif ($status === 'pending'): ?>

                    <span class="px-4 py-2 rounded-lg bg-gray-100
                                 text-gray-500 text-sm font-semibold cursor-not-allowed">
                        ⏳ Menunggu Verifikasi Admin
                    </span>

                <?php else: ?>

                    <a href="<?= base_url('user/pembayaran/'.$p['id_lelang']) ?>"
                       class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700
                              text-white text-sm font-semibold">
                        💳 Upload Bukti Pembayaran
                    </a>

                <?php endif; ?>

            </div>

        </div>

        <?php endforeach; ?>

        <!-- CATATAN -->
        <div class="text-xs text-gray-500">
            <span class="font-semibold">Catatan:</span>
            Setelah bukti pembayaran dikirim, silakan tunggu admin melakukan verifikasi.
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
