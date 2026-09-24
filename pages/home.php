<?php
$bestSellers = $pdo->query("SELECT * FROM products WHERE is_active = 1 ORDER BY id ASC LIMIT 8")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- 1. HERO SECTION -->
<section class="relative w-full overflow-hidden bg-inverse-surface -mt-20 pt-24 min-h-[942px] flex items-center">
<!-- Hero Background Image & Atmospheric Scrim -->
<div class="absolute inset-0 bg-cover bg-center mix-blend-luminosity opacity-40" data-alt="An expansive cinematic photograph of rugged alpine mountain ridge at golden hour with sharp granite peaks, deep ochre and terracotta rock faces, drifting high-altitude clouds, and a solitary mountaineer wearing a technical rust-colored pack surveying the vast untamed valley beneath warm glowing sunlight." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAn9MEsgaNq9QmW86GyeyzJUuqWcBVVy7WyGWhG3m0ylrU111l6Z6mMPFhRUwBXiIoMEfNJLF3VzxSWRp-hBhk2OymA5daH2bFSCvtRzbzjUszTdERmc08QNTEmAhFd-MI0s_eGjwNntJuOsx42wHa9mPz2FV_ZT0IFJxkvOk_0TGPrxMqmbqxlAdt4cGauBwOwApCouTGR1Kx4pyIkVf1S-0MWZSJ8pQBMoHq7CWNEQdZpn2SUVxsR')">
</div>
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface via-inverse-surface/60 to-transparent"></div>
<div class="absolute -right-32 -top-32 w-96 h-96 rounded-full bg-primary/20 blur-3xl pointer-events-none"></div>
<div class="relative z-10 w-full px-margin-mobile md:px-margin-desktop py-space-3xl flex flex-col justify-center">
<div class="max-w-4xl flex flex-col items-start gap-space-md">
<!-- Badge -->
<div class="inline-flex items-center gap-space-xs px-space-sm py-space-xxs rounded-DEFAULT bg-primary-container text-on-primary-container shadow-md">
<span class="material-symbols-outlined text-sm">explore</span>
<span class="font-label-sm text-label-sm uppercase tracking-widest">ENGINEERED FOR THE WILD UNCHARTED</span>
</div>
<!-- Headline -->
<h1 class="font-display-lg text-display-lg-mobile md:text-display-lg text-inverse-on-surface uppercase tracking-tight font-bold">
          FORGED IN THE NORTH. <br class="hidden sm:inline"><span class="text-primary-fixed">CRAFTED FOR THE SUMMIT.</span>
</h1>
<!-- Subtitle -->
<p class="font-body-lg text-body-lg text-surface-container-high/90 max-w-2xl leading-relaxed">
          Technical alpine packs, ergonomic load-distribution systems, and weatherproof ballistic cordura engineered for grueling mountain ascents and spontaneous backcountry journeys.
        </p>
<!-- CTA Cluster -->
<div class="flex flex-wrap items-center gap-space-md pt-space-sm w-full sm:w-auto">
<a class="w-full sm:w-auto text-center px-space-xl py-space-md bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg uppercase tracking-wider rounded-DEFAULT shadow-lg transition-all duration-200 transform hover:-translate-y-0.5" href="?page=products">
            Explore All Packs
          </a>
<button class="w-full sm:w-auto inline-flex items-center justify-center gap-space-sm px-space-lg py-space-md bg-transparent hover:bg-surface/10 text-inverse-on-surface font-label-lg text-label-lg uppercase tracking-wider rounded-DEFAULT border-none transition-colors" id="openFilmModal">
<span class="material-symbols-outlined text-primary-fixed">play_circle</span>
            Watch Field Test Film
          </button>
