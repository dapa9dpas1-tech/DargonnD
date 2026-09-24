<?php
?>
<main class="w-full pt-20 bg-background min-h-screen">
<div class="flex flex-col w-full">
<!-- Topographic Contour / Grid Ambience Header -->
<section class="relative w-full bg-surface-container-low px-margin-mobile md:px-margin-desktop py-space-3xl overflow-hidden">
<div class="absolute inset-0 opacity-10 pointer-events-none">
<svg class="w-full h-full" height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
<defs>
<pattern height="48" id="alpine-grid" patternunits="userSpaceOnUse" width="48">
<path class="text-on-surface" d="M 48 0 L 0 0 0 48" fill="none" stroke="currentColor" stroke-width="0.75"></path>
<circle class="text-primary" cx="24" cy="24" fill="currentColor" r="1"></circle>
</pattern>
</defs>
<rect fill="url(#alpine-grid)" height="100%" width="100%"></rect>
</svg>
</div>
<div class="relative z-10 max-w-5xl mx-auto flex flex-col items-center text-center">
<!-- Breadcrumb -->
<nav aria-label="Breadcrumb" class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm uppercase tracking-widest mb-space-sm">
<a class="hover:text-primary transition-colors" href="#">HOME</a>
<span>/</span>
<a class="hover:text-primary transition-colors" href="#">FIELD SUPPORT</a>
<span>/</span>
<span class="text-primary font-bold">FAQ &amp; CONTACT</span>
</nav>
<!-- Badge / Terminal Callout -->
<div class="inline-flex items-center gap-space-xs bg-surface px-space-sm py-space-xxs rounded-DEFAULT shadow-sm mb-space-md">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
<span class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface">BASECAMP COMMS &amp; EXPEDITION DISPATCH // 24/7 ALPINE SUPPORT</span>
</div>
<!-- Main Headline -->
<h1 class="font-headline-lg text-headline-lg text-on-surface uppercase tracking-tight max-w-3xl mb-space-sm">
        Technical Assistance &amp; Contact Basecamp
      </h1>
<!-- Subtitle -->
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mb-space-xl">
        Find verified answers regarding 1000D Cordura specs, lifetime warranty, torso harness calibration, or establish a direct transmission with a DND rig technician.
      </p>
<!-- Alpine Technical Search Bar -->
<div class="w-full max-w-2xl bg-surface-container-lowest p-space-xs rounded-DEFAULT shadow-md flex items-center gap-space-xs">
<span class="material-symbols-outlined text-outline text-2xl ml-space-xs">manage_search</span>
<input class="bg-transparent font-body-md text-body-md text-on-surface placeholder:text-outline w-full focus:outline-none px-space-xs" id="faqSearchInput" onkeyup="filterFaqs()" placeholder="Search for questions (e.g., warranty claims, expedition shipping, torso capacity)..." type="text"/>
<button class="bg-primary-container text-on-primary-container font-label-md text-label-md uppercase px-space-lg py-space-xs rounded-DEFAULT hover:bg-primary transition-colors flex-shrink-0 flex items-center gap-space-xxs" type="button">
<span>Find</span>
<span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
<!-- Quick Metrics Strip -->
<div class="flex flex-wrap justify-center items-center gap-space-md mt-space-lg text-on-surface-variant font-label-sm text-label-sm uppercase">
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-base text-primary">verified_user</span>
          Average Response: &lt; 15 Minutes
        </span>
<span class="text-outline-variant">•</span>
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-base text-primary">build_circle</span>
          Repair Service: 100% Free for Life
        </span>
<span class="text-outline-variant">•</span>
<span class="flex items-center gap-1">
<span class="material-symbols-outlined text-base text-primary">near_me</span>
          Bandung Alpine Lab Terminal: Online
        </span>
</div>
</div>
</section>
<!-- Quick Help Channels Grid (3 Cards) -->
<section class="w-full px-margin-mobile md:px-margin-desktop -mt-8 relative z-20">
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-lg max-w-7xl mx-auto">
<!-- Card 1: WhatsApp Hotline -->
<div class="bg-surface-container p-space-lg rounded-DEFAULT shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="p-space-sm bg-primary text-on-primary rounded-DEFAULT">
<span class="material-symbols-outlined text-2xl">chat</span>
</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider bg-surface-container-high px-space-xs py-space-xxs rounded-DEFAULT text-on-surface-variant">24/7 Hotline</span>
</div>
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">WhatsApp &amp; Signal Hotline</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
            Quick consultation on back load adjustments, volume selection, and emergency summit readiness confirmation.
          </p>
