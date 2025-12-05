<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Admin Panel</title>
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

    <!-- Footer -->
    <?= $this->include('layout/admin_footer') ?>

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
    <?= $this->renderSection('scripts') ?>

</body>
</html>