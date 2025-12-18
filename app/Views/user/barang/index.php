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
    <div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 gap-8">

        <?php foreach($barang as $b): ?>

        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl
            transition duration-300 overflow-hidden border border-gray-100">

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

                <?php if($b['status_pengajuan']=='approved'): ?>
                <div class="mt-3 text-sm">

                    <?php if(empty($b['id_lelang'])): ?>
                        <div class="flex items-start gap-2 text-blue-700">
                            <span class="mt-1">⏳</span>
                            <p>
                                <b>Menunggu Jadwal Lelang</b><br>
                                <span class="text-xs text-gray-500">
                                    Admin akan menentukan waktu mulai dan selesai lelang
                                </span>
                            </p>
                        </div>

                    <?php elseif($b['status_lelang']=='aktif'): ?>
                        <div class="flex items-start gap-2 text-green-700">
                            <span class="mt-1">🔴</span>
                            <p>
                                <b>Lelang Sedang Berlangsung</b><br>
                                <span class="text-xs text-gray-500">
                                    Penawaran masih dibuka sampai waktu berakhir
                                </span>
                            </p>
                        </div>

                    <?php elseif($b['status_lelang']=='selesai'): ?>
                        <div class="flex items-start gap-2 text-gray-700">
                            <span class="mt-1">🏁</span>
                            <p>
                                <b>Lelang Telah Selesai</b><br>
                                <span class="text-xs text-gray-500">
                                    Menunggu konfirmasi admin & pembayaran pemenang
                                </span>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
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
                       
                    <?php else: ?>
                        ❗ Ditolak — silakan ajukan ulang
                    <?php endif; ?>
                </p>

                <p class="text-xs text-gray-600 mt-1">📅 <?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?></p>

            </div>

            <!-- ACTION BUTTON -->
            <div class="p-5 border-t bg-gray-50 space-y-3">

            <?php if($b['status_pengajuan']=='rejected'): ?>
                <a href="/user/barang/edit/<?= $b['id_barang'] ?>" 
                class="block w-full bg-yellow-500 hover:bg-yellow-600
                        text-white py-3 rounded-xl text-center font-semibold transition">
                    Ajukan Ulang Barang
                </a>

            <?php elseif($b['status_pengajuan']=='pending'): ?>
                <div class="bg-white border border-gray-200 rounded-xl p-4 text-center">
                    <p class="font-semibold text-gray-700">
                        Menunggu Review Admin
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        Barang akan diperiksa sebelum masuk jadwal lelang
                    </p>
                </div>

            <?php elseif($b['status_pengajuan']=='approved'): ?>

                <?php if(empty($b['id_lelang'])): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                        <p class="font-semibold text-blue-800 text-lg">
                            Barang Disetujui
                        </p>
                        <p class="text-sm text-blue-700 mt-1">
                            Menunggu penjadwalan lelang oleh admin
                        </p>
                    </div>

                <?php elseif($b['status_lelang']=='aktif'): ?>
                    <a href="<?= base_url('user/lelang/monitoring/'.$b['id_lelang']) ?>"
                    class="block w-full bg-green-600 hover:bg-green-700
                            text-white py-4 rounded-xl text-center font-bold transition">
                        Monitoring Lelang
                        <p class="text-xs font-normal opacity-90 mt-1">
                            Lelang sedang berlangsung
                        </p>
                    </a>

                <?php elseif($b['status_lelang']=='selesai'): ?>
                    <a href="<?= base_url('user/barang/hasil') ?>"
                    class="block w-full bg-gray-900 hover:bg-black
                            text-white py-4 rounded-xl text-center font-semibold transition">
                        Lihat Hasil Lelang
                        <p class="text-xs font-normal opacity-80 mt-1">
                            Status pemenang & pembayaran
                        </p>
                    </a>
                <?php endif; ?>

            <?php endif; ?>

            </div>

        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
