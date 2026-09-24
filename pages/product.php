<?php
$productId = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND is_active = 1");
$stmt->execute([$productId]);
$prod = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$prod) { header('Location: ?page=products'); exit; }

$related = $pdo->prepare("SELECT * FROM products WHERE is_active = 1 AND id != ? ORDER BY id DESC LIMIT 3");
$related->execute([$productId]);
$relatedProducts = $related->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Top Technical Breadcrumbs & Altitude Gauge -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-sm bg-surface-container-low/60 mt-20">
<div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-space-xs text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
<div class="flex items-center gap-space-xs flex-wrap">
<a class="hover:text-primary transition-colors" data-path="home" href="?page=home">Home</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" data-path="shop-catalog" href="?page=products">Collection</a>
<span class="text-outline-variant">/</span>
<span class="text-on-surface font-semibold"><?= htmlspecialchars($prod['name']) ?></span>
</div>
<div class="flex items-center gap-space-sm text-outline">
<span class="flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
          MIL-SPEC 810-H COMPLIANT
        </span>
<span class="hidden sm:inline text-outline-variant">•</span>
<span class="hidden sm:inline font-mono text-[11px]">SERIAL: DND-<?= $prod['id'] ?>-CHX</span>
</div>
</div>
</section>

<!-- Main Product Stage (Asymmetric 7/5 Grid) -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-xl md:py-space-2xl bg-surface">
<div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
<!-- LEFT COLUMN: Technical Equipment Gallery (Col 7) -->
<div class="lg:col-span-7 flex flex-col gap-space-md">
<!-- Main Stage Container -->
<div class="relative w-full aspect-[4/5] bg-surface-container-low rounded-lg overflow-hidden shadow-xl group">
<!-- Live Badges -->
<div class="absolute top-4 left-4 z-20 flex flex-wrap gap-2 pointer-events-none">
<?php if ($prod['badge']): ?>
<span class="bg-primary-container text-on-primary-container font-label-sm text-label-sm uppercase px-2.5 py-1 rounded-DEFAULT tracking-wider shadow-sm">
<?= htmlspecialchars($prod['badge']) ?>
</span>
<?php endif; ?>
<?php if ($prod['capacity_liters']): ?>
<span class="bg-inverse-surface/90 backdrop-blur-md text-inverse-on-surface font-label-sm text-label-sm uppercase px-2.5 py-1 rounded-DEFAULT tracking-wider shadow-sm">
<?= htmlspecialchars($prod['capacity_liters']) ?> CAPACITY
</span>
<?php endif; ?>
<span class="bg-surface-container-high/90 backdrop-blur-md text-on-surface font-label-sm text-label-sm uppercase px-2.5 py-1 rounded-DEFAULT tracking-wider shadow-sm flex items-center gap-1">
<span class="material-symbols-outlined text-xs text-primary">verified_user</span>
              FIELD-TESTED
            </span>
</div>
<!-- Utility Float Tools -->
<div class="absolute top-4 right-4 z-20 flex flex-col gap-2">
<button class="w-10 h-10 rounded-lg bg-surface/90 hover:bg-surface text-on-surface backdrop-blur-md flex items-center justify-center shadow-md transition-all active:scale-95" id="zoomToggleBtn" title="Toggle Detail Zoom">
<span class="material-symbols-outlined text-xl">zoom_in</span>
</button>
</div>
<!-- Primary Active Image -->
<img class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105 select-none cursor-crosshair" id="mainDisplayImage" src="<?= e(product_image_url($prod['image'])) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
<!-- 360 Drag Badge Overlay -->
<div class="absolute bottom-4 left-4 z-20 bg-inverse-surface/85 backdrop-blur-sm text-inverse-on-surface px-3 py-1.5 rounded-DEFAULT font-label-sm text-label-sm uppercase flex items-center gap-2 pointer-events-none">
<span class="material-symbols-outlined text-sm text-tertiary-fixed">sync</span>
<span>Interactive Inspector</span>
</div>
<div class="absolute bottom-4 right-4 z-20 bg-surface/90 backdrop-blur-sm text-on-surface font-mono text-[11px] px-2.5 py-1 rounded-DEFAULT uppercase">
            SCALE: 1:1 TRUE FIT
          </div>
