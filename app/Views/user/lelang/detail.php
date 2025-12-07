<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="p-3 bg-green-100 border border-green-300 rounded text-green-700 mb-3">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="p-3 bg-red-100 border border-red-300 rounded text-red-700 mb-3">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>


<div class="p-6">

    <!-- Breadcrumb -->
    <a href="/user/lelang/aktif" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
        <i class="fas fa-chevron-left text-xs"></i> Kembali ke Lelang Aktif
    </a>

    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- FOTO -->
        <div>
            <img src="/uploads/barang/<?= $lelang['foto'] ?>" 
                 class="w-full rounded-xl shadow-md object-cover">
        </div>

        <!-- INFO BARANG -->
        <div class="space-y-4">

            <h2 class="text-3xl font-bold text-gray-800"><?= $lelang['nama_barang'] ?></h2>

            <p class="text-gray-500 text-sm">ID Lelang : <b>#<?= $lelang['id_lelang'] ?></b></p>

            <div class="p-4 rounded-lg border bg-blue-50">
                <p class="text-md font-medium">Harga Awal:</p>
                <p class="text-2xl text-blue-700 font-bold">
                    Rp <?= number_format($lelang['harga_awal']) ?>
                </p>
            </div>

            <div class="p-4 rounded-lg border bg-yellow-50">
                <p class="text-md font-medium">Bid Tertinggi Saat Ini:</p>
                <p class="text-2xl text-yellow-700 font-bold">
                    <?php if($maxBid): ?>
                        Rp <?= number_format($maxBid['harga_penawaran']) ?>
                    <?php else: ?>
                        <span class="text-gray-500">Belum ada penawaran</span>
                    <?php endif ?>
                </p>
            </div>

            <!-- Countdown -->
            <div class="p-3 rounded-lg border bg-green-50">
                <p class="font-medium">Sisa Waktu Lelang:</p>
                <p id="countdown" class="text-lg font-semibold text-green-700"></p>
            </div>
            
            <!-- CEK PESERTA -->
            <?php if(!$isPeserta): ?>
                <div class="p-4 bg-yellow-100 border border-yellow-300 rounded-lg text-center">
                    <p class="mb-2 text-gray-700 font-medium">⚠ Kamu belum terdaftar sebagai peserta lelang.</p>
                    <a href="/user/peserta/daftar" 
                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold">
                        Daftar Peserta untuk Ikut Bid
                    </a>
                </div>
            
            <?php else: ?>

            <!-- FORM BID -->
            <form action="<?= base_url('user/bid/'.$lelang['id_lelang']) ?>" method="POST" class="mt-4 space-y-3">

                <label class="block text-gray-700 font-medium">Masukkan Bid Anda</label>
                <input type="number" name="harga_penawaran"
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500"
                       placeholder="Contoh: 5200000" required>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow">
                    🚀 Ajukan Penawaran
                </button>
            </form>

            <?php endif; ?> 
        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="mt-10 bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-semibold mb-3 text-gray-800">📄 Deskripsi Barang</h3>
        <p class="text-gray-600 leading-relaxed"><?= nl2br($lelang['deskripsi']) ?></p>
    </div>


    <!-- RIWAYAT PENAWARAN -->
    <div class="mt-10 bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">📊 Riwayat Penawaran Terbaru</h3>

        <!-- Nanti diisi realtime dari database -->
        <table class="w-full text-sm border-collapse overflow-hidden rounded-xl">
            <thead class="bg-gray-100 font-medium text-gray-700">
                <tr>
                    <th class="p-2">User</th>
                    <th class="p-2">Harga Bid</th>
                    <th class="p-2">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php if($riwayat): foreach($riwayat as $r): ?>
                <tr class="border-b">
                    <td class="p-2"><?= $r['nama_user'] ?></td>
                    <td class="p-2 font-semibold text-blue-700">Rp <?= number_format($r['harga_penawaran']) ?></td>
                    <td class="p-2"><?= date('d/m/Y H:i', strtotime($r['waktu_penawaran'])) ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="3" class="p-3 text-center text-gray-500">Belum ada penawaran</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

</div>


<script>
// COUNTDOWN TIMER
let endTime = new Date("<?= $lelang['tanggal_selesai'] ?>").getTime();
let cd = document.getElementById("countdown");

let timer = setInterval(function(){
    let now = new Date().getTime();
    let distance = endTime - now;

    if(distance < 0){
        cd.innerHTML = "⛔ Lelang Selesai";
        cd.classList.remove("text-green-700");
        cd.classList.add("text-red-600");
        clearInterval(timer);
        return;
    }

    let h = Math.floor(distance / (1000*60*60));
    let m = Math.floor((distance % (1000*60*60)) / (1000*60));
    let s = Math.floor((distance % (1000*60)) / 1000);

    cd.innerHTML = `${h}j ${m}m ${s}d`;

    if(distance < 1000*60*10){ // last 10 minutes warning
        cd.classList.remove("text-green-700");
        cd.classList.add("text-red-600", "font-bold");
    }

},1000);
</script>

<?= $this->endSection() ?>
