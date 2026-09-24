<?php
// HELPER FUNCTIONS
// ============================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const WA_NUMBER = '62822196449'; // admin whatsapp (no +, no leading 0)

// Team photo: one shared group photo, shown once as the team hero image
const TEAM_PHOTO_GROUP = 'assets/team/image_ef9c80.jpg';
// Kept for backward-compat / in case individual headshots are added later
const TEAM_PHOTO_MASEP = TEAM_PHOTO_GROUP;
const TEAM_PHOTO_KAIRA = TEAM_PHOTO_GROUP;
const TEAM_PHOTO_NABIL = TEAM_PHOTO_GROUP;

function rupiah($angka) {
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}

function is_logged_in() { return isset($_SESSION['user_id']); }
function is_admin() { return is_logged_in() && in_array($_SESSION['role'] ?? '', ['admin', 'admin pro']); }
function is_admin_pro() { return is_logged_in() && ($_SESSION['role'] ?? '') === 'admin pro'; }
function current_user_id() { return $_SESSION['user_id'] ?? null; }

function require_login($redirectPage = 'login') {
    if (!is_logged_in()) { header('Location: ?page=' . $redirectPage); exit; }
}

function require_admin_pro() {
    if (!is_admin_pro()) {
        if (is_admin()) {
            header('Location: ?page=admin_products');
            exit;
        }
        require_admin();
    }
}

function require_admin() {
    if (!is_admin()) { 
        if (is_logged_in()) {
            echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Dragon Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: { extend: {
            colors: { surface: "#fff8f6", "surface-container": "#ffe9e5", primary: "#a13c17", "on-primary": "#ffffff", "on-surface": "#2b1613", error: "#ba1a1a", "error-container": "#ffdad6", "on-error-container": "#93000a" },
            fontFamily: { headline: ["Space Grotesk", "sans-serif"], body: ["Manrope", "sans-serif"] }
        }}
      }
    </script>
</head>
<body class="bg-surface font-body text-on-surface h-screen flex items-center justify-center p-4">
    <div class="bg-surface-container max-w-md w-full rounded-2xl p-8 flex flex-col items-center text-center shadow-sm">
        <div class="w-16 h-16 bg-error-container rounded-full flex items-center justify-center mb-6">
            <span class="material-symbols-outlined text-on-error-container text-4xl">admin_panel_settings</span>
        </div>
        <h1 class="font-headline font-bold text-2xl text-on-surface mb-2">Akses Ditolak</h1>
        <p class="text-on-surface/80 mb-8 leading-relaxed">
            Kamu bukan admin. Perubahan ditolak dan dibatalkan. Silahkan log out untuk kembali menggunakan layanan dengan akun yang sesuai.
        </p>
        <a href="?page=logout" class="w-full inline-flex items-center justify-center gap-2 bg-primary text-on-primary font-headline font-semibold px-6 py-3.5 rounded-xl hover:opacity-90 transition-opacity shadow-sm">
            <span class="material-symbols-outlined text-[20px]">logout</span>
            LOG OUT SEKARANG
        </a>
    </div>
</body>
</html>';
            exit;
        } else {
            header('Location: ?page=home'); 
            exit; 
        }
    }
}

function flash_set($msg, $type = 'success') { $_SESSION['flash'] = ['msg' => $msg, 'type' => $type]; }
function flash_get() {
    if (!empty($_SESSION['flash'])) { $f = $_SESSION['flash']; unset($_SESSION['flash']); return $f; }
    return null;
}

// ------------------------------------------------------------
// CART
// ------------------------------------------------------------
function cart_get() {
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) { $_SESSION['cart'] = []; }
    return $_SESSION['cart'];
}
function cart_add($productId, $qty = 1) {
    $cart = cart_get();
    $productId = (int)$productId;
    $qty = max(1, (int)$qty);
    $cart[$productId] = ($cart[$productId] ?? 0) + $qty;
    $_SESSION['cart'] = $cart;
}
function cart_update($productId, $qty) {
    $cart = cart_get();
    $productId = (int)$productId; $qty = (int)$qty;
    if ($qty <= 0) { unset($cart[$productId]); } else { $cart[$productId] = $qty; }
    $_SESSION['cart'] = $cart;
}
function cart_remove($productId) { $cart = cart_get(); unset($cart[(int)$productId]); $_SESSION['cart'] = $cart; }
function cart_clear() { $_SESSION['cart'] = []; }
function cart_count() { return array_sum(cart_get()); }

function cart_items($pdo) {
    $cart = cart_get();
    if (empty($cart)) return [];
    $ids = array_keys($cart);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $items = [];
    foreach ($rows as $row) {
        $qty = $cart[$row['id']];
        $items[] = ['product' => $row, 'qty' => $qty, 'subtotal' => $qty * $row['price']];
    }
    return $items;
}
function cart_total($pdo) {
    $total = 0;
    foreach (cart_items($pdo) as $item) { $total += $item['subtotal']; }
    return $total;
}