</div>
<!-- 5 Asymmetrical Thumbnails Dock -->
<div class="grid grid-cols-5 gap-space-xs sm:gap-space-sm">
<button class="thumb-btn relative aspect-square rounded-lg overflow-hidden bg-surface-container transition-all ring-2 ring-primary">
<img class="w-full h-full object-cover" src="<?= e(product_image_url($prod['image'])) ?>" alt="Front View">
<span class="absolute bottom-1 right-1 bg-inverse-surface/80 text-[9px] font-mono text-inverse-on-surface px-1 rounded uppercase">Front</span>
</button>
<!-- Add dummy thumbnails if no gallery exists, or you could loop through an image gallery table -->
</div>
<!-- Quick Material Schematic Bar -->
<div class="p-space-md bg-surface-container-low rounded-lg flex flex-wrap items-center justify-between gap-space-sm text-on-surface-variant text-body-sm font-body-sm shadow-sm">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-lg">shield</span>
<span><strong class="font-semibold text-on-surface">Material:</strong> <?= htmlspecialchars($prod['material']) ?></span>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary text-lg">water_drop</span>
<span><strong class="font-semibold text-on-surface">Origin:</strong> <?= htmlspecialchars($prod['material_origin']) ?></span>
</div>
</div>
</div>

<!-- RIGHT COLUMN: Buy Box & Technical Configuration (Col 5) -->
<div class="lg:col-span-5 flex flex-col gap-space-lg">
<!-- Header & Pricing Block -->
<div class="flex flex-col gap-space-xs">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold">EXPEDITION ARCHITECTURE // SER. 06</span>
<span class="bg-surface-container px-2 py-0.5 rounded text-[11px] font-label-sm text-outline uppercase font-semibold">IN STOCK // FIELD READY</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight leading-tight uppercase">
            <?= htmlspecialchars($prod['name']) ?>
          </h1>
<!-- Reviews Strip -->
<div class="flex items-center gap-space-sm flex-wrap pt-1">
<div class="flex items-center text-tertiary gap-0.5">
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star_half</span>
</div>
<a class="font-label-md text-label-md uppercase tracking-wider text-on-surface font-bold hover:text-primary transition-colors" href="#reviews-section">
              4.9 (184 VERIFIED REVIEWS)
            </a>
<span class="text-outline-variant">•</span>
<a class="font-label-sm text-label-sm uppercase tracking-wider text-outline hover:text-on-surface transition-colors" href="#faq-section">
              <?= htmlspecialchars($prod['grade']) ?> GRADE
            </a>
</div>
<!-- Pricing Block -->
<div class="pt-space-sm flex items-baseline gap-space-sm">
<span class="font-display-lg text-display-lg text-on-surface font-bold tracking-tight"><?= rupiah($prod['price']) ?></span>
<span class="font-body-md text-body-md text-outline">IDR MSRP</span>
</div>
</div>
<!-- Divider Line -->
<div class="w-full h-px bg-outline-variant/40"></div>
<p class="font-body-md text-body-md text-on-surface-variant">
<?= htmlspecialchars($prod['description']) ?>
</p>

<!-- Action Matrix: Quantity + Add To Cart + Wishlist -->
<div class="flex flex-col gap-space-sm pt-space-xs">
<?php if ((int)$prod['stock'] > 0): ?>
<form method="POST" class="add-cart-form flex flex-col gap-space-sm" id="cartForm">
    <input type="hidden" name="do" value="add_to_cart">
    <input type="hidden" name="product_id" value="<?= (int)$prod['id'] ?>">
    <input type="hidden" name="redirect" value="?page=product&id=<?= (int)$prod['id'] ?>">
    
    <div class="flex items-center gap-space-sm">
        <!-- Counter -->
        <div class="flex items-center bg-surface-container rounded-lg p-1">
        <button aria-label="Decrease quantity" type="button" class="w-9 h-9 flex items-center justify-center text-on-surface hover:bg-surface-container-high rounded transition-colors" id="qtyMinus">
        <span class="material-symbols-outlined text-base">remove</span>
        </button>
        <input class="w-10 text-center font-mono font-bold bg-transparent text-on-surface focus:outline-none select-none" id="qtyInput" name="qty" readonly="" type="text" value="1" max="<?= (int)$prod['stock'] ?>">
        <button aria-label="Increase quantity" type="button" class="w-9 h-9 flex items-center justify-center text-on-surface hover:bg-surface-container-high rounded transition-colors" id="qtyPlus">
        <span class="material-symbols-outlined text-base">add</span>
        </button>
        </div>
        <!-- Main CTA -->
        <button class="flex-1 py-space-sm px-space-lg bg-primary-container hover:bg-primary text-on-primary-container font-label-md text-label-md uppercase tracking-wider rounded-lg shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 group" type="submit" id="addToCartBtn">
        <span class="material-symbols-outlined text-xl group-hover:-translate-y-0.5 transition-transform">backpack</span>
        <span id="cartBtnText">Add to Cart</span>
        </button>
        <!-- Wishlist Button -->
        <button aria-label="Add to gear locker" type="button" class="p-3 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg transition-colors flex items-center justify-center">
        <span class="material-symbols-outlined text-2xl">favorite</span>
        </button>
    </div>
