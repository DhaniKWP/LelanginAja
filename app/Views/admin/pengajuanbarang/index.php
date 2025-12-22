<?= $this->extend('layout/admin_main') ?>
<?= $this->section('content') ?>

<!-- HEADER -->
<div class="mb-5">
    <h2 class="text-2xl font-bold text-gray-800">
        Pengajuan Barang Pending
    </h2>
    <p class="text-sm text-gray-500">
        Daftar barang yang menunggu persetujuan admin
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
            <th class="p-3 border text-right">Harga Awal</th>
            <th class="p-3 border text-center">Status</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if(empty($barang)): ?>
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                Tidak ada pengajuan barang pending
            </td>
        </tr>
    <?php else: ?>

        <?php foreach($barang as $b): ?>
        <tr class="hover:bg-gray-50">

            <td class="p-3 border text-center">
                <img src="/uploads/barang/<?= esc($b['foto']) ?>"
                     class="w-14 h-14 object-cover rounded border">
            </td>

            <td class="p-3 border font-medium">
                <?= esc($b['nama_barang']) ?>
            </td>

            <td class="p-3 border text-right text-blue-600 font-semibold">
                Rp <?= number_format($b['harga_awal']) ?>
            </td>

            <td class="p-3 border text-center">
                <span class="text-yellow-600 font-medium">
                    Pending
                </span>
            </td>

            <td class="p-3 border text-center space-x-4">

                <a href="javascript:void(0)"
                onclick="confirmApprove('<?= base_url('admin/pengajuanbarang/approve/'.$b['id_barang']) ?>')"
                class="text-green-600 hover:underline">
                    Approve
                </a>

                <a href="javascript:void(0)"
                onclick="confirmReject('<?= base_url('admin/pengajuanbarang/reject/'.$b['id_barang']) ?>')"
                class="text-red-600 hover:underline">
                    Reject
                </a>

            </td>

        </tr>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>

</table>
</div>

<script>
function confirmApprove(url) {
    Swal.fire({
        title: 'Setujui barang ini?',
        text: 'Barang akan masuk ke daftar lelang.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, setujui',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function confirmReject(url) {
    Swal.fire({
        title: 'Tolak pengajuan barang?',
        text: 'Barang akan ditolak dan tidak ditampilkan di lelang.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>


<?= $this->endSection() ?>
