<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto p-8">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
            <i class="fas fa-cubes text-blue-600"></i> Barang Saya
        </h2>

        <a href="/user/barang/create"
           class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
           + Ajukan Barang
        </a>
    </div>

    <!-- Flash Success -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="mb-5 p-3 bg-green-100 border border-green-300 text-green-700 rounded-md shadow-sm">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <!-- Jika Belum Ada Barang -->
    <?php if(empty($barang)): ?>
        <div class="text-center py-16 bg-gradient-to-br from-blue-50 to-white border border-gray-200 rounded-xl shadow-sm">

            <div class="flex flex-col items-center mb-5">
                <div class="w-20 h-20 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full text-4xl mb-4 shadow">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700">Belum Ada Barang Diajukan</h3>
            </div>

            <p class="text-gray-600 leading-relaxed max-w-md mx-auto mb-6">
                Kamu belum mengajukan barang untuk dilelang.  
                Ajukan barang terbaikmu dan biarkan pembeli bersaing menawar harga terbaik 🚀
            </p>

            <ul class="text-sm text-gray-600 max-w-md mx-auto mb-8 space-y-1">
                <li>• Pastikan foto barang jelas dan tidak blur</li>
                <li>• Jelaskan kondisi secara detail & jujur</li>
                <li>• Barang ilegal/berbahaya tidak diperbolehkan</li>
                <li>• Setelah diproses admin, barang akan masuk jadwal lelang</li>
            </ul>

            <a href="/user/barang/create" 
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg font-medium text-sm transition">
                + Ajukan Barang Sekarang
            </a>
        </div>

    <?php else: ?>


    <!-- List Barang -->
    <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-7">

        <?php foreach($barang as $b): ?>

        <div class="bg-white rounded-xl shadow hover:shadow-xl transition duration-300 overflow-hidden">

            <!-- FOTO -->
            <div class="w-full h-48 bg-gray-100 overflow-hidden">
                <img src="/uploads/barang/<?= $b['foto'] ?>" 
                     class="w-full h-full object-cover hover:scale-105 transition duration-300">
            </div>

            <!-- CONTENT -->
            <div class="p-4 space-y-2">

                <h3 class="font-bold text-gray-800 text-lg flex justify-between items-center">
                    <?= $b['nama_barang'] ?>
                </h3>

                <?php if(isset($b['kategori_barang'])): ?>
                    <p class="text-xs text-gray-600 mt-1">Kategori: 
                        <span class="font-medium text-blue-600"><?= $b['kategori_barang'] ?></span>
                    </p>
                <?php endif; ?>

                <p class="text-gray-500 text-sm">Harga Awal:</p>
                <p class="text-blue-700 font-bold text-xl">Rp <?= number_format($b['harga_awal']) ?></p>

                <!-- STATUS BADGE -->
                <span class="
                    inline-block rounded-full px-3 py-1 text-sm font-medium
                    <?php if($b['status_pengajuan']=='pending'){echo 'bg-yellow-200 text-yellow-800';}
                          elseif($b['status_pengajuan']=='approved'){echo 'bg-green-600 text-white';}
                          else{echo 'bg-red-600 text-white';} ?>">
                    <?= ucfirst($b['status_pengajuan']) ?>
                </span>

                <p class="text-xs text-gray-500 italic">
                    <?php if($b['status_pengajuan']=='pending'): ?>
                        ⏳ Menunggu verifikasi admin
                    <?php elseif($b['status_pengajuan']=='approved'): ?>
                        ✔ Disetujui · Menunggu jadwal lelang
                    <?php else: ?>
                        ❗ Ditolak — silakan ajukan ulang
                    <?php endif; ?>
                </p>

                <p class="text-xs text-gray-600 mt-1">📅 <?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?></p>

            </div>

            <!-- ACTION BUTTON -->
            <div class="p-4 border-t flex gap-2">

                <?php if($b['status_pengajuan']=='rejected'): ?>
                    <a href="/user/barang/edit/<?= $b['id_barang'] ?>" 
                       class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg font-medium">
                       Ajukan Ulang
                    </a>
                <?php elseif($b['status_pengajuan']=='pending'): ?>
                    <button disabled class="flex-1 bg-gray-400 text-white py-2 rounded-lg opacity-80 cursor-not-allowed">
                        Menunggu Review
                    </button>
                <?php elseif($b['status_pengajuan']=='approved'): ?>
                    <span class="flex-1 text-center bg-green-600 text-white py-2 rounded-lg font-medium">
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
