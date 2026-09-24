<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/helpers.php';

// ============================================================
// SYNC USER SESSION WITH DATABASE
// ============================================================
if (is_logged_in()) {
    $stmtSync = $pdo->prepare("SELECT role, name FROM users WHERE id = ?");
    $stmtSync->execute([current_user_id()]);
    $syncData = $stmtSync->fetch(PDO::FETCH_ASSOC);
    if ($syncData) {
        $_SESSION['role'] = $syncData['role'];
        $_SESSION['name'] = $syncData['name'];
    } else {
        $_SESSION = [];
        session_destroy();
    }
}

// HANDLE PAGE SWITCHING
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$active_page = $page;
$action = $_POST['do'] ?? ($_GET['do'] ?? null);

require __DIR__ . '/includes/actions.php';

// ============================================================
// PAGE CONTENT RENDERING
// ============================================================
ob_start();

$pageFile = __DIR__ . '/pages/' . basename($page) . '.php';

switch ($page) {
    case 'about':
    case 'products':
    case 'product':
    case 'team':
    case 'testimonials':
    case 'contact':
    case 'login':
    case 'register':
    case 'cart':
    case 'checkout':
    case 'order_success':
    case 'my_orders':
    case 'order_detail':
    case 'admin':
    case 'admin_products':
    case 'admin_orders':
    case 'admin_order_detail':
    case 'admin_users':
        require $pageFile;
        break;

    default: // HOME PAGE
        require __DIR__ . '/pages/home.php';
        break;
}

$pageContent = ob_get_clean();

if (strpos($page, 'admin') === 0) {
    require __DIR__ . '/includes/admin_header.php';
    echo $pageContent;
    require __DIR__ . '/includes/admin_footer.php';
} else {
    require __DIR__ . '/includes/header.php';
    echo $pageContent;
    require __DIR__ . '/includes/footer.php';
}
