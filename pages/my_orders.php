<?php
require_login('login');
$stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
$stmt->execute([current_user_id()]);
$myOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userStmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$userStmt->execute([current_user_id()]);
$currentUser = $userStmt->fetch(PDO::FETCH_ASSOC);

$activeOrders = [];
$completedOrders = [];
foreach ($myOrders as $o) {
    if (in_array($o['status'], ['selesai', 'dibatalkan'])) {
        $completedOrders[] = $o;
    } else {
        $activeOrders[] = $o;
    }
}

// Pre-fetch order items for easy rendering
$orderItemsByOrderId = [];
if (!empty($myOrders)) {
    $orderIds = array_column($myOrders, 'id');
    $placeholders = implode(',', array_fill(0, count($orderIds), '?'));
    $stmtItems = $pdo->prepare("SELECT oi.*, p.image FROM order_items oi LEFT JOIN products p ON p.id = oi.product_id WHERE order_id IN ($placeholders)");
    $stmtItems->execute($orderIds);
    $allItems = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
    foreach ($allItems as $item) {
        $orderItemsByOrderId[$item['order_id']][] = $item;
    }
}
?>
<main class="w-full pt-20 bg-background min-h-screen">
<div class="flex flex-col w-full">
<!-- Explorer Header / Profile Summary Section -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-xl bg-surface-container-low">
<!-- Breadcrumb & Technical Coordinate -->
<div class="flex flex-wrap items-center justify-between gap-space-sm mb-space-lg">
<nav class="flex items-center gap-space-xs font-label-md text-label-md text-outline uppercase tracking-wider">
<a class="hover:text-primary transition-colors" href="#">Beranda</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="#">Akun Explorer</a>
<span class="text-outline-variant">/</span>
<span class="text-on-surface font-bold">Profil &amp; Pengaturan</span>
</nav>
<div class="flex items-center gap-space-xs bg-surface-container px-space-sm py-space-xxs rounded">
<span class="inline-block w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
<span class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant">SINKRONISASI TERMINAL: LAT 46°30' N // AKTIF</span>
</div>
</div>
<!-- Explorer Master Identity Card -->
<div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md flex flex-col lg:flex-row items-start lg:items-center justify-between gap-space-lg">
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-space-md sm:gap-space-lg">
<!-- Explorer Portrait with Status Ring -->
<div class="relative">
<img class="w-20 h-20 md:w-24 md:h-24 rounded-full object-cover shadow-inner" data-alt="Portrait photo of a male alpine explorer wearing outdoor technical weather gear and beanie against a backdrop of snowy mountain ridges under bright overcast alpine sky, warm terracotta and earthy tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuByydx3AsfbR9YHLGPJJHEeR2i8UPFvNaPNq8bxzk9Qa8431ItM_Ye-6LHzcanWddyJwwrh_pu1zoz9p4jfJ4vf2zI7qxbq2SQHBhn_xQsei2gXJHl8GDW7EzViq_2oLoDlBTfm7f0tRacypQgauDdSQfQPwhDe7c0Z9SmnhmQD74IhICEQrPHQg4bSGdZUch8hMN5LwurJqq0gGlXyFpsfigeq2CCDUOaYOkdsb3el75HKoeFMaw5l"/>
<button class="absolute bottom-0 right-0 bg-primary text-on-primary w-7 h-7 rounded-full flex items-center justify-center shadow hover:bg-primary-container transition-transform hover:scale-105" title="Ubah Foto Identitas">
<span class="material-symbols-outlined text-sm">photo_camera</span>
</button>
</div>
<!-- Identity Details -->
<div class="flex flex-col gap-space-xxs">
<div class="flex flex-wrap items-center gap-space-xs">
<span class="bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm px-space-xs py-0.5 rounded uppercase tracking-wider font-bold">LEVEL 3 // SUMMIT SPECIALIST</span>
<span class="bg-surface-container text-outline font-label-sm text-label-sm px-space-xs py-0.5 rounded uppercase">DIV-ALPHA #7704</span>
</div>
<h1 class="font-headline-md text-headline-md text-on-surface tracking-tight uppercase" id="explorerDisplayName"><?= htmlspecialchars($currentUser['name'] ?? '') ?></h1>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-space-xs">
<span class="material-symbols-outlined text-base text-primary">pin_drop</span>
            Basecamp Bandung // <?= htmlspecialchars($currentUser['email'] ?? '') ?> // <?= htmlspecialchars($currentUser['phone'] ?? '') ?>
          </p>
