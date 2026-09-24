<section id="about" class="relative w-full py-20 lg:py-28 bg-sa-card/60 border-y border-sa-border overflow-hidden">
    <!-- Ambient Pastel Accents -->
    <div class="absolute top-1/2 -left-20 w-80 h-80 bg-accent-sage/15 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -bottom-10 right-1/4 w-72 h-72 bg-accent-lavender/15 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20 space-y-4" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sa-bg border border-sa-border text-accent-lavender-dark text-xs font-bold uppercase tracking-wider shadow-sa-soft">
                <i class="ri-information-line"></i> Why PassVault Internal?
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-charcoal-900 tracking-tight">
                Designed specifically for our agency's workflow 
            </h2>
            <p class="text-sm sm:text-base text-charcoal-700 leading-relaxed">
                Shared plain-text sheets and insecure chat sharing create risk. PassVault delivers zero-leak credential management hosted natively within our company ecosystem.
            </p>
        </div>

        <!-- 3-Pillar Value Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 mb-16">
            
            <!-- Card 1: Selective Visibility (Sage Pastel) -->
            <div class="bg-sa-bg rounded-3xl border border-sa-border p-7 sm:p-8 flex flex-col justify-between shadow-sa-card hover:-translate-y-1.5 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-accent-sage/20 border border-accent-sage/30 text-accent-sage-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ri-eye-off-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal-900">Per-User Visibility</h3>
                    <p class="text-sm text-charcoal-700 leading-relaxed">
                        Every password is assigned on a strict need-to-know basis. Team members only see the exact client logins required for their ongoing projects.
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-sa-border flex items-center gap-2 text-xs font-semibold text-accent-sage-dark">
                    <i class="ri-checkbox-circle-fill"></i>
                    <span>RBAC Access Control</span>
                </div>
            </div>

            <!-- Card 2: Instant Activation Lock (Coral Pastel) -->
            <div class="bg-sa-bg rounded-3xl border border-sa-border p-7 sm:p-8 flex flex-col justify-between shadow-sa-card hover:-translate-y-1.5 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-accent-coral/20 border border-accent-coral/30 text-accent-coral-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ri-user-unfollow-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal-900">Real-Time Deactivation</h3>
                    <p class="text-sm text-charcoal-700 leading-relaxed">
                        Toggle user access instantly using the <code class="font-mono text-xs text-charcoal-900 bg-sa-card px-1.5 py-0.5 rounded">isActive</code> field. Revoked users lose access on their very next API query or page refresh.
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-sa-border flex items-center gap-2 text-xs font-semibold text-accent-coral-dark">
                    <i class="ri-flashlight-fill"></i>
                    <span>Zero-Delay Session Revoke</span>
                </div>
            </div>

            <!-- Card 3: Encrypted Infrastructure (Lavender Pastel) -->
            <div class="bg-sa-bg rounded-3xl border border-sa-border p-7 sm:p-8 flex flex-col justify-between shadow-sa-card hover:-translate-y-1.5 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                <div class="space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-accent-lavender/20 border border-accent-lavender/30 text-accent-lavender-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                        <i class="ri-lock-password-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal-900">AES-256 Storage</h3>
                    <p class="text-sm text-charcoal-700 leading-relaxed">
                        Credentials are encrypted with OpenSSL AES-256-CBC before touching the MySQL database. Database dumps remain unreadable without the protected master key.
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-sa-border flex items-center gap-2 text-xs font-semibold text-accent-lavender-dark">
                    <i class="ri-shield-keyhole-line"></i>
                    <span>Encrypted at Rest</span>
                </div>
            </div>

        </div>

        <!-- Interactive Architecture Breakdown Box -->
        <div class="w-full bg-sa-bg rounded-3xl border border-sa-border p-6 sm:p-10 shadow-sa-card" data-aos="fade-up" data-aos-delay="150">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-6 space-y-4 text-center lg:text-left">
                    <span class="text-xs font-bold uppercase tracking-wider text-accent-sage-dark bg-accent-sage/15 px-3 py-1 rounded-full border border-accent-sage/30">
                        Native Hostinger Subfolder Deployment
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900">
                        Zero 3rd-Party SaaS Subscriptions
                    </h3>
                    <p class="text-sm text-charcoal-700 leading-relaxed">
                        Hosted directly under <code class="font-mono text-xs bg-sa-card px-2 py-0.5 rounded text-charcoal-900">socialamplifiers.com/password-manager</code>. You maintain 100% control over database backups, master keys, and audit logs without recurring external software costs.
                    </p>
                </div>

                <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                    <div class="p-4 sm:p-5 rounded-2xl bg-sa-card border border-sa-border text-center space-y-1">
                        <div class="text-2xl sm:text-3xl font-extrabold text-charcoal-900">100%</div>
                        <div class="text-xs font-medium text-charcoal-500">Data Ownership</div>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl bg-sa-card border border-sa-border text-center space-y-1">
                        <div class="text-2xl sm:text-3xl font-extrabold text-accent-sage-dark">0s</div>
                        <div class="text-xs font-medium text-charcoal-500">Access Propagation Lag</div>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl bg-sa-card border border-sa-border text-center space-y-1">
                        <div class="text-2xl sm:text-3xl font-extrabold text-accent-lavender-dark">PDO</div>
                        <div class="text-xs font-medium text-charcoal-500">SQL Injection Proof</div>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl bg-sa-card border border-sa-border text-center space-y-1">
                        <div class="text-2xl sm:text-3xl font-extrabold text-accent-coral-dark">.htaccess</div>
                        <div class="text-xs font-medium text-charcoal-500">Locked Core Files</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>