<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Platform Lelang Online Terpercaya
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="home" class="gradient-accent text-white py-20 lg:py-32 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <div class="relative z-10">
                <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight">
                    Platform Lelang Barang Online
                </h1>
                <p class="text-lg lg:text-xl mb-8 text-blue-50">
                    Lelang dan dapatkan barang impian Anda dengan mudah, aman, dan transparan. Bergabunglah dengan ribuan pengguna lainnya!
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?= base_url('/register') ?>" class="bg-white text-primary px-8 py-4 rounded-full font-bold text-lg hover:scale-105 transition-transform text-center shadow-xl">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </a>
                    <a href="#barang" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition-all text-center">
                        <i class="fas fa-box"></i> Lihat Barang Lelang
                    </a>
                </div>
            </div>
            <div class="hidden lg:flex justify-center items-center">
                <i class="fas fa-gavel text-white opacity-20" style="font-size: 20rem;"></i>
            </div>
        </div>
    </div>
</section>

<section id="barang" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-secondary mb-4">
                Barang Lelang Terbaru
            </h2>
            <p class="text-gray-600 text-lg">
                Jangan lewatkan kesempatan untuk mendapatkan barang favorit Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php if (empty($lelang)): ?>
                <div class="col-span-4 text-center text-gray-500">
                    Belum ada lelang aktif.
                </div>
            <?php endif; ?>

            <?php foreach ($lelang as $l): ?>
                <?php
                    // hitung sisa waktu
                    $sisa = strtotime($l['tanggal_selesai']) - time();
                    $hari = floor($sisa / 86400);
                    $jam  = floor(($sisa % 86400) / 3600);
                ?>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden
                            hover:shadow-2xl hover:-translate-y-2 transition-all">

                    <!-- FOTO -->
                    <div class="h-48 overflow-hidden">
                        <img src="/uploads/barang/<?= esc($l['foto']) ?>"
                        onclick="openImageModal(this.src)"
                        class="w-full h-full object-cover cursor-pointer hover:opacity-90 transition">
                        <p class="text-sm text-gray-400 text-center mt-2">
                            Klik foto untuk memperbesar
                        </p>
                    </div>

                    <div class="p-6">
                        <h5 class="text-xl font-bold text-secondary mb-2">
                            <?= esc($l['nama_barang']) ?>
                        </h5>

                        <div class="text-3xl font-bold text-primary my-3">
                            Rp <?= number_format($l['harga_awal'], 0, ',', '.') ?>
                        </div>

                        <div class="bg-blue-50 text-secondary font-semibold
                                    py-2 px-4 rounded-lg text-center mb-4">
                            <i class="fas fa-clock"></i>
                            <?= $hari ?> Hari <?= $jam ?> Jam
                        </div>

                        <a href="/lelang/<?= $l['id_lelang'] ?>"
                        class="block w-full bg-primary text-white py-3
                                rounded-lg font-semibold text-center
                                hover:bg-secondary transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


<!-- Categories -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-secondary mb-4">Kategori Barang</h2>
            <p class="text-gray-600 text-lg">Temukan barang sesuai kebutuhan Anda</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                <i class="fas fa-car text-primary text-6xl mb-4"></i>
                <h4 class="text-xl font-bold text-secondary">Mobil</h4>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                <i class="fas fa-motorcycle text-primary text-6xl mb-4"></i>
                <h4 class="text-xl font-bold text-secondary">Motor</h4>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                <i class="fas fa-laptop text-primary text-6xl mb-4"></i>
                <h4 class="text-xl font-bold text-secondary">Elektronik</h4>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                <i class="fas fa-tshirt text-primary text-6xl mb-4"></i>
                <h4 class="text-xl font-bold text-secondary">Fashion</h4>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="tentang" class="gradient-blue text-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4">Cara Mengikuti Lelang</h2>
            <p class="text-blue-100 text-lg">Mudah dan cepat, hanya 3 langkah</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                    1
                </div>
                <h4 class="text-2xl font-bold mb-4">Daftar Akun</h4>
                <p class="text-blue-100">Buat akun gratis dengan mengisi formulir pendaftaran. Proses cepat dan mudah!</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                    2
                </div>
                <h4 class="text-2xl font-bold mb-4">Ajukan Barang / Ikut Lelang</h4>
                <p class="text-blue-100">Ajukan barang untuk dilelang atau ikuti lelang barang yang Anda inginkan.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                    3
                </div>
                <h4 class="text-2xl font-bold mb-4">Menang & Lakukan Pembayaran</h4>
                <p class="text-blue-100">Jika menang, lakukan pembayaran dengan aman melalui sistem kami.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-secondary mb-4">Keunggulan Platform</h2>
            <p class="text-gray-600 text-lg">Mengapa memilih LelanginAja?</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h5 class="text-2xl font-bold text-secondary mb-3">Aman & Terpercaya</h5>
                <p class="text-gray-600">Sistem keamanan berlapis untuk melindungi transaksi Anda</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                    <i class="fas fa-eye"></i>
                </div>
                <h5 class="text-2xl font-bold text-secondary mb-3">Transparan</h5>
                <p class="text-gray-600">Semua proses lelang dapat dipantau secara real-time</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                    <i class="fas fa-bolt"></i>
                </div>
                <h5 class="text-2xl font-bold text-secondary mb-3">Real-time</h5>
                <p class="text-gray-600">Update harga dan status lelang secara langsung</p>
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