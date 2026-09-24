<?php
// LOGOUT
// ============================================================
if ($page === 'logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: ?page=home');
    exit;
}

// ============================================================
// AUTH ACTIONS
// ============================================================
if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        flash_set('All fields are required.', 'error');
        header('Location: ?page=register'); exit;
    }
    if (strlen($password) < 6) {
        flash_set('Password must be at least 6 characters.', 'error');
        header('Location: ?page=register'); exit;
    }
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        flash_set('Email already registered. Please sign in.', 'error');
        header('Location: ?page=login'); exit;
    }
    $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password_hash, role) VALUES (?,?,?,?,'customer')");
    $stmt->execute([$name, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]);
    $userId = $pdo->lastInsertId();

    session_regenerate_id(true);
    $_SESSION['user_id'] = $userId;
    $_SESSION['role'] = 'customer';
    $_SESSION['name'] = $name;
    flash_set('Registration successful! Welcome, ' . $name . '.');
    header('Location: ?page=home'); exit;
}

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        flash_set('Signed in successfully. Welcome back, ' . $user['name'] . '.');
        if ($user['role'] === 'admin pro') {
            header('Location: ?page=admin');
        } elseif ($user['role'] === 'admin') {
            header('Location: ?page=admin_products');
        } else {
            header('Location: ?page=home');
        }
        exit;
    }
    flash_set('Incorrect email or password.', 'error');
    header('Location: ?page=login'); exit;
}

// ============================================================
// CART ACTIONS
// ============================================================
if ($action === 'add_to_cart' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_logged_in()) {
        flash_set('Please log in to add items to your cart.', 'error');
        header('Location: ?page=login');
        exit;
    }
    cart_add($_POST['product_id'] ?? 0, $_POST['qty'] ?? 1);
    flash_set('Product added to cart.');
    header('Location: ' . ($_POST['redirect'] ?? '?page=cart')); exit;
}
if ($action === 'update_cart' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (($_POST['qty'] ?? []) as $pid => $qty) { cart_update($pid, $qty); }
    flash_set('Cart updated.');
    header('Location: ?page=cart'); exit;
}
if ($action === 'remove_from_cart' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    cart_remove($_POST['product_id'] ?? 0);
    flash_set('Product removed from cart.');
    header('Location: ?page=cart'); exit;
}

// ============================================================
// CHECKOUT
// ============================================================
if ($action === 'checkout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login('login');
    
    // VALIDASI USER: Pastikan ID user benar-benar ada di database
    $user_id = current_user_id();
    $stmtCheck = $pdo->prepare("SELECT id FROM users WHERE id = ?");
    $stmtCheck->execute([$user_id]);
    if (!$stmtCheck->fetch()) {
        $_SESSION = [];
        session_destroy();
        header('Location: ?page=login'); 
        exit;
    }

    $items = cart_items($pdo);
    if (empty($items)) { flash_set('Your cart is empty.', 'error'); header('Location: ?page=cart'); exit; }

    $name = trim($_POST['recipient_name'] ?? '');
    $phone = trim($_POST['recipient_phone'] ?? '');
    $address = trim($_POST['recipient_address'] ?? '');
    $paymentMethod = $_POST['payment_method'] ?? '';

    if ($name === '' || $phone === '' || $address === '' || !in_array($paymentMethod, ['transfer', 'cod'], true)) {
        flash_set('Please complete your shipping details and select a payment method.', 'error');
        header('Location: ?page=checkout'); exit;
    }

    $total = cart_total($pdo);
    $orderCode = generate_order_code();
    $initialStatus = $paymentMethod === 'transfer' ? 'menunggu_pembayaran' : 'diproses';

    // Eksekusi pesanan dengan User ID yang sudah terverifikasi
    $stmt = $pdo->prepare("INSERT INTO orders (order_code, user_id, total, payment_method, status, recipient_name, recipient_phone, recipient_address) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->execute([$orderCode, $user_id, $total, $paymentMethod, $initialStatus, $name, $phone, $address]);
    $orderId = $pdo->lastInsertId();

    $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, price, qty) VALUES (?,?,?,?,?)");
    foreach ($items as $item) {
        $stmtItem->execute([$orderId, $item['product']['id'], $item['product']['name'], $item['product']['price'], $item['qty']]);
    }

    $initialNote = $paymentMethod === 'transfer'
        ? 'Awaiting proof of transfer to be confirmed by admin via WhatsApp.'
        : 'COD order received and is being processed immediately by our team.';
    log_order_status($pdo, $orderId, $initialStatus, $initialNote);

    cart_clear();
    header('Location: ?page=order_success&id=' . $orderId); exit;
}