</div>
<div>
<div class="p-space-xs bg-surface-container-low rounded-DEFAULT mb-space-md flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface uppercase font-bold">+62 811-DND-GEAR</span>
<span class="material-symbols-outlined text-primary text-sm">cell_tower</span>
</div>
<a class="inline-flex items-center gap-space-xs font-label-md text-label-md uppercase text-primary font-bold group-hover:text-primary-container transition-colors" href="https://wa.me/628113634327" rel="noopener noreferrer" target="_blank">
<span>Open WhatsApp Transmission</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
</div>
<!-- Card 2: Field Warranty & Repair -->
<div class="bg-surface-container p-space-lg rounded-DEFAULT shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="p-space-sm bg-inverse-surface text-inverse-on-surface rounded-DEFAULT">
<span class="material-symbols-outlined text-2xl">construction</span>
</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider bg-surface-container-high px-space-xs py-space-xxs rounded-DEFAULT text-on-surface-variant">Lifetime Warranty</span>
</div>
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Warranty Claims &amp; Repairs</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
            Restitching ballistic nylon seams, replacing cracked Duraflex buckles, and free YKK Aquaguard zipper services for life.
          </p>
</div>
<div>
<div class="p-space-xs bg-surface-container-low rounded-DEFAULT mb-space-md flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface uppercase font-bold">Basecamp Rigging Bay #04</span>
<span class="material-symbols-outlined text-secondary text-sm">shield</span>
</div>
<a class="inline-flex items-center gap-space-xs font-label-md text-label-md uppercase text-primary font-bold group-hover:text-primary-container transition-colors" href="#dispatch-form" onclick="selectCategory('Field Warranty Claim')">
<span>Start Service Registration</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
</div>
<!-- Card 3: Physical Alpine Lab -->
<div class="bg-surface-container p-space-lg rounded-DEFAULT shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
<div>
<div class="flex items-center justify-between mb-space-md">
<span class="p-space-sm bg-tertiary-container text-on-tertiary-container rounded-DEFAULT">
<span class="material-symbols-outlined text-2xl">location_on</span>
</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider bg-surface-container-high px-space-xs py-space-xxs rounded-DEFAULT text-on-surface-variant">Lab &amp; Workshop</span>
</div>
<h2 class="font-headline-sm text-headline-sm text-on-surface mb-space-xs">Physical Office &amp; Workshop</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
            Visit Basecamp Bandung Alpine Lab in Dago highlands. Direct torso measurement and consultation for heavy expedition loads.
          </p>
</div>
<div>
<div class="p-space-xs bg-surface-container-low rounded-DEFAULT mb-space-md flex items-center justify-between">
<span class="font-label-md text-label-md text-on-surface uppercase font-bold">Sen - Sab // 08:00 - 18:00 WIB</span>
<span class="material-symbols-outlined text-tertiary text-sm">schedule</span>
</div>
<a class="inline-flex items-center gap-space-xs font-label-md text-label-md uppercase text-primary font-bold group-hover:text-primary-container transition-colors" href="#basecamp-coordinates">
<span>Check Map Coordinates</span>
<span class="material-symbols-outlined text-base transition-transform group-hover:translate-x-1">arrow_forward</span>
</a>
</div>
</div>
</div>
</section>
<!-- Editorial Alpine Workshop Visual Break -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl">
<div class="max-w-7xl mx-auto bg-inverse-surface rounded-DEFAULT overflow-hidden relative shadow-xl text-inverse-on-surface">
<div class="grid grid-cols-1 lg:grid-cols-12">
<div class="lg:col-span-7 relative min-h-[320px] lg:min-h-[420px]">
<img class="w-full h-full object-cover object-center" data-alt="Technical gear craftsmen and backpack tailors inside the rustic alpine Dragon North Division workshop sewing terracotta Cordura mountaineering backpacks against panoramic cold snowy alpine jagged peaks through massive timber window frame, cinematic warm diffused light, industrial sewing tables, spools of heavy thread and climbing ropes" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBl5gQiYMbp_uPwD8O6Vsg4OEviVxrrFN_kDq9Rc1ucSwniDlHIdp7mMqz2xldV7VNgH8Xb3Biouer6tb_YJj1AEGXJFWMSlFpBqDO9b0PkP1504DUKpHpe6rlr5ZeWPjY0eAv5cv-_-J3qvKMhaNlOTIoMp_GiR3kp301ADfkGiOIf7rjXEq6HRffgvUKL9nbd8C3Q9UnnJCKd8D4RdlO6u323rODTj2chVJE8azGo2XtvfDM_mRnP"/>
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface via-transparent to-transparent lg:bg-gradient-to-r"></div>
<div class="absolute top-4 left-4 bg-inverse-surface/80 backdrop-blur-md px-space-sm py-space-xxs rounded-DEFAULT flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary-fixed text-sm">satellite_alt</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-surface-container-high">BANDUNG ALPINE LAB PROTO-SHOP</span>
</div>
</div>
<div class="lg:col-span-5 p-space-xl flex flex-col justify-center">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary-fixed mb-space-xs">MANUFACTURING &amp; MATERIAL INTEGRITY</span>
<h2 class="font-headline-md text-headline-md uppercase text-inverse-on-surface mb-space-md">
            Designed at Altitude, Tested on Granite Rock
          </h2>
