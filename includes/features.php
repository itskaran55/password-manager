<section id="features" class="relative w-full py-20 lg:py-28 bg-sa-bg overflow-hidden">
    <!-- Ambient Pastel Glow Accents -->
    <div class="absolute top-1/4 -right-16 w-80 sm:w-96 h-80 sm:h-96 bg-accent-lavender/15 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-72 sm:w-80 h-72 sm:h-80 bg-accent-sage/15 rounded-full blur-[110px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 sm:mb-20 space-y-4" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sa-card border border-sa-border text-accent-sage-dark text-xs font-bold uppercase tracking-wider shadow-sa-soft">
                <i class="ri-sound-module-line"></i> Granular Governance
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-charcoal-900 tracking-tight">
                Complete control over who accesses what
            </h2>
            <p class="text-sm sm:text-base text-charcoal-700 leading-relaxed">
                Admins can provision credentials per user, revoke access dynamically, and manage operational rights across all company accounts.
            </p>
        </div>

        <!-- Interactive Permission Matrix Simulation Showcase -->
        <div class="w-full bg-sa-card/90 rounded-3xl border border-sa-border p-6 sm:p-10 shadow-sa-card mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 pb-6 mb-6 border-b border-sa-border">
                <div>
                    <h3 class="text-xl sm:text-2xl font-bold text-charcoal-900 flex items-center gap-2.5">
                        <i class="ri-shield-user-line text-accent-lavender-dark"></i>
                        Live Role-Based Access Control (RBAC)
                    </h3>
                    <p class="text-xs sm:text-sm text-charcoal-500 mt-1">
                        How permissions and visibility reflect across different team roles in real-time.
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-sa-bg border border-sa-border text-xs font-mono text-charcoal-700">
                        <span class="w-2 h-2 rounded-full bg-accent-sage"></span> Active Session
                    </span>
                </div>
            </div>

            <!-- Responsive Table / Matrix Grid -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="border-b border-sa-border text-xs uppercase tracking-wider text-charcoal-500 font-bold">
                            <th class="pb-3 px-3">Team Member</th>
                            <th class="pb-3 px-3">Account Status</th>
                            <th class="pb-3 px-3">Assigned Credentials</th>
                            <th class="pb-3 px-3">View Right</th>
                            <th class="pb-3 px-3">Edit Right</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sa-border text-sm text-charcoal-900 font-medium">
                        <!-- Row 1: Admin -->
                        <tr class="hover:bg-sa-bg/60 transition-colors">
                            <td class="py-4 px-3 flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-accent-lavender/20 text-accent-lavender-dark font-bold text-xs flex items-center justify-center">
                                    AD
                                </div>
                                <div>
                                    <div class="font-bold text-xs">Super Admin</div>
                                    <div class="text-[11px] font-mono text-charcoal-500">admin@socialamplifiers.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-3">
                                <span class="px-2.5 py-1 text-xs rounded-lg bg-accent-sage/15 text-accent-sage-dark font-semibold border border-accent-sage/30 inline-flex items-center gap-1">
                                    <i class="ri-checkbox-circle-fill"></i> isActive = 1
                                </span>
                            </td>
                            <td class="py-4 px-3 text-xs font-mono text-charcoal-700">All Company Passwords</td>
                            <td class="py-4 px-3 text-accent-sage-dark"><i class="ri-check-line text-lg font-bold"></i></td>
                            <td class="py-4 px-3 text-accent-sage-dark"><i class="ri-check-line text-lg font-bold"></i></td>
                        </tr>

                        <!-- Row 2: Active User with Limited Rights -->
                        <tr class="hover:bg-sa-bg/60 transition-colors">
                            <td class="py-4 px-3 flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-accent-sage/20 text-accent-sage-dark font-bold text-xs flex items-center justify-center">
                                    DV
                                </div>
                                <div>
                                    <div class="font-bold text-xs">Frontend Developer</div>
                                    <div class="text-[11px] font-mono text-charcoal-500">dev@socialamplifiers.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-3">
                                <span class="px-2.5 py-1 text-xs rounded-lg bg-accent-sage/15 text-accent-sage-dark font-semibold border border-accent-sage/30 inline-flex items-center gap-1">
                                    <i class="ri-checkbox-circle-fill"></i> isActive = 1
                                </span>
                            </td>
                            <td class="py-4 px-3 text-xs font-mono text-charcoal-700">GitHub & Staging Server</td>
                            <td class="py-4 px-3 text-accent-sage-dark"><i class="ri-check-line text-lg font-bold"></i></td>
                            <td class="py-4 px-3 text-charcoal-400"><i class="ri-close-line text-lg"></i></td>
                        </tr>

                        <!-- Row 3: Deactivated User -->
                        <tr class="hover:bg-sa-bg/60 transition-colors bg-accent-coral/5">
                            <td class="py-4 px-3 flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-accent-coral/20 text-accent-coral-dark font-bold text-xs flex items-center justify-center">
                                    EX
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-charcoal-500 line-through">Former Contractor</div>
                                    <div class="text-[11px] font-mono text-charcoal-400">ex@socialamplifiers.com</div>
                                </div>
                            </td>
                            <td class="py-4 px-3">
                                <span class="px-2.5 py-1 text-xs rounded-lg bg-accent-coral/15 text-accent-coral-dark font-semibold border border-accent-coral/30 inline-flex items-center gap-1">
                                    <i class="ri-close-circle-fill"></i> isActive = 0
                                </span>
                            </td>
                            <td class="py-4 px-3 text-xs font-mono text-accent-coral-dark">Access Locked Out</td>
                            <td class="py-4 px-3 text-accent-coral-dark"><i class="ri-lock-fill text-base"></i></td>
                            <td class="py-4 px-3 text-accent-coral-dark"><i class="ri-lock-fill text-base"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 4-Card Feature Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Feature 1 -->
            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border flex flex-col justify-between shadow-sa-soft hover:shadow-sa-card transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-accent-sage/20 text-accent-sage-dark flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="ri-shield-keyhole-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-charcoal-900">One-Click Copy</h4>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        Copy passwords securely directly to the clipboard with automated clipboard clearance timeouts.
                    </p>
                </div>
                <div class="mt-4 text-[11px] font-mono text-accent-sage-dark font-semibold">
                    Clipboard API Secured
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border flex flex-col justify-between shadow-sa-soft hover:shadow-sa-card transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-accent-lavender/20 text-accent-lavender-dark flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="ri-user-settings-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-charcoal-900">Admin Control Panel</h4>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        Add, modify, or reassign credentials and toggle active states without direct database queries.
                    </p>
                </div>
                <div class="mt-4 text-[11px] font-mono text-accent-lavender-dark font-semibold">
                    AJAX Action Hooks
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border flex flex-col justify-between shadow-sa-soft hover:shadow-sa-card transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-accent-coral/20 text-accent-coral-dark flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="ri-search-eye-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-charcoal-900">Instant Search & Filter</h4>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        Find credentials instantly by project title, client name, category, or service URL.
                    </p>
                </div>
                <div class="mt-4 text-[11px] font-mono text-accent-coral-dark font-semibold">
                    Fast In-Memory Filtering
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border flex flex-col justify-between shadow-sa-soft hover:shadow-sa-card transition-all duration-300 group" data-aos="fade-up" data-aos-delay="400">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-accent-sand/40 text-charcoal-900 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="ri-database-2-line"></i>
                    </div>
                    <h4 class="text-base font-bold text-charcoal-900">MySQL & PDO Safety</h4>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        All database transactions use strictly parameterized prepared statements to eliminate SQL injection.
                    </p>
                </div>
                <div class="mt-4 text-[11px] font-mono text-charcoal-700 font-semibold">
                    PDO Prepared Statements
                </div>
            </div>

        </div>

    </div>
</section>