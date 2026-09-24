<?php
// AMBIL ID ORDER DARI URL (Contoh: ?page=order_success&id=6)
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$order_id) {
    header("Location: ?page=home");
    exit;
}

// 1. AMBIL DATA ORDER UTAMA DARI DATABASE
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<div class='text-center py-20 font-label-md text-error'>ERROR: DATA ORDER TIDAK DITEMUKAN.</div>";
    exit;
}

// 2. AMBIL DATA BARANG YANG DIBELI (JOIN DENGAN TABEL PRODUCTS)
$stmt_items = $pdo->prepare("
    SELECT oi.*, p.name, p.material 
    FROM order_items oi 
    JOIN products p ON oi.product_id = p.id 
    WHERE oi.order_id = ?
");
$stmt_items->execute([$order_id]);
$items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

// Format ID Order ala DND (Contoh: #DND-EXP-00006)
$formatted_order_id = "#DND-EXP-" . str_pad($order['id'], 5, '0', STR_PAD_LEFT);

// Fallback function rupiah jika belum didefinisikan di file lain
if (!function_exists('rupiah')) {
    function rupiah($angka){
        return "Rp " . number_format($angka,0,',','.');
    }
}
?>

<!-- Tambahan CSS untuk Background Grid Kertas Koordinat -->
<style>
    .bg-tactical-grid {
        background-color: #faf9f6; /* Warna kertas usang/krem terang */
        background-image: 
            linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
        background-size: 24px 24px;
    }
    .corner-cross::before, .corner-cross::after {
        content: '+';
        position: absolute;
        font-family: monospace;
        color: #9ca3af;
        font-size: 10px;
    }
    .corner-tl::before { top: 4px; left: 8px; }
    .corner-tr::after { top: 4px; right: 8px; }
    .corner-bl::before { bottom: 4px; left: 8px; }
    .corner-br::after { bottom: 4px; right: 8px; }
</style>

<section class="w-full min-h-screen bg-tactical-grid py-space-xl px-margin-mobile md:px-margin-desktop font-sans text-on-surface">
    <div class="max-w-3xl mx-auto flex flex-col gap-space-md mt-16">

        <!-- Top Header & Stepper -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-4 border-b border-outline-variant/30 pb-4">
            <div class="flex items-center gap-space-sm font-mono text-xs text-outline-variant uppercase tracking-widest">
                <div class="flex items-center gap-2 line-through">
                    <span class="bg-surface-container-highest text-on-surface rounded-full w-5 h-5 flex items-center justify-center">1</span>
                    <span>Manifest</span>
                </div>
                <span>——</span>
                <div class="flex items-center gap-2 line-through">
                    <span class="bg-surface-container-highest text-on-surface rounded-full w-5 h-5 flex items-center justify-center">2</span>
                    <span>Transit</span>
                </div>
                <span>——</span>
                <div class="flex items-center gap-2 text-error font-bold bg-white px-3 py-1 rounded shadow-sm border border-outline-variant/30">
                    <span class="bg-error text-white rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    <span>Final Summit</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center font-mono text-xs uppercase tracking-widest text-outline mb-2">
            <span>Coordinate 46°30' N</span>
            <span class="text-error font-bold flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-error animate-pulse"></span> Dispatch Confirmed
            </span>
        </div>

        <!-- MAIN CARD 1: STATUS -->
        <div class="bg-white border border-[#e5e5e5] rounded-lg p-space-lg shadow-sm relative corner-cross corner-tl corner-tr corner-bl corner-br text-center flex flex-col items-center gap-space-md mt-4">
            <!-- Icon Success -->
            <div class="w-16 h-16 rounded-full border-2 border-[#b04a3e] text-[#b04a3e] flex items-center justify-center mb-2 bg-[#fdf2f0]">
                <span class="material-symbols-outlined text-3xl">check</span>
            </div>
            
            <div class="bg-[#2a2a2a] text-white font-mono text-xs uppercase tracking-widest px-6 py-2 w-full max-w-md mx-auto rounded shadow-inner">
                Pembayaran Berhasil • Order Dispatched
            </div>

            <div>
                <h1 class="font-headline-lg text-3xl font-bold uppercase tracking-tight text-on-surface mt-2">Final Summit Reached</h1>
                <p class="font-body-md text-on-surface-variant max-w-md mx-auto mt-2">
                    Perlengkapan ekspedisi Anda telah diverifikasi oleh Basecamp DND dan segera dipersiapkan untuk pengiriman rute pegunungan.
                </p>
            </div>

            <div class="w-full border-t border-dashed border-outline-variant/50 mt-4 pt-6 flex justify-between items-center text-left">
                <div>
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Order Identifier</span>
                    <span class="font-mono text-sm font-bold text-on-surface"><?= $formatted_order_id ?></span>
                </div>
                <div class="text-right">
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Security Clearance</span>
                    <span class="font-mono text-xs font-bold text-[#059669] flex items-center justify-end gap-1">
                        <span class="material-symbols-outlined text-sm">lock</span> 256-Bit Vault Paid
                    </span>
                </div>
            </div>
        </div>

        <!-- MAIN CARD 2: LOADOUT MANIFEST -->
        <div class="bg-white border border-[#e5e5e5] rounded-lg p-space-lg shadow-sm mt-4">
            <div class="flex justify-between items-center border-b border-outline-variant/30 pb-4 mb-4">
                <div class="flex items-center gap-2 font-mono text-sm font-bold uppercase tracking-widest">
                    <span class="material-symbols-outlined text-error">work</span>
                    Loadout Manifest
                </div>
                <span class="bg-[#e5e2db] text-[#5a5753] font-mono text-[10px] uppercase tracking-widest px-2 py-1 rounded">
                    <?= count($items) ?> Items Deployed
                </span>
            </div>

            <div class="flex flex-col gap-4">
                <!-- Looping Data Barang dari Database -->
                <?php foreach ($items as $item): ?>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-on-surface"><?= (int)$item['qty'] ?>x <?= htmlspecialchars($item['name']) ?></h3>
                        <p class="text-xs text-outline-variant mt-1"><?= htmlspecialchars($item['material'] ?? 'Tactical Series') ?></p>
                    </div>
                    <div class="font-mono font-bold text-sm">
                        <?= rupiah($item['price'] * $item['qty']) ?>
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- Bonus Item -->
                <div class="flex justify-between items-start border-t border-dashed border-outline-variant/30 pt-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-on-surface">1x Expedition Rain Cover</h3>
                            <span class="bg-[#b04a3e] text-white text-[9px] uppercase px-1.5 py-0.5 rounded font-mono tracking-wider">Free Bonus</span>
                        </div>
                        <p class="text-xs text-outline-variant mt-1">Complimentary 45L+ Heavy-Duty Waterproof Shield</p>
                    </div>
                    <div class="font-mono font-bold text-[#059669]">
                        Rp 0
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-outline-variant/30 font-mono text-xs flex flex-col gap-3">
                <div class="flex justify-between items-center">
                    <span class="text-outline-variant uppercase">Routing & Tactical Freight</span>
                    <span class="font-bold text-on-surface uppercase">Free Dispatch</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-outline-variant uppercase">Settlement Method</span>
                    <span class="text-on-surface uppercase"><?= htmlspecialchars($order['payment_method'] ?? 'Bank Transfer (Verified)') ?></span>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t-2 border-[#e5e5e5] flex justify-between items-end">
                <div>
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Total Capital Paid</span>
                    <span class="font-mono text-2xl font-bold text-on-surface"><?= rupiah($order['total'] ?? 0) ?></span>
                </div>
                <div class="border border-[#059669] text-[#059669] bg-[#ecfdf5] font-mono text-xs uppercase font-bold tracking-widest px-3 py-1 rounded">
                    Lunas / Completed
                </div>
            </div>
        </div>

        <!-- MAIN CARD 3: EXPEDITION DELIVERY COORDINATES -->
        <div class="bg-white border border-[#e5e5e5] rounded-lg p-space-lg shadow-sm mt-4">
            <div class="flex items-center gap-2 font-mono text-sm font-bold uppercase tracking-widest border-b border-outline-variant/30 pb-4 mb-6">
                <span class="material-symbols-outlined text-error">location_on</span>
                Expedition Delivery Coordinates
            </div>

            <div class="flex flex-col gap-4">
                <div class="border border-[#e5e5e5] rounded p-3 bg-[#faf9f6]">
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Explorer Full Name</span>
                    <span class="font-mono font-bold text-sm uppercase"><?= htmlspecialchars($order['recipient_name'] ?? $order['nama_penerima'] ?? 'N/A') ?></span>
                </div>
                <div class="border border-[#e5e5e5] rounded p-3 bg-[#faf9f6]">
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Field Comms (WhatsApp Connected)</span>
                    <span class="font-mono font-bold text-sm uppercase"><?= htmlspecialchars($order['recipient_phone'] ?? $order['phone'] ?? 'N/A') ?></span>
                </div>
                <div class="border border-[#e5e5e5] rounded p-3 bg-[#faf9f6]">
                    <span class="block font-mono text-[10px] text-outline uppercase tracking-widest mb-1">Basecamp / Street Coordinates</span>
                    <span class="font-mono font-bold text-sm uppercase"><?= nl2br(htmlspecialchars($order['recipient_address'] ?? $order['address'] ?? 'N/A')) ?></span>
                </div>
            </div>
        </div>

        <!-- FOOTER ACTIONS & NOTES -->
        <div class="border-l-4 border-[#b04a3e] bg-[#f5ebe9] p-4 mt-6">
            <h4 class="font-mono font-bold text-sm uppercase tracking-widest mb-1">Field Operative Note:</h4>
            <p class="text-sm text-on-surface-variant leading-relaxed">
                Nomor resi logistik akan ditransmisikan via WhatsApp ke <strong class="font-mono"><?= htmlspecialchars($order['recipient_phone'] ?? $order['phone'] ?? '') ?></strong> dalam 1x24 jam operasional tim pangkalan Dragon North Division.
            </p>
        </div>

        <div class="flex flex-col gap-3 mt-4">
            <!-- 1. TOMBOL LACAK STATUS EKSPEDISI (SUDAH DIUBAH MENJADI LINK / TAG A) -->
            <a href="?page=my_orders" class="w-full bg-[#b04a3e] hover:bg-[#8e392f] text-white font-mono font-bold uppercase tracking-widest py-4 rounded shadow transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">bolt</span> Lacak Status Ekspedisi
            </a>
            
            <!-- 2. Tombol Download PDF -->
            <button class="w-full bg-[#e5e2db] hover:bg-[#d5d1c8] text-[#5a5753] font-mono font-bold uppercase tracking-widest py-4 rounded shadow-sm transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">download</span> Download Dispatch Manifest (PDF)
            </button>
        </div>

        <div class="text-center mt-6 mb-10">
            <a href="?page=home" class="inline-block font-mono text-xs text-outline-variant hover:text-on-surface uppercase tracking-widest border-b border-outline-variant hover:border-on-surface pb-1 transition-colors">
                &larr; Kembali ke Beranda (Home Base)
            </a>
        </div>

    </div>
</section>

<!-- Footer Bawah Kecil -->
<footer class="w-full bg-[#eae7df] py-6 text-center font-mono text-[9px] text-[#88857f] uppercase tracking-widest border-t border-[#d8d4cb]">
    Dragon North Division • Tactical Outdoor Loadouts<br>
    Standard Ridgeline Field Terms & Codes Apply
</footer>