import sys

with open('c:/xampp/htdocs/king/config.php', 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = []
skip = False
for i, line in enumerate(lines):
    if i == 8: # line 9 is 0-indexed 8
        new_lines.append('// ============================================================\n')
        new_lines.append('// DATABASE LAYER (MySQL via PDO)\n')
        new_lines.append('// ============================================================\n\n')
        new_lines.append('try {\n')
        new_lines.append('    $host = \'127.0.0.1\';\n')
        new_lines.append('    $db   = \'okeuy\';\n')
        new_lines.append('    $user = \'root\';\n')
        new_lines.append('    $pass = \'\';\n')
        new_lines.append('    $charset = \'utf8mb4\';\n\n')
        new_lines.append('    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";\n')
        new_lines.append('    $options = [\n')
        new_lines.append('        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,\n')
        new_lines.append('        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,\n')
        new_lines.append('        PDO::ATTR_EMULATE_PREPARES   => false,\n')
        new_lines.append('    ];\n')
        new_lines.append('    $pdo = new PDO($dsn, $user, $pass, $options);\n')
        new_lines.append('} catch (PDOException $e) {\n')
        new_lines.append('    die(\'Database connection failed: \' . htmlspecialchars($e->getMessage()));\n')
        new_lines.append('}\n\n')
        skip = True
    elif i == 27: # line 28
        new_lines.append('// ------------------------------------------------------------\n')
        new_lines.append('// SCHEMA\n')
        new_lines.append('// ------------------------------------------------------------\n')
        new_lines.append('// Schema and indexes are managed manually in MySQL.\n\n')
    elif i >= 28 and i <= 159:
        pass
    elif i == 160:
        skip = False
    elif not skip:
        new_lines.append(line)

with open('c:/xampp/htdocs/king/config.php', 'w', encoding='utf-8') as f:
    f.writelines(new_lines)
