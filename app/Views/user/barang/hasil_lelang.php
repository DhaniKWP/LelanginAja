<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto p-8">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-blue-700">
            🏁 Hasil Lelang Barang Saya
        </h2>
        <p class="text-sm text-gray-500">
            Informasi hasil lelang dan status pembayaran
        </p>
    </div>

    <?php if(empty($hasil)): ?>
        <div class="bg-white rounded-xl shadow p-10 text-center text-gray-500">
            Belum ada hasil lelang.
        </div>
    <?php else: ?>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach($hasil as $h): ?>
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <img src="/uploads/barang/<?= esc($h['foto']) ?>"
                 class="w-full h-40 object-cover">

            <div class="p-4 space-y-2">

                <h3 class="font-bold text-lg">
                    <?= esc($h['nama_barang']) ?>
                </h3>

                <?php if($h['harga_menang']): ?>
                    <p class="text-sm">
                        Harga Menang:
                        <b class="text-green-600">
                            Rp <?= number_format($h['harga_menang']) ?>
                        </b>
                    </p>

                    <p class="text-xs text-gray-600">
                        Pemenang:
                        <?= esc($h['nama_pemenang']) ?>
                    </p>

                    <?php if($h['status_bayar'] == 'paid'): ?>
                        <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                            Pembayaran Diterima
                        </span>
                    <?php else: ?>
                        <span class="inline-block px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">
                            Menunggu Pembayaran
                        </span>
                    <?php endif; ?>

                <?php else: ?>
                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-600 font-medium">
                        Tidak Ada Penawaran
                    </span>
                <?php endif; ?>

            </div>

        </div>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div>

<?= $this->endSection() ?>
