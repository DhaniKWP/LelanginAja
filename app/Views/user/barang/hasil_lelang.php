<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto p-8">

    <!-- HEADER -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-blue-700">
            🏁 Hasil Lelang Barang Saya
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Ringkasan hasil lelang, pemenang, dan status pembayaran
        </p>
    </div>

    <?php if(empty($hasil)): ?>
        <div class="bg-white rounded-xl shadow p-12 text-center text-gray-500">
            <p class="text-lg font-medium">Belum ada hasil lelang</p>
            <p class="text-sm mt-1">
                Barang yang selesai dilelang akan muncul di halaman ini
            </p>
        </div>
    <?php else: ?>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php foreach($hasil as $h): ?>
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

            <!-- FOTO -->
            <div class="relative">
                <img src="/uploads/barang/<?= esc($h['foto']) ?>"
                     class="w-full h-48 object-cover">

                <?php if($h['harga_menang']): ?>
                    <span class="absolute top-3 right-3 bg-green-600 text-white text-xs px-3 py-1 rounded-full font-semibold">
                        TERJUAL
                    </span>
                <?php else: ?>
                    <span class="absolute top-3 right-3 bg-gray-600 text-white text-xs px-3 py-1 rounded-full font-semibold">
                        TIDAK TERJUAL
                    </span>
                <?php endif; ?>
            </div>

            <!-- CONTENT -->
            <div class="p-5 space-y-3">

                <h3 class="font-bold text-xl text-gray-800">
                    <?= esc($h['nama_barang']) ?>
                </h3>

                <?php if($h['harga_menang']): ?>

                    <!-- UCAPAN -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-sm text-green-800">
                        🎉 <b>Selamat!</b> Barang kamu berhasil terjual melalui lelang.
                    </div>

                    <div class="text-sm space-y-1">
                        <p>
                            Harga Menang:
                            <b class="text-green-600 text-lg">
                                Rp <?= number_format($h['harga_menang']) ?>
                            </b>
                        </p>

                        <p class="text-gray-600">
                            Pemenang:
                            <b><?= esc($h['nama_pemenang']) ?></b>
                        </p>
                    </div>

                    <!-- STATUS BAYAR -->
                    <?php if($h['status_bayar'] === 'paid'): ?>
                        <div class="mt-3 bg-green-600 text-white text-center py-2 rounded-lg font-semibold">
                            Pembayaran Telah Diterima
                        </div>
                        <p class="text-xs text-gray-500 text-center mt-1">
                            Admin telah mengonfirmasi pembayaran pemenang
                        </p>
                    <?php else: ?>
                        <div class="mt-3 bg-yellow-100 border border-yellow-300 text-yellow-800 text-center py-2 rounded-lg font-semibold">
                            Menunggu Pembayaran Pemenang
                        </div>
                        <p class="text-xs text-gray-500 text-center mt-1">
                            Mohon tunggu hingga pemenang menyelesaikan pembayaran
                        </p>
                    <?php endif; ?>

                <?php else: ?>

                    <!-- TIDAK ADA PENAWARAN -->
                    <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 text-center">
                        <p class="font-semibold text-gray-700">
                            Tidak Ada Penawaran
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            Barang ini belum berhasil terjual pada sesi lelang
                        </p>
                    </div>

                <?php endif; ?>

            </div>

        </div>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