</div>
<!-- Trust Badges -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-space-md pt-space-xl w-full">
<div class="flex items-center gap-space-sm bg-inverse-surface/60 backdrop-blur-md px-space-md py-space-xs rounded-DEFAULT">
<span class="material-symbols-outlined text-tertiary-fixed text-2xl">verified_user</span>
<div class="flex flex-col">
<span class="font-label-md text-label-md uppercase text-surface-container-lowest">Lifetime Alpine Guarantee</span>
<span class="font-body-sm text-body-sm text-surface-variant">Field-tested repairs on trail</span>
</div>
</div>
<div class="flex items-center gap-space-sm bg-inverse-surface/60 backdrop-blur-md px-space-md py-space-xs rounded-DEFAULT">
<span class="material-symbols-outlined text-tertiary-fixed text-2xl">straighten</span>
<div class="flex flex-col">
<span class="font-label-md text-label-md uppercase text-surface-container-lowest">Custom Torso Fit</span>
<span class="font-body-sm text-body-sm text-surface-variant">Micro-adjustable harness</span>
</div>
</div>
<div class="flex items-center gap-space-sm bg-inverse-surface/60 backdrop-blur-md px-space-md py-space-xs rounded-DEFAULT">
<span class="material-symbols-outlined text-tertiary-fixed text-2xl">recycling</span>
<div class="flex flex-col">
<span class="font-label-md text-label-md uppercase text-surface-container-lowest">100% Recycled Ripstop</span>
<span class="font-body-sm text-body-sm text-surface-variant">Circular nylon 500D weave</span>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- 2. PRODUCT CATEGORIES GRID -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl bg-surface">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-space-2xl gap-space-sm">
<div>
<div class="inline-flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-widest mb-space-xxs">
<span class="w-2 h-2 rounded-full bg-primary inline-block"></span> Range Classification
        </div>
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface">Mission Systems</h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md">
        Constructed around specific expedition durations, load-bearing capacities, and rapid access dynamics.
      </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg">