</form>
<?php else: ?>
    <div class="flex items-center gap-space-sm">
        <button class="flex-1 py-space-sm px-space-lg bg-surface-container text-on-surface-variant font-label-md text-label-md uppercase tracking-wider rounded-lg cursor-not-allowed flex items-center justify-center gap-2">
            Out of Stock
        </button>
    </div>
<?php endif; ?>

<!-- Fast Checkout Perks Strip -->
<div class="p-space-md bg-surface-container-low rounded-lg grid grid-cols-1 sm:grid-cols-3 gap-space-sm text-body-sm font-body-sm text-on-surface-variant mt-4">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-xl">local_shipping</span>
<div class="flex flex-col">
<span class="font-semibold text-on-surface text-[12px] uppercase">Free 2-Day Air</span>
<span class="text-[11px] text-outline">Continental dispatch</span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary text-xl">verified</span>
<div class="flex flex-col">
<span class="font-semibold text-on-surface text-[12px] uppercase">Ironclad Lifetime</span>
<span class="text-[11px] text-outline">Complete seam guarantee</span>
</div>
</div>
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-xl">restart_alt</span>
<div class="flex flex-col">
<span class="font-semibold text-on-surface text-[12px] uppercase">45-Day Trail Trial</span>
<span class="text-[11px] text-outline">Free return logistics</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- Technical Spec Matrix Strip -->
<section class="w-full bg-inverse-surface text-inverse-on-surface py-space-xl px-margin-mobile md:px-margin-desktop">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-space-lg gap-space-sm">
<div>
<p class="font-label-sm text-label-sm uppercase text-primary-fixed-dim tracking-widest">AERODYNAMIC ARCHITECTURE</p>
<h2 class="font-headline-md text-headline-md uppercase tracking-tight text-surface-container-lowest">Precision Engineering Specs</h2>
</div>
<p class="font-mono text-body-sm text-surface-container-high max-w-md">
          Zero excess weight. Every gram calibrated for high-altitude bivouac balance and 45lb+ load distribution.
        </p>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-space-md">
<div class="p-space-md bg-surface-container-highest/10 rounded-lg">
<span class="material-symbols-outlined text-primary-fixed-dim text-2xl mb-1">scale</span>
<span class="block font-display-lg-mobile text-display-lg-mobile text-surface-container-lowest font-bold"><?= $prod['weight'] ?? '1.5kg' ?></span>
<span class="block font-label-md text-label-md uppercase text-surface-container-high">Empty Weight</span>
</div>
<div class="p-space-md bg-surface-container-highest/10 rounded-lg">
<span class="material-symbols-outlined text-primary-fixed-dim text-2xl mb-1">view_in_ar</span>
<span class="block font-display-lg-mobile text-display-lg-mobile text-surface-container-lowest font-bold"><?= $prod['capacity_liters'] ?? '55' ?><span class="text-base font-normal text-surface-container-high">L</span></span>
<span class="block font-label-md text-label-md uppercase text-surface-container-high">Internal Chamber</span>
</div>
<div class="p-space-md bg-surface-container-highest/10 rounded-lg">
<span class="material-symbols-outlined text-primary-fixed-dim text-2xl mb-1">hardware</span>
<span class="block font-display-lg-mobile text-display-lg-mobile text-surface-container-lowest font-bold"><?= $prod['zipper_brand'] ?? 'YKK' ?></span>
<span class="block font-label-md text-label-md uppercase text-surface-container-high">Zipper Brand</span>
</div>
<div class="p-space-md bg-surface-container-highest/10 rounded-lg">
<span class="material-symbols-outlined text-primary-fixed-dim text-2xl mb-1">water</span>
<span class="block font-display-lg-mobile text-display-lg-mobile text-surface-container-lowest font-bold"><?= $prod['water_resistance'] ?? 'DWR' ?></span>
<span class="block font-label-md text-label-md uppercase text-surface-container-high">Water Resistance</span>
</div>
</div>
</div>
</section>

