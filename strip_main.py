import re
import os

files = [
    'c:/xampp/htdocs/king/pages/admin.php',
    'c:/xampp/htdocs/king/pages/admin_products.php',
    'c:/xampp/htdocs/king/pages/admin_orders.php',
    'c:/xampp/htdocs/king/pages/admin_order_detail.php',
    'c:/xampp/htdocs/king/pages/admin_collections.php'
]

for file in files:
    with open(file, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Remove the opening <main class="w-full max-w-7xl mx-auto px-margin-mobile md:px-margin-desktop py-space-3xl">
    content = re.sub(r'<main[^>]*>', '<div>', content, count=1)
    
    # Remove the closing </main> at the end
    content = re.sub(r'</main>$', '</div>', content.strip())
    
    with open(file, 'w', encoding='utf-8') as f:
        f.write(content)