<!-- Card 1 -->
<a class="group relative flex flex-col bg-surface-container rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" href="?page=products">
<div class="relative w-full aspect-[4/5] overflow-hidden bg-surface-dim">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="DND lightweight daypack backpack strapped securely on an athlete climbing steep mountain rocks, golden morning light emphasizing technical buckles and rust colored ripstop fabric." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDodVjVtDB8pfRtzdJuzzCwOZmf4jlChtIvXCLUF9nurrK_vlGk_TVEURIocIvEx9VfVuK2P13EYJe4NcbtBkrKJJ5ONL6upostDCEKgbCAlQSVX29zlFGdXRim5EYqu9CA5gs5gae7wkUjw46WNmr8BLZIXGxFy12VhJePJ_btACnejbPu_7MGf4x1RbqJ_NBYYZHFpffRqSHFqrrjOYllrBqdTul7UOP2mbssj5HZNtOz5-bhuMxa')">
</div>
<div class="absolute top-space-sm left-space-sm bg-inverse-surface/90 text-inverse-on-surface px-space-xs py-space-xxs rounded-DEFAULT font-label-sm text-label-sm uppercase">
            18L – 28L
          </div>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between gap-space-sm">
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">Daypacks &amp; Trail</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xxs">Rapid trail scrambles and single-day ridgeline crossings with minimal drag.</p>
</div>
<div class="flex items-center justify-between pt-space-sm">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Fast &amp; Light</span>
<span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
</div>
</div>
</a>
<!-- Card 2 -->
<a class="group relative flex flex-col bg-surface-container rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" href="?page=products">
<div class="relative w-full aspect-[4/5] overflow-hidden bg-surface-dim">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Massive technical expedition hiking backpack placed on a high altitude alpine glacier camp with snow peaks and ice axe attached, dramatic mountain terrain under crisp blue sky." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCmVuYrRRIOYpKJ4iq40u0Xu_VByHWGpE9sgHHIKgMFZu2Rms_wx4tp3EEaJwSuiNXMc2TONmkX3oybzWL4hWA-JcOI1XFlzbnJdEfOSjVxZV9D9MfQHcn-51ch6ziIGggi7poIqq71kTj60t5lqBTXy6ffw2v8_2c6viiuqt3CmU6tFGLocet0hhE6hYR3XsI-ESXrVoOe04H-gYe-TkwKv4RNDHrDVFVHLuk89EwyhV3IAgpx98V2')">
</div>
<div class="absolute top-space-sm left-space-sm bg-primary text-on-primary px-space-xs py-space-xxs rounded-DEFAULT font-label-sm text-label-sm uppercase">
            40L – 65L+
          </div>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between gap-space-sm">
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">Multi-Day Alpine</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xxs">Maximum load-transfer chassis with external sleeping bag docks and ice tool clips.</p>
</div>
<div class="flex items-center justify-between pt-space-sm">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Heavy Backcountry</span>
<span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
</div>
</div>
</a>
<!-- Card 3 -->
<a class="group relative flex flex-col bg-surface-container rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" href="?page=products">
<div class="relative w-full aspect-[4/5] overflow-hidden bg-surface-dim">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Modern technical commuter backpack in soft sand and burnt orange resting against a brutalist concrete wall, sleek roll-top aesthetic with weather-resistant zippers." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBZ2rjuuwauFb7OzMQsHXHf_Zt-vxUoVHR9Qu5WlNQ-MlJ3wmOqJ55zLR1IAXYE6yU1JqBujvuU57XWqV1v96ywdFOtR0Va3NxrQW6WWZI3DfpfXFq9OWF6k6kgsL5KWI62VIM6fyZw5JNHPUdqOOmUtS7AxzKdBoT6HYGqHj6-rZlxLwuyhNm3rNJK5ncqh9ecViCLso5dD0VATzF8pKhjSOnqRSdo22pCP9TBgQKbU8hnuZM6sbcx')">
</div>
<div class="absolute top-space-sm left-space-sm bg-inverse-surface/90 text-inverse-on-surface px-space-xs py-space-xxs rounded-DEFAULT font-label-sm text-label-sm uppercase">
            20L – 30L
          </div>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between gap-space-sm">
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">Technical EDC</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xxs">Urban transit to trailhead utility featuring waterproof laptop sleeves and hidden stash pockets.</p>
</div>
<div class="flex items-center justify-between pt-space-sm">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Everyday Commute</span>
<span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
</div>
</div>
</a>
<!-- Card 4 -->
<a class="group relative flex flex-col bg-surface-container rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" href="?page=products">
<div class="relative w-full aspect-[4/5] overflow-hidden bg-surface-dim">
<div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" data-alt="Macro flat-lay photo of outdoor equipment modular attachments, tactical hip pouch, orange raincover, carabiners, and water bottle sling on slate gray rock." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDZ1oexhdgskVDizMwjA8GmEiSETyDyIc0WRb03RKLIkLLfV7Ay8UIaoKmfFIZp7HCdIqBGmAgDu6tKfAoIC1rNEOfXqV7agTgGKd_45RFKcnOYoUrlflsali5CMkk7xA4jyG58p58U0GZHDprTP9LK-Vj6Eyg19_hrttKCNBp30mCjiwagvOYmctc4fHcey4FxK9qRFxEg9aTlwqaFErNpzLlsfd5DqUsQDq2ZCDrDo4nJdJ8hUlAw')">
</div>
<div class="absolute top-space-sm left-space-sm bg-tertiary-container text-on-tertiary-container px-space-xs py-space-xxs rounded-DEFAULT font-label-sm text-label-sm uppercase">
            System Addons
          </div>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between gap-space-sm">
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">Modular Systems</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xxs">Weatherproof storm shields, hydration reservoirs, and quick-release sternum pouches.</p>
</div>
<div class="flex items-center justify-between pt-space-sm">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Custom Rigging</span>
<span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
</div>
</div>
</a>
</div>
</section>

<!-- 3. FEATURED / BEST SELLER PACKS -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl bg-surface-container-low" id="catalog">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-space-2xl gap-space-sm">
<div>
<div class="inline-flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-widest mb-space-xxs">
<span class="material-symbols-outlined text-base">award_star</span> Alpine Division Favorites
        </div>
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface">Field Proven Flagships</h2>
</div>
<div class="flex items-center gap-space-xs overflow-x-auto pb-space-xxs" id="filterTabs">
<a href="?page=products" class="px-space-md py-space-xs rounded-DEFAULT bg-inverse-surface text-inverse-on-surface font-label-md text-label-md uppercase tracking-wider">All Packs</a>
</div>
</div>

<!-- Interactive Product Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-space-lg">
<?php foreach ($bestSellers as $p): ?>
<!-- Product -->
<div class="group relative flex flex-col bg-surface-container-lowest rounded-DEFAULT overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
<div class="relative w-full aspect-[4/5] bg-surface-container-high overflow-hidden">
<a href="?page=product&id=<?= $p['id'] ?>" class="block w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('<?= e(product_image_url($p['image'])) ?>')"></a>