</div>
</div>
<!-- Quick Actions & Log Out CTA -->
<div class="flex flex-wrap sm:flex-nowrap items-center gap-space-sm w-full lg:w-auto justify-start lg:justify-end">
<a class="w-full sm:w-auto text-center font-label-md text-label-md uppercase tracking-wider bg-surface-container-high text-on-surface px-space-lg py-space-sm rounded hover:bg-surface-variant transition-colors flex items-center justify-center gap-space-xs" href="#order-section">
<span class="material-symbols-outlined text-base">local_shipping</span>
          Pesanan Aktif (1)
        </a>
<button class="w-full sm:w-auto font-label-md text-label-md uppercase tracking-wider bg-surface-container-low text-primary px-space-lg py-space-sm rounded hover:bg-primary hover:text-on-primary transition-all flex items-center justify-center gap-space-xs" onclick="window.location.href=' ?page=logout' ">
<span class="material-symbols-outlined text-base">logout</span>
          Keluar Terminal
        </button>
</div>
</div>
</section>
<!-- Interactive Dashboard Tabs & Body -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-2xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-2xl">
<!-- Navigation Sidebar for Account Management -->
<div class="lg:col-span-4 flex flex-col gap-space-md">
<div class="bg-surface-container-low p-space-md rounded-xl flex flex-col gap-space-xs shadow-sm">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-outline px-space-sm py-space-xxs">MENU NAVIGASI TERMINAL</span>
<!-- Tab Button 1: Tracking / Orders -->
<button class="w-full text-left p-space-md rounded flex items-center justify-between transition-all bg-surface-container-lowest text-primary shadow-sm font-bold" id="tabBtnOrders" onclick="switchTab('orders')">
<div class="flex items-center gap-space-sm">
<span class="material-symbols-outlined text-xl">package_2</span>
<div>
<span class="block font-label-md text-label-md uppercase tracking-wide">Proses &amp; Riwayat Pesanan</span>
<span class="block font-body-sm text-body-sm text-on-surface-variant font-normal">1 Dalam Rigging, 4 Selesai</span>
</div>
</div>
<span class="bg-primary text-on-primary font-label-sm text-label-sm w-5 h-5 rounded-full flex items-center justify-center">1</span>
</button>
<!-- Tab Button 2: Profile & Name -->
<button class="w-full text-left p-space-md rounded flex items-center justify-between transition-all text-on-surface hover:bg-surface-container-high font-medium" id="tabBtnProfile" onclick="switchTab('profile')">
<div class="flex items-center gap-space-sm">
<span class="material-symbols-outlined text-xl text-outline">badge</span>
<div>
<span class="block font-label-md text-label-md uppercase tracking-wide">Pengaturan Profil &amp; Nama</span>
<span class="block font-body-sm text-body-sm text-outline font-normal">Ganti Nama, Call Sign, Alamat</span>
</div>
</div>
<span class="material-symbols-outlined text-outline text-sm">chevron_right</span>
</button>
<!-- Tab Button 3: Security & Password -->
<button class="w-full text-left p-space-md rounded flex items-center justify-between transition-all text-on-surface hover:bg-surface-container-high font-medium" id="tabBtnSecurity" onclick="switchTab('security')">
<div class="flex items-center gap-space-sm">
<span class="material-symbols-outlined text-xl text-outline">shield_lock</span>
<div>
<span class="block font-label-md text-label-md uppercase tracking-wide">Keamanan &amp; Kata Sandi</span>
<span class="block font-body-sm text-body-sm text-outline font-normal">Ganti Password, 2FA Autentikasi</span>
</div>
</div>
<span class="material-symbols-outlined text-outline text-sm">chevron_right</span>
</button>
</div>
<!-- Alpine Field Spec Sheet Banner -->
<div class="bg-inverse-surface text-inverse-on-surface p-space-lg rounded-xl shadow-md flex flex-col gap-space-sm relative overflow-hidden">
<div class="flex items-center justify-between text-secondary-fixed">
<span class="font-label-sm text-label-sm uppercase tracking-widest font-bold">GARANSI LAPANGAN DND SEUMUR HIDUP</span>
<span class="material-symbols-outlined text-lg">verified</span>
</div>
<p class="font-body-sm text-body-sm text-surface-container-high">Setiap carrier Cordura 500D &amp; 1000D DND yang Anda beli dilindungi program reparasi hardware, buckle, dan zipper di markas resmi kami.</p>
<div class="pt-space-xs">
<a class="font-label-sm text-label-sm uppercase tracking-wider text-tertiary-fixed underline underline-offset-4 hover:text-white transition-colors" href="#">Klaim Servis Hardware Lapangan →</a>
</div>
</div>
</div>
<!-- Main Dynamic Content Workspace -->
<div class="lg:col-span-8 flex flex-col">
<!-- ============================================== -->
<!-- TAB 1: ORDER TRACKING & FULFILLMENT PIPELINE   -->
<!-- ============================================== -->
<div class="flex flex-col gap-space-xl" id="paneOrders">
    <?php if (empty($activeOrders) && empty($completedOrders)): ?>
        <div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md">
            <h3 class="font-headline-sm uppercase text-on-surface">Tidak Ada Pesanan</h3>
            <p class="font-body-sm text-on-surface-variant">Anda belum pernah melakukan pemesanan.</p>
        </div>
    <?php endif; ?>

    <?php foreach ($activeOrders as $o): ?>
    <div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md flex flex-col gap-space-lg" id="order-section-<?= $o['id'] ?>">
        <div class="flex flex-wrap items-center justify-between gap-space-sm pb-space-sm">
            <div class="flex flex-col">
                <div class="flex items-center gap-space-xs">
                    <span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold">EKSPEDISI LAPANGAN AKTIF</span>
                    <span class="text-outline-variant">�</span>
                    <span class="font-label-sm text-label-sm text-outline"><?= htmlspecialchars($o['order_code']) ?></span>
                </div>
                <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface tracking-tight mt-1">Status: <?= status_label($o['status']) ?></h2>
            </div>
            <div class="flex items-center gap-space-xs">
                <span class="bg-primary-container text-on-primary-container font-label-md text-label-md uppercase px-space-md py-space-xxs rounded font-bold flex items-center gap-space-xxs">
                    <span class="inline-block w-2 h-2 rounded-full bg-white animate-ping"></span>
                    <?= status_label($o['status']) ?>
                </span>
            </div>
        </div>

        <div class="flex flex-col gap-space-sm">
            <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Daftar Muatan Pesanan</span>
            <?php 
            $items = $orderItemsByOrderId[$o['id']] ?? []; 
            foreach ($items as $item): 
            ?>
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-space-md bg-surface-container-low rounded-lg gap-space-md">
                <div class="flex items-center gap-space-md">
                    <?php if ($item['image']): ?>
                    <img class="w-16 h-16 rounded object-cover shadow-sm flex-shrink-0" src="<?= e(product_image_url($item['image'])) ?>"/>
                    <?php else: ?>
                    <div class="w-16 h-16 rounded bg-surface-container shadow-sm flex-shrink-0"></div>
                    <?php endif; ?>
                    <div class="flex flex-col">
                        <span class="font-headline-sm text-headline-sm uppercase text-on-surface text-base"><?= htmlspecialchars($item['product_name']) ?></span>
                        <span class="font-label-sm text-label-sm text-primary font-bold mt-1">Qty: <?= $item['qty'] ?></span>
                    </div>
                </div>
                <div class="flex flex-col sm:items-end">
                    <span class="font-headline-sm text-headline-sm text-on-surface"><?= rupiah($item['price'] * $item['qty']) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-space-sm pt-space-xs">
            <div class="flex items-center gap-space-sm">
                <span class="font-label-md text-label-md uppercase tracking-wider text-outline">Total: <?= rupiah($o['total']) ?> (<?= strtoupper($o['payment_method']) ?>)</span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (!empty($completedOrders)): ?>
    <div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md flex flex-col gap-space-md mt-space-xl">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">Riwayat Pesanan Ekspedisi Terdahulu</h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Arsip pembelian perlengkapan pendakian yang telah tuntas diterima di basecamp Anda.</p>
            </div>
            <span class="bg-surface-container text-outline font-label-sm text-label-sm px-space-sm py-space-xxs rounded uppercase">TOTAL <?= count($completedOrders) ?> MISI SELESAI</span>
        </div>
        
        <div class="flex flex-col gap-space-sm mt-space-sm">
            <?php foreach ($completedOrders as $o): ?>
                <?php 
                $items = $orderItemsByOrderId[$o['id']] ?? []; 
                foreach ($items as $item): 
                ?>
                <div class="flex flex-col md:flex-row md:items-center justify-between p-space-md bg-surface-container-low rounded-lg gap-space-md">
                    <div class="flex items-center gap-space-md">
                        <?php if ($item['image']): ?>
                        <img class="w-14 h-14 rounded object-cover shadow-sm" src="<?= e(product_image_url($item['image'])) ?>"/>
                        <?php else: ?>
                        <div class="w-14 h-14 rounded bg-surface-container shadow-sm"></div>
                        <?php endif; ?>
                        <div>
                            <span class="font-label-md text-label-md text-on-surface uppercase font-bold block"><?= htmlspecialchars($item['product_name']) ?> (<?= $item['qty'] ?>x)</span>
                            <span class="font-body-sm text-body-sm text-outline block"><?= status_label($o['status']) ?> pada <?= date('d M Y', strtotime($o['created_at'])) ?> � <?= htmlspecialchars($o['order_code']) ?></span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between md:justify-end gap-space-lg">
                        <span class="font-label-md text-label-md text-on-surface font-bold"><?= rupiah($item['price'] * $item['qty']) ?></span>
                        <div class="flex items-center gap-space-xs">
                            <span class="bg-surface-container-high text-on-surface font-label-sm text-label-sm px-space-xs py-1 rounded uppercase font-bold"><?= status_label($o['status']) ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- ============================================== -->
