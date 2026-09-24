<?php
require_login('login');
$items = cart_items($pdo);
$total = cart_total($pdo);
if (empty($items)) { header('Location: ?page=cart'); exit; }

// Ambil data user
$user_id = current_user_id();
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$me = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA DATA USER TIDAK ADA DI DATABASE (Sesi Nyangkut) -> Hapus Sesi & Tendang ke Login
if (!$me) {
    $_SESSION = [];
    session_destroy();
    header('Location: ?page=login');
    exit;
}
?>
<!-- Top Technical Breadcrumbs & Altitude Gauge -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-sm bg-surface-container-low/60 mt-20">
<div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-space-xs text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<div class="flex items-center gap-space-xs flex-wrap">
<a class="hover:text-primary transition-colors" data-path="home" href="?page=home">Home</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" data-path="cart" href="?page=cart">Loadout</a>
<span class="text-outline-variant">/</span>
<span class="text-on-surface font-semibold">Checkout</span>
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
                <span class="text-primary font-bold">FINAL PREP</span>
            </div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight uppercase">Order Checkout</h1>
        </div>
        <!-- Topographic Step Indicators -->
        <div class="flex items-center gap-space-sm bg-surface-container-low px-space-md py-space-xs rounded-lg shadow-sm">
            <div class="flex items-center gap-space-xs text-on-surface font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-surface-container-highest flex items-center justify-center text-xs">1</span>
                <span>Manifest</span>
            </div>
            <span class="text-outline-variant">———</span>
            <div class="flex items-center gap-space-xs text-primary font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-primary text-on-primary flex items-center justify-center text-xs">2</span>
                <span>Transit</span>
            </div>
            <span class="text-outline-variant">———</span>
            <div class="flex items-center gap-space-xs text-outline font-label-md text-label-md uppercase">
                <span class="w-5 h-5 rounded-full bg-surface-container flex items-center justify-center text-xs">3</span>
                <span>Final Summit</span>
            </div>
        </div>
    </div>

    <form method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-space-2xl items-start" id="checkoutForm">
        <input type="hidden" name="do" value="checkout">
        
        <div class="lg:col-span-7 flex flex-col gap-space-2xl">
            <!-- Shipping & Delivery Address Form -->
            <div class="bg-surface-container-low p-space-lg rounded-xl shadow-sm flex flex-col gap-space-lg">
                <div class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-primary">location_on</span>
                    <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface">Expedition Delivery Coordinates</h2>
                </div>
                
                <div class="flex flex-col gap-space-md">
                    <div class="flex flex-col gap-space-xxs">
                        <label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">Explorer Full Name *</label>
                        <input name="recipient_name" class="bg-surface px-space-md py-space-sm rounded-DEFAULT text-on-surface font-body-md text-body-md focus:outline-none focus:ring-1 focus:ring-primary shadow-sm" type="text" value="<?= htmlspecialchars($me['name'] ?? '') ?>" required>
                    </div>
                    
                    <div class="flex flex-col gap-space-xxs">
                        <label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">Field Comms (WhatsApp Number) *</label>
                        <input name="recipient_phone" class="bg-surface px-space-md py-space-sm rounded-DEFAULT text-on-surface font-body-md text-body-md focus:outline-none focus:ring-1 focus:ring-primary shadow-sm" type="tel" value="<?= htmlspecialchars($me['phone'] ?? '') ?>" placeholder="e.g. +62 8xx-xxxx-xxxx" required>
                    </div>
                    
                    <div class="flex flex-col gap-space-xxs">
                        <label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">Basecamp / Full Street Address *</label>
                        <textarea name="recipient_address" rows="3" class="bg-surface px-space-md py-space-sm rounded-DEFAULT text-on-surface font-body-md text-body-md focus:outline-none focus:ring-1 focus:ring-primary shadow-sm" placeholder="Street name, house number, district, city, postal code" required><?= htmlspecialchars($me['address'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Payment Methodology -->
            <div class="bg-surface-container-low p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-primary">credit_card</span>
                        <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface">Encrypted Settlement</h2>
                    </div>
                    <div class="flex items-center gap-space-xs text-outline font-label-sm text-label-sm uppercase">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        <span>256-Bit Vault</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
                    <!-- Bank Transfer -->
                    <label class="relative flex flex-col p-space-md rounded-lg bg-surface cursor-pointer shadow-sm hover:shadow transition-all group payment-option-label" onclick="selectPayment('transfer')">
                        <div class="flex items-center justify-between mb-space-xs">
                            <div class="flex items-center gap-space-xs">
                                <span class="w-4 h-4 rounded-full bg-primary flex items-center justify-center" id="radio-transfer">
                                    <span class="w-1.5 h-1.5 rounded-full bg-on-primary"></span>
                                </span>
                                <span class="font-headline-sm text-headline-sm uppercase text-on-surface">Bank Transfer</span>
                            </div>
                            <span class="material-symbols-outlined text-outline">account_balance</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">After your order is placed, you'll be redirected to WhatsApp to send proof of payment.</p>
                        <input type="radio" name="payment_method" value="transfer" class="hidden" checked>
                    </label>

                    <!-- COD -->
                    <label class="relative flex flex-col p-space-md rounded-lg bg-surface cursor-pointer shadow-sm hover:shadow transition-all group payment-option-label" onclick="selectPayment('cod')">
                        <div class="flex items-center justify-between mb-space-xs">
                            <div class="flex items-center gap-space-xs">
                                <span class="w-4 h-4 rounded-full bg-surface-container-highest flex items-center justify-center" id="radio-cod">
                                    <span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>
                                </span>
                                <span class="font-headline-sm text-headline-sm uppercase text-on-surface">Cash on Delivery</span>
                            </div>
                            <span class="material-symbols-outlined text-outline">payments</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Pay in cash when the item arrives at your designated basecamp address.</p>
                        <input type="radio" name="payment_method" value="cod" class="hidden">
                    </label>
                </div>
            </div>
            
            <!-- Trust & Assurance Field Badges -->
            <div class="bg-surface-container-low p-space-md rounded-xl shadow-sm grid grid-cols-2 gap-space-md">
                <div class="flex items-start gap-space-xs">
                    <span class="material-symbols-outlined text-primary text-xl">verified_user</span>
                    <div class="flex flex-col">
                        <span class="font-label-sm text-label-sm uppercase text-on-surface font-bold">256-Bit SSL</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Bank-grade vaulting</span>
                    </div>
                </div>
                <div class="flex items-start gap-space-xs">
                    <span class="material-symbols-outlined text-primary text-xl">published_with_changes</span>
                    <div class="flex flex-col">
                        <span class="font-label-sm text-label-sm uppercase text-on-surface font-bold">45-Day Trail Test</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Try on actual terrain</span>
                    </div>
                </div>
                <div class="flex items-start gap-space-xs">
                    <span class="material-symbols-outlined text-primary text-xl">keyboard_return</span>
                    <div class="flex flex-col">
                        <span class="font-label-sm text-label-sm uppercase text-on-surface font-bold">Free Returns</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Pre-printed labels</span>
                    </div>
                </div>
                <div class="flex items-start gap-space-xs">
                    <span class="material-symbols-outlined text-primary text-xl">shield</span>
                    <div class="flex flex-col">
                        <span class="font-label-sm text-label-sm uppercase text-on-surface font-bold">Lifetime Repair</span>
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Archival warranty</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column: Ledger -->
        <div class="lg:col-span-5 flex flex-col gap-space-lg sticky top-28">
            <div class="bg-surface-container p-space-lg rounded-xl shadow-md flex flex-col gap-space-lg">
                <div class="flex items-center justify-between pb-space-xs border-b border-outline-variant/30">
                    <h2 class="font-headline-sm text-headline-sm uppercase text-on-surface tracking-tight">Order Summary</h2>
                    <span class="bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm uppercase px-space-xs py-0.5 rounded-DEFAULT"><?= count($items) ?> ITEMS</span>
                </div>
                
                <div class="flex flex-col gap-space-md">
                    <?php foreach ($items as $item): $p = $item['product']; ?>
                    <div class="flex items-center justify-between gap-space-sm text-body-md font-body-md">
                        <div class="flex items-center gap-space-sm">
                            <span class="font-bold text-on-surface"><?= (int)$item['qty'] ?>x</span>
                            <span class="text-on-surface-variant"><?= htmlspecialchars($p['name']) ?></span>
                        </div>
                        <span class="font-mono text-on-surface font-bold"><?= rupiah($item['subtotal']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="h-px bg-outline-variant opacity-30 my-space-xxs"></div>
                
                <div class="flex flex-col gap-space-sm font-body-md text-body-md text-on-surface-variant">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center gap-1">
                            Routing & Freight
                            <span class="material-symbols-outlined text-sm text-outline">local_shipping</span>
                        </span>
                        <span class="font-label-md text-label-md uppercase font-bold text-primary">FREE</span>
                    </div>
                </div>
                
                <div class="flex justify-between items-end mt-space-xs">
                    <div class="flex flex-col">
                        <span class="font-label-sm text-label-sm uppercase text-outline tracking-wider">Total Capital Due</span>
                        <span class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface tracking-tight"><?= rupiah($total) ?></span>
                    </div>
                    <div class="text-right">
                        <span class="font-label-sm text-label-sm text-outline uppercase block">IDR Currency</span>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary-container text-on-primary-container hover:bg-primary py-space-md px-space-lg rounded-DEFAULT font-label-lg text-label-lg uppercase tracking-wider shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-space-sm group">
                    <span>Complete Expedition Order</span>
                    <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">check_circle</span>
                </button>
                <p class="font-label-sm text-label-sm text-center text-outline uppercase">
                    By issuing dispatch, you agree to DND Standard Ridgeline Field Terms & Conditions.
                </p>
            </div>
        </div>
    </form>
</div>
</section>

<script>
    function selectPayment(type) {
        const radioTransfer = document.getElementById('radio-transfer');
        const radioCod = document.getElementById('radio-cod');
        
        // Find the hidden radio inputs and check the right one
        const radios = document.querySelectorAll('input[name="payment_method"]');
        radios.forEach(r => {
            if (r.value === type) r.checked = true;
            else r.checked = false;
        });

        if (type === 'cod') {
            radioTransfer.className = 'w-4 h-4 rounded-full bg-surface-container-highest flex items-center justify-center';
            radioTransfer.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>';
            radioCod.className = 'w-4 h-4 rounded-full bg-primary flex items-center justify-center';
            radioCod.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-on-primary"></span>';
        } else {
            radioCod.className = 'w-4 h-4 rounded-full bg-surface-container-highest flex items-center justify-center';
            radioCod.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-transparent"></span>';
            radioTransfer.className = 'w-4 h-4 rounded-full bg-primary flex items-center justify-center';
            radioTransfer.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-on-primary"></span>';
        }
    }
</script>