<p class="font-body-md text-body-md text-surface-dim mb-space-lg">
            Every DND carrier is assembled by certified mountaineering craftsmen. We understand that a backpack tearing in a storm is not just an inconvenience, but a safety risk for climbers.
          </p>
<div class="grid grid-cols-2 gap-space-md pt-space-xs">
<div class="p-space-sm bg-inverse-surface/60 rounded-DEFAULT">
<p class="font-headline-sm text-headline-sm text-primary-fixed">1000D</p>
<p class="font-label-sm text-label-sm uppercase text-surface-dim">Cordura Invista Ballistic</p>
</div>
<div class="p-space-sm bg-inverse-surface/60 rounded-DEFAULT">
<p class="font-headline-sm text-headline-sm text-primary-fixed">100%</p>
<p class="font-label-sm text-label-sm uppercase text-surface-dim">Seam Taped Waterproofing</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Technical FAQ Section: Tabs & Accordion -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-xl bg-surface">
<div class="max-w-7xl mx-auto">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between mb-space-2xl gap-space-md">
<div>
<div class="flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-wider mb-space-xxs">
<span class="material-symbols-outlined text-base">help_outline</span>
<span>FIELD QUESTION DIRECTORY</span>
</div>
<h2 class="font-headline-lg text-headline-lg uppercase text-on-surface">Technical Answer Center</h2>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant max-w-md">
          List of manual instructions, expedition regulations, material formulation, and independent maintenance steps for DND backpacks.
        </p>
</div>
<!-- Category Filter Tabs -->
<div class="flex items-center gap-space-xs overflow-x-auto pb-space-sm mb-space-xl no-scrollbar">
<button class="faq-tab-btn px-space-md py-space-xs rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-all bg-on-surface text-surface shadow-sm" onclick="setFaqTab('all', this)">
          All FAQs (5)
        </button>
<button class="faq-tab-btn px-space-md py-space-xs rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-all bg-surface-container-low text-on-surface hover:bg-surface-container" onclick="setFaqTab('garansi', this)">
          Warranty &amp; Repair
        </button>
<button class="faq-tab-btn px-space-md py-space-xs rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-all bg-surface-container-low text-on-surface hover:bg-surface-container" onclick="setFaqTab('pengiriman', this)">
          Shipping &amp; Tracking
        </button>
<button class="faq-tab-btn px-space-md py-space-xs rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-all bg-surface-container-low text-on-surface hover:bg-surface-container" onclick="setFaqTab('torso', this)">
          Torso Size Guide
        </button>
<button class="faq-tab-btn px-space-md py-space-xs rounded-DEFAULT font-label-md text-label-md uppercase tracking-wider transition-all bg-surface-container-low text-on-surface hover:bg-surface-container" onclick="setFaqTab('material', this)">
          Maintenance &amp; Cordura
        </button>
</div>
<!-- FAQ Accordion Container -->
<div class="space-y-space-md max-w-4xl mx-auto" id="faqList">
<!-- FAQ Item 1 -->
<div class="faq-item bg-surface-container-low rounded-DEFAULT overflow-hidden shadow-sm transition-all" data-category="garansi" data-search="garansi seumur hidup lifetime gear warranty dnd perbaikan jahitan buckle duraflex aluminium zipper ykk">
<button class="w-full p-space-lg text-left flex items-start justify-between gap-space-md hover:bg-surface-container transition-colors" onclick="toggleAccordion(this)" type="button">
<div class="flex items-start gap-space-md">
<span class="font-label-md text-label-md text-primary font-bold pt-1">01/</span>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Warranty &amp; Repair</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Bagaimana cara kerja Lifetime Warranty (Lifetime Gear Warranty) DND?</h3>
</div>
</div>
<span class="material-symbols-outlined text-2xl text-on-surface transition-transform duration-200 accordion-icon">expand_more</span>
</button>
<div class="faq-content hidden px-space-lg pb-space-lg pt-space-xs">
<div class="pl-space-xl">
<p class="font-body-md text-body-md text-on-surface-variant mb-space-md">
                Every DND backpack is covered by a lifetime warranty for manufacturing technical failures: mil-spec nylon thread seams, Duraflex polymer buckles broken under load, bent 7075-T6 aluminum internal frames, and stuck YKK Aquaguard zippers.
              </p>
<div class="bg-surface p-space-md rounded-DEFAULT flex flex-col sm:flex-row items-start sm:items-center justify-between gap-space-sm">
<div>
<p class="font-label-sm text-label-sm uppercase font-bold text-on-surface">Field Claim Stages:</p>
<p class="font-body-sm text-body-sm text-outline">Submit damage photos via the form below &gt; Get a Repair Dispatch Code &gt; Send to Basecamp Bandung.</p>
</div>
<button class="bg-primary-container text-on-primary-container font-label-sm text-label-sm uppercase px-space-md py-space-xs rounded-DEFAULT whitespace-nowrap" onclick="selectCategory('Field Warranty Claim'); document.getElementById('dispatch-form').scrollIntoView({behavior: 'smooth'});">
                  Submit Service
                </button>
