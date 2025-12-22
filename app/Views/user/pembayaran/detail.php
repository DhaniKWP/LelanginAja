<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6 max-w-3xl mx-auto space-y-6">

    <!-- HEADER -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Pembayaran
        </h2>
        <p class="text-sm text-gray-600">
            Informasi detail transaksi pembayaran lelang.
        </p>
    </div>

    <!-- CARD DETAIL -->
    <div class="bg-white border rounded-xl shadow-sm p-6 space-y-4">

        <div class="grid grid-cols-2 gap-4 text-sm">

            <div>
                <p class="text-gray-500">ID Pembayaran</p>
                <p class="font-semibold text-gray-800">
                    #<?= esc($pembayaran['id_bayar']) ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tanggal Pembayaran</p>
                <p class="font-semibold text-gray-800">
                    <?= date('d M Y H:i', strtotime($pembayaran['tanggal_bayar'])) ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500">Metode Pembayaran</p>
                <p class="font-semibold text-gray-800 uppercase">
                    <?= esc($pembayaran['metode']) ?>
                </p>
            </div>

            <div>
                <p class="text-gray-500">Status</p>
                <?php if ($pembayaran['status'] === 'paid'): ?>
                    <span class="inline-block px-3 py-1 rounded-full
                                 bg-green-100 text-green-700 text-xs font-semibold">
                        Pembayaran Lunas
                    </span>
                <?php elseif ($pembayaran['status'] === 'pending'): ?>
                    <span class="inline-block px-3 py-1 rounded-full
                                 bg-yellow-100 text-yellow-700 text-xs font-semibold">
                        Menunggu Verifikasi
                    </span>
                <?php else: ?>
                    <span class="inline-block px-3 py-1 rounded-full
                                 bg-red-100 text-red-700 text-xs font-semibold">
                        Ditolak
                    </span>
                <?php endif; ?>
            </div>

        </div>

        <!-- DIVIDER -->
        <hr>

        <!-- BUKTI TRANSFER -->
        <div>
            <p class="text-sm font-semibold text-gray-700 mb-2">
                Bukti Transfer
            </p>

            <?php if (!empty($pembayaran['bukti_transfer'])): ?>
                <img src="/uploads/bukti/<?= esc($pembayaran['bukti_transfer']) ?>"
                     alt="Bukti Transfer"
                     class="max-h-80 rounded-lg border shadow cursor-pointer"
                     onclick="openImageModal('/uploads/bukti/<?= esc($pembayaran['bukti_transfer']) ?>')">
            <?php else: ?>
                <p class="text-sm text-gray-500">
                    Bukti transfer belum tersedia.
                </p>
            <?php endif; ?>
        </div>

    </div>

    <!-- NOTE -->
    <div class="text-xs text-gray-500 text-center">
        Detail barang dan nominal pembayaran akan ditampilkan setelah sistem pemenang lelang diaktifkan.
    </div>

    <!-- BACK -->
    <div class="text-center">
        <a href="<?= base_url('user/pembayaran/history') ?>"
           class="inline-block px-5 py-2 rounded-lg
                  bg-gray-100 hover:bg-gray-200
                  text-gray-700 text-sm font-semibold">
            ← Kembali ke Riwayat Pembayaran
        </a>
    </div>

</div>

<!-- IMAGE MODAL -->
<div id="imageModal"
     class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center">
    <div class="absolute inset-0" onclick="closeImageModal()"></div>
    <img id="imagePreview"
         class="max-w-[90vw] max-h-[90vh] rounded-xl shadow-lg">
</div>

<script>
function openImageModal(src) {
    imagePreview.src = src;
    imageModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    imageModal.classList.add('hidden');
    document.body.style.overflow = '';
}
</script>

<?= $this->endSection() ?>