<!-- TAB 2: PROFILE & CHANGE NAME FORM              -->
<!-- ============================================== -->
<div class="hidden flex-col gap-space-xl" id="paneProfile">
<div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md flex flex-col gap-space-lg">
<div class="flex flex-col gap-space-xxs">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold">MANAJEMEN IDENTITAS EXPLORER</span>
<h2 class="font-headline-md text-headline-md uppercase text-on-surface tracking-tight">Ganti &amp; Perbarui Nama Profil</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Pastikan nama lengkap dan nama panggilan taktis (Call Sign) sesuai dengan identitas kartu pendakian resmi dan lisensi ekspedisi Anda.</p>
</div>
<!-- Profile Edit Form -->
<form class="flex flex-col gap-space-lg" id="profileNameForm" method="POST" action="?action=update_profile">
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<!-- Full Name Field (Ganti Nama) -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold flex items-center justify-between" for="fullNameInput">
<span>Nama Lengkap Pendaki</span>
<span class="text-primary font-label-sm text-label-sm">*Wajib</span>
</label>
<input class="bg-surface-container-low px-space-md py-space-sm rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="fullNameInput" name="name" placeholder="Masukkan nama lengkap Anda..." required="" type="text" value="<?= htmlspecialchars($currentUser['name'] ?? '') ?>" />
<span class="font-body-sm text-body-sm text-outline text-xs">Nama yang tercantum pada sertifikat ekspedisi dan faktur resmi DND.</span>
</div>
<!-- Call Sign / Display Username -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold flex items-center justify-between" for="callSignInput">
<span>Call Sign / Tanda Panggilan</span>
<span class="text-outline font-label-sm text-label-sm">Kode Taktis</span>
</label>
<div class="flex items-center bg-surface-container-low px-space-md py-space-sm rounded focus-within:bg-surface-container-high transition-colors">
<span class="text-outline font-label-md text-label-md uppercase mr-space-xs font-mono">DND //</span>
<input class="bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none w-full font-bold uppercase" id="callSignInput" placeholder="Contoh: RIDGE-HAWK" type="text" value="EXP-7704"/>
</div>
<span class="font-body-sm text-body-sm text-outline text-xs">Akan terlihat pada logboard komunitas basecamp dan leaderboard.</span>
</div>
</div>
<!-- Contact Information -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="emailInput">
                    Alamat Email Explorer
                  </label>