</div>
</div>
</div>
</div>
<!-- FAQ Item 2 -->
<div class="faq-item bg-surface-container-low rounded-DEFAULT overflow-hidden shadow-sm transition-all" data-category="torso" data-search="ukuran torso sebelum membeli carrier 45l 55l 65l c7 leher puncak tulang pinggul iliac crest harness">
<button class="w-full p-space-lg text-left flex items-start justify-between gap-space-md hover:bg-surface-container transition-colors" onclick="toggleAccordion(this)" type="button">
<div class="flex items-start gap-space-md">
<span class="font-label-md text-label-md text-primary font-bold pt-1">02/</span>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Torso Size Guide</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">How to determine the right torso size before buying a 45L / 55L / 65L carrier?</h3>
</div>
</div>
<span class="material-symbols-outlined text-2xl text-on-surface transition-transform duration-200 accordion-icon">expand_more</span>
</button>
<div class="faq-content hidden px-space-lg pb-space-lg pt-space-xs">
<div class="pl-space-xl">
<p class="font-body-md text-body-md text-on-surface-variant mb-space-md">
                Measure the distance from the C7 neck bone bump (prominent when the head is tilted) along the spinal contour to the point parallel to the iliac crest:
              </p>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm mb-space-md">
<div class="p-space-sm bg-surface rounded-DEFAULT">
<span class="font-label-md text-label-md text-primary font-bold uppercase">Torso Regular (S/M)</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Length: 43 cm – 49 cm. Suitable for heights 155 cm – 174 cm with standard hip circumference.</p>
</div>
<div class="p-space-sm bg-surface rounded-DEFAULT">
<span class="font-label-md text-label-md text-primary font-bold uppercase">Torso Long (L/XL)</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">Length: 50 cm – 56 cm. Designed for athletic postures or heights 175 cm and above.</p>
</div>
</div>
<p class="font-body-sm text-body-sm text-outline">
                *All DND Expedition 40L+ variants feature a velcro ladder system micro-adjustment for precise load tuning up to a 5 cm shift.
              </p>
</div>
</div>
</div>
<!-- FAQ Item 3 -->
<div class="faq-item bg-surface-container-low rounded-DEFAULT overflow-hidden shadow-sm transition-all" data-category="pengiriman" data-search="berapa lama estimasi pengiriman ekspedisi jne cargo sicepat waterproof packaging resi bandung">
<button class="w-full p-space-lg text-left flex items-start justify-between gap-space-md hover:bg-surface-container transition-colors" onclick="toggleAccordion(this)" type="button">
<div class="flex items-start gap-space-md">
<span class="font-label-md text-label-md text-primary font-bold pt-1">03/</span>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Shipping &amp; Tracking</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">How long is the estimated shipping time and what couriers are used?</h3>
</div>
</div>
<span class="material-symbols-outlined text-2xl text-on-surface transition-transform duration-200 accordion-icon">expand_more</span>
</button>
<div class="faq-content hidden px-space-lg pb-space-lg pt-space-xs">
<div class="pl-space-xl">
<p class="font-body-md text-body-md text-on-surface-variant mb-space-sm">
                All orders are processed and packed within 24 hours from the Bandung dispatch basecamp. Backpacks are packed in double heavy-duty waterproof polybags to prevent moisture during transit.
              </p>
<ul class="space-y-space-xxs font-body-sm text-body-sm text-on-surface-variant mb-space-sm">
<li class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-base">check</span>
<span><strong>Java &amp; Bali Regions:</strong> 1 - 2 Business Days via JNE YES / SiCepat Best.</span>
</li>
<li class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-base">check</span>
<span><strong>Outside Java (Sumatra, Kalimantan, Sulawesi):</strong> 2 - 4 Business Days.</span>
</li>
<li class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-base">check</span>
<span><strong>Extreme Regions / Eastern Indonesia (Papua, Maluku, NTT):</strong> 4 - 6 Business Days via JNE Sea/Air Cargo.</span>
</li>
</ul>
<p class="font-label-sm text-label-sm uppercase text-outline">The tracking number (AWB) will be transmitted automatically via SMS and registered email as soon as the courier picks it up in the afternoon.</p>
</div>
</div>
</div>
<!-- FAQ Item 4 -->
<div class="faq-item bg-surface-container-low rounded-DEFAULT overflow-hidden shadow-sm transition-all" data-category="material" data-search="ransel dnd tahan air waterproof badai gunung cordura 500d 1000d dwr poliuretan storm shield">
<button class="w-full p-space-lg text-left flex items-start justify-between gap-space-md hover:bg-surface-container transition-colors" onclick="toggleAccordion(this)" type="button">
<div class="flex items-start gap-space-md">
<span class="font-label-md text-label-md text-primary font-bold pt-1">04/</span>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Perawatan &amp; Material Cordura</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Is the DND backpack 100% waterproof when hit by a mountain storm?</h3>
</div>
</div>
<span class="material-symbols-outlined text-2xl text-on-surface transition-transform duration-200 accordion-icon">expand_more</span>
</button>
<div class="faq-content hidden px-space-lg pb-space-lg pt-space-xs">
<div class="pl-space-xl">
<p class="font-body-md text-body-md text-on-surface-variant mb-space-md">
                The base material of our backpacks is <strong>1000D &amp; 500D Cordura Invista</strong> with a dual-polyurethane internal coating and water-repellent DWR coating. This layer can independently withstand light to moderate rain.
              </p>
