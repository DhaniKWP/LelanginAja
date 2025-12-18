<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<!-- Flash Messages -->
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

    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-10">

        <!-- FOTO + CAROUSEL -->
        <div class="space-y-4">

            <!-- Main Image -->
            <div class="w-full h-72 bg-gray-200 rounded-xl overflow-hidden shadow cursor-pointer">
                <img id="mainImage"
                     src="/uploads/barang/<?= $lelang['foto'] ?>"
                     onclick="openImageModal('/uploads/barang/<?= $lelang['foto'] ?>')"
                     class="w-full h-full object-cover hover:scale-105 transition duration-300">
            </div>

            <!-- Thumbnail Carousel Placeholder (future multi-image) -->
            <div class="flex gap-2 overflow-x-auto">
                <img src="/uploads/barang/<?= $lelang['foto'] ?>"
                     onclick="setMainImage(this.src)"
                     class="w-20 h-20 object-cover rounded-lg shadow cursor-pointer hover:ring-2 hover:ring-blue-500 transition">
            </div>

        </div>


        <!-- INFO BARANG -->
        <div class="space-y-5">

        <h2 class="text-2xl font-bold text-gray-800">
            <?= $lelang['nama_barang'] ?>
        </h2>

        <p class="text-sm text-gray-500">
            ID Lelang <span class="font-mono">#<?= $lelang['id_lelang'] ?></span>
        </p>


        <div class="p-5 rounded-xl border bg-gray-50 shadow-sm space-y-3">
            <div>
                <p class="text-sm text-gray-600">Harga Awal</p>
                <p class="text-2xl font-bold text-gray-800">
                    Rp <?= number_format($lelang['harga_awal']) ?>
                </p>
            </div>

            <hr>

            <div>
                <p class="text-sm text-gray-600">Penawaran Tertinggi</p>
                <p class="text-2xl font-bold text-blue-700">
                    <?= $maxBid
                        ? 'Rp ' . number_format($maxBid['harga_penawaran'])
                        : 'Belum ada penawaran' ?>
                </p>
            </div>
        </div>


        <!-- Countdown -->
        <div class="p-4 rounded-xl border bg-white shadow-sm">
            <p class="text-sm text-gray-600">Sisa Waktu Lelang</p>
            <p id="countdown" class="text-xl font-semibold text-gray-800"></p>
        </div>

        <!-- ================== LOGIKA BID ================== -->

        <?php if ($isExpired): ?>

            <!-- ⛔ LELANG HABIS -->
            <div class="p-4 bg-red-100 border border-red-300 rounded-lg text-center shadow">
                <p class="text-red-700 font-semibold text-lg">
                    ⛔ Lelang telah berakhir
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    Penawaran sudah ditutup.
                </p>
            </div>

        <?php elseif (!$isPeserta): ?>

            <!-- ⚠ BELUM PESERTA -->
            <div class="p-4 bg-yellow-100 border border-yellow-300 rounded-lg text-center shadow">
                <p class="mb-2 text-gray-700 font-medium">
                    ⚠ Kamu belum terdaftar sebagai peserta lelang.
                </p>
                <a href="/user/peserta/daftar"
                class="inline-block bg-yellow-500 hover:bg-yellow-600
                        text-white px-6 py-2 rounded-lg font-semibold">
                    Daftar Peserta untuk Ikut Bid
                </a>
            </div>

        <?php else: ?>

            <!-- ✅ FORM BID (AMAN) -->
            <div id="bidSection">
                <form action="<?= base_url('user/bid/'.$lelang['id_lelang']) ?>"
                    method="POST"
                    class="mt-4 space-y-3 bg-white p-5 rounded-xl shadow-md">

                    <label class="block text-gray-700 font-medium">
                        Masukkan Penawaran
                    </label>

                    <input type="number"
                        name="harga_penawaran"
                        class="w-full border rounded-lg p-2
                                focus:ring-2 focus:ring-blue-500"
                        placeholder="contoh: 5500000"
                        required>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700
                            text-white py-3 rounded-lg font-semibold">
                        Ajukan Penawaran
                    </button>
                </form>
                <div class="mt-4 text-sm text-gray-500 bg-gray-50 border rounded-lg p-4">
                    <p class="font-medium text-gray-700 mb-1">Catatan:</p>
                    <ul class="list-disc ml-5 space-y-1">
                        <li>Penawaran tertinggi saat lelang berakhir otomatis menjadi pemenang</li>
                        <li>Lelang tidak dapat dibatalkan setelah waktu habis</li>
                        <li>Admin akan memverifikasi hasil & pembayaran pemenang</li>
                    </ul>
                </div>
            </div>

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
        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Riwayat Penawaran
        </h3>


        <table class="w-full text-sm border-collapse rounded-xl overflow-hidden shadow-sm">
            <thead class="bg-gray-100 font-medium text-gray-700">
                <tr>
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Harga Penawaran</th>
                    <th class="p-3 text-left">Waktu</th>
                </tr>
            </thead>

            <tbody>
                <?php if($riwayat): foreach($riwayat as $r): ?>
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3"><?= $r['nama_user'] ?></td>
                    <td class="p-3 font-semibold text-blue-700">Rp <?= number_format($r['harga_penawaran']) ?></td>
                    <td class="p-3"><?= date('d/m/Y H:i', strtotime($r['waktu_penawaran'])) ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">Belum ada penawaran</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>