<input class="bg-surface-container-low px-space-md py-space-sm rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="emailInput" name="email" required="" type="email" value="<?= htmlspecialchars($currentUser['email'] ?? '') ?>" />
</div>
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="phoneInput">
                    Nomor Telepon Lapangan / WA
                  </label>
<input class="bg-surface-container-low px-space-md py-space-sm rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="phoneInput" name="phone" required="" type="tel" value="<?= htmlspecialchars($currentUser['phone'] ?? '') ?>" />
</div>
</div>
<!-- Basecamp Address -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="addressInput">
                  Alamat Pengiriman Utama Basecamp
                </label>
<textarea class="bg-surface-container-low px-space-md py-space-sm rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors resize-none" id="addressInput" name="address" rows="3"><?= htmlspecialchars($currentUser['address'] ?? '') ?></textarea>
</div>
<!-- Notification Toast for Profile Save -->
<div class="hidden p-space-md bg-secondary-fixed text-on-secondary-fixed rounded flex items-center gap-space-sm" id="profileSuccessNotice">
<span class="material-symbols-outlined text-xl">check_circle</span>
<span class="font-body-sm text-body-sm font-semibold">Profil identitas explorer berhasil diperbarui dan disinkronkan ke seluruh stasiun jaringan DND.</span>
</div>
<!-- Form Submit Controls -->
<div class="flex flex-wrap items-center justify-end gap-space-sm pt-space-xs">
<button class="font-label-md text-label-md uppercase tracking-wider bg-surface-container-high text-on-surface px-space-lg py-space-sm rounded hover:bg-surface-variant transition-colors" type="reset">
                  Kembalikan Semula
                </button>
