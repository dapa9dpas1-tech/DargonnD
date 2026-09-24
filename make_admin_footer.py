import re

with open('c:/xampp/htdocs/king/stitch_dragon_north_division_design_system/admin_panel_manajemen_form_koleksi/code.html', 'r', encoding='utf-8') as f:
    lines = f.readlines()

footer_lines = lines[688:694]
footer_content = ''.join(footer_lines)

with open('c:/xampp/htdocs/king/includes/admin_footer.php', 'w', encoding='utf-8') as out:
    out.write(footer_content)
