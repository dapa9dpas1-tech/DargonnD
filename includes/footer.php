<?php $flash = flash_get(); ?>
</div>
</main>
<footer class="w-full bg-surface-container-low mt-space-3xl">
  <div class="w-full px-margin-mobile md:px-margin-desktop py-space-3xl">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-space-2xl">
      <div class="lg:col-span-4 flex flex-col gap-space-md">
        <div class="flex items-center gap-space-sm">
          <img alt="DND Brand Emblem Logo" class="h-8 w-auto object-contain" src="dragon_logo.png" style="filter: brightness(0) saturate(100%) invert(26%) sepia(85%) saturate(1915%) hue-rotate(344deg) brightness(85%) contrast(100%);">
          <span class="font-headline-sm text-headline-sm uppercase text-on-surface">Dragon North Division</span>
        </div>
        <p class="font-body-md text-body-md text-on-surface-variant max-w-md">Engineered alpine utility equipment forged for harsh ridgelines and unforgiving altitudes. Crafted with archival durability, ballistic Cordura nylon, and high-load distribution geometry.</p>
        <div class="flex items-center gap-space-md text-on-surface-variant pt-space-xs">
          <a class="font-label-md text-label-md uppercase text-outline hover:text-primary transition-colors" href="#">Instagram</a>
          <span class="text-outline-variant">•</span>
          <a class="font-label-md text-label-md uppercase text-outline hover:text-primary transition-colors" href="#">Strava</a>
          <span class="text-outline-variant">•</span>
          <a class="font-label-md text-label-md uppercase text-outline hover:text-primary transition-colors" href="#">YouTube</a>
        </div>
      </div>
      <div class="lg:col-span-2 flex flex-col gap-space-sm">
        <h3 class="font-label-lg text-label-lg uppercase tracking-wider text-on-surface">Collections</h3>
        <ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
          <li><a class="hover:text-primary transition-colors" href="?page=products">All Backpacks</a></li>
          <li><a class="hover:text-primary transition-colors" href="?page=products">New Releases</a></li>
        </ul>
      </div>
      <div class="lg:col-span-2 flex flex-col gap-space-sm">
        <h3 class="font-label-lg text-label-lg uppercase tracking-wider text-on-surface">Account</h3>
        <ul class="flex flex-col gap-space-xs font-body-sm text-body-sm text-on-surface-variant">
          <?php if (is_logged_in()): ?>
              <li><a class="hover:text-primary transition-colors" href="?page=my_orders">My Orders</a></li>
              <li><a class="hover:text-primary transition-colors" href="?page=cart">Cart</a></li>
              <li><a class="hover:text-primary transition-colors" href="?page=logout">Sign Out</a></li>
          <?php else: ?>
              <li><a class="hover:text-primary transition-colors" href="?page=login">Sign In</a></li>
              <li><a class="hover:text-primary transition-colors" href="?page=register">Sign Up</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="lg:col-span-4 flex flex-col gap-space-md">
        <h3 class="font-label-lg text-label-lg uppercase tracking-wider text-on-surface">Expedition Dispatch</h3>
        <p class="font-body-sm text-body-sm text-on-surface-variant">Subscribe to receive technical field notes, summit route maps, and 15% off your first pack purchase.</p>
        <form class="flex flex-col sm:flex-row gap-space-xs" onsubmit="return false;">
          <input class="bg-surface font-body-sm text-body-sm text-on-surface placeholder:text-outline px-space-md py-space-sm rounded-DEFAULT flex-1 focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Enter explorer coordinate / email" type="email">
          <button class="bg-primary-container text-on-primary-container font-label-md text-label-md uppercase px-space-lg py-space-sm rounded-DEFAULT hover:bg-primary transition-colors" type="submit">Join Dispatch</button>
        </form>
        <div class="flex items-center gap-space-sm pt-space-xs text-outline">
          <span class="material-symbols-outlined text-base">verified</span>
          <span class="font-label-sm text-label-sm uppercase tracking-wider">Built to MIL-SPEC ISO 9001 Standards</span>
        </div>
      </div>
    </div>
    <div class="mt-space-2xl pt-space-lg flex flex-col md:flex-row items-center justify-between gap-space-md font-label-sm text-label-sm uppercase text-outline">
      <p>© 2026 DND DRAGON NORTH DIVISION CORP. ALL RIGHTS RESERVED.</p>
      <div class="flex items-center gap-space-lg">
        <span>Secure Field Transactions: VISA • MASTERCARD • AMEX • APPLE PAY</span>
      </div>
    </div>
  </div>
</footer>
<div id="toast-stack"></div>
<script>
// ============== TOAST NOTIFICATION ==============
function showToast(message, type) {
    type = type || 'success';
    const stack = document.getElementById('toast-stack');
    if (!stack) return;
    const icon = type === 'error' ? '⚠️' : '✅';
    const toast = document.createElement('div');
    toast.className = 'toast' + (type === 'error' ? ' toast-error' : '');
    toast.innerHTML = '<span class="toast-icon">' + icon + '</span><span>' + message + '</span>';
    stack.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 350);
    }, 3500);
}
<?php if ($flash): ?>
document.addEventListener('DOMContentLoaded', function () {
    showToast(<?php echo json_encode($flash['msg']); ?>, <?php echo json_encode($flash['type']); ?>);
});
<?php endif; ?>
</script>
</body>
</html>
