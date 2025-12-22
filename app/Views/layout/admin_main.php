<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> LelanginAja - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <?= $this->renderSection('styles') ?>
</head>
<body class="bg-gray-100">
    
    <!-- Header/Navbar -->
    <?= $this->include('layout/admin_header') ?>

    <!-- Container -->
    <div class="flex pt-16">
        
        <!-- Sidebar -->
        <?= $this->include('layout/admin_sidebar') ?>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
    function toggleSubmenu(id) {
        const submenu = document.getElementById(id + '-submenu');

        // Toggle submenu
        submenu.classList.toggle('hidden');

        // Simpan state ke localStorage
        const isOpen = !submenu.classList.contains('hidden');
        localStorage.setItem('submenu-' + id, isOpen);
    }

    // Restore submenu state saat page load
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[id$="-submenu"]').forEach(submenu => {
            const id = submenu.id.replace('-submenu', '');
            const isOpen = localStorage.getItem('submenu-' + id);

            if (isOpen === 'true') {
                submenu.classList.remove('hidden');
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmLogout(url) {
    Swal.fire({
        title: 'Yakin ingin logout?',
        text: 'Kamu akan keluar dari sesi saat ini.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>


    <?= $this->renderSection('scripts') ?>

</body>
</html>