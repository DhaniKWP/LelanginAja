<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard Pengguna
        </h2>
        <p class="text-gray-600 mt-1">
            Selamat datang kembali,
            <span class="font-semibold text-blue-600">
                <?= esc($users['nama'] ?? 'Pengguna') ?>
            </span>.
            Berikut ringkasan aktivitas akun Anda pada platform lelang.
        </p>
    </div>

    <!-- STATISTICS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- TOTAL BARANG -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm hover:shadow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Jumlah Barang Terdaftar</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">
                        <?= $stats['total_barang'] ?? 0 ?>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600
                            flex items-center justify-center text-xl">
                    📦
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">
                Total barang yang pernah Anda daftarkan ke sistem.
            </p>
        </div>

        <!-- BARANG AKTIF -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm hover:shadow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Lelang Sedang Berlangsung</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">
                        <?= $stats['barang_aktif'] ?? 0 ?>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600
                            flex items-center justify-center text-xl">
                    ⏱️
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">
                Jumlah barang Anda yang sedang dalam proses lelang aktif.
            </p>
        </div>

        <!-- TOTAL PENAWARAN -->
        <div class="bg-white border rounded-2xl p-5 shadow-sm hover:shadow transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Partisipasi Penawaran</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">
                        <?= $stats['total_penawaran'] ?? 0 ?>
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600
                            flex items-center justify-center text-xl">
                    💰
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">
                Total penawaran yang pernah Anda lakukan pada lelang.
            </p>
        </div>

    </div>

    <!-- INFO NOTE -->
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-sm text-blue-700">
        Statistik di atas menampilkan ringkasan aktivitas akun Anda.
        Informasi akan terus diperbarui sesuai dengan proses lelang yang berlangsung.
    </div>

    <!-- BARANG POPULER -->
    <div>
        <h3 class="text-xl font-semibold text-gray-800 mb-4">
            Lelang Aktif Tersedia
        </h3>

        <?php if (empty($barang_populer)): ?>
            <div class="bg-white border rounded-xl p-6 text-center text-gray-500">
                Saat ini belum tersedia data lelang aktif.
                <div class="text-sm text-gray-400 mt-1">
                    Data akan ditampilkan setelah aktivitas lelang berlangsung.
                </div>
            </div>
        <?php else: ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php foreach ($barang_populer as $barang): ?>
            <div class="bg-white border rounded-2xl overflow-hidden shadow-sm hover:shadow transition">

                <?php if (!empty($barang['foto'])): ?>
                    <div class="relative h-40 bg-gray-100 group cursor-pointer"
                        onclick="openImageModal('/uploads/barang/<?= esc($barang['foto']) ?>')">

                        <img src="/uploads/barang/<?= esc($barang['foto']) ?>"
                            class="w-full h-full object-cover">

                        <!-- OVERLAY -->
                        <div class="absolute inset-0 bg-black/30 opacity-0
                                    group-hover:opacity-100 transition
                                    flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                Klik untuk memperbesar
                            </span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                        Tidak ada foto
                    </div>
                <?php endif; ?>

                <!-- BODY -->
                <div class="p-4 space-y-2">
                    <h4 class="font-semibold text-gray-800">
                        <?= esc($barang['nama']) ?>
                    </h4>

                    <div class="text-sm text-gray-600">
                        Kategori:
                        <span class="font-medium"><?= esc($barang['kategori']) ?></span>
                    </div>

                    <div class="text-sm text-gray-600">
                        Kondisi:
                        <span class="font-medium"><?= esc($barang['kondisi']) ?></span>
                    </div>

                    <div class="text-sm text-gray-600">
                        Harga Start:
                        <span class="font-semibold text-green-600">
                            Rp <?= number_format($barang['harga_saat_ini'], 0, ',', '.') ?>
                        </span>
                    </div>

                    <div class="text-xs text-gray-500">
                        Total Penawaran: <?= $barang['total_bid'] ?>
                    </div>

                    <div class="mt-2 text-xs font-medium text-blue-600">
                        Sisa Waktu: <?= esc($barang['waktu_tersisa']) ?>
                    </div>

                    <a href="<?= base_url('user/lelang/detail/'.$barang['id']) ?>"
                       class="block mt-3 text-center text-sm px-4 py-2
                              bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Ikut Lelang
                    </a>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>
    </div>

</div>
<!-- IMAGE MODAL -->
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center">

    <div class="absolute inset-0" onclick="closeImageModal()"></div>

    <img id="imagePreview"
         class="relative max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl
                object-contain transform scale-95 transition-all duration-300">
</div>
<script>
    // =========================
// IMAGE MODAL
// =========================
function openImageModal(src) {
    imagePreview.src = src;
    imageModal.classList.remove('hidden');
    setTimeout(() => imagePreview.classList.add('scale-100'), 10);
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    imagePreview.classList.remove('scale-100');
    imagePreview.classList.add('scale-95');
    setTimeout(() => imageModal.classList.add('hidden'), 200);
    document.body.style.overflow = '';
}
</script>

<?= $this->endSection() ?>
