<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Lelang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <!-- Navbar -->
    <nav class="bg-gray-900 text-white fixed w-full top-0 z-50 shadow-lg">
        <div class="px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold text-blue-400"><i class="fas fa-shield-alt"></i> Admin Panel</h1>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative cursor-pointer hover:text-blue-400 transition">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full w-5 h-5 flex items-center justify-center">5</span>
                </div>
                <div class="flex items-center gap-3 cursor-pointer hover:text-blue-400 transition">
                    <div class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center font-bold">
                        A
                    </div>
                    <span>Admin</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="flex pt-16">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen fixed shadow-lg overflow-y-auto">
            <div class="p-6">
                <ul class="space-y-2">
                    
                    <!-- Dashboard -->
                    <li>
                        <a href="#dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-500 text-white">
                            <i class="fas fa-home w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Master Data -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('master')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-database w-5"></i>
                                <span>Master Data</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="master-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="#users" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage User</a></li>
                            <li><a href="#kategori" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Kategori</a></li>
                            <li><a href="#kondisi" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Kondisi</a></li>
                            <li><a href="#barang" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Barang</a></li>
                            <li><a href="#peserta" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Manage Peserta</a></li>
                        </ul>
                    </li>

                    <!-- Pengajuan Barang -->
                    <li>
                        <a href="#pengajuan" class="flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-inbox w-5"></i>
                                <span>Pengajuan Barang</span>
                            </div>
                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">12</span>
                        </a>
                    </li>

                    <!-- Proses Lelang -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('lelang')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-gavel w-5"></i>
                                <span>Proses Lelang</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="lelang-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="#jadwal" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Jadwal Lelang</a></li>
                            <li><a href="#aktif" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Lelang Aktif</a></li>
                            <li><a href="#monitoring" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Monitoring Real-time</a></li>
                        </ul>
                    </li>

                    <!-- Penawaran & Pemenang -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('penawaran')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-trophy w-5"></i>
                                <span>Penawaran</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="penawaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="#penawaran-list" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Daftar Penawaran</a></li>
                            <li><a href="#pemenang" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Tentukan Pemenang</a></li>
                            <li><a href="#transaksi-pemenang" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Transaksi Pemenang</a></li>
                        </ul>
                    </li>

                    <!-- Pembayaran -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('pembayaran')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-money-check-alt w-5"></i>
                                <span>Pembayaran</span>
                            </div>
                            <span class="bg-orange-500 text-white text-xs rounded-full px-2 py-1">8</span>
                        </button>
                        <ul id="pembayaran-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="#verifikasi" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Verifikasi Pembayaran</a></li>
                            <li><a href="#riwayat-bayar" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Riwayat Pembayaran</a></li>
                        </ul>
                    </li>

                    <!-- Laporan -->
                    <li>
                        <button class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition" onclick="toggleSubmenu('laporan')">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-chart-bar w-5"></i>
                                <span>Laporan</span>
                            </div>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <ul id="laporan-submenu" class="ml-8 mt-2 space-y-1 hidden">
                            <li><a href="#lap-barang" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Barang</a></li>
                            <li><a href="#lap-pemenang" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Pemenang</a></li>
                            <li><a href="#lap-transaksi" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Laporan Transaksi</a></li>
                            <li><a href="#lap-export" class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-600 text-sm">Export Data</a></li>
                        </ul>
                    </li>

                    <!-- Pengaturan -->
                    <li>
                        <a href="#pengaturan" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 transition">
                            <i class="fas fa-cog w-5"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <a href="#logout" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-100 text-red-600 transition">
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
                <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin</h2>
                <p class="text-gray-600 mt-1">Selamat datang kembali, Admin!</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Total User -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total User</p>
                            <h3 class="text-3xl font-bold mt-2">248</h3>
                            <p class="text-blue-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +12 minggu ini</p>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Barang Aktif -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Barang Aktif</p>
                            <h3 class="text-3xl font-bold mt-2">45</h3>
                            <p class="text-green-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +5 hari ini</p>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-box text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Approval -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-sm font-medium">Pending Approval</p>
                            <h3 class="text-3xl font-bold mt-2">12</h3>
                            <p class="text-orange-100 text-xs mt-2"><i class="fas fa-clock"></i> Perlu review</p>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-inbox text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Transaksi</p>
                            <h3 class="text-3xl font-bold mt-2">Rp 2.8M</h3>
                            <p class="text-purple-100 text-xs mt-2"><i class="fas fa-arrow-up"></i> +18% bulan ini</p>
                        </div>
                        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-bolt text-yellow-500"></i> Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition">
                        <i class="fas fa-check-circle text-blue-500 text-3xl"></i>
                        <span class="text-sm font-medium text-gray-700">Approve Barang</span>
                    </button>
                    <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-green-500 hover:bg-green-50 transition">
                        <i class="fas fa-play-circle text-green-500 text-3xl"></i>
                        <span class="text-sm font-medium text-gray-700">Mulai Lelang</span>
                    </button>
                    <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-purple-500 hover:bg-purple-50 transition">
                        <i class="fas fa-file-invoice text-purple-500 text-3xl"></i>
                        <span class="text-sm font-medium text-gray-700">Verifikasi Bayar</span>
                    </button>
                    <button class="flex flex-col items-center gap-2 p-4 rounded-lg border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-50 transition">
                        <i class="fas fa-download text-orange-500 text-3xl"></i>
                        <span class="text-sm font-medium text-gray-700">Export Laporan</span>
                    </button>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid lg:grid-cols-2 gap-6 mb-8">
                
                <!-- Pending Approval -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-clock text-orange-500"></i> Pending Approval</h3>
                        <a href="#pengajuan" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-laptop text-blue-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Laptop Gaming ASUS ROG</h5>
                                <p class="text-xs text-gray-500">User: John Doe • 2 jam lalu</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-green-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">iPhone 15 Pro Max</h5>
                                <p class="text-xs text-gray-500">User: Jane Smith • 4 jam lalu</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-motorcycle text-purple-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Honda Vario 160</h5>
                                <p class="text-xs text-gray-500">User: Ahmad Ali • 1 hari lalu</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lelang Berakhir Hari Ini -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-800"><i class="fas fa-hourglass-end text-red-500"></i> Lelang Berakhir Hari Ini</h3>
                        <a href="#aktif" class="text-blue-500 hover:text-blue-700 font-medium text-sm">Lihat Semua <i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-car text-red-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Toyota Avanza 2020</h5>
                                <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 2 jam</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-blue-600">Rp 150jt</p>
                                <p class="text-xs text-gray-500">18 bid</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-camera text-orange-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Kamera Canon EOS R6</h5>
                                <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 5 jam</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-blue-600">Rp 28jt</p>
                                <p class="text-xs text-gray-500">25 bid</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-3 border rounded-lg hover:bg-gray-50 transition">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-watch text-yellow-500 text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-semibold text-gray-800">Apple Watch Ultra 2</h5>
                                <p class="text-xs text-red-600 font-medium"><i class="fas fa-clock"></i> Berakhir dalam 8 jam</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-blue-600">Rp 12jt</p>
                                <p class="text-xs text-gray-500">32 bid</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-history text-blue-500"></i> Aktivitas Terbaru</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 pb-4 border-b">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-green-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-medium">Barang "MacBook Pro M2" telah disetujui</p>
                            <p class="text-xs text-gray-500">5 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-gavel text-blue-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-medium">Lelang "iPhone 15 Pro" dimulai</p>
                            <p class="text-xs text-gray-500">15 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 pb-4 border-b">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-money-check-alt text-purple-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-medium">Pembayaran "Honda Vario 160" telah diverifikasi</p>
                            <p class="text-xs text-gray-500">1 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user-plus text-orange-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800 font-medium">User baru "Sarah Williams" terdaftar</p>
                            <p class="text-xs text-gray-500">2 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Footer -->
    <footer class="ml-64 bg-gray-900 text-white text-center py-4 mt-8">
        <p>&copy; 2025 Sistem Lelang Online - Admin Panel. All rights reserved.</p>
    </footer>

    <script>
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id + '-submenu');
            submenu.classList.toggle('hidden');
        }

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId !== '#logout') {
                    console.log('Navigating to:', targetId);
                }
            });
        });
    </script>

</body>
</html>