<button class="font-label-md text-label-md uppercase tracking-wider bg-primary-container text-on-primary-container px-space-xl py-space-sm rounded hover:bg-primary transition-colors flex items-center gap-space-xs shadow" type="submit">
<span class="material-symbols-outlined text-base">save</span>
                  Simpan Perubahan Nama
                </button>
</div>
</form>
</div>
</div>
<!-- ============================================== -->
<!-- TAB 3: SECURITY & CHANGE PASSWORD FORM         -->
<!-- ============================================== -->
<div class="hidden flex-col gap-space-xl" id="paneSecurity">
<div class="bg-surface-container-lowest p-space-lg md:p-space-xl rounded-xl shadow-md flex flex-col gap-space-lg">
<div class="flex flex-col gap-space-xxs">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold">PROTOKOL KEAMANAN BASECAMP</span>
<h2 class="font-headline-md text-headline-md uppercase text-on-surface tracking-tight">Ganti Kata Sandi Terminal</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Amankan terminal akun Anda dengan sandi enkripsi tinggi untuk menjaga data ekspedisi, kupon preorder, dan riwayat pesanan.</p>
</div>
<!-- Password Change Form -->
<form class="flex flex-col gap-space-lg" id="passwordForm" method="POST" action="?action=update_password">
<!-- Current Password -->
<div class="flex flex-col gap-space-xs max-w-lg">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="currentPassword">
                  Kata Sandi Saat Ini
                </label>