<?php if ($p['badge']): ?>
<span class="absolute top-space-sm left-space-sm px-space-xs py-space-xxs <?= $p['badge']=='sold out'?'bg-error text-on-error':'bg-primary text-on-primary' ?> font-label-sm text-label-sm uppercase rounded-DEFAULT tracking-wider shadow">
    <?= htmlspecialchars($p['badge']) ?>
</span>
<?php endif; ?>

<button aria-label="Add to wishlist" class="wishlist-btn absolute top-space-sm right-space-sm p-space-xs bg-surface/80 hover:bg-surface text-on-surface rounded-full backdrop-blur-sm transition-colors">
<span class="material-symbols-outlined text-xl">favorite_border</span>
</button>
</div>
<div class="p-space-lg flex flex-col flex-1 justify-between">
<div class="flex flex-col gap-space-xs">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm uppercase text-outline"><?= htmlspecialchars(material_flag($p['material'])) ?> • <?= htmlspecialchars($p['grade']) ?></span>
<div class="flex items-center text-tertiary text-sm">
<span class="material-symbols-outlined text-base fill-1" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="font-label-sm text-label-sm font-bold ml-1">4.9</span>
</div>
</div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface font-bold"><a href="?page=product&id=<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></a></h3>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2"><?= htmlspecialchars($p['description']) ?></p>
</div>
<div class="mt-space-lg pt-space-sm flex items-center justify-between bg-surface-container-low px-space-sm py-space-xs rounded-DEFAULT">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm uppercase text-outline">Price</span>
<span class="font-headline-sm text-headline-sm font-bold text-on-surface"><?= rupiah($p['price']) ?></span>
</div>
<form method="POST">
    <input type="hidden" name="do" value="add_to_cart">
    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
    <input type="hidden" name="redirect" value="?page=home">
    <button type="submit" class="add-to-cart-btn px-space-md py-space-xs bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md uppercase rounded-DEFAULT transition-colors flex items-center gap-space-xxs" <?= $p['stock'] <= 0 ? 'disabled style="opacity:.5"' : '' ?>>
    <span class="material-symbols-outlined text-base">add_shopping_cart</span> Add
    </button>
</form>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</section>

<!-- 4. WHY CHOOSE DND -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl bg-surface">
<div class="max-w-3xl mb-space-2xl">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary">Archival Engineering &amp; Materials</span>
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface mt-space-xxs">Precision Built For Failure-Free Exploration</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant mt-space-sm">
        Every seam, buckled strap, and structural rib is stress-tested in Sub-Zero alpine wind tunnels and 100-kilometer continuous abrasion tracks.
      </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg">
<div class="p-space-xl bg-surface-container-low rounded-DEFAULT flex flex-col gap-space-md shadow-sm">
<div class="w-12 h-12 rounded-DEFAULT bg-primary-container text-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">shield</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">Dragonhide™ 500D Ripstop</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">
            Tear-proof diamond weave nylon reinforced with TPU weatherproof laminate resistant to jagged granite and icy crusts.
          </p>
</div>
<div class="mt-auto pt-space-sm font-label-sm text-label-sm uppercase text-outline tracking-wider">
          Tensile: 420 N/cm
        </div>
</div>
<div class="p-space-xl bg-surface-container-low rounded-DEFAULT flex flex-col gap-space-md shadow-sm">
<div class="w-12 h-12 rounded-DEFAULT bg-secondary text-on-secondary flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">accessibility_new</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">Dynamic Vertebrae™</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">
            Contoured 7075 aluminum stay frame channeling up to 80% of backpack payload straight onto pelvic lumbar stabilizers.
          </p>
</div>
<div class="mt-auto pt-space-sm font-label-sm text-label-sm uppercase text-outline tracking-wider">
          Load Index: 35kg Max
        </div>
</div>
<div class="p-space-xl bg-surface-container-low rounded-DEFAULT flex flex-col gap-space-md shadow-sm">
<div class="w-12 h-12 rounded-DEFAULT bg-tertiary-container text-on-tertiary-container flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">grid_view</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">Modular North-Mount</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">
            Multi-point anchoring daisy chains precision laser-cut for seamless docking of crampon quivers, dry bags, and GPS sensors.
          </p>
