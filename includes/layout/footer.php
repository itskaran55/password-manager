<footer class="w-full bg-sa-card border-t border-sa-border text-charcoal-700 relative overflow-hidden">
    <!-- Subtle Background Glows -->
    <div class="absolute -top-24 left-1/4 w-[450px] h-[300px] bg-accent-lavender/10 blur-[130px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-[350px] h-[250px] bg-accent-sage/15 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 sm:pt-16 pb-10 relative z-10">

        <!-- 1. Visually Engaging Pre-Footer CTA Card -->
        <div class="w-full bg-sa-bg rounded-3xl border border-sa-border p-8 sm:p-12 mb-16 shadow-sa-card relative overflow-hidden" data-aos="fade-up" data-aos-duration="700">
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-gradient-to-br from-accent-sage/20 to-accent-coral/20 rounded-full blur-2xl pointer-events-none"></div>
            
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 relative z-10">
                <div class="max-w-xl text-center lg:text-left space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent-lavender/15 border border-accent-lavender/30 text-accent-lavender-dark text-xs font-semibold uppercase tracking-wider">
                        <i class="ri-shield-flash-line"></i> Ready for Deployment
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight">
                        Protect and streamline your team's access today.
                    </h3>
                    <p class="text-sm sm:text-base text-charcoal-700 leading-relaxed">
                        Granular permissions, zero-knowledge AES-256 encryption, and instant user activation toggles—all hosted natively on your company server.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3.5 w-full lg:w-auto">
                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-semibold text-sm shadow-sa-soft active:scale-95 transition-all duration-200">
                            <i class="ri-dashboard-line text-accent-sage"></i>
                            Open Vault Dashboard
                        </a>
                    <?php else: ?>
                        <a href="index.php?page=login" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-semibold text-sm shadow-sa-soft active:scale-95 transition-all duration-200">
                            <i class="ri-lock-password-line text-accent-sage"></i>
                            Sign In to Vault
                        </a>
                        <a href="#about" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover font-semibold text-sm active:scale-95 transition-all duration-200">
                            Learn More
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- 2. Main Footer Navigation Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 sm:gap-10 lg:gap-8">
            
            <!-- Brand Column (lg:col-span-4) -->
            <div class="sm:col-span-2 lg:col-span-4 flex flex-col gap-4">
                <a href="index.php" class="flex items-center gap-3.5 group focus:outline-none w-fit">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm group-hover:scale-105 transition-all duration-300">
                        <div class="w-full h-full bg-sa-bg rounded-[14px] flex items-center justify-center">
                            <i class="ri-shield-keyhole-fill text-accent-lavender-dark text-xl"></i>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                            PassVault
                            <span class="text-[10px] tracking-wider px-1.5 py-0.5 rounded-full bg-accent-lavender/15 text-accent-lavender-dark border border-accent-lavender/30 font-semibold uppercase">SA</span>
                        </span>
                        <span class="text-[11px] text-charcoal-500 font-medium">Social Amplifiers Internal</span>
                    </div>
                </a>

                <p class="text-sm text-charcoal-700 leading-relaxed max-w-sm">
                    Centralized credential governance infrastructure engineered exclusively for Social Amplifiers. Protected at rest with AES-256 and restricted with granular permission layers.
                </p>

                <!-- Live System Node Status -->
                <div class="flex items-center gap-2.5 pt-1">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-sage opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent-sage-dark"></span>
                    </span>
                    <span class="text-xs font-semibold text-charcoal-900">All Security Nodes Active & Encrypted</span>
                </div>
            </div>

            <!-- Navigation Links (lg:col-span-2) -->
            <div class="lg:col-span-2 flex flex-col gap-3">
                <h4 class="text-xs font-bold text-charcoal-900 uppercase tracking-wider">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="index.php" class="hover:text-accent-lavender-dark transition-colors">Home</a></li>
                    <li><a href="#about" class="hover:text-accent-lavender-dark transition-colors">About</a></li>
                    <li><a href="#features" class="hover:text-accent-lavender-dark transition-colors">Features</a></li>
                    <li><a href="#security" class="hover:text-accent-lavender-dark transition-colors">Security Specs</a></li>
                </ul>
            </div>

            <!-- Access Portals (lg:col-span-3) -->
            <div class="lg:col-span-3 flex flex-col gap-3">
                <h4 class="text-xs font-bold text-charcoal-900 uppercase tracking-wider">Internal Portals</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="dashboard.php" class="hover:text-accent-sage-dark transition-colors flex items-center gap-2">
                            <i class="ri-lock-2-line text-accent-sage-dark text-base"></i> Team Vault
                        </a>
                    </li>
                    <li>
                        <a href="admin/users.php" class="hover:text-accent-lavender-dark transition-colors flex items-center gap-2">
                            <i class="ri-admin-line text-accent-lavender-dark text-base"></i> User Access Matrix
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=login" class="hover:text-charcoal-900 transition-colors flex items-center gap-2">
                            <i class="ri-login-circle-line text-charcoal-400 text-base"></i> Portal Login
                        </a>
                    </li>
                    <li>
                        <span class="text-xs text-charcoal-500 flex items-center gap-1.5 pt-1">
                            <span>Subfolder:</span>
                            <code class="text-charcoal-900 bg-sa-bg px-2 py-0.5 rounded-md border border-sa-border font-mono text-[11px]">/password-manager</code>
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Protocol Standards & Badges (lg:col-span-3) -->
            <div class="lg:col-span-3 flex flex-col gap-3">
                <h4 class="text-xs font-bold text-charcoal-900 uppercase tracking-wider">Security Architecture</h4>
                <div class="flex flex-wrap gap-2 pt-1">
                    <span class="px-2.5 py-1 text-xs rounded-xl bg-sa-bg border border-sa-border text-charcoal-900 font-mono flex items-center gap-1.5 shadow-sm">
                        <i class="ri-shield-check-line text-accent-sage-dark"></i> AES-256-CBC
                    </span>
                    <span class="px-2.5 py-1 text-xs rounded-xl bg-sa-bg border border-sa-border text-charcoal-900 font-mono flex items-center gap-1.5 shadow-sm">
                        <i class="ri-key-2-line text-accent-lavender-dark"></i> RBAC Matrix
                    </span>
                    <span class="px-2.5 py-1 text-xs rounded-xl bg-sa-bg border border-sa-border text-charcoal-900 font-mono flex items-center gap-1.5 shadow-sm">
                        <i class="ri-user-settings-line text-accent-coral-dark"></i> isActive Guard
                    </span>
                </div>
                <p class="text-xs text-charcoal-500 mt-2 leading-relaxed">
                    Internal utility configured for <a href="https://socialamplifiers.com" target="_blank" class="font-semibold text-charcoal-900 hover:underline">socialamplifiers.com</a>.
                </p>
            </div>

        </div>

        <!-- 3. Bottom Bar -->
        <div class="border-t border-sa-border my-8 sm:my-10"></div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-charcoal-500">
            <p class="text-center sm:text-left">
                &copy; <?= date('Y'); ?> <span class="text-charcoal-900 font-semibold">Social Amplifiers</span>. All rights reserved. Built with PHP, MySQL & GSAP.
            </p>

            <a href="#main-navbar" class="group flex items-center gap-1.5 text-charcoal-700 hover:text-charcoal-900 font-semibold transition-colors">
                <span>Back to top</span>
                <i class="ri-arrow-up-line group-hover:-translate-y-0.5 transition-transform duration-200"></i>
            </a>
        </div>
    </div>
</footer>