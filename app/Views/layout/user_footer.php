<!-- User Footer Component -->
<footer class="ml-64 bg-gradient-to-r from-blue-800 to-blue-900 text-white py-10 mt-8">
    <div class="px-8">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
            <!-- Brand Info -->
            <div>
                <h5 class="text-2xl font-bold mb-4">
                    <i class="fas fa-gavel"></i> LelanginAja
                </h5>
                <p class="text-blue-100 mb-4">
                    Platform lelang online terpercaya di Indonesia. Dapatkan barang impian dengan harga terbaik.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors" aria-label="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h5 class="text-xl font-bold mb-4">Link Cepat</h5>
                <ul class="space-y-2">
                    <li>
                        <a href="<?= base_url('user/dashboard') ?>" 
                           class="text-blue-100 hover:text-white hover:pl-2 transition-all">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/lelang-aktif') ?>" 
                           class="text-blue-100 hover:text-white hover:pl-2 transition-all">
                            Lelang Aktif
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('user/profil') ?>" 
                           class="text-blue-100 hover:text-white hover:pl-2 transition-all">
                            Profil Saya
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('auth/logout') ?>" 
                           class="text-blue-100 hover:text-white hover:pl-2 transition-all">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h5 class="text-xl font-bold mb-4">Kontak</h5>
                <ul class="space-y-2 text-blue-100">
                    <li>
                        <i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia
                    </li>
                    <li>
                        <i class="fas fa-phone mr-2"></i> +62 812-3456-7890
                    </li>
                    <li>
                        <i class="fas fa-envelope mr-2"></i> info@lelanginaja.com
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-blue-700 pt-6 text-center text-blue-100">
            <p>&copy; <?= date('Y') ?> LelanginAja. All Rights Reserved.</p>
        </div>
    </div>
</footer>