import re

with open('c:/xampp/htdocs/king/includes/actions.php', 'r', encoding='utf-8') as f:
    content = f.read()

php_code = """
        } elseif ($err !== UPLOAD_ERR_NO_FILE) {
            $errorMsg = 'Upload failed. Error code: ' . $err;
            if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) {
                $errorMsg = 'Ukuran file foto terlalu besar (Maks 2MB). Silakan kompres foto Anda terlebih dahulu.';
            }
            flash_set($errorMsg, 'error');
            header('Location: ?page=admin_products'); exit;
        }
"""

content = re.sub(
    r"\} elseif \(\$err !== UPLOAD_ERR_NO_FILE\) \{\s+flash_set\('Upload error code: ' \. \$err, 'error'\);\s+header\('Location: \?page=admin_products'\); exit;\s+\}",
    php_code.strip(),
    content
)

with open('c:/xampp/htdocs/king/includes/actions.php', 'w', encoding='utf-8') as out:
    out.write(content)
