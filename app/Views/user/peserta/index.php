<?php $this->extend('layout/user_main'); ?>
<?php $this->section('content'); ?>

<div class="p-6 max-w-xl mx-auto">

<h2 class="text-2xl font-semibold text-blue-700 mb-4">👤 Status Peserta Lelang</h2>

<?php if(!$registrasi && !$peserta): ?>
    <!-- Belum daftar -->
    <div class="p-4 bg-red-100 border border-red-300 rounded mb-3">
        Kamu belum terdaftar sebagai peserta lelang.
    </div>

    <a href="/user/peserta/daftar" 
       class="block bg-blue-600 hover:bg-blue-700 text-white py-2 rounded text-center font-medium">
       Daftar Peserta Untuk Bisa Bid
    </a>

<?php elseif($registrasi && $registrasi['status']=='pending'): ?>
    <!-- Sudah daftar tapi belum approve -->
    <div class="p-4 bg-yellow-100 border border-yellow-300 rounded mb-3 text-center">
        <p class="font-medium text-yellow-800">Pengajuan kamu sedang menunggu verifikasi admin.</p>
    </div>

<?php elseif($peserta): ?>
    <!-- Peserta resmi -->
    <div class="bg-white p-4 rounded shadow border space-y-2">
        <p><b>Status:</b> <span class="text-green-600 font-semibold">Disetujui ✔</span></p>
        <p><b>ID Peserta:</b> <?= $peserta['id_peserta'] ?></p>
        <p><b>No HP:</b> <?= $peserta['no_hp'] ?></p>
        <p><b>Alamat:</b> <?= $peserta['alamat'] ?></p>
    </div>
<?php endif; ?>

</div>

<?= $this->endSection(); ?>
