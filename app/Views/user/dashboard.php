<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - LelanginAja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .gradient-accent {
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
    <nav class="gradient-blue text-white fixed w-full top-0 z-50 shadow-xl">
        <div class="px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold"><i class="fas fa-gavel mr-2"></i> LelanginAja</h1>
            </div>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-blue-200 transition hidden md:block"><i class="fas fa-home"></i> Dashboard</a>
                <div class="relative cursor-pointer hover:text-blue-200 transition">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </div>
                <div class="flex items-center gap-3 cursor-pointer hover:text-blue-200 transition">
                    <div class="w-9 h-9 bg-white text-primary rounded-full flex items-center justify-center font-bold text-blue-600">
                        JD
                    </div>
                    <span class="hidden md:block">John Doe</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="flex pt-16">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen fixed shadow-xl overflow-y-auto border-r border-gray-200">
            <div class="p-6">
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg">
                            <i class="fas fa-home w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Barang Saya -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" onclick="toggleSubmenu('barang')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-box w-5 text-blue-500"></i>
                                <span>Barang Saya</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="barang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="ajukan_barang.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Ajukan Barang</a></li>
                            <li><a href="barang_saya.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Status Barang</a></li>
                        </ul>
                    </li>

                    <!-- Lelang -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" onclick="toggleSubmenu('lelang')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-gavel w-5 text-blue-500"></i>
                                <span>Lelang</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="lelang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="daftar_lelang.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Lelang Aktif</a></li>
                            <li><a href="riwayat_penawaran.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Riwayat Penawaran</a></li>
                            <li><a href="status_pemenang.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Status Pemenang</a></li>
                        </ul>
                    </li>

                    <!-- Pembayaran -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition" onclick="toggleSubmenu('pembayaran')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-credit-card w-5 text-blue-500"></i>
                                <span>Pembayaran</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="pembayaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="pembayaran.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Upload Bukti</a></li>
                            <li><a href="status_pembayaran.php" class="block px-4 py-2 rounded-lg hover:bg-blue-50 text-gray-600 text-sm transition">Status Pembayaran</a></li>
                        </ul>
                    </li>

                    <!-- Profil -->
                    <li>
                        <a href="profil.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-blue-50 text-gray-700 transition">
                            <i class="fas fa-user w-5 text-blue-500"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li class="pt-4">
                        <hr class="border-gray-200">
                    </li>

                    <!-- Logout -->
                    <li>
                        <a href="../auth/logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-50 text-red-600 transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h2>
                <p class="text-gray-600">Selamat datang kembali, <span class="font-semibold text-blue-600">John Doe</span>!</p>
            </div>

            <!-- Search Bar -->
            <div class="mb-8">
                <div class="relative">
                    <input type="text" placeholder="Cari barang lelang..." class="w-full px-6 py-4 rounded-2xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pl-14 shadow-sm">
                    <i class="fas fa-search absolute left-5 top-5 text-gray-400"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Card 1 -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Barang</p>
                            <h3 class="text-4xl font-bold mt-2">12</h3>
                            <p class="text-blue-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +2 bulan ini</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-box text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Barang Aktif</p>
                            <h3 class="text-4xl font-bold mt-2">5</h3>
                            <p class="text-green-100 text-xs mt-2"><i class="fas fa-check-circle"></i> Sedang lelang</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-100 text-sm font-medium">Lelang Dimenangkan</p>
                            <h3 class="text-4xl font-bold mt-2">8</h3>
                            <p class="text-yellow-100 text-xs mt-2"><i class="fas fa-trophy"></i> Total kemenangan</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-trophy text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 text-white transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Penawaran</p>
                            <h3 class="text-4xl font-bold mt-2">34</h3>
                            <p class="text-purple-100 text-xs mt-2"><i class="fas fa-hand-holding-usd"></i> Bid aktif</p>
                        </div>
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-hand-holding-usd text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barang Lelang Populer -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-fire text-orange-500"></i> Barang Lelang Populer
                    </h3>
                    <a href="daftar_lelang.php" class="text-blue-600 hover:text-blue-700 font-semibold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                        Lihat Semua <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Item 1 -->
                    <div class="border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 bg-white">
                        <div class="bg-gradient-to-br from-blue-100 to-blue-50 h-48 flex items-center justify-center">
                            <i class="fas fa-laptop text-blue-500 text-6xl"></i>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-800 mb-2 text-lg">Laptop Gaming ROG</h4>
                            <p class="text-sm text-gray-500 mb-4">Elektronik • Kondisi: Baru</p>
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Harga Saat Ini</p>
                                    <p class="text-xl font-bold text-blue-600">Rp 12,5jt</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 mb-1">Total Bid</p>
                                    <p class="text-xl font-bold text-gray-800">23</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-orange-600 mb-4 bg-orange-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-clock"></i>
                                <span class="font-medium">Berakhir dalam 2 jam 30 menit</span>
                            </div>
                            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                                <i class="fas fa-gavel"></i> Ikut Lelang
                            </button>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 bg-white">
                        <div class="bg-gradient-to-br from-purple-100 to-purple-50 h-48 flex items-center justify-center">
                            <i class="fas fa-mobile-alt text-purple-500 text-6xl"></i>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-800 mb-2 text-lg">iPhone 15 Pro Max</h4>
                            <p class="text-sm text-gray-500 mb-4">Elektronik • Kondisi: Bekas</p>
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Harga Saat Ini</p>
                                    <p class="text-xl font-bold text-blue-600">Rp 18,2jt</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 mb-1">Total Bid</p>
                                    <p class="text-xl font-bold text-gray-800">45</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-orange-600 mb-4 bg-orange-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-clock"></i>
                                <span class="font-medium">Berakhir dalam 5 jam 15 menit</span>
                            </div>
                            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                                <i class="fas fa-gavel"></i> Ikut Lelang
                            </button>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 bg-white">
                        <div class="bg-gradient-to-br from-green-100 to-green-50 h-48 flex items-center justify-center">
                            <i class="fas fa-motorcycle text-green-500 text-6xl"></i>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-800 mb-2 text-lg">Sepeda Motor Honda CBR</h4>
                            <p class="text-sm text-gray-500 mb-4">Otomotif • Kondisi: Bekas</p>
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Harga Saat Ini</p>
                                    <p class="text-xl font-bold text-blue-600">Rp 25jt</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 mb-1">Total Bid</p>
                                    <p class="text-xl font-bold text-gray-800">12</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-orange-600 mb-4 bg-orange-50 px-3 py-2 rounded-lg">
                                <i class="fas fa-clock"></i>
                                <span class="font-medium">Berakhir dalam 1 hari 3 jam</span>
                            </div>
                            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition-all shadow-lg hover:shadow-xl">
                                <i class="fas fa-gavel"></i> Ikut Lelang
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Footer -->
    <footer class="ml-64 bg-gradient-to-r from-blue-800 to-blue-900 text-white py-10 mt-8">
        <div class="px-8">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
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
                        <li><a href="dashboard.php" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Dashboard</a></li>
                        <li><a href="daftar_lelang.php" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Lelang Aktif</a></li>
                        <li><a href="profil.php" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Profil Saya</a></li>
                        <li><a href="../auth/logout.php" class="text-blue-100 hover:text-white hover:pl-2 transition-all">Logout</a></li>
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
            <div class="border-t border-blue-700 pt-6 text-center text-blue-100">
                <p>&copy; 2025 LelanginAja. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id + '-submenu');
            submenu.classList.toggle('hidden');
        }
    </script>

</body>
</html>