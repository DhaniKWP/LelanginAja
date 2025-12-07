<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-blue-700">📅 Jadwal Lelang Barang</h2>
        <a href="/admin/lelang/create" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
            + Buat Jadwal Lelang
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="p-3 mb-4 bg-green-100 border-l-4 border-green-600 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Card Grid -->
    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-5">

        <?php foreach($lelang as $l): ?>
        <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition p-4">

            <img src="/uploads/barang/<?= $l['foto'] ?>" 
                 class="w-full h-40 object-cover rounded-lg mb-3">

            <h3 class="text-lg font-bold text-gray-800"><?= $l['nama_barang'] ?></h3>

            <p class="text-gray-600 text-sm mt-1">Mulai: 
                <b><?= date('d M Y H:i',strtotime($l['tanggal_mulai'])) ?></b>
            </p>
            <p class="text-gray-600 text-sm">Selesai: 
                <b><?= date('d M Y H:i',strtotime($l['tanggal_selesai'])) ?></b>
            </p>

            <!-- Status Badge -->
            <div class="mt-2">
                <?php if($l['status']=="aktif"): ?>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs font-medium">Aktif</span>
                <?php elseif($l['status']=="selesai"): ?>
                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded text-xs font-medium">Selesai</span>
                <?php else: ?>
                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded text-xs font-medium">Dibatalkan</span>
                <?php endif; ?>
            </div>

            <!-- Aksi -->
            <div class="flex gap-2 mt-4">

                <a href="/admin/lelang/edit/<?= $l['id_lelang'] ?>"
                   class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded text-sm">
                    Edit
                </a>
                
                <a href="/admin/lelang/delete/<?= $l['id_lelang'] ?>" 
                   onclick="return confirm('Hapus jadwal ini?')"
                   class="flex-1 text-center bg-red-600 hover:bg-red-700 text-white py-2 rounded text-sm">
                    Delete
                </a>
            </div>

        </div>
        <?php endforeach; ?>

    </div>
</div>

<?= $this->endSection() ?>
