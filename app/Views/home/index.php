<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LelanginAja - Platform Lelang Online Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                        accent: '#0ea5e9',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .gradient-accent {
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
        }
    </style>
</head>
<body class="font-sans">
    <!-- Navbar -->
    <nav class="gradient-blue sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-white text-2xl font-bold flex items-center">
                    <i class="fas fa-gavel mr-2"></i> LelanginAja
                </a>
                
                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-white" onclick="toggleMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="text-white hover:text-blue-100 transition-all">Home</a>
                    <a href="#barang" class="text-white hover:text-blue-100 transition-all">Barang Lelang</a>
                    <a href="#tentang" class="text-white hover:text-blue-100 transition-all">Tentang</a>
                    <a href="#kontak" class="text-white hover:text-blue-100 transition-all">Kontak</a>
                    <a href="<?= base_url('auth/login') ?>" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:scale-105 transition-transform">
                        <i class="fas fa-sign-in-alt"></i> Login / Register
                    </a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden pb-4">
                <a href="#home" class="block text-white py-2 hover:text-blue-100">Home</a>
                <a href="#barang" class="block text-white py-2 hover:text-blue-100">Barang Lelang</a>
                <a href="#tentang" class="block text-white py-2 hover:text-blue-100">Tentang</a>
                <a href="#kontak" class="block text-white py-2 hover:text-blue-100">Kontak</a>
                <a href="<?= base_url('auth/login') ?>" class="block bg-white text-primary px-6 py-2 rounded-full font-semibold text-center mt-3">
                    <i class="fas fa-sign-in-alt"></i> Login / Register
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="gradient-accent text-white py-20 lg:py-32 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-8 items-center">
                <div class="relative z-10">
                    <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight">
                        Platform Lelang Barang Online
                    </h1>
                    <p class="text-lg lg:text-xl mb-8 text-blue-50">
                        Lelang dan dapatkan barang impian Anda dengan mudah, aman, dan transparan. Bergabunglah dengan ribuan pengguna lainnya!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?= base_url('auth/register') ?>" class="bg-white text-primary px-8 py-4 rounded-full font-bold text-lg hover:scale-105 transition-transform text-center shadow-xl">
                            <i class="fas fa-user-plus"></i> Daftar Sekarang
                        </a>
                        <a href="#barang" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition-all text-center">
                            <i class="fas fa-box"></i> Lihat Barang Lelang
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex justify-center items-center">
                    <i class="fas fa-gavel text-white opacity-20" style="font-size: 20rem;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Auction Items -->
    <section id="barang" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-secondary mb-4">Barang Lelang Terbaru</h2>
                <p class="text-gray-600 text-lg">Jangan lewatkan kesempatan untuk mendapatkan barang favorit Anda</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                        <i class="fas fa-car text-primary text-7xl"></i>
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-secondary mb-2">Toyota Avanza 2020</h5>
                        <div class="text-3xl font-bold text-primary my-3">Rp 150.000.000</div>
                        <div class="bg-blue-50 text-secondary font-semibold py-2 px-4 rounded-lg text-center mb-4">
                            <i class="fas fa-clock"></i> 2 Hari 5 Jam
                        </div>
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                        <i class="fas fa-motorcycle text-primary text-7xl"></i>
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-secondary mb-2">Honda Vario 160</h5>
                        <div class="text-3xl font-bold text-primary my-3">Rp 18.500.000</div>
                        <div class="bg-blue-50 text-secondary font-semibold py-2 px-4 rounded-lg text-center mb-4">
                            <i class="fas fa-clock"></i> 1 Hari 12 Jam
                        </div>
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                        <i class="fas fa-laptop text-primary text-7xl"></i>
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-secondary mb-2">MacBook Pro M2</h5>
                        <div class="text-3xl font-bold text-primary my-3">Rp 22.000.000</div>
                        <div class="bg-blue-50 text-secondary font-semibold py-2 px-4 rounded-lg text-center mb-4">
                            <i class="fas fa-clock"></i> 3 Hari 8 Jam
                        </div>
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                        <i class="fas fa-tshirt text-primary text-7xl"></i>
                    </div>
                    <div class="p-6">
                        <h5 class="text-xl font-bold text-secondary mb-2">Jaket Kulit Premium</h5>
                        <div class="text-3xl font-bold text-primary my-3">Rp 1.200.000</div>
                        <div class="bg-blue-50 text-secondary font-semibold py-2 px-4 rounded-lg text-center mb-4">
                            <i class="fas fa-clock"></i> 5 Jam 30 Menit
                        </div>
                        <button class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-secondary mb-4">Kategori Barang</h2>
                <p class="text-gray-600 text-lg">Temukan barang sesuai kebutuhan Anda</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <i class="fas fa-car text-primary text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold text-secondary">Mobil</h4>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <i class="fas fa-motorcycle text-primary text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold text-secondary">Motor</h4>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <i class="fas fa-laptop text-primary text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold text-secondary">Elektronik</h4>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl text-center border-2 border-transparent hover:border-primary hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                    <i class="fas fa-tshirt text-primary text-6xl mb-4"></i>
                    <h4 class="text-xl font-bold text-secondary">Fashion</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="tentang" class="gradient-blue text-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Cara Mengikuti Lelang</h2>
                <p class="text-blue-100 text-lg">Mudah dan cepat, hanya 3 langkah</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                        1
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Daftar Akun</h4>
                    <p class="text-blue-100">Buat akun gratis dengan mengisi formulir pendaftaran. Proses cepat dan mudah!</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                        2
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Ajukan Barang / Ikut Lelang</h4>
                    <p class="text-blue-100">Ajukan barang untuk dilelang atau ikuti lelang barang yang Anda inginkan.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-white text-primary rounded-full flex items-center justify-center text-4xl font-bold mx-auto mb-6 shadow-xl">
                        3
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Menang & Lakukan Pembayaran</h4>
                    <p class="text-blue-100">Jika menang, lakukan pembayaran dengan aman melalui sistem kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-secondary mb-4">Keunggulan Platform</h2>
                <p class="text-gray-600 text-lg">Mengapa memilih LelanginAja?</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="text-2xl font-bold text-secondary mb-3">Aman & Terpercaya</h5>
                    <p class="text-gray-600">Sistem keamanan berlapis untuk melindungi transaksi Anda</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h5 class="text-2xl font-bold text-secondary mb-3">Transparan</h5>
                    <p class="text-gray-600">Semua proses lelang dapat dipantau secara real-time</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 gradient-accent rounded-2xl flex items-center justify-center text-white text-4xl mx-auto mb-6">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h5 class="text-2xl font-bold text-secondary mb-3">Real-time</h5>
                    <p class="text-gray-600">Update harga dan status lelang secara langsung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-secondary text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h5 class="text-2xl font-bold mb-4">
                        <i class="fas fa-gavel"></i> LelanginAja
                    </h5>
                    <p class="text-blue-100 mb-4">Platform lelang online terpercaya di Indonesia. Dapatkan barang impian dengan harga terbaik.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-blue-200 text-2xl transition-colors"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Link Cepat</h5>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Home</a></li>
                        <li><a href="#barang" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Barang Lelang</a></li>
                        <li><a href="#tentang" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Tentang Kami</a></li>
                        <li><a href="<?= base_url('auth/login') ?>" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Login</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Kontak</h5>
                    <ul class="space-y-2 text-blue-100">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                        <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@lelanginaja.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-blue-700 mt-8 pt-8 text-center text-blue-100">
                <p>&copy; 2024 LelanginAja. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>