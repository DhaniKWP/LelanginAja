<nav class="gradient-blue sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="<?= base_url('/') ?>" class="text-white text-2xl font-bold flex items-center">
                <i class="fas fa-gavel mr-2"></i> LelanginAja
            </a>
            
            <!-- Mobile Menu Button -->
            <button class="lg:hidden text-white" onclick="toggleMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="<?= base_url('/') ?>#home" class="text-white hover:text-blue-100 transition-all">Home</a>
                <a href="<?= base_url('/') ?>#barang" class="text-white hover:text-blue-100 transition-all">Barang Lelang</a>
                <a href="<?= base_url('/') ?>#tentang" class="text-white hover:text-blue-100 transition-all">Tentang</a>
                <a href="<?= base_url('/') ?>#kontak" class="text-white hover:text-blue-100 transition-all">Kontak</a>
                <a href="<?= base_url('auth/login') ?>" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:scale-105 transition-transform">
                    <i class="fas fa-sign-in-alt"></i> Login / Register
                </a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden pb-4">
            <a href="<?= base_url('/') ?>#home" class="block text-white py-2 hover:text-blue-100">Home</a>
            <a href="<?= base_url('/') ?>#barang" class="block text-white py-2 hover:text-blue-100">Barang Lelang</a>
            <a href="<?= base_url('/') ?>#tentang" class="block text-white py-2 hover:text-blue-100">Tentang</a>
            <a href="<?= base_url('/') ?>#kontak" class="block text-white py-2 hover:text-blue-100">Kontak</a>
            <a href="<?= base_url('auth/login') ?>" class="block bg-white text-primary px-6 py-2 rounded-full font-semibold text-center mt-3">
                <i class="fas fa-sign-in-alt"></i> Login / Register
            </a>
        </div>
    </div>
</nav>