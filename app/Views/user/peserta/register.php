<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-lg mx-auto bg-white p-6 shadow rounded-lg mt-6">

    <h2 class="text-2xl font-bold text-blue-700 mb-4">📝 Daftar Sebagai Peserta Lelang</h2>
    <p class="text-gray-600 text-sm mb-4">
        Daftarkan diri dulu sebelum bisa ikut bidding & memenangkan lelang.
    </p>

    <form action="/user/peserta/store" method="POST" class="space-y-4">

        <div>
            <label class="block font-medium mb-1">Alamat</label>
            <textarea name="alamat" required
                      class="w-full border rounded p-2 focus:ring focus:ring-blue-400"></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Nomor HP</label>
            <input type="text" name="no_hp" required
                   class="w-full border rounded p-2 focus:ring focus:ring-blue-400"
                   placeholder="08xxxxxxxxxx">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
            Daftar Peserta
        </button>
    </form>

</div>

<?= $this->endSection() ?>
