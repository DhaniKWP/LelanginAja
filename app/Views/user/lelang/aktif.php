<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Lelang Aktif
        </h2>
        <p class="text-gray-600 mt-1 text-sm">
            Daftar lelang yang sedang berlangsung dan dapat diikuti secara real-time.
        </p>
    </div>

    <!-- SEARCH & FILTER -->
    <div class="flex flex-wrap gap-3 bg-white p-4 rounded-xl border shadow-sm">

        <input type="text" id="searchInput"
               placeholder="Cari nama barang…"
               class="flex-1 min-w-[220px] border border-gray-300 rounded-lg px-4 py-2
                      focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

        <select id="kategoriFilter"
                class="border border-gray-300 rounded-lg px-4 py-2
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Semua Kategori</option>
            <option value="properti">Properti</option>
            <option value="roda dua">Roda Dua</option>
            <option value="roda empat">Roda Empat</option>
            <option value="elektronik">Elektronik</option>
            <option value="fashion">Fashion</option>
        </select>
    </div>

    <?php if (empty($lelang)): ?>
        <div class="bg-white border rounded-xl p-8 text-center text-gray-500">
            Saat ini belum tersedia lelang yang dapat diikuti.
        </div>
    <?php endif; ?>

    <!-- LIST LELANG (CARD SAMA DASHBOARD) -->
    <div id="lelangContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php foreach ($lelang as $l): ?>
        <div class="lelang-card bg-white border rounded-2xl overflow-hidden
                    shadow-sm hover:shadow transition"
             data-nama="<?= strtolower($l['nama_barang']) ?>"
             data-kategori="<?= strtolower($l['nama_kategori'] ?? '') ?>">

            <!-- IMAGE (SAMA DASHBOARD) -->
            <div class="relative h-40 bg-gray-100">
                <?php if (!empty($l['foto'])): ?>
                    <div class="relative h-40 bg-gray-100 group cursor-pointer"
                        onclick="openImageModal('/uploads/barang/<?= esc($l['foto']) ?>')">

                        <img src="/uploads/barang/<?= esc($l['foto']) ?>"
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
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                        Tidak ada foto
                    </div>
                <?php endif; ?>

                <span class="absolute top-3 left-3 bg-green-100 text-green-700
                             text-xs font-medium px-3 py-1 rounded-full">
                    Aktif
                </span>
            </div>

            <!-- BODY -->
            <div class="p-4 space-y-2">

                <h4 class="font-semibold text-gray-800 truncate">
                    <?= esc($l['nama_barang']) ?>
                </h4>

                <div class="text-sm text-gray-600">
                    Kategori:
                    <span class="font-medium"><?= esc($l['nama_kategori']) ?></span>
                </div>

                <div class="text-sm text-gray-600">
                    Harga Start:
                    <span class="font-semibold text-green-600">
                        Rp <?= number_format($l['harga_saat_ini'], 0, ',', '.') ?>
                    </span>
                </div>

                <div class="text-xs text-gray-500">
                    Total Penawaran: <?= $l['total_bid'] ?>
                </div>

                <div class="text-xs font-medium text-blue-600">
                    Sisa Waktu: <?= esc($l['waktu_tersisa']) ?>
                </div>

                <a href="<?= base_url('user/lelang/detail/'.$l['id_lelang']) ?>"
                   class="block mt-3 text-center text-sm px-4 py-2
                          bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Ikut Lelang
                </a>
            </div>

        </div>
        <?php endforeach; ?>

    </div>
</div>

<!-- IMAGE MODAL (SAMA DASHBOARD) -->
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center">

    <div class="absolute inset-0" onclick="closeImageModal()"></div>

    <img id="imagePreview"
         class="relative max-w-[90vw] max-h-[90vh] rounded-xl shadow-2xl
                object-contain transform scale-95 transition-all duration-300">
</div>

<script>
// =========================
// SEARCH & FILTER
// =========================
function applyFilter() {
    const keyword  = searchInput.value.toLowerCase();
    const kategori = kategoriFilter.value.toLowerCase();

    document.querySelectorAll('.lelang-card').forEach(card => {
        const nama = card.dataset.nama || '';
        const kat  = card.dataset.kategori || '';
        card.style.display =
            nama.includes(keyword) && (!kategori || kat === kategori)
            ? 'block' : 'none';
    });
}
searchInput.addEventListener('keyup', applyFilter);
kategoriFilter.addEventListener('change', applyFilter);

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
