import re

with open('c:/xampp/htdocs/king/stitch_dragon_north_division_design_system/admin_panel_manajemen_form_koleksi/code.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

header_lines = lines[0:217]
header_content = ''.join(header_lines)

new_php = """<?php
$seo_title = "Dragon Admin - Storefront Ops";
$seo_desc = "Admin Dashboard";
?>
""" + header_content

with open('c:/xampp/htdocs/king/includes/admin_header.php', 'w', encoding='utf-8') as out:
    out.write(new_php)
