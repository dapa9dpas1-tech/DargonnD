import re

with open('c:/xampp/htdocs/king/includes/admin_header.php', 'r', encoding='utf-8') as f:
    content = f.read()

nav_php = """
<nav class="flex flex-col gap-stack-2xs px-stack-sm">
    <?php
    $navItems = [
        ['path' => 'admin', 'icon' => 'dashboard', 'label' => 'Dashboard'],
        ['path' => 'admin_orders', 'icon' => 'shopping_cart', 'label' => 'Pesanan'],
        ['path' => 'admin_products', 'icon' => 'category', 'label' => 'Produk'],
        ['path' => 'admin_collections', 'icon' => 'folder_open', 'label' => 'Koleksi'],
        ['path' => 'admin_pages', 'icon' => 'article', 'label' => 'Halaman'],
        ['path' => 'admin_menus', 'icon' => 'account_tree', 'label' => 'Menu Navigasi'],
        ['path' => 'admin_settings', 'icon' => 'settings', 'label' => 'Pengaturan'],
    ];
    
    foreach ($navItems as $item) {
        $isActive = (strpos($active_page, $item['path']) === 0);
        if ($item['path'] === 'admin' && $active_page !== 'admin') {
            $isActive = false;
        }
        
        if ($isActive) {
            echo '<a aria-current="page" class="flex items-center gap-stack-sm px-stack-sm py-2.5 transition-all bg-primary-container text-on-primary-container font-headline-sm font-semibold rounded-lg" href="?page=' . $item['path'] . '"><span class="material-symbols-outlined text-[20px]">' . $item['icon'] . '</span><span>' . $item['label'] . '</span></a>';
        } else {
            echo '<a class="flex items-center gap-stack-sm px-stack-sm py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface transition-all font-body-sm text-body-sm" href="?page=' . $item['path'] . '"><span class="material-symbols-outlined text-[20px]">' . $item['icon'] . '</span><span>' . $item['label'] . '</span></a>';
        }
    }
    ?>
    <div class="mt-4 border-t border-outline-variant/30 pt-4"></div>
    <a class="flex items-center gap-stack-sm px-stack-sm py-2.5 rounded-lg text-error hover:bg-error-container hover:text-error transition-all font-body-sm text-body-sm font-bold" href="?page=logout">
        <span class="material-symbols-outlined text-[20px]">logout</span><span>Logout</span>
    </a>
</nav>
"""

content = re.sub(r'<nav.*?</nav>', nav_php, content, flags=re.DOTALL)

with open('c:/xampp/htdocs/king/includes/admin_header.php', 'w', encoding='utf-8') as out:
    out.write(content)
