import re

with open('c:/xampp/htdocs/king/includes/actions.php', 'r', encoding='utf-8') as f:
    content = f.read()

php_code = """
if ($action === 'admin_save_product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    $id = (int)($_POST['id'] ?? 0);

    $fields = [
        'name'                 => trim($_POST['name'] ?? ''),
        'description'          => trim($_POST['description'] ?? ''),
        'price'                => (int)($_POST['price'] ?? 0),
        'material'             => $_POST['material'] ?? 'suede',
        'grade'                => $_POST['grade'] ?? 'a',
        'badge'                => trim($_POST['badge'] ?? ''),
        'stock'                => (int)($_POST['stock'] ?? 0),
        'zipper_brand'         => trim($_POST['zipper_brand'] ?? ''),
        'buckle_brand'         => trim($_POST['buckle_brand'] ?? ''),
        'lining_material'      => trim($_POST['lining_material'] ?? ''),
        'strap_material'       => trim($_POST['strap_material'] ?? ''),
        'dimensions'           => trim($_POST['dimensions'] ?? ''),
        'weight'               => trim($_POST['weight'] ?? ''),
        'warranty'             => trim($_POST['warranty'] ?? ''),
        'material_origin'      => trim($_POST['material_origin'] ?? ''),
        'leather_origin'       => trim($_POST['leather_origin'] ?? ''),
        'zipper_origin'        => trim($_POST['zipper_origin'] ?? ''),
        'buckle_origin'        => trim($_POST['buckle_origin'] ?? ''),
        'thread_material'      => trim($_POST['thread_material'] ?? ''),
        'zipper_detail'        => trim($_POST['zipper_detail'] ?? ''),
        'warranty_period'      => trim($_POST['warranty_period'] ?? ''),
        'water_resistance'     => trim($_POST['water_resistance'] ?? ''),
        'capacity_liters'      => trim($_POST['capacity_liters'] ?? ''),
        'compartments_detail'  => trim($_POST['compartments_detail'] ?? ''),
        'laptop_sleeve'        => trim($_POST['laptop_sleeve'] ?? ''),
        'back_panel'           => trim($_POST['back_panel'] ?? ''),
        'closure_type'         => trim($_POST['closure_type'] ?? ''),
        'country_of_assembly'  => trim($_POST['country_of_assembly'] ?? ''),
        'quality_control'      => trim($_POST['quality_control'] ?? ''),
        'care_instructions'    => trim($_POST['care_instructions'] ?? ''),
        'certification'        => trim($_POST['certification'] ?? ''),
        'packaging'            => trim($_POST['packaging'] ?? ''),
    ];

    if ($fields['name'] === '' || $fields['price'] <= 0) {
        flash_set('Product name and price must be filled in correctly.', 'error');
        header('Location: ?page=admin_products'); exit;
    }

    // Handle File Upload
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $imagePath = '';
    if ($id > 0) {
        // fetch existing image first
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            $imagePath = $existing['image'];
        }
    }
    
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image_file']['tmp_name'];
        $fileName = $_FILES['image_file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($fileExtension, $allowedExts)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;
            
            if(move_uploaded_file($fileTmpPath, $destPath)) {
                $imagePath = 'uploads/' . $newFileName;
            } else {
                flash_set('Error moving uploaded file.', 'error');
            }
        } else {
            flash_set('Invalid file extension for image.', 'error');
        }
    }
    
    $fields['image'] = $imagePath;

    if ($id > 0) {
        $setSql = implode(', ', array_map(function ($c) { return "$c = :$c"; }, array_keys($fields)));
        $stmt = $pdo->prepare("UPDATE products SET $setSql WHERE id = :id");
        $stmt->execute($fields + ['id' => $id]);
        flash_set('Product updated successfully.');
    } else {
        $colList = implode(', ', array_keys($fields));
        $phList = ':' . implode(', :', array_keys($fields));
        $stmt = $pdo->prepare("INSERT INTO products ($colList) VALUES ($phList)");
        $stmt->execute($fields);
        flash_set('New product added successfully.');
    }
    header('Location: ?page=admin_products'); exit;
}
"""

content = re.sub(
    r"if \(\$action === 'admin_save_product'.*?header\('Location: \?page=admin_products'\); exit;\n\}",
    php_code,
    content,
    flags=re.DOTALL
)

with open('c:/xampp/htdocs/king/includes/actions.php', 'w', encoding='utf-8') as out:
    out.write(content)