<!-- Technical Deep-Dive Accordion Details -->
<section class="w-full bg-surface-container-low/40 py-space-2xl px-margin-mobile md:px-margin-desktop">
<div class="max-w-4xl mx-auto flex flex-col gap-space-md">
<div class="flex flex-col gap-1">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary font-bold">FIELD MANUAL</span>
<h2 class="font-headline-md text-headline-md uppercase text-on-surface tracking-tight">Pack Mechanics &amp; Specifications</h2>
</div>
<!-- Accordion Items -->
<div class="flex flex-col gap-space-xs" id="specsAccordion">
<!-- Item 1 -->
<div class="accordion-item bg-surface rounded-lg overflow-hidden shadow-sm">
<button class="accordion-trigger w-full p-space-md text-left flex items-center justify-between font-headline-sm text-headline-sm uppercase text-on-surface">
<span>Material Composition &amp; Origin</span>
<span class="material-symbols-outlined transition-transform duration-300">expand_more</span>
</button>
<div class="accordion-content px-space-md pb-space-md pt-0 text-body-sm font-body-sm text-on-surface-variant">
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-sm">
<div class="p-space-sm bg-surface-container rounded">
<span class="font-bold text-on-surface block uppercase font-label-md text-label-md">Main Material</span>
<p><?= htmlspecialchars($prod['material']) ?> - <?= htmlspecialchars($prod['material_origin']) ?></p>
</div>
<div class="p-space-sm bg-surface-container rounded">
<span class="font-bold text-on-surface block uppercase font-label-md text-label-md">Grade</span>
<p><?= htmlspecialchars($prod['grade']) ?></p>
</div>
</div>
</div>
</div>
<!-- Item 2 -->
<div class="accordion-item bg-surface rounded-lg overflow-hidden shadow-sm">
<button class="accordion-trigger w-full p-space-md text-left flex items-center justify-between font-headline-sm text-headline-sm uppercase text-on-surface">
<span>Hardware &amp; Construction</span>
<span class="material-symbols-outlined transition-transform duration-300">expand_more</span>
</button>
<div class="accordion-content px-space-md pb-space-md pt-0 text-body-sm font-body-sm text-on-surface-variant" style="display: none;">
<ul class="list-disc list-inside space-y-1">
<li>Zipper: <?= htmlspecialchars($prod['zipper_brand'] . ' - ' . $prod['zipper_detail']) ?></li>
<li>Buckle: <?= htmlspecialchars($prod['buckle_brand'] . ' - ' . $prod['buckle_origin']) ?></li>
<li>Closure Type: <?= htmlspecialchars($prod['closure_type']) ?></li>
<li>Assembled In: <?= htmlspecialchars($prod['country_of_assembly']) ?></li>
</ul>
</div>
</div>
<!-- Item 3 -->
<div class="accordion-item bg-surface rounded-lg overflow-hidden shadow-sm">
<button class="accordion-trigger w-full p-space-md text-left flex items-center justify-between font-headline-sm text-headline-sm uppercase text-on-surface">
<span>Pack Care, Warranty &amp; Field Repair</span>
<span class="material-symbols-outlined transition-transform duration-300">expand_more</span>
</button>
<div class="accordion-content px-space-md pb-space-md pt-0 text-body-sm font-body-sm text-on-surface-variant" style="display: none;">
<p><strong>Warranty:</strong> <?= htmlspecialchars($prod['warranty_period']) ?> - <?= htmlspecialchars($prod['warranty']) ?></p>
<p><strong>Care:</strong> <?= htmlspecialchars($prod['care_instructions']) ?></p>
<p><strong>Quality Control:</strong> <?= htmlspecialchars($prod['quality_control']) ?></p>
</div>
</div>
</div>
</div>
</section>