// ============================================================
// RATING
// ============================================================
if ($action === 'rate_order' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login('login');
    $orderId = (int)($_POST['order_id'] ?? 0);
    $rating = max(1, min(5, (int)($_POST['rating'] ?? 5)));
    $review = trim($_POST['review'] ?? '');

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$orderId, current_user_id()]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order && $order['status'] === 'selesai') {
        $stmt = $pdo->prepare("SELECT id FROM ratings WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            $stmt = $pdo->prepare("UPDATE ratings SET rating = ?, review = ? WHERE order_id = ?");
            $stmt->execute([$rating, $review, $orderId]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO ratings (order_id, user_id, rating, review) VALUES (?,?,?,?)");
            $stmt->execute([$orderId, current_user_id(), $rating, $review]);
        }
        flash_set('Thank you for your rating!');
    } else {
        flash_set('This order cannot be rated yet.', 'error');
    }
    header('Location: ?page=order_detail&order=' . $orderId); exit;
}

// ============================================================
// ADMIN: ORDER STATUS
// ============================================================
if ($action === 'admin_update_status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    $orderId = (int)($_POST['order_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    $note = trim($_POST['note'] ?? '');

    if (array_key_exists($status, order_status_flow())) {
        log_order_status($pdo, $orderId, $status, $note !== '' ? $note : null);
        flash_set('Order status updated successfully.');
    } else {
        flash_set('Invalid status.', 'error');
    }
    header('Location: ?page=admin_order_detail&order=' . $orderId); exit;
}

// ============================================================
// ADMIN: PRODUCT CRUD
// ============================================================
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
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            $imagePath = $existing['image'];
        }
    }
    
    if (isset($_FILES['image_file'])) {
        $err = $_FILES['image_file']['error'];
        if ($err === UPLOAD_ERR_OK) {
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
                    flash_set('Error moving uploaded file. Check folder permissions.', 'error');
                    header('Location: ?page=admin_products'); exit;
                }
            } else {
                flash_set('Invalid file extension for image. Allowed: jpg, png, gif, webp.', 'error');
                header('Location: ?page=admin_products'); exit;
            }
        } elseif ($err !== UPLOAD_ERR_NO_FILE) {
            $errorMsg = 'Upload failed. Error code: ' . $err;
            if ($err === UPLOAD_ERR_INI_SIZE || $err === UPLOAD_ERR_FORM_SIZE) {
                $errorMsg = 'Ukuran file foto terlalu besar (Maks 2MB). Silakan kompres foto Anda terlebih dahulu.';
            }
            flash_set($errorMsg, 'error');
            header('Location: ?page=admin_products'); exit;
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

if ($action === 'admin_toggle_product' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    $id = (int)($_POST['id'] ?? 0);
    $newState = (int)($_POST['state'] ?? 1);
    $stmt = $pdo->prepare("UPDATE products SET is_active = ? WHERE id = ?");
    $stmt->execute([$newState, $id]);
    flash_set($newState ? 'Product reactivated.' : 'Product deactivated.');
    header('Location: ?page=admin_products'); exit;
}

// ============================================================
// USER PROFILE & PASSWORD
// ============================================================
if ($action === 'update_profile' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login('login');
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $userId = current_user_id();

    if ($name === '' || $email === '') {
        flash_set('Name and Email are required.', 'error');
        header('Location: ?page=my_orders'); exit;
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$email, $userId]);
    if ($stmt->fetch()) {
        flash_set('Email is already taken by another account.', 'error');
        header('Location: ?page=my_orders'); exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $address, $userId]);
    
    $_SESSION['name'] = $name;
    flash_set('Profile identity updated successfully.');
    header('Location: ?page=my_orders'); exit;
}

if ($action === 'update_password' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_login('login');
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $userId = current_user_id();

    if (strlen($new) < 8) {
        flash_set('New password must be at least 8 characters.', 'error');
        header('Location: ?page=my_orders'); exit;
    }
    if ($new !== $confirm) {
        flash_set('New password confirmation does not match.', 'error');
        header('Location: ?page=my_orders'); exit;
    }

    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($current, $user['password_hash'])) {
        flash_set('Current password is incorrect.', 'error');
        header('Location: ?page=my_orders'); exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $stmt->execute([password_hash($new, PASSWORD_DEFAULT), $userId]);
    
    flash_set('Security protocol updated: password changed successfully.');
    header('Location: ?page=my_orders'); exit;
}

// ============================================================
// ADMIN: USER MANAGEMENT
// ============================================================
if ($action === 'admin_save_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin_pro();
    $id = (int)($_POST['id'] ?? 0);
    $role = $_POST['role'] ?? 'customer';
    
    if ($id == 1) {
        flash_set('Role untuk Admin Pro utama tidak dapat diubah.', 'error');
        header('Location: index.php?page=admin_users');
        exit;
    }

    $allowed_roles = ['admin', 'customer'];
    if (current_user_id() == 1) {
        $allowed_roles[] = 'admin pro';
    } elseif ($role === 'admin pro') {
        $stmtCheck = $pdo->prepare("SELECT role FROM users WHERE id = ?");
        $stmtCheck->execute([$id]);
        $existingUser = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        if ($existingUser && $existingUser['role'] === 'admin pro') {
            $allowed_roles[] = 'admin pro';
        }
    }

    if (!in_array($role, $allowed_roles)) {
        $role = 'customer';
    }
    
    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $id]);
        flash_set('Role for this user has been updated to ' . strtoupper($role) . '.');
    }
    
    header('Location: index.php?page=admin_users&edit=' . $id);
    exit;
}