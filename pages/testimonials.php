<?php
        $ratedOrders = $pdo->query("
            SELECT r.rating, r.review, r.created_at, u.name AS user_name
            FROM ratings r JOIN orders o ON o.id = r.order_id JOIN users u ON u.id = r.user_id
            ORDER BY r.created_at DESC LIMIT 12
        ")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <main class="main-content testimonials-page">
            <div class="container">
                <div class="page-header">
                    <span class="eyebrow">FIELD REPORTS</span>
                    <h1 class="page-title">What Our <span class="accent">Customers</span> Say</h1>
                    <p>Their trust and satisfaction are our top priority.</p>
                </div>
                <div class="testimonial-grid">
                    <div class="testi-card highlight-1">
                        <div class="quote-stars"><?php echo star_html(5); ?></div>
                        <div class="quote">"Dragon North bags are incredibly tough! I've used mine for mountain hiking and it still looks brand new. The suede material is super comfortable."</div>
                        <div class="user"><strong>Budi Santoso</strong> <br> <span>Adventurer</span></div>
                    </div>
                    <div class="testi-card highlight-2">
                        <div class="quote-stars"><?php echo star_html(5); ?></div>
                        <div class="quote">"My kid loves their Dragon North school bag — Grade A Italian leather, durable, and still stylish."</div>
                        <div class="user"><strong>Dewi Lestari</strong> <br> <span>Homemaker</span></div>
                    </div>
                    <div class="testi-card highlight-3">
                        <div class="quote-stars"><?php echo star_html(4); ?></div>
                        <div class="quote">"I've bought 3 bags from here. Even the more affordable Grade C quality still offers maximum protection."</div>
                        <div class="user"><strong>Rudi Hermawan</strong> <br> <span>Private Employee</span></div>
                    </div>
                    <?php foreach ($ratedOrders as $i => $r): ?>
                    <div class="testi-card highlight-<?php echo (($i % 3) + 1); ?>">
                        <div class="quote-stars"><?php echo star_html($r['rating']); ?></div>
                        <div class="quote"><?php echo $r['review'] !== '' ? '"' . e($r['review']) . '"' : '<em>Customer did not leave a written review.</em>'; ?></div>
                        <div class="user"><strong><?php echo e($r['user_name']); ?></strong> <br> <span>Verified Customer</span></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