<div class="relative flex items-center">
<input class="w-full bg-surface-container-low px-space-md py-space-sm pr-10 rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="currentPassword" name="current_password" placeholder="Ketikkan sandi aktif Anda..." required="" type="password"/>
<button class="absolute right-3 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('currentPassword', this)" type="button">
<span class="material-symbols-outlined text-lg">visibility</span>
</button>
</div>
<div class="text-right">
<a class="font-label-sm text-label-sm uppercase tracking-wider text-outline hover:text-primary transition-colors" href="#">Lupa kata sandi saat ini?</a>
</div>
</div>
<!-- New Password & Confirm Password Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<!-- New Password Field -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="newPassword">
                    Kata Sandi Baru
                  </label>
<div class="relative flex items-center">
<input class="w-full bg-surface-container-low px-space-md py-space-sm pr-10 rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="newPassword" name="new_password" minlength="8" oninput="checkPasswordStrength(this.value)" placeholder="Minimal 8 karakter unik..." required="" type="password"/>
<button class="absolute right-3 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('newPassword', this)" type="button">
<span class="material-symbols-outlined text-lg">visibility</span>
</button>
</div>
</div>
<!-- Confirm New Password Field -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold" for="confirmPassword">
                    Konfirmasi Kata Sandi Baru
                  </label>
<div class="relative flex items-center">
<input class="w-full bg-surface-container-low px-space-md py-space-sm pr-10 rounded font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-high transition-colors" id="confirmPassword" name="confirm_password" placeholder="Ulangi kata sandi baru..." required="" type="password"/>
<button class="absolute right-3 text-outline hover:text-on-surface" onclick="togglePasswordVisibility('confirmPassword', this)" type="button">
<span class="material-symbols-outlined text-lg">visibility</span>
</button>
</div>
</div>
</div>
<!-- Password Requirements Matrix Box -->
<div class="bg-surface-container-low p-space-md rounded-lg flex flex-col gap-space-xs">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-outline font-bold">STANDAR PROTOKOL ENKRIPSI DND</span>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-x-space-md gap-y-space-xxs text-outline font-body-sm text-body-sm text-xs">
<div class="flex items-center gap-space-xxs" id="ruleLength">
<span class="material-symbols-outlined text-base">radio_button_unchecked</span>
<span>Minimal 8 karakter alfanumerik</span>
</div>
<div class="flex items-center gap-space-xxs" id="ruleUpper">
<span class="material-symbols-outlined text-base">radio_button_unchecked</span>
<span>Mengandung huruf besar (A-Z)</span>
</div>
<div class="flex items-center gap-space-xxs" id="ruleNumber">
<span class="material-symbols-outlined text-base">radio_button_unchecked</span>
<span>Mengandung angka koordinat (0-9)</span>
</div>
<div class="flex items-center gap-space-xxs" id="ruleMatch">
<span class="material-symbols-outlined text-base">radio_button_unchecked</span>
<span>Konfirmasi sandi cocok identik</span>
</div>
</div>
</div>
<!-- Notification Toast for Password Save -->
<div class="hidden p-space-md bg-secondary-fixed text-on-secondary-fixed rounded flex items-center gap-space-sm" id="passwordSuccessNotice">
<span class="material-symbols-outlined text-xl">verified_user</span>
<span class="font-body-sm text-body-sm font-semibold">Kata sandi berhasil diperbarui! Sesi login Anda telah diamankan kembali.</span>
</div>
<div class="hidden p-space-md bg-error-container text-on-error-container rounded flex items-center gap-space-sm" id="passwordErrorNotice">
<span class="material-symbols-outlined text-xl">error</span>
<span class="font-body-sm text-body-sm font-semibold">Konfirmasi kata sandi tidak cocok. Mohon periksa kembali input Anda.</span>
</div>
<!-- Submit Buttons -->
<div class="flex flex-wrap items-center justify-end gap-space-sm pt-space-xs">
<button class="font-label-md text-label-md uppercase tracking-wider bg-primary-container text-on-primary-container px-space-xl py-space-sm rounded hover:bg-primary transition-colors flex items-center gap-space-xs shadow" type="submit">
<span class="material-symbols-outlined text-base">lock_reset</span>
                  Perbarui Kata Sandi
                </button>
