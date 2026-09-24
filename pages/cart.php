<?php
// --- LOGIKA UNTUK MENGHAPUS ITEM (Baru Ditambahkan) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengecek apakah ada request penghapusan item
    if (isset($_POST['remove_item_id'])) {
        $remove_id = (int)$_POST['remove_item_id'];
        
        // CARA 1: Jika sistem keranjangmu menggunakan $_SESSION
        if (isset($_SESSION['cart'][$remove_id])) {
            unset($_SESSION['cart'][$remove_id]);
        }
        
        // CARA 2: Jika sistem keranjangmu menggunakan Database MySQL (tabel cart)
        // Silakan uncomment/hapus tanda // di bawah ini dan sesuaikan dengan nama fungsimu:
        // remove_cart_item($pdo, $remove_id); 
        
        // Redirect ulang ke halaman cart agar data ter-refresh
        header("Location: ?page=cart");
        exit;
    }
}
// --------------------------------------------------------

$items = cart_items($pdo);
$total = cart_total($pdo);
?>
<!-- Top Technical Breadcrumbs & Altitude Gauge -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-sm bg-surface-container-low/60 mt-20">
<div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-space-xs text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<div class="flex items-center gap-space-xs flex-wrap">
<a class="hover:text-primary transition-colors" data-path="home" href="?page=home">Home</a>
<span class="text-outline-variant">/</span>
<span class="text-on-surface font-semibold">Loadout Manifest</span>
</div>
</div>
</section>

