<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">Lelang Aktif</h2>
    <p class="text-sm text-gray-500">
        Daftar lelang yang sedang berlangsung & menunggu validasi admin
    </p>
</div>

<!-- FILTER -->
<div class="mb-4 flex gap-3">
    <a href="<?= base_url('admin/lelang/aktif') ?>"
       class="px-4 py-2 text-sm rounded border <?= !isset($_GET['filter']) ? 'bg-blue-600 text-white' : '' ?>">
        Semua
    </a>

    <a href="<?= base_url('admin/lelang/aktif?filter=running') ?>"
       class="px-4 py-2 text-sm rounded border <?= ($_GET['filter'] ?? '')=='running' ? 'bg-blue-600 text-white' : '' ?>">
        Masih Berjalan
    </a>

    <a href="<?= base_url('admin/lelang/aktif?filter=expired') ?>"
       class="px-4 py-2 text-sm rounded border <?= ($_GET['filter'] ?? '')=='expired' ? 'bg-blue-600 text-white' : '' ?>">
        Waktu Habis
    </a>
</div>

<!-- TABLE -->
<div class="bg-white border rounded-lg overflow-hidden">
<table class="w-full text-sm border-collapse">

    <thead class="bg-gray-50">
        <tr>
            <th class="p-3 border">Foto</th>
            <th class="p-3 border text-left">Nama Barang</th>
            <th class="p-3 border text-left">Harga Awal</th>
            <th class="p-3 border text-left">Bid Tertinggi</th>
            <th class="p-3 border text-left">Selesai</th>
            <th class="p-3 border text-center">Status Waktu</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($lelang)): ?>
        <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">
                Tidak ada data lelang
            </td>
        </tr>
    <?php else: foreach($lelang as $l): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center">
                <img src="/uploads/barang/<?= esc($l['foto']) ?>"
                     class="w-14 h-14 object-cover rounded border">
            </td>

            <td class="p-3 border font-medium">
                <?= esc($l['nama_barang']) ?>
            </td>

            <td class="p-3 border">
                Rp <?= number_format($l['harga_awal'],0,',','.') ?>
            </td>

            <td class="p-3 border text-green-600 font-semibold">
                <?php if ($l['highest_bid'] === null): ?>
                    <span class="text-gray-400">-</span>
                <?php else: ?>
                    Rp <?= number_format($l['highest_bid'],0,',','.') ?>
                <?php endif; ?>
            </td>

            <td class="p-3 border">
                <?= date('d M Y H:i', strtotime($l['tanggal_selesai'])) ?>
            </td>

            <td class="p-3 border text-center">
                <?php if($l['is_expired']): ?>
                    <span class="text-red-600 font-semibold">Waktu Habis</span>
                <?php else: ?>
                    <span class="text-green-600 font-semibold">Berjalan</span>
                <?php endif; ?>
            </td>

            <td class="p-3 border text-center space-x-3">
                <a href="<?= base_url('admin/lelang/monitor/'.$l['id_lelang']) ?>"
                   class="text-blue-600 hover:underline">
                    Monitoring
                </a>

                <?php if($l['is_expired']): ?>
                <a href="<?= base_url('admin/lelang/stop/'.$l['id_lelang']) ?>"
                   onclick="return confirm('Hentikan lelang ini?')"
                   class="text-red-600 hover:underline">
                    Stop
                </a>
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; endif; ?>
    </tbody>

</table>
</div>

<?= $this->endSection() ?>