<div class="bg-surface-container-high p-space-md rounded-DEFAULT">
<div class="flex items-center gap-space-xs text-primary font-bold font-label-md text-label-md uppercase mb-1">
<span class="material-symbols-outlined">tsunami</span>
<span>Extreme Tropical Storm Protocol</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  For strong gales and hours of heavy rain, deploy the <em>DND Waterproof Storm Shield 55L</em> (equipped with a 10,000mm hydrostatic head thermo-seal tape) which is included for free in the bottom compartment pocket of every 45L+ variant.
                </p>
</div>
</div>
</div>
</div>
<!-- FAQ Item 5 -->
<div class="faq-item bg-surface-container-low rounded-DEFAULT overflow-hidden shadow-sm transition-all" data-category="garansi" data-search="menukar ukuran retur barang tidak pas 14 hari coba coba hangtag garansi pengembalian">
<button class="w-full p-space-lg text-left flex items-start justify-between gap-space-md hover:bg-surface-container transition-colors" onclick="toggleAccordion(this)" type="button">
<div class="flex items-start gap-space-md">
<span class="font-label-md text-label-md text-primary font-bold pt-1">05/</span>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-outline block mb-1">Warranty &amp; Repair</span>
<h3 class="font-headline-sm text-headline-sm text-on-surface">Can I exchange the size or return the item if it doesn't fit my back?</h3>
</div>
</div>
<span class="material-symbols-outlined text-2xl text-on-surface transition-transform duration-200 accordion-icon">expand_more</span>
</button>
<div class="faq-content hidden px-space-lg pb-space-lg pt-space-xs">
<div class="pl-space-xl">
<p class="font-body-md text-body-md text-on-surface-variant mb-space-sm">
                Yes. We enforce a <strong>14-Day Alpine Fit Guarantee</strong>. You have 14 days from receiving the item to try the backpack with a simulated load indoors.
              </p>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
                As long as the original hangtag is intact, the material is not soiled with dirt or exposed to extreme weather, you have the right to exchange the torso size or harness type without any administration or restocking fees.
              </p>
<div class="flex items-center gap-space-sm">
<span class="font-label-sm text-label-sm uppercase text-outline">Need to exchange size now?</span>
<a class="font-label-sm text-label-sm uppercase text-primary font-bold underline underline-offset-4" href="#dispatch-form" onclick="selectCategory('Field Warranty Claim')">Submit Torso Exchange →</a>
</div>
</div>
</div>
</div>
</div>
<!-- No Results State (Hidden by default) -->
<div class="hidden text-center py-space-2xl" id="noFaqResults">
<span class="material-symbols-outlined text-4xl text-outline mb-space-xs">search_off</span>
<h4 class="font-headline-sm text-headline-sm text-on-surface">No Answers Found</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant max-w-sm mx-auto mt-space-xxs mb-space-md">
          Search terms do not match the standard FAQ directory. Please submit through the transmission form below.
        </p>
<a class="inline-block bg-primary-container text-on-primary-container font-label-md text-label-md uppercase px-space-md py-space-xs rounded-DEFAULT" href="#dispatch-form">
          Send Specific Question
        </a>
</div>
</div>
</section>
<!-- Dispatch / Contact Form Section (Split Layout) -->
<section class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl bg-surface-container-low" id="dispatch-form">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-2xl">
<!-- Left Side: Interactive Dispatch Form (7 Cols) -->
<div class="lg:col-span-7 bg-surface-container-lowest p-space-xl rounded-DEFAULT shadow-md flex flex-col justify-between">
<div>
<!-- Form Header -->
<div class="flex items-center justify-between mb-space-sm">
<div class="flex items-center gap-space-xs text-primary font-label-sm text-label-sm uppercase tracking-wider">
<span class="material-symbols-outlined text-base">send_and_archive</span>
<span>BASECAMP TRANSMISSION TERMINAL</span>
</div>
<span class="font-label-sm text-label-sm uppercase bg-surface-container px-space-xs py-space-xxs rounded-DEFAULT text-on-surface-variant">FORM ID: DND-REP-2024</span>
</div>
<h2 class="font-headline-md text-headline-md uppercase text-on-surface mb-space-xs">Send a Signal / Technical Message</h2>
<p class="font-body-md text-body-md text-on-surface-variant mb-space-xl">
              Encrypted form for warranty service requests, order adjustments, or mountain expedition sponsorship coordination.
            </p>
