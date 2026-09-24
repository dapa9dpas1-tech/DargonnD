<?php
$filterProducts = $pdo->query("SELECT * FROM products WHERE is_active = 1 ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Sub-Header Status & Field Breadcrumbs -->
<section class="w-full bg-surface-container-low py-space-sm px-margin-mobile md:px-margin-desktop mt-20">
<div class="flex flex-wrap items-center justify-between gap-space-sm">
<div class="flex items-center gap-space-xs font-label-sm text-label-sm uppercase tracking-wider text-outline">
<a class="hover:text-primary transition-colors" href="#">Field Outfitter</a>
<span class="text-outline-variant">/</span>
<a class="hover:text-primary transition-colors" href="#">Technical Packs</a>
<span class="text-outline-variant">/</span>
<span class="text-primary font-bold">Catalog Matrix</span>
</div>
<div class="flex items-center gap-space-md font-label-sm text-label-sm uppercase text-outline">
<div class="flex items-center gap-space-xxs">
<span class="w-2 h-2 rounded-full bg-primary inline-block"></span>
<span class="text-on-surface">Basecamp Inventory: <?= count($filterProducts) ?> Systems Active</span>
</div>
<span class="hidden sm:inline text-outline-variant">•</span>
<span class="hidden sm:inline">Altitude Certified ISO-8000</span>
</div>
</div>
</section>

<!-- Main Category Header & Controls -->
<section class="w-full px-margin-mobile md:px-margin-desktop pt-space-xl pb-space-lg">
<div class="flex flex-col lg:flex-row lg:items-end justify-between gap-space-xl pb-space-lg">
<div class="flex flex-col gap-space-xs max-w-2xl">
<div class="flex items-center gap-space-xs">
<span class="px-space-xs py-space-xxs bg-surface-container text-primary font-label-sm text-label-sm uppercase tracking-widest rounded-DEFAULT">
            Division Series 2026
          </span>
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Premium Materials</span>
</div>
<h1 class="font-headline-lg text-headline-lg uppercase tracking-tight text-on-surface">
          All Expedition &amp; Alpine Bags
        </h1>
<p class="font-body-md text-body-md text-on-surface-variant">
          Engineered load-transfer architecture, weather-sealed rolltops, and aerospace aluminum framing built for sheer granite ascents and unmapped ridgelines.
        </p>
</div>
<!-- Live Quick Stats Counter Display -->
<div class="flex items-stretch gap-space-sm self-start lg:self-auto bg-surface-container-low p-space-xs rounded-lg shadow-sm">
<div class="px-space-md py-space-xs flex flex-col">
<span class="font-headline-sm text-headline-sm text-primary"><?= count($filterProducts) ?></span>
<span class="font-label-sm text-label-sm uppercase text-outline">Packs</span>
</div>
<div class="w-px bg-outline-variant/30 my-space-xxs"></div>
<div class="px-space-md py-space-xs flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">100%</span>
<span class="font-label-sm text-label-sm uppercase text-outline">Premium</span>
</div>
</div>
</div>
<!-- Secondary Utility Bar: Search, Sorting, Layout Toggle -->
<div class="flex flex-wrap items-center justify-between gap-space-md mt-space-md pt-space-md bg-surface-container-low/60 p-space-md rounded-lg">
<div class="flex items-center gap-space-sm flex-1 min-w-[260px] max-w-md">
<div class="flex items-center bg-surface w-full px-space-sm py-space-xs rounded-DEFAULT shadow-sm">
<span class="material-symbols-outlined text-outline text-lg mr-space-xs">search</span>
<input class="bg-transparent font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none w-full" id="product-search" placeholder="Search by model, volume, or use case..." type="text">
</div>
</div>
<div class="flex items-center gap-space-md ml-auto">
<div class="flex items-center gap-space-xs">
<span class="font-label-sm text-label-sm uppercase text-outline">Sort By:</span>
<select class="bg-surface font-label-md text-label-md uppercase tracking-wider text-on-surface px-space-sm py-space-xs rounded-DEFAULT focus:outline-none shadow-sm cursor-pointer" id="product-sort">
<option value="default">Default</option>
<option value="price-asc">Price: Low to High</option>
<option value="price-desc">Price: High to Low</option>
<option value="name-asc">Name: A to Z</option>
<option value="newest">Newest First</option>
</select>
</div>
<div class="hidden sm:flex items-center bg-surface p-1 rounded-DEFAULT shadow-sm">
<button aria-label="Grid view" class="p-1 rounded bg-surface-container text-primary transition-colors" id="view-grid">
<span class="material-symbols-outlined text-lg block">grid_view</span>
</button>
<button aria-label="List view" class="p-1 rounded hover:bg-surface-container text-outline hover:text-on-surface transition-colors" id="view-list">
<span class="material-symbols-outlined text-lg block">view_list</span>
</button>
</div>
</div>
</div>
</section>

<!-- Catalog Main Body: Left Rail + Product Grid -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-lg">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
<!-- Filter Sidebar Rail (col 1-3 on Desktop) -->
<aside class="lg:col-span-3 flex flex-col gap-space-lg bg-surface-container-low/70 p-space-lg rounded-xl shadow-sm">
<div class="flex items-center justify-between pb-space-xs">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-xl">tune</span>
<span class="font-label-lg text-label-lg uppercase tracking-wider text-on-surface">Filter Gear</span>
</div>
<button class="font-label-sm text-label-sm uppercase text-outline hover:text-primary transition-colors underline decoration-outline-variant" onclick="filterProducts('all')">
            Clear All
          </button>
</div>

<!-- Filter: Material -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">Material</label>
<div class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 accent-primary cursor-pointer filter-radio" name="material" type="radio" value="all" checked onchange="filterProducts('all')">
<span class="group-hover:text-on-surface transition-colors">All Materials</span>
</label>
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 accent-primary cursor-pointer filter-radio" name="material" type="radio" value="suede" onchange="filterProducts('suede')">
<span class="group-hover:text-on-surface transition-colors">🇸🇪 Swedish Suede</span>
</label>
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 accent-primary cursor-pointer filter-radio" name="material" type="radio" value="italia" onchange="filterProducts('italia')">
<span class="group-hover:text-on-surface transition-colors">🇮🇹 Italian Leather</span>
</label>
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 accent-primary cursor-pointer filter-radio" name="material" type="radio" value="australia" onchange="filterProducts('australia')">
<span class="group-hover:text-on-surface transition-colors">🇦🇺 Australian Leather</span>
</label>
</div>
</div>
<div class="h-px bg-outline-variant/30"></div>

<!-- Filter: Grade -->
<div class="flex flex-col gap-space-xs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">Grade</label>
<div class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 rounded-DEFAULT accent-primary cursor-pointer filter-radio" name="material" type="radio" value="grade-a" onchange="filterProducts('grade-a')">
<span class="group-hover:text-on-surface transition-colors">⭐ Grade A</span>
</label>
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 rounded-DEFAULT accent-primary cursor-pointer filter-radio" name="material" type="radio" value="grade-b" onchange="filterProducts('grade-b')">
<span class="group-hover:text-on-surface transition-colors">⭐ Grade B</span>
</label>
<label class="flex items-center gap-space-xs cursor-pointer group">
<input class="w-4 h-4 rounded-DEFAULT accent-primary cursor-pointer filter-radio" name="material" type="radio" value="grade-c" onchange="filterProducts('grade-c')">
<span class="group-hover:text-on-surface transition-colors">⭐ Grade C</span>
</label>
</div>
</div>
<div class="h-px bg-outline-variant/30"></div>

<!-- Mobile Apply Filters (Hidden on Desktop) -->
<button class="lg:hidden w-full py-space-sm bg-primary text-on-primary font-label-md text-label-md uppercase rounded-DEFAULT shadow-md">
          Apply Filters
        </button>
</aside>
<!-- Products Grid Section (col 4-12 on Desktop) -->
<main class="lg:col-span-9 flex flex-col gap-space-xl">
<!-- 8 Rich Product Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-space-lg" id="product-card-container">
<?php if (empty($filterProducts)): ?>
<p class="col-span-full text-center text-on-surface-variant">No products available at this time.</p>
<?php endif; ?>

<?php foreach ($filterProducts as $p): ?>
<!-- Product Card -->
<article class="product-card group flex flex-col bg-surface-container-low rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-material="<?= $p['material'] ?>" data-grade="<?= $p['grade'] ?>" data-name="<?= strtolower($p['name']) ?>" data-price="<?= (int)$p['price'] ?>" data-id="<?= $p['id'] ?>">
<div class="relative aspect-[4/5] w-full bg-surface-container overflow-hidden">
<a href="?page=product&id=<?= $p['id'] ?>"><img class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" data-alt="<?= htmlspecialchars($p['name']) ?>" src="<?= e(product_image_url($p['image'])) ?>"></a>
<div class="absolute top-space-sm left-space-sm flex flex-col gap-space-xxs">
<?php if ($p['badge']): ?>
<span class="bg-primary text-on-primary font-label-sm text-label-sm uppercase px-space-xs py-space-xxs rounded-DEFAULT shadow-sm">
<?= htmlspecialchars($p['badge']) ?>
</span>
<?php endif; ?>
</div>
<button aria-label="Save to Wishlist" class="wishlist-btn absolute top-space-sm right-space-sm p-space-xs bg-surface/80 hover:bg-surface text-on-surface rounded-full shadow-sm transition-colors">
<span class="material-symbols-outlined text-lg">favorite_border</span>
</button>
</div>
<div class="flex flex-col p-space-md flex-1 justify-between gap-space-md">
<div class="flex flex-col gap-space-xxs">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline"><?= htmlspecialchars(material_flag($p['material'])) ?> • <?= htmlspecialchars($p['grade']) ?></span>
<div class="flex items-center text-tertiary-container gap-0.5">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="font-label-sm text-label-sm text-on-surface font-bold">4.9</span>
</div>
</div>
<h2 class="font-headline-sm text-headline-sm uppercase text-on-surface group-hover:text-primary transition-colors">
<a href="?page=product&id=<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></a>
</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2">
<?= htmlspecialchars($p['description']) ?>
</p>
</div>
<div class="flex items-center justify-between pt-space-xs border-t border-outline-variant/20">
<div class="flex items-baseline gap-space-xxs">
<span class="font-label-md text-label-md uppercase text-outline">Price</span>
<span class="font-headline-sm text-headline-sm text-on-surface font-bold"><?= rupiah($p['price']) ?></span>
</div>
</div>
<div class="grid grid-cols-2 gap-space-xs pt-space-xxs">
<a href="?page=product&id=<?= $p['id'] ?>" class="w-full py-space-xs bg-surface hover:bg-surface-container text-on-surface font-label-sm text-label-sm uppercase tracking-wider rounded-DEFAULT transition-colors text-center inline-flex items-center justify-center">
                  Specs
                </a>
<form method="POST" class="add-cart-form">
    <input type="hidden" name="do" value="add_to_cart">
    <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
    <input type="hidden" name="redirect" value="?page=products">
    <button type="submit" class="w-full py-space-xs bg-primary hover:bg-primary-container text-on-primary font-label-sm text-label-sm uppercase tracking-wider rounded-DEFAULT transition-colors shadow-sm flex items-center justify-center gap-1" <?= $p['stock'] <= 0 ? 'disabled style="opacity:.5"' : '' ?>>
    <span class="material-symbols-outlined text-base">add</span> Add
    </button>
</form>
</div>
</div>
</article>
<?php endforeach; ?>
</div>

<div class="no-results-state" id="no-results-state" style="display:none; text-align: center; padding: 40px 0;">
    <div class="nr-icon" style="font-size: 48px; margin-bottom: 20px;">🧭</div>
    <h3 class="font-headline-md text-headline-md text-on-surface">No products found</h3>
    <p class="font-body-md text-body-md text-on-surface-variant">Try a different keyword or reset the filters.</p>
</div>
</main>
</div>
</section>

<script>
    let currentFilter = 'all';

    function filterProducts(filter) {
        currentFilter = filter;
        document.querySelectorAll('.filter-radio').forEach(r => r.checked = false);
        const radio = document.querySelector(`.filter-radio[value="${filter}"]`);
        if (radio) radio.checked = true;
        applyProductView();
    }

    function matchesFilter(card, filter) {
        const material = card.dataset.material;
        const grade = card.dataset.grade;
        if (filter === 'all') return true;
        if (filter === 'suede') return material === 'suede';
        if (filter === 'italia') return material === 'italia';
        if (filter === 'australia') return material === 'australia';
        if (filter === 'grade-a') return grade === 'a';
        if (filter === 'grade-b') return grade === 'b';
        if (filter === 'grade-c') return grade === 'c';
        return true;
    }

    function applyProductView() {
        const grid = document.getElementById('product-card-container');
        const cards = Array.from(grid.querySelectorAll('.product-card'));
        const query = (document.getElementById('product-search')?.value || '').trim().toLowerCase();
        const sort = document.getElementById('product-sort')?.value || 'default';
        const noResults = document.getElementById('no-results-state');

        let visibleCount = 0;
        cards.forEach(card => {
            const inFilter = matchesFilter(card, currentFilter);
            const inSearch = !query || card.dataset.name.includes(query);
            const show = inFilter && inSearch;
            card.style.display = show ? '' : 'none';
            if (show) visibleCount++;
        });

        // sorting
        let sorted = cards.filter(c => c.style.display !== 'none');
        if (sort === 'price-asc') sorted.sort((a, b) => a.dataset.price - b.dataset.price);
        else if (sort === 'price-desc') sorted.sort((a, b) => b.dataset.price - a.dataset.price);
        else if (sort === 'name-asc') sorted.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
        else if (sort === 'newest') sorted.sort((a, b) => b.dataset.id - a.dataset.id);
        
        sorted.forEach(card => {
            grid.appendChild(card);
        });

        if (noResults) noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    document.getElementById('product-search')?.addEventListener('input', applyProductView);
    document.getElementById('product-sort')?.addEventListener('change', applyProductView);
    document.addEventListener('DOMContentLoaded', () => {
        applyProductView();

        // View toggle logic
        const gridBtn = document.getElementById('view-grid');
        const listBtn = document.getElementById('view-list');
        const productContainer = document.getElementById('product-card-container');
        if (gridBtn && listBtn && productContainer) {
            listBtn.addEventListener('click', () => {
            productContainer.classList.remove('sm:grid-cols-2', 'xl:grid-cols-3');
            productContainer.classList.add('grid-cols-1');
            listBtn.classList.add('bg-surface-container', 'text-primary');
            listBtn.classList.remove('text-outline');
            gridBtn.classList.remove('bg-surface-container', 'text-primary');
            gridBtn.classList.add('text-outline');
            });
            gridBtn.addEventListener('click', () => {
            productContainer.classList.add('sm:grid-cols-2', 'xl:grid-cols-3');
            productContainer.classList.remove('grid-cols-1');
            gridBtn.classList.add('bg-surface-container', 'text-primary');
            gridBtn.classList.remove('text-outline');
            listBtn.classList.remove('bg-surface-container', 'text-primary');
            listBtn.classList.add('text-outline');
            });
        }
    });
</script>