</div>
<div class="mt-auto pt-space-sm font-label-sm text-label-sm uppercase text-outline tracking-wider">
          Universal 25mm Webbing
        </div>
</div>
<div class="p-space-xl bg-surface-container-low rounded-DEFAULT flex flex-col gap-space-md shadow-sm">
<div class="w-12 h-12 rounded-DEFAULT bg-inverse-surface text-inverse-on-surface flex items-center justify-center">
<span class="material-symbols-outlined text-2xl">handyman</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm uppercase text-on-surface">Ironclad Warranty</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">
            If a buckle snaps or an alpine seam tears on trail, send it back. We repair or replace it unconditionally for life.
          </p>
</div>
<div class="mt-auto pt-space-sm font-label-sm text-label-sm uppercase text-outline tracking-wider">
          Global Depot Coverage
        </div>
</div>
</div>
<div class="mt-space-2xl bg-inverse-surface text-inverse-on-surface p-space-xl rounded-DEFAULT flex flex-col lg:flex-row items-center justify-between gap-space-xl">
<div class="flex flex-col gap-space-xs max-w-xl">
<div class="font-label-sm text-label-sm uppercase text-primary-fixed tracking-widest">Architectural Geometry</div>
<h3 class="font-headline-md text-headline-md uppercase">Calculated Center of Gravity (CoG)</h3>
<p class="font-body-md text-body-md text-surface-container-high/80">
          Unlike ordinary hiking packs that drag backward on your shoulders, DND's reverse wedge geometry pulls weight inward towards your natural spine line, saving up to 18% metabolic energy on steep climbs.
        </p>
</div>
<div class="w-full lg:w-96 flex flex-col items-center bg-surface-container-low/10 p-space-md rounded-DEFAULT">
<svg class="w-full h-auto text-primary-fixed" fill="none" stroke="currentColor" viewBox="0 0 320 120">
<line stroke="currentColor" stroke-dasharray="4 4" stroke-opacity="0.4" stroke-width="1.5" x1="20" x2="300" y1="100" y2="100"></line>
<path d="M 30 90 Q 90 20 160 40 T 290 85" fill="none" stroke="currentColor" stroke-width="2.5"></path>
<circle cx="160" cy="40" fill="#c2542d" r="5" stroke="#ffffff" stroke-width="2"></circle>
<circle cx="90" cy="55" fill="currentColor" r="4"></circle>
<circle cx="230" cy="62" fill="currentColor" r="4"></circle>
<text fill="#ffffff" font-family="Space Grotesk" font-size="10" font-weight="bold" x="170" y="38">COG PINPOINT</text>
<text fill="#dec0b7" font-family="Space Grotesk" font-size="9" x="30" y="112">LUMBAR BASE</text>
<text fill="#dec0b7" font-family="Space Grotesk" font-size="9" x="230" y="112">TORSO AXIS</text>
</svg>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-surface-container-high mt-space-xs">Standard Load Equilibrium (35° Incline)</span>
</div>
</div>
</section>

<!-- 5. MOUNTAIN GUIDE TESTIMONIALS -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl bg-surface-container">
<div class="text-center max-w-2xl mx-auto mb-space-2xl">
<div class="inline-flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-widest mb-space-xxs">
<span class="material-symbols-outlined text-base">verified</span> Certified Field Guides
      </div>
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface">Trusted at 4,000+ Meters</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-space-xs">
        Real feedback from expedition leads testing prototypes across the Appalachian Trail, the Swiss Alps, and the North Cascades.
      </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg">
<div class="p-space-xl bg-surface-container-lowest rounded-DEFAULT flex flex-col justify-between shadow-sm">
<div class="flex flex-col gap-space-sm">
<div class="flex items-center text-tertiary">
<span class="material-symbols-outlined fill-1">star</span><span class="material-symbols-outlined fill-1">star</span><span class="material-symbols-outlined fill-1">star</span><span class="material-symbols-outlined fill-1">star</span><span class="material-symbols-outlined fill-1">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
            "I hauled the Frostpeak 65L through 12 days on the Haute Route in whiteout conditions. Zero water ingress, and the suspension spared my clavicles even with two 4-season tents strapped to the sides."
          </p>