<!-- Form Body -->
<form class="space-y-space-md" id="expeditionForm" onsubmit="handleFormSubmit(event)">
<!-- 2-col Row: Nama & Email -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="senderName">
                    Full Name / Call Sign <span class="text-primary">*</span>
</label>
<input class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner" id="senderName" placeholder="e.g. Arya Wardhana" required="" type="text"/>
</div>
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="senderEmail">
                    Explorer Email Address <span class="text-primary">*</span>
</label>
<input class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner" id="senderEmail" placeholder="name@domain.com" required="" type="email"/>
</div>
</div>
<!-- 2-col Row: WhatsApp & Kategori -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="senderPhone">
                    Active WhatsApp / Phone Number <span class="text-primary">*</span>
</label>
<input class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner" id="senderPhone" placeholder="+62 812-XXXX-XXXX" required="" type="tel"/>
</div>
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="ticketCategory">
                    Request Category <span class="text-primary">*</span>
</label>
<select class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner cursor-pointer" id="ticketCategory" required="">
<option value="Pertanyaan Produk">Gear Specification Consultation</option>
<option value="Klaim Garansi Lapangan">Field Warranty &amp; Repair Claim</option>
<option value="Status Pesanan">Shipping / Tracking Status</option>
<option value="Penukaran Ukuran Torso">Torso Size Exchange (14 Days)</option>
<option value="Kemitraan Ekspedisi">Collaboration / Summit Expedition</option>
</select>
</div>
</div>
<!-- Single Row: Order Number -->
<div class="flex flex-col gap-space-xxs">
<div class="flex items-center justify-between">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="invoiceNumber">
                    Order / Invoice Number
                  </label>
<span class="font-label-sm text-label-sm text-outline uppercase">Optional if available</span>
</div>
<input class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner" id="invoiceNumber" placeholder="e.g. DND-INV-89241" type="text"/>
</div>
<!-- Single Row: Message Details -->
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface" for="messageContent">
                  Message &amp; Damage Chronology / Question <span class="text-primary">*</span>
</label>
<textarea class="bg-surface-container-low font-body-md text-body-md text-on-surface p-space-sm rounded-DEFAULT focus:outline-none focus:bg-surface shadow-inner resize-none" id="messageContent" placeholder="Write detailed specifications or chronology of buckle / zipper damage in the field..." required="" rows="4"></textarea>
</div>
<!-- Dropzone Upload Area -->
<div class="flex flex-col gap-space-xxs">
<label class="font-label-md text-label-md uppercase tracking-wider text-on-surface">
                  Attachment of Damage Photos / Proof of Purchase
                </label>
<div class="bg-surface-container-low hover:bg-surface-container p-space-lg rounded-DEFAULT text-center cursor-pointer transition-colors shadow-inner flex flex-col items-center justify-center gap-space-xs" id="dropzone" onclick="document.getElementById('fileInput').click()">
<span class="material-symbols-outlined text-3xl text-primary">cloud_upload</span>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold">Select Photo Document</span>
<span class="font-body-sm text-body-sm text-outline block">Drag JPG, PNG, or HEIC files here (Max 10MB)</span>
</div>
<input accept="image/*" class="hidden" id="fileInput" onchange="updateFileName(this)" type="file"/>
<span class="hidden font-label-sm text-label-sm uppercase text-primary font-bold mt-space-xxs" id="selectedFileName"></span>
</div>
</div>
<!-- Submit Button -->
<div class="pt-space-sm">
<button class="w-full bg-primary-container text-on-primary-container font-label-md text-label-md uppercase tracking-wider py-space-md rounded-DEFAULT hover:bg-primary transition-all duration-200 flex items-center justify-center gap-space-xs shadow-md active:translate-y-px" id="submitBtn" type="submit">
<span>Send Message Transmission</span>
<span class="material-symbols-outlined text-lg">arrow_forward</span>
</button>
</div>
<!-- Success Alert Box (Hidden by default) -->
<div class="hidden p-space-md bg-surface-container-high rounded-DEFAULT" id="submitAlert">
<div class="flex items-center gap-space-xs text-primary font-bold font-label-md text-label-md uppercase mb-1">
<span class="material-symbols-outlined">mark_email_read</span>
<span>Transmission Successfully Sent</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                  Ticket signal <strong>#DND-TK-8834</strong> has been logged by our Rig Technician at Basecamp Bandung. A reply will be routed to your WhatsApp number and email within 15 minutes.
                </p>
