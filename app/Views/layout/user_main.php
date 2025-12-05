<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LelanginAja - Platform lelang online terpercaya di Indonesia">
    <title><?= $title ?? 'Dashboard' ?> - LelanginAja</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        .gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
        .gradient-accent {
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
        }
    </style>
    
    <!-- Additional CSS -->
    <?= $this->renderSection('styles') ?>
</head>
<body class="bg-gray-50">
    
    <!-- Navbar -->
    <?= $this->include('layout/user_navbar') ?>

    <!-- Container -->
    <div class="flex pt-16">
        
        <!-- Sidebar -->
        <?= $this->include('layout/user_sidebar') ?>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-8 min-h-screen">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <!-- Footer -->
    <?= $this->include('layout/user_footer') ?>
    
    <!-- Additional Scripts -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>