</div>
</form>
<!-- 2-Factor Authentication Status Card -->
<div class="bg-surface-container-low p-space-md rounded-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-md mt-space-sm">
<div class="flex items-center gap-space-sm">
<div class="w-10 h-10 rounded bg-surface-container-high flex items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-xl">phonelink_lock</span>
</div>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold block">Autentikasi Dua Langkah (2FA)</span>
<span class="font-body-sm text-body-sm text-outline block">Kirim kode konfirmasi SMS/Authenticator saat checkout pack ekspedisi</span>
</div>
</div>
<button class="font-label-sm text-label-sm uppercase tracking-wider bg-surface-container text-on-surface px-space-md py-space-xs rounded hover:bg-primary hover:text-on-primary transition-colors font-bold" onclick="alert('Mengaktifkan autentikasi 2 langkah via nomor ponsel...');">
                Aktifkan 2FA
              </button>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Log Out Confirmation Modal Dialog (Client-side interactive) -->
<div class="fixed inset-0 z-50 bg-inverse-surface/60 backdrop-blur-sm hidden items-center justify-center p-space-md" id="logoutModal">
<div class="bg-surface-container-lowest max-w-md w-full p-space-xl rounded-xl shadow-2xl flex flex-col gap-space-md transform transition-all">
<div class="w-12 h-12 rounded-full bg-error-container text-on-error-container flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">logout</span>
</div>
<div class="flex flex-col gap-space-xxs">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-outline">TERMINAL EXIT CONFIRMATION</span>
<h3 class="font-headline-md text-headline-md uppercase text-on-surface tracking-tight">Keluar Dari Akun Explorer?</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Anda akan keluar dari sesi login Dragon North Division. Semua sinkronisasi rute aktif pada browser ini akan diputus sementara sampai Anda login kembali.</p>
</div>
<div class="flex items-center justify-end gap-space-sm pt-space-xs">
<button class="font-label-md text-label-md uppercase tracking-wider bg-surface-container text-on-surface px-space-lg py-space-sm rounded hover:bg-surface-container-high transition-colors" id="cancelLogoutBtn">
          Batal &amp; Tetap Di Sini
        </button>
<button class="font-label-md text-label-md uppercase tracking-wider bg-primary text-on-primary px-space-lg py-space-sm rounded hover:bg-primary-container transition-colors font-bold shadow" onclick="window.location.href='?page=home&amp;do=logout'">
          Ya, Keluar Akun
        </button>
