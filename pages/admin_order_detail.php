<?php
require_admin();
$orderId = (int)($_GET['order'] ?? 0);
$stmt = $pdo->prepare("SELECT o.*, u.name AS customer_name, u.email AS customer_email FROM orders o JOIN users u ON u.id = o.user_id WHERE o.id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$order) { header('Location: ?page=admin_orders'); exit; }

$stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$orderId]);
$orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM order_status_log WHERE order_id = ? ORDER BY created_at ASC, id ASC");
$stmt->execute([$orderId]);
$statusLog = $stmt->fetchAll(PDO::FETCH_ASSOC);

$nextOptions = next_status_options($order['status']);
$custWaMsg = "Hello {$order['recipient_name']}, this is Dragon North Division with an update on your order {$order['order_code']}.";
?>
<div>
    <div class="mb-space-xl flex items-center justify-between flex-wrap gap-4">
        <div>
            <span class="font-label-md text-primary tracking-widest uppercase block mb-1">LOGISTICS</span>
            <h1 class="font-headline-lg text-on-surface tracking-tight">Order <span class="text-primary font-bold"><?php echo e($order['order_code']); ?></span></h1>
        </div>
        <a href="?page=admin_orders" class="px-4 py-2 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container-high transition-colors font-label-md uppercase tracking-wider flex items-center gap-2">
            <span class="material-symbols-outlined text-lg">arrow_back</span> Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Status & Timeline -->
        <div class="lg:col-span-7 flex flex-col gap-6">
            <!-- Current Status Update Card -->
            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30">
                <h3 class="font-headline-sm font-bold text-on-surface mb-4">Status Fulfillment</h3>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-surface-container-highest text-on-surface font-label-md uppercase tracking-wider font-bold mb-6">
                    <?php echo status_icon($order['status']); ?> <?php echo e(status_label($order['status'])); ?>
                </div>

                <?php if ($order['status'] !== 'selesai' && $order['status'] !== 'dibatalkan'): ?>
                <div class="pt-6 border-t border-outline-variant/30">
                    <h4 class="font-label-md uppercase tracking-widest text-on-surface-variant mb-4">Update Status</h4>
                    <form method="POST" class="flex flex-col gap-4">
                        <input type="hidden" name="do" value="admin_update_status">
                        <input type="hidden" name="order_id" value="<?php echo (int)$order['id']; ?>">
                        
                        <div class="flex flex-col gap-2">
                            <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">New Action / Status</label>
                            <select name="status" required class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md appearance-none">
                                <?php foreach ($nextOptions as $opt): ?>
                                <option value="<?php echo $opt; ?>"><?php echo status_icon($opt); ?> <?php echo status_label($opt); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Logistics Note (Optional)</label>
                            <textarea name="note" rows="3" placeholder="e.g. Package shipped via JNT, tracking # JP123456789" class="w-full p-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full py-3 mt-2 rounded-lg bg-primary hover:bg-primary/90 text-on-primary font-label-md uppercase tracking-widest font-bold shadow-md transition-all">
                            Submit Update
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>

            <!-- Timeline -->
            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30">
                <h3 class="font-headline-sm font-bold text-on-surface mb-6">Status Log</h3>
                <div class="relative border-l-2 border-outline-variant/40 ml-4 space-y-8">
                    <?php foreach ($statusLog as $log): ?>
                    <div class="relative pl-8">
                        <div class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-lg border-4 border-surface-container shadow-sm">
                            <?php echo status_icon($log['status']); ?>
                        </div>
                        <div>
                            <h4 class="font-label-md uppercase tracking-wider font-bold text-on-surface"><?php echo e(status_label($log['status'])); ?></h4>
                            <span class="block text-label-sm text-on-surface-variant mb-2"><?php echo e(date('d M Y, H:i', strtotime($log['created_at']))); ?> (GMT+7)</span>
                            <?php if ($log['note']): ?>
                            <p class="text-body-sm text-on-surface-variant bg-surface-container-lowest p-3 rounded-lg border border-outline-variant/30 inline-block"><?php echo e($log['note']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right Column: Info & Items -->
        <div class="lg:col-span-5 flex flex-col gap-6">
            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30">
                <h3 class="font-headline-sm font-bold text-on-surface mb-4">Customer Info</h3>
                <div class="space-y-4 text-body-sm text-on-surface">
                    <div>
                        <span class="block text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Name</span>
                        <div class="font-semibold"><?php echo e($order['customer_name']); ?></div>
                    </div>
                    <div>
                        <span class="block text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Email</span>
                        <div><?php echo e($order['customer_email']); ?></div>
                    </div>
                    <div>
                        <span class="block text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Phone / Whatsapp</span>
                        <div><?php echo e($order['recipient_phone']); ?></div>
                    </div>
                    <div>
                        <span class="block text-label-sm uppercase tracking-widest text-on-surface-variant mb-1">Shipping Address</span>
                        <div class="leading-relaxed"><?php echo e($order['recipient_address']); ?></div>
                    </div>
                </div>
                
                <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', str_starts_with($order['recipient_phone'], '0') ? '62' . substr($order['recipient_phone'], 1) : $order['recipient_phone'])); ?>?text=<?php echo rawurlencode($custWaMsg); ?>" target="_blank" class="mt-6 flex items-center justify-center gap-2 w-full py-2.5 rounded-lg bg-[#25D366] hover:bg-[#128C7E] text-white font-label-md uppercase tracking-wider font-bold transition-colors">
                    <span class="material-symbols-outlined text-[20px]">chat</span> Chat via WhatsApp
                </a>
            </div>

            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30">
                <h3 class="font-headline-sm font-bold text-on-surface mb-4">Order Items</h3>
                <div class="space-y-4 mb-6">
                    <?php foreach ($orderItems as $it): ?>
                    <div class="flex justify-between items-start gap-4">
                        <div class="text-body-sm font-semibold text-on-surface">
                            <span class="text-primary"><?php echo (int)$it['qty']; ?>x</span> <?php echo e($it['product_name']); ?>
                        </div>
                        <div class="text-body-sm text-on-surface-variant shrink-0 font-mono">
                            <?php echo rupiah($it['price'] * $it['qty']); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="pt-4 border-t border-outline-variant/50 flex justify-between items-center text-headline-sm font-bold text-on-surface">
                    <span>Total</span>
                    <span class="font-mono text-primary"><?php echo rupiah($order['total']); ?></span>
                </div>
                <div class="mt-4 pt-4 border-t border-outline-variant/30 flex justify-between items-center text-body-sm">
                    <span class="font-label-md uppercase tracking-widest text-on-surface-variant">Payment Method</span>
                    <span class="font-bold text-on-surface"><?php echo $order['payment_method'] === 'transfer' ? 'Transfer Bank' : 'COD (Cash on Delivery)'; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>