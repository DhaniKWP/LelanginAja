<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<h2 class="text-2xl font-bold mb-4 text-blue-700">📢 Lelang Aktif</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-700 text-sm">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (empty($lelang)): ?>
    <div class="p-6 bg-white rounded-lg shadow text-center text-gray-500">
        Belum ada lelang yang sedang aktif saat ini.
    </div>
<?php else: ?>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    <?php foreach ($lelang as $l): ?>
        <div class="border rounded-xl shadow-sm bg-white overflow-hidden flex flex-col">
            
            <?php if (!empty($l['foto'])): ?>
                <img src="/uploads/barang/<?= esc($l['foto']) ?>" 
                     class="h-44 w-full object-cover" 
                     alt="<?= esc($l['nama_barang']) ?>">
            <?php else: ?>
                <div class="h-44 w-full flex items-center justify-center bg-gray-100 text-gray-400 text-sm">
                    Tidak ada foto
                </div>
            <?php endif; ?>

            <div class="p-4 flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-gray-800 mb-1">
                    <?= esc($l['nama_barang']) ?>
                </h3>

                <p class="text-gray-600 text-sm">
                    Harga Awal:
                    <span class="font-semibold">
                        Rp <?= number_format($l['harga_awal'], 0, ',', '.') ?>
                    </span>
                </p>

                <p class="text-gray-700 text-sm">
                    Highest Bid:
                    <span class="text-green-600 font-bold">
                        Rp <?= number_format($l['highest_bid'], 0, ',', '.') ?>
                    </span>
                </p>

                <p class="text-xs mt-2 text-gray-500 leading-snug">
                    Mulai: <?= date('d M Y H:i', strtotime($l['tanggal_mulai'])) ?><br>
                    Selesai: <?= date('d M Y H:i', strtotime($l['tanggal_selesai'])) ?>
                </p>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-2 rounded mt-3">
                    <span class="text-xs font-semibold text-blue-700 block">Sisa Waktu:</span>
                    <span class="text-blue-600 font-bold text-sm countdown" 
                          data-end="<?= esc($l['tanggal_selesai']) ?>">
                        -
                    </span>
                </div>

                <div class="flex justify-between items-center mt-4 gap-2">
                    <a href="<?= base_url('admin/lelang/monitor/' . $l['id_lelang']) ?>"
                       class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                        Monitoring
                    </a>

                    <a href="<?= base_url('admin/lelang/stop/' . $l['id_lelang']) ?>"
                       onclick="return confirm('Hentikan lelang ini?')"
                       class="px-3 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600">
                        Stop
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<script>
// Countdown tiap card
document.querySelectorAll('.countdown').forEach(el => {
    const end = new Date(el.dataset.end).getTime();

    function updateCountdown() {
        const now  = new Date().getTime();
        const diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "<span class='text-red-600 font-bold'>Selesai</span>";
            return;
        }

        const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const m = Math.floor((diff / (1000 * 60)) % 60);
        const s = Math.floor((diff / 1000) % 60);

        let txt = '';
        if (d > 0) txt += d + "h ";
        txt += h + "j " + m + "m " + s + "d";

        el.textContent = txt;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>

<?= $this->endSection() ?>
