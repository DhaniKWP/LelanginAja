<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Manajemen Peserta Lelang
    </h2>
    <p class="text-sm text-gray-500">
        Daftar peserta yang mendaftar untuk mengikuti lelang
    </p>
</div>

<?php if(session()->getFlashdata('success')): ?>
<div class="mb-4 text-sm text-green-600">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<!-- TABLE -->
<div class="bg-white border rounded-lg overflow-hidden">
<table class="w-full text-sm border-collapse">

    <thead class="bg-gray-50 text-gray-700">
        <tr>
            <th class="p-3 border text-center">No</th>
            <th class="p-3 border text-left">Nama</th>
            <th class="p-3 border text-left">Email</th>
            <th class="p-3 border text-center">Tanggal Daftar</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($registrasi)): ?>
        <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">
                Data peserta belum tersedia
            </td>
        </tr>
    <?php else: ?>

        <?php $no=1; foreach($registrasi as $r): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center"><?= $no++ ?></td>

            <td class="p-3 border font-medium">
                <?= esc($r['nama']) ?>
            </td>

            <td class="p-3 border text-gray-600">
                <?= esc($r['email']) ?>
            </td>

            <td class="p-3 border text-center text-gray-600">
                <?= date('d M Y', strtotime($r['tanggal_daftar'])) ?>
            </td>

            <td class="p-3 border text-center">
                <?php if($r['status'] === 'pending'): ?>
                    <span class="text-yellow-600 font-medium">Pending</span>
                <?php elseif($r['status'] === 'disetujui'): ?>
                    <span class="text-green-600 font-medium">Disetujui</span>
                <?php else: ?>
                    <span class="text-red-600 font-medium">Ditolak</span>
                <?php endif; ?>
            </td>

            <td class="p-3 border text-center space-x-3">

                <?php if($r['status'] === 'pending'): ?>
                    <a href="<?= base_url('admin/peserta/approve/'.$r['id_reg']) ?>"
                       class="text-green-600 hover:underline">
                        Setujui
                    </a>

                    <a href="<?= base_url('admin/peserta/reject/'.$r['id_reg']) ?>"
                       onclick="return confirm('Tolak pendaftaran peserta ini?')"
                       class="text-red-600 hover:underline">
                        Tolak
                    </a>
                <?php else: ?>
                    <span class="text-gray-400">—</span>
                <?php endif; ?>

            </td>

        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
</div>

<?= $this->endSection() ?>
