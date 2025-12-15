<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <h2 class="text-2xl font-semibold text-blue-700 mb-5">👥 Manajemen Peserta Lelang</h2>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded mb-3">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama User</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Tanggal Daftar</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php $no=1; foreach($registrasi as $r): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2"><?= $no++ ?></td>
                    <td class="px-4 py-2 font-medium"><?= $r['nama'] ?></td>
                    <td class="px-4 py-2 text-gray-600"><?= $r['email'] ?></td>
                    <td class="px-4 py-2"><?= $r['tanggal_daftar'] ?></td>
                    <td class="px-4 py-2">
                        <?php if($r['status'] === 'pending'): ?>
                            <span class="px-3 py-1 rounded bg-yellow-400 text-sm font-medium">
                                Pending
                            </span>

                        <?php elseif($r['status'] === 'disetujui'): ?>
                            <span class="px-3 py-1 rounded bg-green-500 text-white text-sm font-medium">
                                Disetujui
                            </span>

                        <?php elseif($r['status'] === 'ditolak'): ?>
                            <span class="px-3 py-1 rounded bg-red-500 text-white text-sm font-medium">
                                Ditolak
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2 text-center">

                        <?php if($r['status']=='pending'): ?>
                            <a href="/admin/peserta/approve/<?= $r['id_reg'] ?>" 
                                class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-sm">
                                Approve
                            </a>
                            <a href="/admin/peserta/reject/<?= $r['id_reg'] ?>" 
                                onclick="return confirm('Tolak pendaftaran?')"
                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">
                                Reject
                            </a>
                        <?php else: ?>
                            <span class="text-gray-500 text-sm">-</span>
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

<?= $this->endSection() ?>
