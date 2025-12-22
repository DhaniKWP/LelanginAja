<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Manajemen Barang Lelang
    </h2>
    <p class="text-sm text-gray-500">
        Daftar seluruh barang yang diajukan untuk lelang
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
            <th class="p-3 border">Foto</th>
            <th class="p-3 border text-left">Nama Barang</th>
            <th class="p-3 border text-left">Kategori</th>
            <th class="p-3 border text-left">Kondisi</th>
            <th class="p-3 border text-right">Harga Awal</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border text-center">Tanggal</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($barang)): ?>
        <tr>
            <td colspan="8" class="p-4 text-center text-gray-500">
                Data barang belum tersedia
            </td>
        </tr>
    <?php else: ?>

        <?php foreach($barang as $b): ?>
        <tr class="hover:bg-gray-50">

            <!-- FOTO -->
            <td class="p-3 border text-center">
                <img src="/uploads/barang/<?= esc($b['foto']) ?>"
                     class="w-12 h-12 object-cover rounded">
            </td>

            <!-- NAMA -->
            <td class="p-3 border font-medium">
                <?= esc($b['nama_barang']) ?>
            </td>

            <!-- KATEGORI -->
            <td class="p-3 border">
                <?= esc($b['nama_kategori'] ?? '-') ?>
            </td>

            <!-- KONDISI -->
            <td class="p-3 border">
                <?= esc($b['kondisi_id'] ?? '-') ?>
            </td>

            <!-- HARGA -->
            <td class="p-3 border text-right text-blue-700 font-medium">
                Rp <?= number_format($b['harga_awal']) ?>
            </td>

            <!-- STATUS -->
            <td class="p-3 border text-center">
                <?= ucfirst($b['status_pengajuan']) ?>
            </td>

            <!-- TANGGAL -->
            <td class="p-3 border text-center text-gray-500">
                <?= date('d M Y', strtotime($b['tanggal_pengajuan'])) ?>
            </td>

            <!-- AKSI -->
            <td class="p-3 border text-center space-x-3">

                <a href="<?= base_url('admin/barang/edit/'.$b['id_barang']) ?>"
                   class="text-blue-600 hover:underline">
                    Edit
                </a>

                <a href="javascript:void(0)"
                   onclick="confirmDelete('<?= base_url('admin/barang/delete/'.$b['id_barang']) ?>')"
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
        text: 'Data barang yang dihapus tidak bisa dikembalikan!',
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
