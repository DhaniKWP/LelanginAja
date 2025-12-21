<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - LelanginAja</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/a2e0e6ad53.js" crossorigin="anonymous"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

<div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden grid md:grid-cols-2">

    <!-- LEFT : VISUAL / BRAND -->
    <div class="hidden md:flex flex-col justify-between p-10
                bg-gradient-to-br from-blue-600 to-indigo-700 text-white relative">

        <!-- LOGO -->
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-xl font-bold">
                LJ
            </div>
            <span class="text-lg font-semibold tracking-wide">
                LelanginAja
            </span>
        </div>

        <!-- CONTENT -->
        <div class="z-10">
            <h2 class="text-3xl font-bold leading-snug mb-4">
                Bergabung dengan <br>
                Platform Lelang Terpercaya
            </h2>

            <p class="text-blue-100 leading-relaxed max-w-sm">
                Buat akun dan ikuti lelang barang secara real-time,
                aman, dan transparan bersama ribuan pengguna lainnya.
            </p>

            <!-- ICON FEATURES -->
            <div class="mt-8 space-y-3 text-sm">
                <div class="flex items-center gap-3">
                    <i class="fas fa-user-check"></i>
                    <span>Pendaftaran Mudah</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-gavel"></i>
                    <span>Lelang Real-time</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-shield-alt"></i>
                    <span>Aman & Transparan</span>
                </div>
            </div>
        </div>

        <!-- DECORATION -->
        <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-white/10 rounded-full"></div>
        <div class="absolute top-20 -left-20 w-40 h-40 bg-white/10 rounded-full"></div>

        <p class="text-xs text-blue-200">
            © <?= date('Y') ?> LelanginAja
        </p>
    </div>

    <!-- RIGHT : FORM -->
    <div class="p-8 sm:p-12">

        <h3 class="text-2xl font-bold text-gray-800 mb-1">
            Buat Akun Baru ✨
        </h3>
        <p class="text-gray-500 mb-6">
            Lengkapi data untuk mulai mengikuti lelang
        </p>

        <!-- ALERT -->
        <?php if(session()->getFlashdata('error')): ?>
            <div class="mb-4 text-sm text-red-700 bg-red-100 border border-red-200 rounded-lg px-4 py-3">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <!-- FORM -->
        <form action="/register/process" method="POST" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Lengkap
                </label>
                <input type="text" name="nama" required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Username
                </label>
                <input type="text" name="username" required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email" name="email" required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input type="password" name="password" required
                       class="w-full h-11 px-4 rounded-lg border border-gray-300
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>

            <button type="submit"
                class="w-full h-11 mt-2 bg-blue-600 text-white font-semibold rounded-lg
                       hover:bg-blue-700 hover:shadow-lg transition">
                Daftar
            </button>

            <p class="text-center text-sm text-gray-500">
                Sudah punya akun?
                <a href="/login" class="text-blue-600 font-medium hover:underline">
                    Login
                </a>
            </p>
        </form>
    </div>

</div>

</body>
</html>
