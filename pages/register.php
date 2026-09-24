<?php
if (is_logged_in()) { header('Location: ?page=home'); exit; }
?>
<section class="w-full py-space-3xl lg:py-space-4xl px-margin-mobile md:px-margin-desktop bg-surface-container-low min-h-screen flex items-center justify-center relative">
    
    <!-- Background Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-surface-container-high to-surface-container pointer-events-none"></div>

    <main class="w-full max-w-6xl relative z-10 grid grid-cols-1 lg:grid-cols-12 rounded-2xl overflow-hidden shadow-2xl bg-surface border border-outline-variant">
        <!-- Left Hero Panel -->
        <aside class="hidden lg:flex lg:col-span-5 relative flex-col justify-between p-10 bg-inverse-surface text-inverse-on-surface overflow-hidden">
            <!-- High altitude backdrop photo -->
            <img alt="Mountaineers testing alpine equipment in ridge conditions" class="absolute inset-0 w-full h-full object-cover object-center opacity-40 mix-blend-luminosity scale-105 transform hover:scale-100 transition-transform duration-1000 ease-out pointer-events-none" src="https://lh3.googleusercontent.com/aida/AEtjO1UOornjdulTG3sgvASGRX8wZh3zSajILvPnu6iqVsgiCf5CBYDDcOKl7j2KHrasnzkD0FBLhXxRegMgylFPlSYsiZk90OK7p9_igBbIXdHwS71sD1s2Eh11ckc3pRfmx8jYqLyvQRcoUcJAF9REqYzEy2KmpUH7dAYBAybvzwcQvTZMH-7y1TNuJiynAa5kNAZwhbf9RHRd1rFMh2vefXC3fompv6UviMT-vfwN3_zX-yKWeK4SaGyIB-g">
            <!-- Atmospheric gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-black/60 opacity-60 z-10"></div>
            
            <!-- Top Header Meta on Image -->
            <div class="relative z-20 space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-sm bg-inverse-surface/80 border border-white/10 text-xs font-mono text-primary backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-tertiary animate-pulse"></span>
                    BASECAMP GRID LAT 48°46' N // EXP-09
                </div>
                <p class="text-xs uppercase tracking-widest text-outline-variant font-mono">DND Tactical &amp; Expedition Gear</p>
            </div>
            
            <!-- Center Brand Message Overlay -->
            <div class="relative z-20 space-y-4 my-auto py-12">
                <div class="w-12 h-1 bg-primary"></div>
                <h2 class="text-headline-md font-bold tracking-tight text-white leading-tight">
                    Forged in the North.<br>
                    Crafted for the Summit.
                </h2>
                <p class="text-body-sm text-outline-variant leading-relaxed max-w-sm">
                    Autentikasi ke sistem Dragon North Division untuk mengelola pesanan ekspedisi, klaim garansi alpine seumur hidup, dan hak akses rilis batch terbatas.
                </p>
            </div>
            
            <!-- Bottom Verified Member Privileges -->
            <div class="relative z-20 pt-6 border-t border-white/15 space-y-2 text-xs text-outline-variant">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-base">verified</span>
                    <span>Garansi Seumur Hidup &amp; Layanan Rigger Lapangan</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-base">verified</span>
                    <span>Akses Drop Terbatas Seri Alpine &amp; Ekspedisi 8000M</span>
                </div>
            </div>
        </aside>
        
        <!-- Auth Forms Area -->
        <div class="lg:col-span-7 flex flex-col justify-between p-6 sm:p-10 lg:p-12 bg-surface">
            <!-- Brand Logo Emblem -->
            <div class="pb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-4xl text-primary">landscape</span>
                    <div>
                        <h1 class="font-bold text-title-md tracking-tight text-on-surface leading-none">
                            DRAGON NORTH DIVISION
                        </h1>
                        <p class="text-label-sm text-on-surface-variant uppercase tracking-wider mt-0.5">Alpine Equipment &amp; Rigger Systems</p>
                    </div>
                </div>
                <span class="hidden sm:inline-block px-2.5 py-1 text-label-sm tracking-wide uppercase bg-surface-container border border-outline-variant text-on-surface rounded-sm">
                    Mode: New Member
                </span>
            </div>
            
            <!-- Interactive Switcher (Login / Register Tabs) -->
            <div class="mt-4 mb-8">
                <div class="grid grid-cols-2 p-1 bg-surface-container rounded-lg border border-outline text-label-md font-semibold">
                    <a href="?page=login" class="py-2.5 rounded-md transition-all duration-150 flex items-center justify-center gap-2 text-on-surface-variant hover:bg-surface-container-high hover:text-on-surface">
                        <span class="material-symbols-outlined text-base">login</span>
                        Masuk (Login)
                    </a>
                    <a href="?page=register" class="py-2.5 rounded-md transition-all duration-150 flex items-center justify-center gap-2 bg-primary text-on-primary shadow-sm">
                        <span class="material-symbols-outlined text-base">person_add</span>
                        Daftar (Register)
                    </a>
                </div>
            </div>
            
            <!-- FORM SECTION: REGISTER -->
            <div class="relative min-h-[350px]">
                <div class="space-y-6">
                    <div class="mb-5">
                        <h3 class="text-headline-sm font-bold text-on-surface">Daftar Akun Explorer</h3>
                        <p class="text-body-sm text-on-surface-variant mt-1">Mulai ekspedisi baru dan bergabung dengan Basecamp DND.</p>
                    </div>
                    
                    <form method="POST" class="space-y-5">
                        <input type="hidden" name="do" value="register">
                        
                        <div class="flex flex-col gap-space-xs">
                            <label class="text-label-sm font-semibold text-on-surface">Nama Lengkap / Call Sign</label>
                            <input type="text" name="name" class="w-full rounded-md border border-outline bg-surface px-3.5 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary text-on-surface placeholder-outline transition" placeholder="e.g. Erik Alpine" required>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div class="flex flex-col gap-space-xs">
                                <label class="text-label-sm font-semibold text-on-surface">Email Explorer</label>
                                <input type="email" name="email" class="w-full rounded-md border border-outline bg-surface px-3.5 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary text-on-surface placeholder-outline transition" placeholder="nama@ekspedisi.com" required>
                            </div>
                            
                            <div class="flex flex-col gap-space-xs">
                                <label class="text-label-sm font-semibold text-on-surface">WhatsApp Number</label>
                                <input type="text" name="phone" class="w-full rounded-md border border-outline bg-surface px-3.5 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary text-on-surface placeholder-outline transition" placeholder="+62 8xx-xxxx-xxxx" required>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-space-xs">
                            <label class="text-label-sm font-semibold text-on-surface">Kata Sandi</label>
                            <input type="password" name="password" class="w-full rounded-md border border-outline bg-surface px-3.5 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary text-on-surface placeholder-outline transition" placeholder="Minimal 6 karakter" required>
                        </div>
                        
                        <button type="submit" class="w-full py-3.5 px-4 rounded-md bg-primary hover:bg-primary/90 text-on-primary font-medium text-label-md tracking-wide uppercase transition shadow-md hover:shadow-lg flex items-center justify-center gap-2 mt-4">
                            <span>Daftar ke Basecamp</span>
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Minimalist Legal & Protocol Stamp -->
            <div class="pt-8 mt-4 border-t border-outline-variant flex flex-col sm:flex-row items-center justify-between text-label-sm text-on-surface-variant gap-2">
                <p>© 2024 Dragon North Division (DND). All Alpine Rights Reserved.</p>
                <div class="flex items-center gap-3">
                    <a href="#" class="hover:underline hover:text-on-surface">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="#" class="hover:underline hover:text-on-surface">Protokol Keamanan</a>
                </div>
            </div>
        </div>
    </main>
</section>