<?php if (!empty($relatedProducts)): ?>
<section class="w-full bg-surface py-space-3xl px-margin-mobile md:px-margin-desktop">
<div class="max-w-7xl mx-auto flex flex-col gap-space-xl">
<div class="flex items-center justify-between">
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface tracking-tight">You May Also Survive With</h2>
<a class="font-label-md text-label-md uppercase tracking-wider text-primary hover:underline" href="?page=products">View All Systems</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-space-lg">
<?php foreach ($relatedProducts as $rp): ?>
<article class="product-card group flex flex-col bg-surface-container-low rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
<div class="relative aspect-[4/5] w-full bg-surface-container overflow-hidden">
<a href="?page=product&id=<?= $rp['id'] ?>"><img class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" data-alt="<?= htmlspecialchars($rp['name']) ?>" src="<?= e(product_image_url($rp['image'])) ?>"></a>
<?php if ($rp['badge']): ?>
<div class="absolute top-space-sm left-space-sm flex flex-col gap-space-xxs">
<span class="bg-primary text-on-primary font-label-sm text-label-sm uppercase px-space-xs py-space-xxs rounded-DEFAULT shadow-sm">
<?= htmlspecialchars($rp['badge']) ?>
</span>
</div>
<?php endif; ?>
</div>
<div class="flex flex-col p-space-md flex-1 justify-between gap-space-md">
<div class="flex flex-col gap-space-xxs">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline"><?= htmlspecialchars(material_flag($rp['material'])) ?> • <?= htmlspecialchars($rp['grade']) ?></span>
</div>
<h2 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">
<a href="?page=product&id=<?= $rp['id'] ?>"><?= htmlspecialchars($rp['name']) ?></a>
</h2>
</div>
<div class="flex items-center justify-between pt-space-xs border-t border-outline-variant/20">
<div class="flex items-baseline gap-space-xxs">
<span class="font-label-md text-label-md uppercase text-outline">Price</span>
<span class="font-headline-sm text-headline-sm text-on-surface font-bold"><?= rupiah($rp['price']) ?></span>
</div>
</div>
</div>
</article>
<?php endforeach; ?>
</div>
</div>
</section>
<?php endif; ?>

<script>
    (function initPDP() {
      // 5. Quantity Counter
      const qtyInput = document.getElementById('qtyInput');
      const qtyMinus = document.getElementById('qtyMinus');
      const qtyPlus = document.getElementById('qtyPlus');
      const maxStock = <?= (int)$prod['stock'] ?>;

      if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', () => {
          let v = parseInt(qtyInput.value, 10);
          if (v > 1) {
            qtyInput.value = v - 1;
          }
        });
        qtyPlus.addEventListener('click', () => {
          let v = parseInt(qtyInput.value, 10);
          if (v < maxStock) {
            qtyInput.value = v + 1;
          }
        });
      }

      // 6. Zoom Toggle
      const zoomBtn = document.getElementById('zoomToggleBtn');
      const mainImg = document.getElementById('mainDisplayImage');
      let zoomed = false;
      if (zoomBtn && mainImg) {
        zoomBtn.addEventListener('click', () => {
          zoomed = !zoomed;
          mainImg.style.transform = zoomed ? 'scale(1.7)' : 'scale(1)';
        });
      }

      // 8. Accordion Toggles
      const accordionTriggers = document.querySelectorAll('.accordion-trigger');
      accordionTriggers.forEach(btn => {
        btn.addEventListener('click', () => {
          const content = btn.nextElementSibling;
          const icon = btn.querySelector('.material-symbols-outlined');
          if (content.style.display === 'none' || !content.style.display) {
            content.style.display = 'block';
            if (icon) icon.style.transform = 'rotate(180deg)';
          } else {
            content.style.display = 'none';
            if (icon) icon.style.transform = 'rotate(0deg)';
          }
        });
      });
    })();
  </script>
