<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Jadwal Lelang Barang
        </h2>
        <p class="text-sm text-gray-500">
            Daftar jadwal lelang yang telah dibuat
        </p>
    </div>

    <a href="<?= base_url('admin/lelang/create') ?>"
       class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
        + Buat Jadwal Lelang
    </a>
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
            <th class="p-3 border">Foto</th>
            <th class="p-3 border text-left">Nama Barang</th>
            <th class="p-3 border text-left">Mulai</th>
            <th class="p-3 border text-left">Selesai</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($lelang)): ?>
        <tr>
            <td colspan="6" class="p-4 text-center text-gray-500">
                Belum ada jadwal lelang
            </td>
        </tr>
    <?php else: ?>

        <?php foreach($lelang as $l): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center">
                <img src="/uploads/barang/<?= esc($l['foto']) ?>"
                     class="w-14 h-14 object-cover rounded border">
            </td>

            <td class="p-3 border font-medium">
                <?= esc($l['nama_barang']) ?>
            </td>

            <td class="p-3 border">
                <?= date('d M Y H:i', strtotime($l['tanggal_mulai'])) ?>
            </td>

            <td class="p-3 border">
                <?= date('d M Y H:i', strtotime($l['tanggal_selesai'])) ?>
            </td>

            <td class="p-3 border text-center">
                <?php if($l['status']=='aktif'): ?>
                    <span class="text-green-600 font-medium">Aktif</span>
                <?php elseif($l['status']=='selesai'): ?>
                    <span class="text-gray-600 font-medium">Selesai</span>
                <?php else: ?>
                    <span class="text-red-600 font-medium">Dibatalkan</span>
                <?php endif; ?>
            </td>

            <td class="p-3 border text-center space-x-4">
                <a href="<?= base_url('admin/lelang/edit/'.$l['id_lelang']) ?>"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>

                <a href="javascript:void(0)"
                   onclick="return confirmDelete('<?= base_url('admin/lelang/delete/'.$l['id_lelang']) ?>')"
                   class="text-red-600 hover:underline">
                    Hapus
                </a>
            </td>

        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
</div>
<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data lelang yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
<?= $this->endSection() ?>
