<?php
$seo_title = "Dragon North Division | Built for Adventure";
$seo_desc = "Premium outdoor and adventure gear. Dragon North is your companion for every journey, passion, and courage.";

if (isset($page)) {
    switch ($page) {
        case 'about':
            $seo_title = "About Us - Dragon North Division";
            $seo_desc = "Learn about the story behind Dragon North Division and our dedication to crafting premium adventure gear.";
            break;
        case 'products':
            $seo_title = "Our Collection - Dragon North Division";
            $seo_desc = "Explore our premium collection of backpacks and outdoor gear built for your next adventure.";
            break;
        case 'contact':
            $seo_title = "Contact Us - Dragon North Division";
            $seo_desc = "Get in touch with Dragon North Division. We are ready to help you gear up for your next adventure.";
            break;
        case 'login':
        case 'register':
            $seo_title = "Account - Dragon North Division";
            break;
    }
}

// Calculate cart count
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['qty'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?= htmlspecialchars($seo_title) ?></title>
<meta name="description" content="<?= htmlspecialchars($seo_desc) ?>">
<link rel="icon" type="image/png" href="dragon_logo.png">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
<style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style>
<script src="https://cdn.tailwindcss.com"></script>
<script id="tailwind-config">
tailwind.config = {
    darkMode: "class",
    theme: {
      extend: {
        "colors": {
          "on-tertiary-container": "#fffeff",
          "outline-variant": "#dec0b7",
          "on-error": "#ffffff",
          "surface-container-high": "#ffe2dd",
          "on-tertiary-fixed-variant": "#5f4100",
          "inverse-surface": "#422a26",
          "on-background": "#2b1613",
          "error-container": "#ffdad6",
          "primary-fixed-dim": "#ffb59d",
          "tertiary-fixed-dim": "#f5bd58",
          "surface-tint": "#a33e18",
          "surface-variant": "#ffdad4",
          "tertiary-fixed": "#ffdeaa",
          "on-secondary-fixed": "#390c00",
          "on-tertiary-fixed": "#271900",
          "surface-container-highest": "#ffdad4",
          "on-primary": "#ffffff",
          "inverse-primary": "#ffb59d",
          "surface-container-lowest": "#ffffff",
          "on-primary-fixed-variant": "#832701",
          "surface": "#fff8f6",
          "tertiary": "#7b5600",
          "on-primary-fixed": "#390c00",
          "background": "#fff8f6",
          "on-secondary-fixed-variant": "#7d2d0e",
          "on-surface-variant": "#57423b",
          "tertiary-container": "#9b6d05",
          "primary-fixed": "#ffdbd0",
          "error": "#ba1a1a",
          "on-error-container": "#93000a",
          "surface-container-low": "#fff0ee",
          "on-tertiary": "#ffffff",
          "primary-container": "#c2542d",
          "outline": "#8a726a",
          "surface-container": "#ffe9e5",
          "secondary": "#9c4323",
          "primary": "#a13c17",
          "surface-bright": "#fff8f6",
          "secondary-fixed": "#ffdbcf",
          "on-secondary": "#ffffff",
          "on-surface": "#2b1613",
          "secondary-fixed-dim": "#ffb59c",
          "inverse-on-surface": "#ffedea",
          "on-primary-container": "#fffeff",
          "secondary-container": "#ff9069",
          "surface-dim": "#f8d1cb",
          "on-secondary-container": "#762808"
        },
        "borderRadius": {
          "DEFAULT": "0.125rem",
          "lg": "0.25rem",
          "xl": "0.5rem",
          "full": "0.75rem"
        },
        "spacing": {
          "gutter-desktop": "2rem",
          "margin-desktop": "3.5rem",
          "space-2xl": "3rem",
          "space-xxs": "0.25rem",
          "space-xl": "2rem",
          "gutter-mobile": "1rem",
          "space-md": "1rem",
          "space-3xl": "4.5rem",
          "space-4xl": "6rem",
          "space-sm": "0.75rem",
          "space-lg": "1.5rem",
          "space-xs": "0.5rem",
          "margin-mobile": "1.25rem"
        },
        "fontFamily": {
          "label-sm": [
            "Space Grotesk"
          ],
          "display-lg-mobile": [
            "Space Grotesk"
          ],
          "label-md": [
            "Space Grotesk"
          ],
          "headline-sm": [
            "Space Grotesk"
          ],
          "body-lg": [
            "Manrope"
          ],
          "body-sm": [
            "Manrope"
          ],
          "body-md": [
            "Manrope"
          ],
          "headline-md": [
            "Space Grotesk"
          ],
          "label-lg": [
            "Space Grotesk"
          ],
          "headline-lg": [
            "Space Grotesk"
          ],
          "display-lg": [
            "Space Grotesk"
          ],
          "headline-lg-mobile": [
            "Space Grotesk"
          ]
        },
        "fontSize": {
          "label-sm": [
            "10px",
            {"lineHeight": "14px", "letterSpacing": "0.12em", "fontWeight": "700"}
          ],
          "display-lg-mobile": [
            "38px",
            {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}
          ],
          "label-md": [
            "12px",
            {"lineHeight": "16px", "letterSpacing": "0.08em", "fontWeight": "600"}
          ],
          "headline-sm": [
            "20px",
            {"lineHeight": "28px", "letterSpacing": "0em", "fontWeight": "600"}
          ],
          "body-lg": [
            "18px",
            {"lineHeight": "28px", "letterSpacing": "-0.01em", "fontWeight": "400"}
          ],
          "body-sm": [
            "13px",
            {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "400"}
          ],
          "body-md": [
            "15px",
            {"lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "400"}
          ],
          "headline-md": [
            "28px",
            {"lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "600"}
          ],
          "label-lg": [
            "14px",
            {"lineHeight": "20px", "letterSpacing": "0.06em", "fontWeight": "600"}
          ],
          "headline-lg": [
            "40px",
            {"lineHeight": "48px", "letterSpacing": "-0.02em", "fontWeight": "700"}
          ],
          "display-lg": [
            "56px",
            {"lineHeight": "64px", "letterSpacing": "-0.03em", "fontWeight": "700"}
          ],
          "headline-lg-mobile": [
            "28px",
            {"lineHeight": "34px", "letterSpacing": "-0.01em", "fontWeight": "700"}
          ]
        }
      },
    },
  }
</script>
<style>
/* Toast Notification Style from existing system */
#toast-stack { position: fixed; top: 90px; right: 20px; z-index: 3000; display: flex; flex-direction: column; gap: 10px; max-width: 340px; }
.toast {
    background: #2b1613; border: none; border-left: 4px solid #a13c17;
    color: #fff; padding: 16px 20px; border-radius: 0.25rem; font-size: 13px; font-weight: 700; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    display: flex; align-items: center; gap: 12px; opacity: 0; transform: translateX(40px); transition: opacity 0.35s ease, transform 0.35s ease;
}
.toast.show { opacity: 1; transform: translateX(0); }
.toast.toast-error { border-left-color: #ba1a1a; }
.toast .toast-icon { font-size: 17px; flex-shrink: 0; }
</style>
</head>
<body class="bg-background font-body-md text-body-md text-on-surface antialiased">
<header class="fixed top-0 left-0 right-0 z-50 bg-surface/90 backdrop-blur-xl shadow-[0_12px_32px_-8px_rgba(62,39,35,0.08)]">
  <div class="w-full bg-inverse-surface text-inverse-on-surface text-center py-space-xxs px-space-md">
    <p class="font-label-sm text-label-sm uppercase tracking-widest text-surface-container-high">COMPLIMENTARY EXPEDITION WATERPROOF COVER WITH EVERY 45L+ PACK — WORLDWIDE SHIPPING</p>
  </div>
  <div class="h-20 w-full px-margin-mobile md:px-margin-desktop flex items-center justify-between gap-space-md">
    <a href="?page=home" class="flex items-center gap-space-sm flex-shrink-0">
      <img alt="DND Brand Emblem Logo" class="h-8 w-auto object-contain" src="dragon_logo.png" style="filter: brightness(0) saturate(100%) invert(26%) sepia(85%) saturate(1915%) hue-rotate(344deg) brightness(85%) contrast(100%);">
      <div class="flex flex-col">
        <span class="font-headline-sm text-headline-sm tracking-tight text-on-surface uppercase">DND</span>
        <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Dragon North Division</span>
      </div>
    </a>
    <nav class="hidden xl:flex items-center gap-space-lg">
      <a class="tracking-wider transition-colors <?= $active_page=='home'?'text-primary font-bold':'text-on-surface-variant hover:text-on-surface' ?>" href="?page=home">Home</a>
      <a class="font-label-md text-label-md uppercase tracking-wider transition-colors <?= $active_page=='products'?'text-primary font-bold':'text-on-surface-variant hover:text-on-surface' ?>" href="?page=products">Shop Catalog</a>
      <a class="font-label-md text-label-md uppercase tracking-wider transition-colors <?= $active_page=='about'?'text-primary font-bold':'text-on-surface-variant hover:text-on-surface' ?>" href="?page=about">About Brand</a>
      <a class="font-label-md text-label-md uppercase tracking-wider transition-colors <?= $active_page=='contact'?'text-primary font-bold':'text-on-surface-variant hover:text-on-surface' ?>" href="?page=contact">FAQ & Contact</a>
    </nav>
    <div class="flex items-center gap-space-sm sm:gap-space-md flex-shrink-0">
      <a class="relative p-space-xs text-on-surface-variant hover:text-on-surface transition-colors flex items-center justify-center" href="?page=cart">
        <span class="material-symbols-outlined text-2xl">shopping_bag</span>
        <?php if ($cart_count > 0): ?>
          <span class="absolute top-0 right-0 bg-primary-container text-on-primary-container font-label-sm text-label-sm w-4 h-4 rounded-full flex items-center justify-center"><?= $cart_count ?></span>
        <?php endif; ?>
      </a>
      <div class="pl-space-xxs flex items-center">
        <?php if (is_logged_in()): ?>
          <a class="block text-on-surface-variant hover:text-on-surface" href="?page=my_orders">
            <span class="material-symbols-outlined text-2xl">account_circle</span>
          </a>
        <?php else: ?>
          <a class="block text-on-surface-variant hover:text-on-surface font-label-md uppercase" href="?page=login">
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
<main class="w-full pt-20 bg-background min-h-screen">
<div class="flex flex-col w-full">
