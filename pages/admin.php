<?php
require_admin_pro();
$totalRevenue = (int)$pdo->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status != 'dibatalkan'")->fetchColumn();
$totalOrders = (int)$pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalProducts = (int)$pdo->query("SELECT COUNT(*) FROM products WHERE is_active = 1")->fetchColumn();
$totalCustomers = (int)$pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'")->fetchColumn();
$pendingPayment = (int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'menunggu_pembayaran'")->fetchColumn();
$needsAction = (int)$pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('diproses','dikemas','dikirim_ekspedisi','dalam_perjalanan','menuju_rumah')")->fetchColumn();
$latestOrders = $pdo->query("SELECT o.*, u.name AS customer_name FROM orders o JOIN users u ON u.id = o.user_id ORDER BY o.created_at DESC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <div class="mb-space-xl">
        <span class="font-label-md text-primary tracking-widest uppercase block mb-1">COMMAND CENTER</span>
        <h1 class="font-headline-lg text-on-surface tracking-tight">Admin <span class="text-primary font-bold">Dashboard</span></h1>
        <p class="text-on-surface-variant mt-2 max-w-2xl text-body-lg">Overview of Dragon North Division's store performance and recent logistics operations.</p>
    </div>



    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-space-xl">
        <!-- Revenue -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">Total Revenue</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo rupiah($totalRevenue); ?></h3>
            </div>
        </div>
        <!-- Total Orders -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-surface-container-highest text-on-surface flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">receipt_long</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">Total Orders</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo $totalOrders; ?></h3>
            </div>
        </div>
        <!-- Registered Customers -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">group</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">Customers</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo $totalCustomers; ?></h3>
            </div>
        </div>
        <!-- Active Products -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-tertiary-container text-on-tertiary-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">backpack</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">Active Products</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo $totalProducts; ?></h3>
            </div>
        </div>
        <!-- Pending Payment -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-error-container text-on-error-container flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">hourglass_empty</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">Awaiting Payment</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo $pendingPayment; ?></h3>
            </div>
        </div>
        <!-- Needs Action -->
        <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 flex items-center gap-5">
            <div class="w-12 h-12 rounded-full bg-primary text-on-primary flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-2xl">local_shipping</span>
            </div>
            <div>
                <p class="text-label-md uppercase text-on-surface-variant tracking-wider">In Progress</p>
                <h3 class="font-headline-md font-bold text-on-surface mt-1"><?php echo $needsAction; ?></h3>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-surface-container rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="p-6 border-b border-outline-variant/30 flex items-center justify-between">
            <h3 class="font-headline-sm font-bold text-on-surface">Recent Orders</h3>
            <a href="?page=admin_orders" class="text-label-md text-primary font-bold hover:underline uppercase tracking-widest">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-body-sm text-on-surface whitespace-nowrap">
                <thead class="bg-surface-container-high border-b border-outline-variant/30 font-label-md uppercase text-on-surface-variant tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Code</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                <?php foreach ($latestOrders as $o): ?>
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-6 py-4 font-bold text-on-surface"><?php echo e($o['order_code']); ?></td>
                        <td class="px-6 py-4"><?php echo e($o['customer_name']); ?></td>
                        <td class="px-6 py-4 font-semibold"><?php echo rupiah($o['total']); ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-bold bg-surface-container-highest text-on-surface uppercase">
                                <?php echo $o['payment_method'] === 'transfer' ? 'Transfer' : 'COD'; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-label-sm font-bold uppercase tracking-wider bg-surface-container-highest">
                                <?php echo status_icon($o['status']); ?> <?php echo e(status_label($o['status'])); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="?page=admin_order_detail&order=<?php echo (int)$o['id']; ?>" class="inline-flex items-center justify-center px-4 py-1.5 text-label-md font-semibold bg-primary text-on-primary rounded hover:bg-primary/90 transition-colors shadow-sm">
                                Manage
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php if(empty($latestOrders)): ?>
                <div class="p-8 text-center text-on-surface-variant text-body-md">
                    No recent orders found.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>