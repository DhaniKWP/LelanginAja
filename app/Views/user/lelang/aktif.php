<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-2xl font-semibold text-blue-700 mb-5">🔔 Lelang Aktif</h2>

    <!-- SEARCH & FILTER -->
    <div class="flex flex-wrap gap-3 mb-6">

        <!-- Search -->
        <input type="text" id="searchInput"
               placeholder="🔍 Cari barang..."
               class="border border-gray-300 rounded-lg px-4 py-2 flex-1 min-w-[200px] focus:ring-2 focus:ring-blue-500">

        <!-- Filter Kategori -->
        <select id="kategoriFilter"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Kategori</option>
            <option value="Properti">Properti</option>
            <option value="Roda Dua">Roda Dua</option>
            <option value="Roda Empat">Roda Empat</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Fashion">Fashion</option>
        </select>
    </div>

    <?php if(empty($lelang)): ?>
        <div class="text-center p-6 bg-white shadow rounded">
            <p class="text-gray-600">Belum ada lelang yang berlangsung saat ini.</p>
        </div>
    <?php endif; ?>

    <!-- LIST LELANG -->
    <div id="lelangContainer" class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">

        <?php foreach($lelang as $l): ?>
        <div class="lelang-card bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition"
             data-nama="<?= strtolower($l['nama_barang']) ?>"
             data-kategori="<?= strtolower($l['nama_kategori'] ?? '') ?>">

            <!-- CAROUSEL FOTO -->
            <div class="relative group">
                <img src="/uploads/barang/<?= $l['foto'] ?>" 
                     class="carousel-image w-full h-40 object-cover cursor-pointer"
                     onclick="openImageModal('/uploads/barang/<?= $l['foto'] ?>')">

                <!-- Indicator -->
                <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1">
                    <div class="w-2 h-2 bg-white rounded-full opacity-80"></div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-4 space-y-2">

                <h3 class="font-semibold text-lg text-gray-800"><?= $l['nama_barang'] ?></h3>

                <p class="text-gray-500 text-sm">Harga Awal:</p>
                <p class="text-blue-700 font-bold text-lg">Rp <?= number_format($l['harga_awal']) ?></p>

                <p class="text-gray-600 text-sm"><b>Selesai:</b> <?= date("d M Y H:i", strtotime($l['tanggal_selesai'])) ?></p>

                <!-- COUNTDOWN -->
                <div class="text-sm font-semibold text-red-600" 
                    id="cd-<?= $l['id_lelang'] ?>"
                    data-end="<?= $l['tanggal_selesai'] ?>">
                </div>

                <span class="inline-block px-3 py-1 bg-green-600 text-white rounded text-sm">
                    🔥 Aktif
                </span>
            </div>

            <!-- BUTTON -->
            <div class="p-4 border-t">
                <a href="<?= base_url('user/lelang/detail/'.$l['id_lelang']) ?>"
                   class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                   Ikut Lelang
                </a>
            </div>

        </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- FULLSCREEN IMAGE MODAL -->
<div id="imageModal"
     class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex items-center justify-center">

    <div class="absolute inset-0" onclick="closeImageModal()"></div>

    <img id="imagePreview" 
         class="relative max-w-[90vw] max-h-[90vh] rounded-lg shadow-xl object-contain transform scale-95 transition-all duration-300">
</div>

<script>
function applyFilter() {
    const keyword  = document.getElementById('searchInput').value.toLowerCase();
    const kategori = document.getElementById('kategoriFilter').value.toLowerCase();

    document.querySelectorAll('.lelang-card').forEach(card => {
        const nama = card.dataset.nama || '';
        const kat  = card.dataset.kategori || '';

        const matchNama     = nama.includes(keyword);
        const matchKategori = !kategori || kat === kategori;

        card.style.display = (matchNama && matchKategori) ? 'block' : 'none';
    });
}

document.getElementById('searchInput').addEventListener('keyup', applyFilter);
document.getElementById('kategoriFilter').addEventListener('change', applyFilter);

// =========================
// ⏳ COUNTDOWN REALTIME
// =========================
function updateCountdown() {
    document.querySelectorAll("[id^='cd-']").forEach(el => {
        const end = new Date(el.dataset.end).getTime();
        const now = new Date().getTime();
        const diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "⛔ Lelang Selesai";
            el.classList.remove("text-red-600");
            el.classList.add("text-gray-500");
            return;
        }

        const h = Math.floor(diff / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        el.innerHTML = `⏳ ${h}h ${m}m ${s}s`;
    });
}
setInterval(updateCountdown, 1000);
updateCountdown();

// =========================
// 🟣 MODAL IMAGE
// =========================
function openImageModal(src) {
    const img = document.getElementById("imagePreview");
    const modal = document.getElementById("imageModal");

    img.src = src;
    modal.classList.remove("hidden");

    setTimeout(() => img.classList.add("scale-100"), 10);
    document.body.style.overflow = "hidden";
}

function closeImageModal() {
    const img = document.getElementById("imagePreview");
    const modal = document.getElementById("imageModal");

    img.classList.remove("scale-100");
    img.classList.add("scale-95");

    setTimeout(() => modal.classList.add("hidden"), 200);
    document.body.style.overflow = "";
}
</script>

<?= $this->endSection() ?>