</div>
</div>
</div>
<script>
    // Tab Switching Functionality
    function switchTab(tabName) {
      const paneOrders = document.getElementById('paneOrders');
      const paneProfile = document.getElementById('paneProfile');
      const paneSecurity = document.getElementById('paneSecurity');

      const btnOrders = document.getElementById('tabBtnOrders');
      const btnProfile = document.getElementById('tabBtnProfile');
      const btnSecurity = document.getElementById('tabBtnSecurity');

      // Hide all panes
      paneOrders.classList.add('hidden');
      paneProfile.classList.add('hidden');
      paneSecurity.classList.add('hidden');

      // Reset button classes
      [btnOrders, btnProfile, btnSecurity].forEach(btn => {
        btn.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm', 'font-bold');
        btn.classList.add('text-on-surface', 'hover:bg-surface-container-high', 'font-medium');
      });

      if (tabName === 'orders') {
        paneOrders.classList.remove('hidden');
        btnOrders.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm', 'font-bold');
        btnOrders.classList.remove('text-on-surface', 'hover:bg-surface-container-high', 'font-medium');
      } else if (tabName === 'profile') {
        paneProfile.classList.remove('hidden');
        btnProfile.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm', 'font-bold');
        btnProfile.classList.remove('text-on-surface', 'hover:bg-surface-container-high', 'font-medium');
      } else if (tabName === 'security') {
        paneSecurity.classList.remove('hidden');
        btnSecurity.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm', 'font-bold');
        btnSecurity.classList.remove('text-on-surface', 'hover:bg-surface-container-high', 'font-medium');
      }
    }

    // Toggle Password View Icon
    function togglePasswordVisibility(fieldId, triggerBtn) {
      const field = document.getElementById(fieldId);
      const icon = triggerBtn.querySelector('.material-symbols-outlined');
      if (field.type === 'password') {
        field.type = 'text';
        icon.textContent = 'visibility_off';
      } else {
        field.type = 'password';
        icon.textContent = 'visibility';
      }
    }

    // Password Validation Check
    function checkPasswordStrength(val) {
      const ruleLength = document.getElementById('ruleLength');
      const ruleUpper = document.getElementById('ruleUpper');
      const ruleNumber = document.getElementById('ruleNumber');

      // Check Length
      if (val.length >= 8) {
        ruleLength.classList.remove('text-outline');
        ruleLength.classList.add('text-primary', 'font-bold');
        ruleLength.querySelector('.material-symbols-outlined').textContent = 'check_circle';
      } else {
        ruleLength.classList.add('text-outline');
        ruleLength.classList.remove('text-primary', 'font-bold');
        ruleLength.querySelector('.material-symbols-outlined').textContent = 'radio_button_unchecked';
      }

      // Check Uppercase
      if (/[A-Z]/.test(val)) {
        ruleUpper.classList.remove('text-outline');
        ruleUpper.classList.add('text-primary', 'font-bold');
        ruleUpper.querySelector('.material-symbols-outlined').textContent = 'check_circle';
      } else {
        ruleUpper.classList.add('text-outline');
        ruleUpper.classList.remove('text-primary', 'font-bold');
        ruleUpper.querySelector('.material-symbols-outlined').textContent = 'radio_button_unchecked';
      }

      // Check Number
      if (/[0-9]/.test(val)) {
        ruleNumber.classList.remove('text-outline');
        ruleNumber.classList.add('text-primary', 'font-bold');
        ruleNumber.querySelector('.material-symbols-outlined').textContent = 'check_circle';
      } else {
        ruleNumber.classList.add('text-outline');
        ruleNumber.classList.remove('text-primary', 'font-bold');
        ruleNumber.querySelector('.material-symbols-outlined').textContent = 'radio_button_unchecked';
      }
    }

    // Profile Edit Submit Handler (Ganti Nama)
    function handleProfileSubmit(e) {
      e.preventDefault();
      const newName = document.getElementById('fullNameInput').value;
      const callSign = document.getElementById('callSignInput').value;
      
      // Update display name on top header
      if (newName.trim()) {
        document.getElementById('explorerDisplayName').textContent = newName.trim();
      }

      const notice = document.getElementById('profileSuccessNotice');
      notice.classList.remove('hidden');
      setTimeout(() => {
        notice.classList.add('hidden');
      }, 5000);
    }

    // Password Change Submit Handler (Ganti Password)
    function handlePasswordSubmit(e) {
      e.preventDefault();
      const newPass = document.getElementById('newPassword').value;
      const confirmPass = document.getElementById('confirmPassword').value;
      const successNotice = document.getElementById('passwordSuccessNotice');
      const errorNotice = document.getElementById('passwordErrorNotice');
      const ruleMatch = document.getElementById('ruleMatch');

      if (newPass !== confirmPass) {
        errorNotice.classList.remove('hidden');
        successNotice.classList.add('hidden');
        ruleMatch.classList.add('text-outline');
        ruleMatch.classList.remove('text-primary', 'font-bold');
        ruleMatch.querySelector('.material-symbols-outlined').textContent = 'radio_button_unchecked';
        return;
      }

      // If matched
      ruleMatch.classList.remove('text-outline');
      ruleMatch.classList.add('text-primary', 'font-bold');
      ruleMatch.querySelector('.material-symbols-outlined').textContent = 'check_circle';

      errorNotice.classList.add('hidden');
      successNotice.classList.remove('hidden');
      document.getElementById('passwordForm').reset();
      setTimeout(() => {
        successNotice.classList.add('hidden');
      }, 5000);
    }

    </script>
</div>
</main>