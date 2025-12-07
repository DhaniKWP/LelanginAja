<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-3xl font-bold text-blue-700 mb-6">🏆 Penentuan Pemenang Lelang</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach($lelang as $l): ?>

        <?php 
            // Ambil bid tertinggi
            $highest = model('TransaksiPenawaranModel')
                        ->where('id_lelang',$l['id_lelang'])
                        ->orderBy('harga_penawaran','DESC')
                        ->first();
            
            // Cek apakah sudah ada pemenang
            $pemenang = model('TransaksiPemenangModel')
                        ->where('id_lelang',$l['id_lelang'])
                        ->join('users','users.id_user=transaksi_pemenang.id_user')
                        ->first();
        ?>

        <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition p-4">

            <img src="/uploads/barang/<?= $l['foto'] ?>" 
                 class="w-full h-40 object-cover rounded-lg mb-3">

            <h3 class="text-lg font-semibold text-gray-800 mb-1"><?= $l['nama_barang'] ?></h3>
            <p class="text-gray-600 text-sm">ID Lelang: <b>#<?= $l['id_lelang'] ?></b></p>
            <p class="text-gray-600 text-sm">Berakhir: <b><?= $l['tanggal_selesai'] ?></b></p>

            <div class="mt-3 p-3 rounded bg-blue-50 border border-blue-200">
                <p class="text-sm text-gray-600">Bid Tertinggi:</p>
                <p class="font-bold text-blue-700 text-lg">
                    <?= $highest ? 'Rp '.number_format($highest['harga_penawaran']) : 'Belum ada penawaran' ?>
                </p>
            </div>

            <?php if(!$pemenang): ?>
                <a href="/admin/pemenang/pilih/<?= $l['id_lelang'] ?>"
                   class="block mt-4 text-center bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded-lg">
                   Tentukan Pemenang
                </a>
            
            <?php else: ?>
                <div class="mt-4 p-3 rounded bg-green-50 border border-green-200">
                    <p class="text-sm text-gray-700">Pemenang:</p>
                    <p class="font-bold text-green-700 text-lg"><?= $pemenang['nama'] ?></p>
                    <p class="text-gray-700 text-sm">Harga Menang:</p>
                    <p class="font-bold text-green-600 text-lg">Rp <?= number_format($pemenang['harga_menang']) ?></p>
                </div>

                <a href="/admin/pembayaran/<?= $pemenang['id_pemenang'] ?>" 
                   class="block mt-4 text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg">
                    Lanjut ke Pembayaran
                </a>
            <?php endif; ?>

        </div>

        <?php endforeach; ?>
    </div>

</div>

<?= $this->endSection() ?>
