<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Lelang Aktif
        </h2>
        <p class="text-sm text-gray-500">
            Daftar lelang yang sedang berlangsung secara real-time
        </p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 px-4 py-2 rounded border border-green-200 bg-green-50 text-green-700 text-sm">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($lelang)): ?>

        <!-- EMPTY -->
        <div class="bg-white border rounded-lg p-6 text-center text-gray-500">
            Tidak ada lelang aktif saat ini.
        </div>

    <?php else: ?>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <?php foreach ($lelang as $l): ?>
        <div class="bg-white border rounded-lg overflow-hidden hover:shadow transition flex flex-col">

            <!-- FOTO -->
            <?php if (!empty($l['foto'])): ?>
                <img src="/uploads/barang/<?= esc($l['foto']) ?>"
                     class="h-44 w-full object-cover"
                     alt="<?= esc($l['nama_barang']) ?>">
            <?php else: ?>
                <div class="h-44 flex items-center justify-center bg-gray-100 text-gray-400 text-sm">
                    Tidak ada foto
                </div>
            <?php endif; ?>

            <!-- BODY -->
            <div class="p-4 flex-1 flex flex-col">

                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    <?= esc($l['nama_barang']) ?>
                </h3>

                <div class="text-sm text-gray-600 space-y-1">
                    <p>
                        Harga Awal:
                        <span class="font-medium text-gray-800">
                            Rp <?= number_format($l['harga_awal'], 0, ',', '.') ?>
                        </span>
                    </p>

                    <p>
                        Penawaran Tertinggi:
                        <span class="font-semibold text-green-600">
                            Rp <?= number_format($l['highest_bid'], 0, ',', '.') ?>
                        </span>
                    </p>
                </div>

                <div class="mt-2 text-xs text-gray-500">
                    Mulai: <?= date('d M Y H:i', strtotime($l['tanggal_mulai'])) ?><br>
                    Selesai: <?= date('d M Y H:i', strtotime($l['tanggal_selesai'])) ?>
                </div>

                <!-- COUNTDOWN -->
                <div class="mt-3 p-2 border rounded bg-gray-50">
                    <p class="text-xs text-gray-500">Sisa Waktu</p>
                    <p class="countdown text-sm font-semibold text-blue-600"
                       data-end="<?= esc($l['tanggal_selesai']) ?>">
                        -
                    </p>
                </div>

                <!-- ACTION -->
                <div class="flex gap-3 mt-4">
                    <a href="<?= base_url('admin/lelang/monitor/'.$l['id_lelang']) ?>"
                       class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        Monitoring
                    </a>

                    <a href="<?= base_url('admin/lelang/stop/'.$l['id_lelang']) ?>"
                       onclick="return confirm('Hentikan lelang ini?')"
                       class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                        Stop
                    </a>
                </div>

            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>

</div>

<script>
document.querySelectorAll('.countdown').forEach(el => {
    const end = new Date(el.dataset.end).getTime();

    function update() {
        const now = new Date().getTime();
        const diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "<span class='text-red-600'>Selesai</span>";
            return;
        }

        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const m = Math.floor((diff / (1000 * 60)) % 60);
        const s = Math.floor((diff / 1000) % 60);

        let txt = '';
        if (d > 0) txt += d + 'h ';
        txt += h + 'j ' + m + 'm ' + s + 'd';

        el.textContent = txt;
    }

    update();
    setInterval(update, 1000);
});
</script>

<?= $this->endSection() ?>
