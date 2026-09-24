<?php
require_admin();
$filterStatus = $_GET['status'] ?? '';
if ($filterStatus !== '' && array_key_exists($filterStatus, order_status_flow())) {
    $stmt = $pdo->prepare("SELECT o.*, u.name AS customer_name FROM orders o JOIN users u ON u.id = o.user_id WHERE o.status = ? ORDER BY o.created_at DESC");
    $stmt->execute([$filterStatus]);
} else {
    $stmt = $pdo->query("SELECT o.*, u.name AS customer_name FROM orders o JOIN users u ON u.id = o.user_id ORDER BY o.created_at DESC");
}
$allOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <div class="mb-space-xl">
        <span class="font-label-md text-primary tracking-widest uppercase block mb-1">LOGISTICS</span>
        <h1 class="font-headline-lg text-on-surface tracking-tight">Manage <span class="text-primary font-bold">Orders</span></h1>
    </div>



    <!-- Filter Buttons -->
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="?page=admin_orders" class="px-4 py-2 rounded-full text-label-md uppercase tracking-wider font-bold transition-colors <?php echo $filterStatus === '' ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant'; ?>">
            All Orders
        </a>
        <?php foreach (order_status_flow() as $key => $s): ?>
        <a href="?page=admin_orders&status=<?php echo $key; ?>" class="px-4 py-2 rounded-full text-label-md uppercase tracking-wider font-bold transition-colors flex items-center gap-1.5 <?php echo $filterStatus === $key ? 'bg-primary text-on-primary shadow-sm' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant'; ?>">
            <?php echo $s['icon']; ?> <?php echo $s['label']; ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Orders Table -->
    <div class="bg-surface-container rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-body-sm text-on-surface whitespace-nowrap">
                <thead class="bg-surface-container-high border-b border-outline-variant/30 font-label-md uppercase text-on-surface-variant tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Code</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Payment</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30">
                <?php if (empty($allOrders)): ?>
                    <tr>
                        <td colspan="7" class="p-8 text-center text-on-surface-variant text-body-md">No orders found for this filter.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($allOrders as $o): ?>
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="px-6 py-4 font-bold text-on-surface"><?php echo e($o['order_code']); ?></td>
                        <td class="px-6 py-4"><?php echo e($o['customer_name']); ?></td>
                        <td class="px-6 py-4 text-on-surface-variant"><?php echo e(date('d M Y', strtotime($o['created_at']))); ?></td>
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
        </div>
    </div>
</div>