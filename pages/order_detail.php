<?php
        require_login('login');
        $orderId = (int)($_GET['order'] ?? 0);
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND (user_id = ? OR ? = 1)");
        $stmt->execute([$orderId, current_user_id(), is_admin() ? 1 : 0]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$order) { header('Location: ?page=my_orders'); exit; }

        $stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM order_status_log WHERE order_id = ? ORDER BY created_at ASC, id ASC");
        $stmt->execute([$orderId]);
        $statusLog = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT * FROM ratings WHERE order_id = ?");
        $stmt->execute([$orderId]);
        $existingRating = $stmt->fetch(PDO::FETCH_ASSOC);

        $waMsg = "Hello Dragon North Admin, I'd like to confirm payment for order {$order['order_code']} totaling " . rupiah($order['total']) . ".";
        ?>
        <main class="main-content order-detail-page">
            <div class="container">
                <div class="page-header">
                    <span class="eyebrow">TRACKING</span>
                    <h1 class="page-title">Order <span class="accent">Details</span></h1>
                    <p>Order Code: <strong><?php echo e($order['order_code']); ?></strong></p>
                </div>

                <div class="order-detail-grid">
                    <div class="order-timeline-col glass-card">
                        <h3>Current Status</h3>
                        <div class="status-pill status-<?php echo e($order['status']); ?> status-pill-lg"><?php echo status_icon($order['status']); ?> <?php echo e(status_label($order['status'])); ?></div>
                        <?php if ($order['payment_method'] === 'transfer' && $order['status'] === 'menunggu_pembayaran'): ?>
                        <a href="<?php echo e(wa_link($waMsg)); ?>" target="_blank" class="btn-primary btn-whatsapp" style="margin-top:15px;display:inline-block;">📲 Confirm Payment via WhatsApp</a>
                        <?php endif; ?>

                        <h3 style="margin-top:25px;">Order Journey History</h3>
                        <div class="timeline">
                            <?php foreach ($statusLog as $log): ?>
                            <div class="timeline-item">
                                <div class="timeline-dot"><?php echo status_icon($log['status']); ?></div>
                                <div class="timeline-content">
                                    <h4><?php echo e(status_label($log['status'])); ?></h4>
                                    <?php if ($log['note']): ?><p><?php echo e($log['note']); ?></p><?php endif; ?>
                                    <span><?php echo e(date('d M Y, H:i', strtotime($log['created_at']))); ?> (GMT+7)</span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <?php if ($order['status'] === 'selesai' && !is_admin()): ?>
                        <h3 style="margin-top:25px;">Leave a Rating</h3>
                        <?php if ($existingRating): ?>
                            <div class="rating-done">
                                <div class="stars-display"><?php echo star_html($existingRating['rating']); ?></div>
                                <p><?php echo e($existingRating['review']); ?></p>
                                <span style="color:#7a8a80;font-size:13px;">Thank you for your review!</span>
                            </div>
                        <?php else: ?>
                            <form method="POST" class="rating-form">
                                <input type="hidden" name="do" value="rate_order">
                                <input type="hidden" name="order_id" value="<?php echo (int)$order['id']; ?>">
                                <div class="star-picker">
                                    <?php for ($s = 5; $s >= 1; $s--): ?>
                                    <input type="radio" id="star<?php echo $s; ?>" name="rating" value="<?php echo $s; ?>" <?php echo $s == 5 ? 'checked' : ''; ?>>
                                    <label for="star<?php echo $s; ?>">★</label>
                                    <?php endfor; ?>
                                </div>
                                <textarea name="review" rows="3" placeholder="Tell us about your shopping experience..."></textarea>
                                <button type="submit" class="btn-primary">Submit Rating</button>
                            </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="order-info-col glass-card">
                        <h3>Shipping Information</h3>
                        <p><strong>Recipient:</strong> <?php echo e($order['recipient_name']); ?></p>
                        <p><strong>Phone:</strong> <?php echo e($order['recipient_phone']); ?></p>
                        <p><strong>Address:</strong> <?php echo e($order['recipient_address']); ?></p>
                        <p><strong>Courier:</strong> <?php echo e($order['courier']); ?></p>
                        <p><strong>Payment:</strong> <?php echo $order['payment_method'] === 'transfer' ? 'Transfer Bank' : 'COD (Cash on Delivery)'; ?></p>

                        <h3 style="margin-top:20px;">Order Items</h3>
                        <?php foreach ($orderItems as $it): ?>
                        <div class="summary-row"><span><?php echo (int)$it['qty']; ?>x <?php echo e($it['product_name']); ?></span><span><?php echo rupiah($it['price'] * $it['qty']); ?></span></div>
                        <?php endforeach; ?>
                        <div class="summary-row summary-total"><span>Total</span><span><?php echo rupiah($order['total']); ?></span></div>

                        <?php if (is_admin()): ?>
                        <a href="?page=admin_order_detail&order=<?php echo (int)$order['id']; ?>" class="btn-secondary-outline" style="margin-top:15px;display:inline-block;">Manage This Order</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
