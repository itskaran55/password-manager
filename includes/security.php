<section id="security" class="relative w-full py-20 lg:py-28 bg-sa-card/70 border-t border-sa-border overflow-hidden">
    <!-- Ambient Pastel Glow Accents -->
    <div class="absolute top-1/3 -left-24 w-80 sm:w-[420px] h-80 sm:h-[420px] bg-accent-sage/15 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute -bottom-16 -right-20 w-80 sm:w-96 h-80 sm:h-96 bg-accent-lavender/20 rounded-full blur-[130px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20 space-y-4" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sa-bg border border-sa-border text-accent-lavender-dark text-xs font-bold uppercase tracking-wider shadow-sa-soft">
                <i class="ri-lock-2-line"></i> Cryptographic Standards
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-charcoal-900 tracking-tight">
                Enterprise security built directly into every layer.
            </h2>
            <p class="text-sm sm:text-base text-charcoal-700 leading-relaxed">
                From raw MySQL data-at-rest encryption to strict Apache rewrite barriers, your credentials remain inaccessible to unauthorized eyes.
            </p>
        </div>

        <!-- 2-Column Technical Deep Dive -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center mb-16">
            
            <!-- Left Column: Code Logic Visualizer (lg:col-span-6) -->
            <div class="lg:col-span-6" data-aos="fade-right" data-aos-duration="800">
                <div class="bg-charcoal-900 text-sa-bg rounded-3xl p-6 sm:p-7 shadow-sa-card border border-charcoal-700 relative overflow-hidden font-mono text-xs">
                    
                    <!-- Header Bar of Terminal Box -->
                    <div class="flex items-center justify-between pb-4 mb-4 border-b border-charcoal-700 text-charcoal-400">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-accent-coral inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-accent-sand inline-block"></span>
                            <span class="w-3 h-3 rounded-full bg-accent-sage inline-block"></span>
                            <span class="ml-2 text-[11px] text-charcoal-400">SecurityRoutine.php</span>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded bg-charcoal-700 text-accent-sage font-bold">
                            AES-256-CBC
                        </span>
                    </div>

                    <!-- Pseudo Code Breakdown -->
                    <div class="space-y-3 leading-relaxed">
                        <p class="text-charcoal-500">// 1. Generate cryptographic IV</p>
                        <p><span class="text-accent-lavender">$iv</span> = openssl_random_pseudo_bytes(16);</p>
                        
                        <p class="text-charcoal-500 pt-2">// 2. Zero-leak AES-256 encryption</p>
                        <p><span class="text-accent-lavender">$ciphertext</span> = openssl_encrypt(<br>
                            &nbsp;&nbsp;<span class="text-accent-coral">$plainText</span>,<br>
                            &nbsp;&nbsp;<span class="text-accent-sage">'AES-256-CBC'</span>,<br>
                            &nbsp;&nbsp;<span class="text-accent-sand">MASTER_KEY</span>,<br>
                            &nbsp;&nbsp;OPENSSL_RAW_DATA,<br>
                            &nbsp;&nbsp;<span class="text-accent-lavender">$iv</span><br>
                        );</p>

                        <p class="text-charcoal-500 pt-2">// 3. Secure PDO parameterization</p>
                        <p><span class="text-accent-lavender">$stmt</span> = <span class="text-accent-coral">$pdo</span>-&gt;prepare(<br>
                            &nbsp;&nbsp;<span class="text-accent-sage">"INSERT INTO passwords (encrypted_password, iv) VALUES (:p, :iv)"</span><br>
                        );</p>
                    </div>

                    <div class="mt-5 pt-3 border-t border-charcoal-700 flex items-center justify-between text-[11px] text-charcoal-400">
                        <span class="flex items-center gap-1.5 text-accent-sage">
                            <i class="ri-shield-check-fill"></i> SQL Injection Immune
                        </span>
                        <span>SHA-256 Key Hashing</span>
                    </div>

                </div>
            </div>

            <!-- Right Column: 3 Architectural Pillars (lg:col-span-6) -->
            <div class="lg:col-span-6 space-y-5" data-aos="fade-left" data-aos-duration="800">
                
                <!-- Pillar 1 -->
                <div class="p-5 sm:p-6 rounded-3xl bg-sa-bg border border-sa-border flex items-start gap-4 shadow-sa-soft">
                    <div class="w-11 h-11 rounded-2xl bg-accent-sage/20 text-accent-sage-dark flex-shrink-0 flex items-center justify-center text-xl">
                        <i class="ri-key-2-fill"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-charcoal-900">Encrypted at Rest</h4>
                        <p class="text-xs sm:text-sm text-charcoal-700 leading-relaxed">
                            Passwords stored in MySQL are ciphertext strings. Decryption occurs only at the instant an authenticated, authorized user requests them.
                        </p>
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div class="p-5 sm:p-6 rounded-3xl bg-sa-bg border border-sa-border flex items-start gap-4 shadow-sa-soft">
                    <div class="w-11 h-11 rounded-2xl bg-accent-lavender/20 text-accent-lavender-dark flex-shrink-0 flex items-center justify-center text-xl">
                        <i class="ri-folder-shield-2-fill"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-charcoal-900">Hostinger Subfolder Hardening</h4>
                        <p class="text-xs sm:text-sm text-charcoal-700 leading-relaxed">
                            Root `.htaccess` rules prevent directory listing, block browser access to `/config` and `/src`, and inject strict X-Frame and MIME type headers.
                        </p>
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div class="p-5 sm:p-6 rounded-3xl bg-sa-bg border border-sa-border flex items-start gap-4 shadow-sa-soft">
                    <div class="w-11 h-11 rounded-2xl bg-accent-coral/20 text-accent-coral-dark flex-shrink-0 flex items-center justify-center text-xl">
                        <i class="ri-user-unfollow-fill"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-charcoal-900">Immediate Session Invalidation</h4>
                        <p class="text-xs sm:text-sm text-charcoal-700 leading-relaxed">
                            If an admin sets <code class="font-mono text-xs bg-sa-card px-1.5 py-0.5 rounded text-charcoal-900 font-bold">isActive = 0</code>, every subsequent request instantly invalidates the user's session token and redirects to login.
                        </p>
                    </div>
                </div>

            </div>

        </div>

        <!-- Security Protocol Summary Strip -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up" data-aos-delay="150">
            <div class="p-4 rounded-2xl bg-sa-bg border border-sa-border text-center">
                <i class="ri-shield-user-line text-accent-sage-dark text-xl mb-1"></i>
                <div class="text-xs font-bold text-charcoal-900">RBAC Gated</div>
                <div class="text-[11px] text-charcoal-500">Fine-grained permissions</div>
            </div>
            <div class="p-4 rounded-2xl bg-sa-bg border border-sa-border text-center">
                <i class="ri-lock-password-line text-accent-lavender-dark text-xl mb-1"></i>
                <div class="text-xs font-bold text-charcoal-900">Zero Plaintext</div>
                <div class="text-[11px] text-charcoal-500">Encrypted in MySQL</div>
            </div>
            <div class="p-4 rounded-2xl bg-sa-bg border border-sa-border text-center">
                <i class="ri-terminal-window-line text-accent-coral-dark text-xl mb-1"></i>
                <div class="text-xs font-bold text-charcoal-900">PDO Prepared</div>
                <div class="text-[11px] text-charcoal-500">Protected against SQLi</div>
            </div>
            <div class="p-4 rounded-2xl bg-sa-bg border border-sa-border text-center">
                <i class="ri-timer-flash-line text-charcoal-700 text-xl mb-1"></i>
                <div class="text-xs font-bold text-charcoal-900">Session Check</div>
                <div class="text-[11px] text-charcoal-500">Live `isActive` checks</div>
            </div>
        </div>

    </div>
</section>