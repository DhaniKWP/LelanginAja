<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="max-w-md mx-auto bg-white shadow-lg p-6 rounded-lg mt-6">

<h2 class="text-xl font-semibold text-blue-700 mb-4 text-center">📝 Form Daftar Peserta</h2>

<form action="/user/peserta/store" method="POST" class="space-y-4">

    <div>
        <label class="font-medium">Alamat Lengkap</label>
        <textarea name="alamat" required 
                  class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div>
        <label class="font-medium">Nomor HP</label>
        <input type="text" name="no_hp" required 
               class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
    </div>

    <button class="w-full bg-blue-600 hover:bg-blue-700 py-2 text-white rounded font-semibold">
        Daftar Peserta
    </button>
</form>

<a href="/user/peserta" class="block text-center mt-2 text-gray-600 hover:text-blue-600">
    Kembali
</a>

</div>

<?= $this->endSection() ?>