// ------------------------------------------------------------
// ORDER STATUS FLOW
// ------------------------------------------------------------
function order_status_flow() {
    return [
        'menunggu_pembayaran' => ['label' => 'Awaiting Payment', 'icon' => '⏳', 'desc' => 'Awaiting your transfer confirmation via WhatsApp.'],
        'diproses'            => ['label' => 'Order Processing',   'icon' => '🧾', 'desc' => 'Payment / COD order has been confirmed and is now being processed.'],
        'dikemas'             => ['label' => 'Packing',             'icon' => '📦', 'desc' => 'Your item is being carefully packed by our team.'],
        'dikirim_ekspedisi'   => ['label' => 'Handed to Courier',   'icon' => '🚚', 'desc' => 'Package has been handed over to the courier (JNT/partner courier).'],
        'dalam_perjalanan'    => ['label' => 'In Transit',          'icon' => '🛣️', 'desc' => 'Package is on its way to your address.'],
        'menuju_rumah'        => ['label' => 'Out for Delivery',    'icon' => '🏠', 'desc' => 'Courier is on the final leg of delivery to your address.'],
        'selesai'             => ['label' => 'Order Completed',     'icon' => '✅', 'desc' => 'Package delivered. Thank you for shopping with us!'],
        'dibatalkan'          => ['label' => 'Cancelled',           'icon' => '❌', 'desc' => 'This order has been cancelled.'],
    ];
}
function status_label($status) { $flow = order_status_flow(); return $flow[$status]['label'] ?? $status; }
function status_icon($status) { $flow = order_status_flow(); return $flow[$status]['icon'] ?? '•'; }

// ------------------------------------------------------------
// STOCK BADGE (UI helper)
// ------------------------------------------------------------
function stock_badge_html($product, $threshold = 5) {
    $stock = isset($product['stock']) ? (int)$product['stock'] : null;
    if ($stock === null) return '';
    if ($stock <= 0) {
        return '<span class="stock-flag stock-out">✕ Out of Stock</span>';
    }
    if ($stock <= $threshold) {
        return '<span class="stock-flag stock-low">⚡ Only ' . (int)$stock . ' left!</span>';
    }
    return '';
}

function next_status_options($currentStatus) {
    $order = ['menunggu_pembayaran', 'diproses', 'dikemas', 'dikirim_ekspedisi', 'dalam_perjalanan', 'menuju_rumah', 'selesai'];
    $pos = array_search($currentStatus, $order);
    $options = [];
    if ($pos !== false) { for ($i = $pos; $i < count($order); $i++) { $options[] = $order[$i]; } }
    if (!in_array('dibatalkan', $options)) { $options[] = 'dibatalkan'; }
    return $options;
}

function generate_order_code() { return 'DN-' . date('ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5)); }
function wa_link($message) { return 'https://wa.me/' . WA_NUMBER . '?text=' . rawurlencode($message); }

function log_order_status($pdo, $orderId, $status, $note = null) {
    $stmt = $pdo->prepare("INSERT INTO order_status_log (order_id, status, note) VALUES (?,?,?)");
    $stmt->execute([$orderId, $status, $note]);
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $orderId]);
}

function e($str) { return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8'); }

/**
 * Resolve a product image path to a displayable URL.
 * - If the image is an external URL (http/https), return it as-is.
 * - If the image is a local upload path (e.g. 'uploads/abc.jpg'), prepend the base path.
 * - If the image is empty, return a placeholder.
 */
function product_image_url($image) {
    if (empty($image)) {
        return 'data:image/svg+xml,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 400 400"><rect fill="#e8e0d8" width="400" height="400"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="sans-serif" font-size="16" fill="#8c7b6b">No Image</text></svg>');
    }
    // External URL — return as-is
    if (preg_match('/^https?:\/\//i', $image)) {
        return $image;
    }
    // Local file — build base path from current script
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    if ($basePath === '' || $basePath === '.') {
        return '/' . ltrim($image, '/');
    }
    return $basePath . '/' . ltrim($image, '/');
}

function badge_class($badge) {
    $b = strtolower((string)$badge);
    if (strpos($b, 'best') !== false) return 'badge-sold';
    if (strpos($b, 'sale') !== false) return 'badge-sale';
    if ($b !== '') return 'badge-new';
    return '';
}

function material_label($material) {
    $map = ['suede' => 'Swedish Suede', 'italia' => 'Italian Leather', 'australia' => 'Australian Leather'];
    return $map[$material] ?? ucfirst((string)$material);
}
function material_flag($material) {
    $map = ['suede' => '🇸🇪', 'italia' => '🇮🇹', 'australia' => '🇦🇺'];
    return $map[$material] ?? '🌍';
}
function grade_label($grade) {
    $map = ['a' => 'Grade A — Premium', 'b' => 'Grade B — Superior', 'c' => 'Grade C — Standard'];
    return $map[$grade] ?? strtoupper((string)$grade);
}

function star_html($rating, $max = 5) {
    $rating = (int)$rating; $html = '';
    for ($i = 1; $i <= $max; $i++) { $html .= $i <= $rating ? '★' : '☆'; }
    return $html;
}

