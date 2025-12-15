<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= esc($barang['nama_barang']) ?> | Detail Lelang
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">

        <!-- ================= HEADER ================= -->
        <div class="grid lg:grid-cols-2 gap-10 bg-white p-8 rounded-3xl shadow-xl">

            <!-- FOTO -->
            <div class="relative">
                <img src="/uploads/barang/<?= esc($barang['foto']) ?>"
                    onclick="openImageModal(this.src)"
                    class="w-full h-96 object-cover rounded-xl shadow
                            cursor-pointer hover:scale-105 transition">
                        <p class="text-sm text-gray-400 text-center mt-2">
                            Klik foto untuk memperbesar
                        </p>
                <!-- Badge -->
                <span class="absolute top-4 left-4 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    Lelang Aktif
                </span>
            </div>

            <!-- INFO -->
            <div class="flex flex-col justify-between">

                <div>
                    <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-800 mb-2">
                        <?= esc($barang['nama_barang']) ?>
                    </h1>

                    <div class="flex flex-wrap items-center gap-3 text-sm mb-6">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-medium">
                            <?= esc($barang['nama_kategori']) ?>
                        </span>

                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                            Kondisi: <?= esc($barang['nama_kondisi']) ?>
                        </span>
                    </div>

                    <!-- Harga -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-5 rounded-xl mb-6 shadow">
                        <p class="text-sm opacity-90">Harga Awal Lelang</p>
                        <p class="text-3xl font-bold tracking-wide">
                            Rp <?= number_format($barang['harga_awal'], 0, ',', '.') ?>
                        </p>
                    </div>

                    <!-- Waktu -->
                    <div class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 p-4 rounded-xl mb-6">
                        <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        <p class="font-semibold text-yellow-700">
                            Sisa Waktu: <?= $sisaHari ?> Hari <?= $sisaJam ?> Jam
                        </p>
                    </div>
                </div>

                <!-- CTA -->
                <?php if (session()->get('id_user')): ?>
                    <a href="/user/lelang/detail/<?= $barang['id_lelang'] ?>"
                       class="block text-center bg-green-600 hover:bg-green-700
                              text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        🔨 Ikut Lelang Sekarang
                    </a>
                <?php else: ?>
                    <a href="/login"
                       class="block text-center bg-blue-600 hover:bg-blue-700
                              text-white py-4 rounded-xl font-bold text-lg transition shadow-lg">
                        🔑 Login untuk Ikut Lelang
                    </a>
                <?php endif; ?>

            </div>
        </div>

        <!-- ================= DETAIL ================= -->
        <div class="mt-12 bg-white p-10 rounded-3xl shadow-xl space-y-10">

            <!-- KEUNGGULAN -->
            <div>
                <h3 class="text-2xl font-bold mb-4">✨ Keunggulan Barang</h3>
                <ul class="grid md:grid-cols-2 gap-3 text-gray-700">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i> Barang original & sesuai foto
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i> Kondisi transparan
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i> Siap dikirim setelah lelang
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-500"></i> Proses aman & terpercaya
                    </li>
                </ul>
            </div>

            <!-- INFORMASI -->
            <div>
                <h3 class="text-2xl font-bold mb-4">📋 Informasi Barang</h3>
                <table class="w-full text-sm border rounded-xl overflow-hidden">
                    <tr class="border-b">
                        <td class="p-4 font-medium w-1/3 bg-gray-50">Kondisi</td>
                        <td class="p-4"><?= esc($barang['nama_kondisi']) ?></td>
                    </tr>
                    <tr class="border-b">
                        <td class="p-4 font-medium bg-gray-50">Tanggal Pengajuan</td>
                        <td class="p-4"><?= date('d M Y', strtotime($barang['tanggal_pengajuan'])) ?></td>
                    </tr>
                    <tr>
                        <td class="p-4 font-medium bg-gray-50">Status</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Lelang Aktif
                            </span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <h3 class="text-2xl font-bold mb-4">📝 Deskripsi Barang</h3>
                <p class="text-gray-700 leading-relaxed text-justify">
                    <?= nl2br(esc($barang['deskripsi'])) ?>
                </p>
            </div>

            <!-- CATATAN -->
            <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-xl">
                <h3 class="font-bold mb-1 text-red-700">⚠️ Catatan Pelelang</h3>
                <p class="text-gray-700 text-sm">
                    Barang dijual apa adanya sesuai foto dan deskripsi. Pastikan membaca detail sebelum melakukan penawaran.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- IMAGE PREVIEW MODAL -->
<div id="imageModal"
     class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50">

    <button onclick="closeImageModal()"
            class="absolute top-6 right-6 text-white text-3xl font-bold hover:text-red-400">
        &times;
    </button>

    <img id="modalImage"
         class="max-w-[90%] max-h-[90%] rounded-xl shadow-2xl">
</div>

<script>
function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const img   = document.getElementById('modalImage');

    img.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

<?= $this->endSection() ?>