<!-- MODAL PREVIEW GAMBAR -->
<div id="imageModal"
     class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex items-center justify-center transition">

    <div class="absolute inset-0" onclick="closeImageModal()"></div>

    <img id="imagePreview"
         class="relative max-w-[90vw] max-h-[90vh] rounded-xl shadow-xl transform scale-95 transition-all duration-300">
</div>


<script>
// SWITCH MAIN IMAGE (carousel-ready)
function setMainImage(src) {
    document.getElementById("mainImage").src = src;
}

// FULLSCREEN IMAGE
function openImageModal(src) {
    let img = document.getElementById("imagePreview");
    let modal = document.getElementById("imageModal");

    img.src = src;
    modal.classList.remove("hidden");

    setTimeout(() => img.classList.add("scale-100"), 10);
}

function closeImageModal() {
    let img = document.getElementById("imagePreview");
    let modal = document.getElementById("imageModal");

    img.classList.remove("scale-100");
    img.classList.add("scale-95");

    setTimeout(() => modal.classList.add("hidden"), 200);
}

// COUNTDOWN TIMER
let endTime = new Date("<?= $lelang['tanggal_selesai'] ?>").getTime();
let cd = document.getElementById("countdown");

let timer = setInterval(function() {
    let now = new Date().getTime();
    let left = endTime - now;

    if(left <= 0){
    cd.innerHTML = "⛔ Lelang Selesai";
    cd.classList.replace("text-green-700","text-red-600");

    // 🔴 SEMBUNYIKAN FORM BID SAAT WAKTU HABIS
    let bidSection = document.getElementById("bidSection");
    if (bidSection) {
        bidSection.innerHTML = `
            <div class="p-4 bg-red-100 border border-red-300 rounded-lg text-center shadow">
                <p class="text-red-700 font-semibold text-lg">
                    ⛔ Lelang telah berakhir
                </p>
                <p class="text-sm text-gray-600 mt-1">
                    Penawaran sudah ditutup.
                </p>
            </div>
        `;
    }

    clearInterval(timer);
    return;
}

    let h = Math.floor(left / (1000 * 60 * 60));
    let m = Math.floor((left % (1000 * 60 * 60)) / (1000 * 60));
    let s = Math.floor((left % (1000 * 60)) / 1000);

    cd.innerHTML = `${h}j ${m}m ${s}d`;

    if(left < 10 * 60 * 1000)
        cd.classList.add("animate-pulse", "text-red-600");
}, 1000);
</script>

<?= $this->endSection() ?>
