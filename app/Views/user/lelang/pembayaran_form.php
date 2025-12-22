<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto p-6 space-y-6">

    <!-- HEADER -->
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-800">
            🎉 Selamat! Kamu Memenangkan Lelang
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Silakan selesaikan pembayaran untuk memproses kemenanganmu
        </p>
    </div>

    <!-- INFO BARANG -->
    <div class="bg-white rounded-xl shadow p-5 space-y-3 border-l-4 border-blue-500">
        <p class="text-sm text-gray-500">Barang Lelang</p>
        <p class="text-lg font-semibold text-gray-800">
            <?= esc($lelang['nama_barang'] ?? 'Barang Lelang') ?>
        </p>

        <div class="flex justify-between items-center pt-3 border-t">
            <span class="text-sm text-gray-500">Total Pembayaran</span>
            <span class="text-xl font-bold text-blue-600">
                Rp <?= number_format(
                    $lelang['harga_menang'] ?? $lelang['harga_awal'],0, ',', '.') ?>
            </span>
        </div>
    </div>

    <!-- FORM PEMBAYARAN -->
    <div class="bg-white rounded-xl shadow p-6 space-y-5">

        <form action="<?= base_url('user/pembayaran/submit/'.$lelang['id_lelang']) ?>"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4">

            <!-- METODE -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Metode Pembayaran
                </label>
                <select name="metode"
                        required
                        class="w-full border rounded-lg px-3 py-2
                               focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="" hidden>Pilih Metode Pembayaran</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="QRIS">QRIS</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <!-- BUKTI -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Upload Bukti Pembayaran
                </label>
                <input type="file"
                       name="bukti_transfer"
                       required
                       accept="image/*"
                       class="w-full border rounded-lg px-3 py-2
                              focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">
                    Format JPG / PNG. Maksimal ukuran 2MB.
                </p>
            </div>

            <!-- SUBMIT -->
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700
                           text-white py-3 rounded-lg font-semibold transition">
                💳 Kirim Bukti Pembayaran
            </button>

        </form>
    </div>

    <!-- CATATAN -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-sm text-blue-700">
        <p class="font-semibold mb-1">📌 Catatan Penting</p>
        <ul class="list-disc ml-5 space-y-1">
            <li>Pastikan nominal pembayaran sesuai dengan harga menang.</li>
            <li>Pembayaran akan diverifikasi oleh admin.</li>
            <li>Admin akan menghubungi kamu jika pembayaran telah dikonfirmasi.</li>
        </ul>
    </div>

</div>

<?= $this->endSection() ?>
