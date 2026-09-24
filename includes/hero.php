<section class="relative w-full min-h-[calc(100vh-80px)] flex items-center justify-center py-12 lg:py-20 overflow-hidden">
    <!-- Ambient Pastel Glow Backgrounds -->
    <div class="absolute -top-16 -left-16 w-72 sm:w-96 h-72 sm:h-96 bg-accent-sage/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute top-1/3 -right-20 w-80 sm:w-[480px] h-80 sm:h-[480px] bg-accent-lavender/25 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute -bottom-20 left-1/3 w-64 sm:w-80 h-64 sm:h-80 bg-accent-coral/15 rounded-full blur-[110px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Column: Headline & Action CTAs (lg:col-span-7) -->
            <div class="lg:col-span-7 flex flex-col items-center lg:items-start text-center lg:text-left space-y-6 sm:space-y-8">
                
                <!-- Security Status Pill -->
                <div id="hero-badge" class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-sa-card border border-sa-border shadow-sa-soft">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-sage opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent-sage-dark"></span>
                    </span>
                    <span class="text-xs font-semibold text-charcoal-700 tracking-wide">
                        Social Amplifiers Internal Vault v2.4
                    </span>
                    <span class="text-[10px] font-mono uppercase bg-accent-lavender/20 text-accent-lavender-dark px-2 py-0.5 rounded-full font-bold">
                        AES-256
                    </span>
                </div>

                <!-- Main Punchy Title -->
                <h1 id="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-charcoal-900 leading-[1.15]">
                    Manage Company Passwords <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-sage-dark via-accent-lavender-dark to-accent-coral-dark">
                        Safely & Anywhere
                    </span>
                </h1>

                <!-- Subheading Description -->
                <p id="hero-desc" class="text-base sm:text-lg text-charcoal-700 max-w-2xl leading-relaxed">
                    Zero-leak internal credential governance. Granular role-based permissions allow admins to provision specific credentials to designated team members while locking out deactivated accounts in real-time.
                </p>

                <!-- Action Button Group -->
                <div id="hero-cta" class="flex flex-col sm:flex-row items-center gap-3.5 w-full sm:w-auto">
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-semibold text-sm shadow-sa-card active:scale-95 transition-all duration-200">
                            <i class="ri-dashboard-3-line text-accent-sage text-lg"></i>
                            <span>Go to Vault Dashboard</span>
                        </a>
                    <?php else: ?>
                        <a href="index.php?page=login" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-4 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-semibold text-sm shadow-sa-card active:scale-95 transition-all duration-200">
                            <i class="ri-key-2-fill text-accent-sage text-lg"></i>
                            <span>Unlock Vault Portal</span>
                        </a>
                    <?php endif; ?>

                    <a href="#features" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover font-semibold text-sm shadow-sa-soft active:scale-95 transition-all duration-200">
                        <i class="ri-shield-user-line text-accent-lavender-dark text-base"></i>
                        <span>Permission Matrix</span>
                    </a>
                </div>

                <!-- Trust Micro Badges -->
                <div id="hero-metrics" class="pt-4 border-t border-sa-border w-full grid grid-cols-3 gap-2 sm:gap-6 text-left">
                    <div>
                        <div class="text-xl sm:text-2xl font-extrabold text-charcoal-900">256-bit</div>
                        <div class="text-xs text-charcoal-500 font-medium">Cipher Encryption</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-extrabold text-accent-sage-dark">100%</div>
                        <div class="text-xs text-charcoal-500 font-medium">RBAC Segregation</div>
                    </div>
                    <div>
                        <div class="text-xl sm:text-2xl font-extrabold text-accent-coral-dark">Instant</div>
                        <div class="text-xs text-charcoal-500 font-medium">isActive Revocation</div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Interactive Vault Visual Mockup (lg:col-span-5) -->
            <div class="lg:col-span-5 relative flex items-center justify-center">
                
                <!-- Main Glassmorphic Vault Card -->
                <div id="hero-main-card" class="w-full max-w-md bg-sa-card/90 backdrop-blur-xl rounded-3xl border border-sa-border p-5 sm:p-6 shadow-sa-card relative z-20">
                    
                    <!-- Header -->
                    <div class="flex items-center justify-between pb-4 mb-4 border-b border-sa-border">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-accent-sage/20 border border-accent-sage/30 flex items-center justify-center text-accent-sage-dark">
                                <i class="ri-lock-password-fill text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-charcoal-900">Credentials Repository</h3>
                                <p class="text-[11px] text-charcoal-500">Live Encrypted Storage</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 text-[11px] font-mono rounded-lg bg-accent-sage/15 text-accent-sage-dark font-semibold border border-accent-sage/30">
                            Synced
                        </span>
                    </div>

                    <!-- Credential Item List Mockup -->
                    <div class="space-y-3">
                        
                        <!-- Item 1 -->
                        <div class="p-3 sm:p-3.5 rounded-2xl bg-sa-bg border border-sa-border flex items-center justify-between hover:border-accent-lavender transition-all duration-200">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base font-bold shadow-xs">
                                    <i class="ri-google-fill"></i>
                                </div>
                                <div class="text-left">
                                    <div class="text-xs font-bold text-charcoal-900">Google Ads Agency</div>
                                    <div class="text-[11px] font-mono text-charcoal-500">ads@socialamplifiers.com</div>
                                </div>
                            </div>
                            <button type="button" class="px-2.5 py-1 text-xs rounded-lg bg-sa-card hover:bg-sa-hover border border-sa-border text-charcoal-700 flex items-center gap-1 font-mono transition-colors">
                                <i class="ri-file-copy-line text-[11px] text-accent-sage-dark"></i>
                                <span>Copy</span>
                            </button>
                        </div>

                        <!-- Item 2 (Active Preview) -->
                        <div class="p-3 sm:p-3.5 rounded-2xl bg-sa-bg border-2 border-accent-lavender/50 flex flex-col gap-2.5 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-base font-bold shadow-xs">
                                        <i class="ri-server-fill"></i>
                                    </div>
                                    <div class="text-left">
                                        <div class="text-xs font-bold text-charcoal-900">Hostinger Main cPanel</div>
                                        <div class="text-[11px] font-mono text-charcoal-500">admin@socialamplifiers.com</div>
                                    </div>
                                </div>
                                <span class="text-[10px] px-2 py-0.5 rounded-md bg-accent-lavender/20 text-accent-lavender-dark font-semibold">
                                    Full Edit
                                </span>
                            </div>
                            
                            <div class="pt-2 border-t border-sa-border flex items-center justify-between bg-sa-card/60 px-2.5 py-1.5 rounded-xl">
                                <span class="font-mono text-xs text-charcoal-700 tracking-wider">••••••••••••••••</span>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[10px] text-accent-sage-dark font-medium"><i class="ri-shield-check-fill"></i> Verified</span>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="p-3 sm:p-3.5 rounded-2xl bg-sa-bg border border-sa-border flex items-center justify-between opacity-80">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-base font-bold shadow-xs">
                                    <i class="ri-github-fill"></i>
                                </div>
                                <div class="text-left">
                                    <div class="text-xs font-bold text-charcoal-900">GitHub Production Repo</div>
                                    <div class="text-[11px] font-mono text-charcoal-500">devs@socialamplifiers.com</div>
                                </div>
                            </div>
                            <span class="text-[10px] px-2 py-1 rounded bg-sa-card text-charcoal-500 font-mono">
                                Read Only
                            </span>
                        </div>

                    </div>

                    <!-- Bottom Status Indicator -->
                    <div class="mt-4 pt-3 border-t border-sa-border flex items-center justify-between text-[11px] text-charcoal-500">
                        <span class="flex items-center gap-1.5">
                            <i class="ri-folder-keyhole-line text-accent-lavender-dark"></i>
                            3 assigned to your role
                        </span>
                        <span class="font-mono text-charcoal-400">PDO Prepared</span>
                    </div>
                </div>

                <!-- Floating Badge 1: User Status (Top Right) -->
                <div id="float-badge-1" class="hidden sm:flex absolute -top-5 -right-4 bg-sa-bg/95 backdrop-blur-md rounded-2xl border border-sa-border p-3 shadow-sa-card items-center gap-2.5 z-30">
                    <div class="w-7 h-7 rounded-xl bg-accent-sage/20 text-accent-sage-dark flex items-center justify-center text-sm">
                        <i class="ri-user-follow-line"></i>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-charcoal-900">isActive = 1</div>
                        <div class="text-[10px] text-charcoal-500">Session Authorized</div>
                    </div>
                </div>

                <!-- Floating Badge 2: Decryption Speed (Bottom Left) -->
                <div id="float-badge-2" class="hidden sm:flex absolute -bottom-6 -left-6 bg-sa-bg/95 backdrop-blur-md rounded-2xl border border-sa-border p-3.5 shadow-sa-card items-center gap-3 z-30">
                    <div class="w-8 h-8 rounded-xl bg-accent-coral/20 text-accent-coral-dark flex items-center justify-center text-base">
                        <i class="ri-flashlight-line"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-charcoal-900">0.03s Response</div>
                        <div class="text-[10px] text-charcoal-500">Hostinger Subfolder Node</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- GSAP Hero Entrance & Floating Physics Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // GSAP Master Timeline for Hero Elements
    const heroTl = gsap.timeline({ defaults: { ease: "power3.out" } });

    heroTl
        .from("#hero-badge", { y: -20, opacity: 0, duration: 0.6 })
        .from("#hero-title", { y: 25, opacity: 0, duration: 0.8 }, "-=0.3")
        .from("#hero-desc", { y: 20, opacity: 0, duration: 0.7 }, "-=0.4")
        .from("#hero-cta", { y: 20, opacity: 0, duration: 0.6 }, "-=0.4")
        .from("#hero-metrics", { y: 15, opacity: 0, duration: 0.6 }, "-=0.3")
        .from("#hero-main-card", { scale: 0.92, opacity: 0, y: 30, duration: 0.9, ease: "back.out(1.4)" }, "-=0.7")
        .from("#float-badge-1", { scale: 0.5, opacity: 0, duration: 0.5, ease: "back.out(1.7)" }, "-=0.4")
        .from("#float-badge-2", { scale: 0.5, opacity: 0, duration: 0.5, ease: "back.out(1.7)" }, "-=0.3");

    // Continuous Gentle Floating Physics for Decorative Badges
    gsap.to("#float-badge-1", {
        y: -10,
        repeat: -1,
        yoyo: true,
        duration: 3,
        ease: "sine.inOut"
    });

    gsap.to("#float-badge-2", {
        y: 10,
        repeat: -1,
        yoyo: true,
        duration: 3.5,
        delay: 0.5,
        ease: "sine.inOut"
    });
});
</script>