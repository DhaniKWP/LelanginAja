<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-blue-700">📦 Barang Saya</h2>
        <a href="/user/barang/create" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
           + Ajukan Barang
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <!-- Jika Belum Ada Barang -->
    <?php if(empty($barang)): ?>
        <div class="text-center p-10 bg-white rounded-lg shadow">
            <h3 class="text-lg text-gray-600 mb-3">Belum ada barang yang diajukan</h3>
            <a href="/user/barang/create" 
               class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
               + Ajukan Barang Pertama
            </a>
        </div>
    <?php else: ?>


    <!-- List Barang -->
    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">

        <?php foreach($barang as $b): ?>

        <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition duration-200">

            <!-- FOTO -->
            <img src="/uploads/barang/<?= $b['foto'] ?>" 
                 class="w-full h-48 object-cover rounded-b-none">

            <div class="p-4 space-y-2">
                
                <!-- NAMA BARANG -->
                <h3 class="font-bold text-gray-800 text-lg"><?= $b['nama_barang'] ?></h3>

                <!-- HARGA -->
                <p class="text-gray-600 text-sm">Harga Awal</p>
                <p class="text-blue-700 font-bold text-xl">Rp <?= number_format($b['harga_awal']) ?></p>

                <!-- STATUS -->
                <span class="
                    px-3 py-1 inline-block text-sm rounded-full font-medium
                    <?php if($b['status_pengajuan']=='pending'){echo 'bg-yellow-400';}
                          elseif($b['status_pengajuan']=='approved'){echo 'bg-green-600 text-white';}
                          else{echo 'bg-red-600 text-white';} ?>">
                    <?= ucfirst($b['status_pengajuan']) ?>
                </span>

                <!-- Info Tambahan -->
                <div class="text-sm text-gray-600 mt-1">
                    <p>📅 Diajukan: <b><?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?></b></p>
                </div>

                <!-- Status Keterangan -->
                <div class="text-xs text-gray-500 italic">
                    <?php if($b['status_pengajuan']=='pending'): ?>
                        ⏳ Menunggu verifikasi admin
                    <?php elseif($b['status_pengajuan']=='approved'): ?>
                        ✔ Barang disetujui, menunggu dijadwalkan lelang
                    <?php else: ?>
                        ❗ Ditolak - silakan perbarui & ajukan ulang
                    <?php endif; ?>
                </div>

            </div>

            <!-- ACTION BUTTON -->
            <div class="p-4 border-t flex gap-2">

                <?php if($b['status_pengajuan']=='rejected'): ?>
                    <a href="/user/barang/edit/<?= $b['id_barang'] ?>" 
                       class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded">
                       Ajukan Ulang
                    </a>
                <?php endif; ?>

                <?php if($b['status_pengajuan']=='pending'): ?>
                    <span class="flex-1 text-center bg-gray-400 text-white py-2 rounded opacity-80">
                        Menunggu Review
                    </span>
                <?php endif; ?>

                <?php if($b['status_pengajuan']=='approved'): ?>
                    <span class="flex-1 text-center bg-green-600 text-white py-2 rounded">
                        Disetujui ✔
                    </span>
                <?php endif; ?>

            </div>
        </div>

        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
