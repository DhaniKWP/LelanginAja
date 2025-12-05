<!-- Admin Footer Component (Minimal) -->
<footer class="ml-64 bg-gray-900 border-t border-gray-800 text-gray-400 py-4 mt-8">
    <div class="px-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <!-- Copyright -->
        <div class="text-sm">
            <p>&copy; <?= date('Y') ?> <span class="text-white font-semibold">LelanginAja</span> Admin Panel. All rights reserved.</p>
        </div>

        <!-- Footer Links -->
        <div class="flex items-center gap-6 text-sm">
            <a href="<?= base_url('admin/bantuan') ?>" class="hover:text-white transition">
                <i class="fas fa-question-circle mr-1"></i> Bantuan
            </a>
            <a href="<?= base_url('admin/dokumentasi') ?>" class="hover:text-white transition">
                <i class="fas fa-book mr-1"></i> Dokumentasi
            </a>
            <div class="text-xs">
                <span class="text-gray-500">Version</span> <span class="text-blue-400 font-semibold">1.0.0</span>
            </div>
        </div>
    </div>
</footer>