import re

with open('c:/xampp/htdocs/king/stitch_dragon_north_division_design_system/admin_panel_manajemen_form_koleksi/code.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

content_lines = lines[217:675] # Lines 218 to 676
content = ''.join(content_lines)

new_php = """<?php
require_admin();
?>
<main class="w-full max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-space-3xl">
    <div class="mb-space-xl">
        <span class="font-label-md text-primary tracking-widest uppercase block mb-1">INVENTORY</span>
        <h1 class="font-headline-lg text-on-surface tracking-tight">Manage <span class="text-primary font-bold">Collections</span></h1>
    </div>

    <!-- Admin Tabs -->
    <div class="flex items-center gap-2 mb-space-xl overflow-x-auto pb-2 border-b border-outline-variant">
        <a href="?page=admin" class="px-4 py-2 font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors">Dashboard</a>
        <a href="?page=admin_orders" class="px-4 py-2 font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors">Manage Orders</a>
        <a href="?page=admin_products" class="px-4 py-2 font-label-md uppercase tracking-wider text-on-surface-variant hover:text-on-surface transition-colors">Manage Products</a>
        <a href="?page=admin_collections" class="px-4 py-2 font-label-md uppercase tracking-wider rounded-t-lg bg-surface-container-high border-b-2 border-primary text-primary transition-colors">Manage Collections</a>
        <a href="?page=logout" class="px-4 py-2 font-label-md uppercase tracking-wider text-error hover:bg-error-container hover:text-error transition-colors rounded-lg ml-auto">Logout</a>
    </div>

""" + content + """
</main>
"""

with open('c:/xampp/htdocs/king/pages/admin_collections.php', 'w', encoding='utf-8') as out:
    out.write(new_php)