</div>
</form>
</div>
</div>
<!-- Right Side: Markas & Koordinat Lapangan Info Card (5 Cols) -->
<div class="lg:col-span-5 flex flex-col gap-space-lg" id="basecamp-coordinates">
<!-- Basecamp Physical Info Card -->
<div class="bg-surface-container p-space-xl rounded-DEFAULT shadow-md flex flex-col justify-between">
<div>
<div class="flex items-center justify-between mb-space-md">
<div class="flex items-center gap-space-xs">
<span class="w-3 h-3 rounded-full bg-tertiary animate-ping"></span>
<span class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface font-bold">CENTRAL BASECAMP TERMINAL</span>
</div>
<span class="font-label-sm text-label-sm uppercase bg-surface px-space-xs py-space-xxs rounded-DEFAULT text-primary font-bold">ELEV: 940M ASL</span>
</div>
<h2 class="font-headline-sm text-headline-sm uppercase text-on-surface mb-space-sm">
                DND Headquarters &amp; Field Coordinates
              </h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-lg">
                Ergonomic research facility and official repair workshop. Provides free load inspection and backpack fitting testing for prospective expeditions.
              </p>
<!-- Address Detail -->
<div class="space-y-space-md font-body-sm text-body-sm mb-space-lg">
<div class="flex items-start gap-space-sm">
<span class="material-symbols-outlined text-primary text-xl flex-shrink-0 pt-0.5">pin_drop</span>
<div>
<span class="font-label-sm text-label-sm uppercase text-outline block font-bold">Physical Workshop Address:</span>
<p class="text-on-surface"> Jl. Sangkuriang No. 30 Cipageran, Kec Cimahi Utara, Kota Cimahi</p>
</div>
</div>
<div class="flex items-start gap-space-sm">
<span class="material-symbols-outlined text-primary text-xl flex-shrink-0 pt-0.5">explore</span>
<div>
<span class="font-label-sm text-label-sm uppercase text-outline block font-bold">GPS Navigation Coordinates:</span>
<p class="text-on-surface font-bold">LAT 6°51'42.1" S // LONG 107°37'18.4" E</p>
</div>
</div>
<div class="flex items-start gap-space-sm">
<span class="material-symbols-outlined text-primary text-xl flex-shrink-0 pt-0.5">alarm</span>
<div>
<span class="font-label-sm text-label-sm uppercase text-outline block font-bold">Workshop &amp; Repair Hours:</span>
<p class="text-on-surface">Monday – Saturday: 08:00 – 18:00 WIB<br/><span class="text-outline">Sunday &amp; Expedition Holidays: Emergency Signal Service Only</span></p>
</div>
</div>
<div class="flex items-start gap-space-sm">
<span class="material-symbols-outlined text-primary text-xl flex-shrink-0 pt-0.5">mail</span>
<div>
<span class="font-label-sm text-label-sm uppercase text-outline block font-bold">Email Transmission Channels:</span>
<p class="text-on-surface">nabil@gmail.com<br/>kaira@gmail.com</p>
</div>
</div>
</div>
</div>
<!-- Terminal Live Signal Status -->
<div class="bg-surface p-space-md rounded-DEFAULT shadow-inner flex items-center justify-between">
<div class="flex items-center gap-space-sm">
<div class="w-2.5 h-2.5 rounded-full bg-primary"></div>
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-on-surface font-bold block">Rig Comms Status</span>
<span class="font-body-sm text-body-sm text-outline">Terminal Active &amp; Response &lt; 15 Minutes</span>
</div>
</div>
<span class="material-symbols-outlined text-primary text-xl">sensors</span>
</div>
</div>
<!-- Dynamic Alpine Map Container (data-location specification) -->
<div class="rounded-DEFAULT overflow-hidden shadow-md relative group">
<div class="w-full h-64 bg-cover bg-center rounded-DEFAULT" data-location="Jl. Raya Dago Pakar Utara No. 88, Ciburial, Bandung, Jawa Barat 40198" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBjumpHAqYFlRYP35NpYPcy5cocHiOGQgejAmaNwg6bl5w_1L7vj9XZ9ELj0InTFeE-hugYo8FxWg1GCNxI1aHByWjl3bMiRFaBoPc-kc10QsMayjlP2-bhVocE1n7ijskHPrUT7ugWfB6ads2F6JqMrB_ilbm8PFTVW5Hkdnj9uuQRFMfuaULxwPbv55f8qt_DnQz8nRnd1R9m1GY4GVHkNe5no_sN3r8suQgzHfyHCdF-YN6q3NL8')">
<div class="w-full h-full bg-inverse-surface/30 group-hover:bg-inverse-surface/10 transition-colors flex flex-col justify-end p-space-md">
<div class="bg-surface-container-lowest/90 backdrop-blur-md p-space-sm rounded-DEFAULT inline-flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary">assistant_navigation</span>
<span class="font-label-sm text-label-sm uppercase font-bold text-on-surface">Open in Satellite Navigation</span>
</div>
<span class="material-symbols-outlined text-sm text-outline">open_in_new</span>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Technical Spec & Protocol Banner -->
<section class="w-full bg-surface px-margin-mobile md:px-margin-desktop py-space-2xl">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-space-md">
<div class="p-space-md bg-surface-container-low rounded-DEFAULT flex items-center gap-space-md">
<span class="material-symbols-outlined text-primary text-3xl">verified</span>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold block">MIL-SPEC STITCHING</span>
<span class="font-body-sm text-body-sm text-outline">Military standard bonded v-69 nylon thread.</span>
</div>
</div>
<div class="p-space-md bg-surface-container-low rounded-DEFAULT flex items-center gap-space-md">
<span class="material-symbols-outlined text-primary text-3xl">lock_reset</span>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold block">GUARANTEED SPARE PARTS</span>
<span class="font-body-sm text-body-sm text-outline">Duraflex &amp; Cordura webbing in stock.</span>
</div>
</div>
<div class="p-space-md bg-surface-container-low rounded-DEFAULT flex items-center gap-space-md">
<span class="material-symbols-outlined text-primary text-3xl">local_shipping</span>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold block">EXPEDITION INSURANCE</span>
<span class="font-body-sm text-body-sm text-outline">100% protection during transit.</span>
</div>
</div>
<div class="p-space-md bg-surface-container-low rounded-DEFAULT flex items-center gap-space-md">
<span class="material-symbols-outlined text-primary text-3xl">contact_support</span>
<div>
<span class="font-label-md text-label-md uppercase text-on-surface font-bold block">DND TECHNICAL DIRECTOR</span>
<span class="font-body-sm text-body-sm text-outline">Guided by certified summit practitioners.</span>
</div>
</div>
</div>
</section>
</div>
<script>
  // Interactive Accordion Handling
  function toggleAccordion(btn) {
    const content = btn.nextElementSibling;
    const icon = btn.querySelector('.accordion-icon');
    const isHidden = content.classList.contains('hidden');
    
    // Close other items
    document.querySelectorAll('.faq-content').forEach(el => {
      el.classList.add('hidden');
    });
    document.querySelectorAll('.accordion-icon').forEach(ic => {
      ic.textContent = 'expand_more';
      ic.classList.remove('rotate-180');
    });

    if (isHidden) {
      content.classList.remove('hidden');
      icon.textContent = 'expand_less';
      icon.classList.add('rotate-180');
    }
  }

  // FAQ Category Tab Filtration
  let currentCategory = 'all';
  function setFaqTab(category, btn) {
    currentCategory = category;
    
    // Update button styles
    document.querySelectorAll('.faq-tab-btn').forEach(b => {
      b.classList.remove('bg-on-surface', 'text-surface');
      b.classList.add('bg-surface-container-low', 'text-on-surface');
    });
    btn.classList.add('bg-on-surface', 'text-surface');
    btn.classList.remove('bg-surface-container-low');

    filterFaqs();
  }

  // Search and Category Combined Filter
  function filterFaqs() {
    const searchInput = document.getElementById('faqSearchInput');
    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    const items = document.querySelectorAll('.faq-item');
    let visibleCount = 0;

    items.forEach(item => {
      const category = item.getAttribute('data-category');
      const searchData = item.getAttribute('data-search') || '';
      const text = (item.innerText + ' ' + searchData).toLowerCase();

      const matchesCat = (currentCategory === 'all' || category === currentCategory);
      const matchesQuery = query === '' || text.includes(query);

      if (matchesCat && matchesQuery) {
        item.style.display = 'block';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });

    const noResults = document.getElementById('noFaqResults');
    if (noResults) {
      if (visibleCount === 0) {
        noResults.classList.remove('hidden');
      } else {
        noResults.classList.add('hidden');
      }
    }
  }

  // Auto-fill category on selection
  function selectCategory(catName) {
    const select = document.getElementById('ticketCategory');
    if (select) {
      for (let i = 0; i < select.options.length; i++) {
        if (select.options[i].text.includes(catName) || select.options[i].value === catName) {
          select.selectedIndex = i;
          break;
        }
      }
    }
  }

  // Update file input feedback
  function updateFileName(input) {
    const label = document.getElementById('selectedFileName');
    if (input.files && input.files[0]) {
      label.textContent = 'Selected file: ' + input.files[0].name;
      label.classList.remove('hidden');
    }
  }

  // Form submission handler
  function handleFormSubmit(e) {
    e.preventDefault();
    const submitBtn = document.getElementById('submitBtn');
    const alertBox = document.getElementById('submitAlert');

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="material-symbols-outlined text-lg animate-spin">refresh</span><span>Sending Signal...</span>';
    }

    setTimeout(() => {
      if (alertBox) {
        alertBox.classList.remove('hidden');
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      if (submitBtn) {
        submitBtn.innerHTML = '<span class="material-symbols-outlined text-lg">done</span><span>Transmission Successful</span>';
        submitBtn.classList.replace('bg-primary-container', 'bg-inverse-surface');
      }
      document.getElementById('expeditionForm').reset();
    }, 1000);
  }
</script>
</main>