<section class="w-full px-margin-mobile md:px-margin-desktop py-space-xl md:py-space-2xl bg-surface">
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-2xl gap-space-md">
        <div>
            <div class="flex items-center gap-space-xs text-outline font-label-sm text-label-sm uppercase mb-space-xs">
                <span>COORDINATE 46°30' N</span>
                <span>/</span>
                <span class="text-primary font-bold">SECURE PACK DISPATCH</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight uppercase">Equipment Loadout</h1>
        </div>
        <!-- Topographic Step Indicators -->
        <div class="flex items-center gap-space-sm bg-surface-container-low px-space-md py-space-xs rounded-lg shadow-sm">
            <div class="flex items-center gap-space-xs text-primary font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-primary text-on-primary flex items-center justify-center text-xs">1</span>
                <span>Manifest</span>
            </div>
            <span class="text-outline-variant">———</span>
            <div class="flex items-center gap-space-xs text-on-surface-variant font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-surface-container-highest flex items-center justify-center text-xs">2</span>
                <span>Transit</span>
            </div>
            <span class="text-outline-variant">———</span>
            <div class="flex items-center gap-space-xs text-outline font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-surface-container flex items-center justify-center text-xs">3</span>
                <span>Final Summit</span>
            </div>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <div class="bg-surface-container-low p-space-2xl rounded-xl shadow-sm flex flex-col items-center justify-center text-center gap-space-md">
            <span class="material-symbols-outlined text-5xl text-outline">shopping_bag</span>
            <h2 class="font-headline-md text-headline-md uppercase text-on-surface">Your Manifest is Empty</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-md">Start exploring our premium bag collection and prepare your gear for the next summit.</p>
            <a href="?page=products" class="bg-primary text-on-primary hover:bg-primary/90 py-space-sm px-space-lg rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-colors mt-space-sm">
                View Collection
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-2xl items-start">
            <div class="lg:col-span-7 flex flex-col gap-space-2xl">
                <!-- Cart Manifest Section -->
                <div class="bg-surface-container-low p-space-lg rounded-xl shadow-sm flex flex-col gap-space-lg">
                    <div class="flex items-center justify-between pb-space-xs">
                        <div class="flex items-center gap-space-xs">
                            <span class="material-symbols-outlined text-primary">backpack</span>
                            <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface">Equipment Manifest</h2>
                        </div>
                        <span class="font-label-sm text-label-sm text-outline uppercase"><?= count($items) ?> Unique Units</span>
                    </div>

                    <!-- Perbaikan di bagian Action Form -->
                    <form method="POST" action="?page=cart" id="cartForm">
                        <input type="hidden" name="do" value="update_cart">
                        <div class="flex flex-col gap-space-md">
                            <?php foreach ($items as $item): $p = $item['product']; ?>
                                <div class="bg-surface p-space-md rounded-lg shadow-sm flex flex-col sm:flex-row gap-space-md items-start sm:items-center justify-between">
                                    <div class="flex items-center gap-space-md">
                                        <div class="w-20 h-24 bg-surface-container-high rounded-DEFAULT overflow-hidden flex-shrink-0 shadow-inner">
                                            <a href="?page=product&id=<?= (int)$p['id'] ?>">
                                                <img class="w-full h-full object-cover" src="<?= e(product_image_url($p['image'])) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                                            </a>
                                        </div>
                                        <div class="flex flex-col gap-space-xxs">
                                            <span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">SKU: DND-<?= $p['id'] ?></span>
                                            <h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">
                                                <a href="?page=product&id=<?= (int)$p['id'] ?>" class="hover:text-primary transition-colors"><?= htmlspecialchars($p['name']) ?></a>
                                            </h3>
                                            <div class="flex items-center gap-space-xs text-on-surface-variant font-body-sm text-body-sm mt-1">
                                                <span class="bg-surface-container-high text-on-surface px-space-xs py-0.5 rounded-DEFAULT font-label-sm text-label-sm uppercase"><?= htmlspecialchars($p['material']) ?></span>
                                                <span>•</span>
                                                <span><?= htmlspecialchars($p['capacity_liters'] ?? 'N/A') ?></span>
                                            </div>
                                            <div class="flex items-center gap-space-sm mt-space-xs">
                                                <div class="flex items-center bg-surface-container-low rounded-DEFAULT px-space-xs py-0.5">
                                                    <input type="number" name="qty[<?= (int)$p['id'] ?>]" value="<?= (int)$item['qty'] ?>" min="0" max="<?= (int)($p['stock'] ?? 99) ?>" class="w-12 bg-transparent text-center font-label-md text-label-md text-on-surface focus:outline-none" onchange="document.getElementById('cartForm').submit()">
                                                </div>
                                                <!-- Perbaikan Tombol Remove di sini -->
                                                <button type="submit" name="remove_item_id" value="<?= (int)$p['id'] ?>" class="font-label-sm text-label-sm uppercase text-outline hover:text-error transition-colors flex items-center gap-0.5" formnovalidate>
                                                    <span class="material-symbols-outlined text-sm">delete</span> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right sm:self-center flex sm:flex-col justify-between w-full sm:w-auto items-baseline">
                                        <span class="font-headline-sm text-headline-sm text-on-surface"><?= rupiah($item['subtotal']) ?></span>
                                        <span class="font-label-sm text-label-sm text-outline uppercase"><?= rupiah($p['price']) ?> / ea</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-space-md flex justify-end">
                            <button type="submit" class="bg-surface-container-high hover:bg-surface-container-highest text-on-surface py-space-sm px-space-md rounded-DEFAULT font-label-md text-label-md uppercase transition-colors">
                                Update Manifest
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Ledger -->
            <div class="lg:col-span-5 flex flex-col gap-space-lg sticky top-28">
                <div class="bg-surface-container p-space-lg rounded-xl shadow-md flex flex-col gap-space-lg">
                    <div class="flex items-center justify-between pb-space-xs">
                        <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface tracking-tight">Expedition Ledger</h2>
                        <span class="bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm uppercase px-space-xs py-0.5 rounded-DEFAULT"><?= count($items) ?> ITEMS READY</span>
                    </div>
                    
                    <div class="flex flex-col gap-space-sm font-body-md text-body-md text-on-surface-variant">
                        <div class="flex justify-between items-center">
                            <span>Manifest Subtotal</span>
                            <span class="font-headline-sm text-headline-sm text-on-surface"><?= rupiah($total) ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1">
                                Routing & Freight
                                <span class="material-symbols-outlined text-sm text-outline">info</span>
                            </span>
                            <span class="font-label-md text-label-md uppercase font-bold text-primary">Calculated Next</span>
                        </div>
                    </div>
                    
                    <div class="h-px bg-outline-variant opacity-30 my-space-xxs"></div>
                    
                    <div class="flex justify-between items-end">
                        <div class="flex flex-col">
                            <span class="font-label-sm text-label-sm uppercase text-outline tracking-wider">Estimated Total</span>
                            <span class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface tracking-tight"><?= rupiah($total) ?></span>
                        </div>
                        <div class="text-right">
                            <span class="font-label-sm text-label-sm text-outline uppercase block">IDR Currency</span>
                        </div>
                    </div>

                    <?php if (is_logged_in()): ?>
                        <a href="?page=checkout" class="w-full bg-primary-container text-on-primary-container hover:bg-primary py-space-md px-space-lg rounded-DEFAULT font-label-lg text-label-lg uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-space-sm group">
                            <span>Proceed to Transit</span>
                            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    <?php else: ?>
                        <div class="flex flex-col gap-space-xs">
                            <p class="font-label-sm text-label-sm text-center text-outline uppercase">Authentication required for dispatch.</p>
                            <a href="?page=login" class="w-full bg-primary-container text-on-primary-container hover:bg-primary py-space-md px-space-lg rounded-DEFAULT font-label-lg text-label-lg uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-space-sm group">
                                <span>Sign In & Checkout</span>
                                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">login</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</section>