</div>
<div class="pt-space-lg mt-space-md flex items-center gap-space-sm">
<img class="w-12 h-12 rounded-full object-cover" data-alt="Guide 1" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8G5KqK1k9tT4h6foldPuN2BmGmtazOXxQXH1pGNV8kEpc0X2TK1tfp4X_4NAqr5eCzGWGDlBqPnG-1t8BSUq6YFBXaBXL_4PrYH_tdzeN372xLKcs6XKtIMoKhg3H9xNueGBn50A-AghDAl7j_5op3F404bOnlxGadYlu6FBR0wJ9bJcaQD1_KtIX0AGNUmYkei6qp6fcXEeTx3Csd-TVukQBwdCLwuE35VIg-lg7-6dAz9myAmHa">
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm uppercase text-on-surface text-base">Marcus Vance</span>
<span class="font-label-sm text-label-sm uppercase text-primary font-bold">IFMGA Certified Alpine Guide</span>
</div>
</div>
</div>
</div>
</section>

<!-- Interactive Modal for Field Film -->
<div class="fixed inset-0 z-50 bg-inverse-surface/80 backdrop-blur-md hidden items-center justify-center p-margin-mobile" id="filmModal">
<div class="bg-surface-container-lowest max-w-2xl w-full rounded-DEFAULT overflow-hidden shadow-2xl flex flex-col">
<div class="p-space-md bg-inverse-surface text-inverse-on-surface flex items-center justify-between">
<span class="font-label-md text-label-md uppercase tracking-wider">Field Report: North Cascade Range</span>
<button class="p-space-xxs text-inverse-on-surface hover:text-primary-fixed" id="closeFilmModal">
<span class="material-symbols-outlined text-2xl">close</span>
</button>
</div>
<div class="p-space-xl flex flex-col gap-space-md">
<div class="w-full aspect-video bg-inverse-surface rounded-DEFAULT flex items-center justify-center relative overflow-hidden">
<div class="w-full h-full bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAu308_6mdDTpfIcKldgZOkjsWlhGAdmHPzd71B7dlHULE9bJZa2ZX0C7dxFxgi92veKy8fol1v7wROzrTGz5KabTdEyidishXx_6LvUCkU2xh9a-_y_kneLEudlubGYXnwGDVi6XpDMEWvUG11T-39uoEMZQqW8FJjQuaNkeZbPZXyHcOzU7Tc_VKoptOH8SRZCmC20w1HWA6AzaGV_krXojtPk_ozdslSHWFG4RhdAd2ksjihKtuI')">
</div>
<div class="absolute inset-0 bg-black/40 flex items-center justify-center">
<span class="material-symbols-outlined text-6xl text-white">full_hd</span>
</div>
</div>
<h4 class="font-headline-sm text-headline-sm uppercase text-on-surface">The 100-Mile Ridge Line Test</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">
          Watch our lead designers put the Frostpeak 65L through sub-zero blizzards, scree screeds, and waterfall crossings to ensure stitch-by-stitch reliability.
        </p>
</div>
</div>
</div>

<script>
  // Micro-interactions and interactive behaviors
  document.addEventListener('DOMContentLoaded', () => {
    // 1. Film Modal Toggle
    const filmModal = document.getElementById('filmModal');
    const openBtn = document.getElementById('openFilmModal');
    const closeBtn = document.getElementById('closeFilmModal');

    if (openBtn && filmModal && closeBtn) {
      openBtn.addEventListener('click', () => {
        filmModal.classList.remove('hidden');
        filmModal.classList.add('flex');
      });
      closeBtn.addEventListener('click', () => {
        filmModal.classList.add('hidden');
        filmModal.classList.remove('flex');
      });
      filmModal.addEventListener('click', (e) => {
        if (e.target === filmModal) {
          filmModal.classList.add('hidden');
          filmModal.classList.remove('flex');
        }
      });
    }

    // 2. Wishlist Buttons Toggle
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const icon = btn.querySelector('.material-symbols-outlined');
        if (icon.textContent === 'favorite_border') {
          icon.textContent = 'favorite';
          icon.style.fontVariationSettings = "'FILL' 1";
          btn.classList.add('text-primary');
        } else {
          icon.textContent = 'favorite_border';
          icon.style.fontVariationSettings = "'FILL' 0";
          btn.classList.remove('text-primary');
        }
      });
    });
  });
</script>
