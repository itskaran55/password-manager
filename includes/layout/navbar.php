<?php
// Session check for dynamic link rendering
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$userRole   = $_SESSION['user_role'] ?? 'user';
$userName   = $_SESSION['user_name'] ?? 'User';
?>

<header id="main-navbar" class="sticky top-0 z-50 w-full backdrop-blur-md bg-sa-bg/85 border-b border-sa-border transition-all duration-300 shadow-sa-soft">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- 1. Brand Logo -->
            <a href="index.php" class="flex items-center gap-3.5 group focus:outline-none">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm group-hover:scale-105 group-hover:shadow-sa-glow transition-all duration-300">
                    <div class="w-full h-full bg-sa-card rounded-[14px] flex items-center justify-center border border-white/60">
                        <i class="ri-shield-keyhole-fill text-accent-sage-dark text-2xl group-hover:rotate-12 transition-transform duration-300"></i>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="text-lg font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                        PassVault
                        <span class="text-[10px] tracking-wider px-2 py-0.5 rounded-full bg-accent-sage/20 text-accent-sage-dark border border-accent-sage/30 font-semibold uppercase">SA</span>
                    </span>
                    <span class="text-[11px] text-charcoal-500 font-medium -mt-0.5">Enterprise Security</span>
                </div>
            </a>

            <!-- 2. Desktop Navigation Links -->
            <nav class="hidden md:flex items-center gap-1.5 lg:gap-2 bg-sa-card/70 p-1.5 rounded-2xl border border-sa-border shadow-inner">
                <a href="index.php" class="px-3.5 py-1.5 text-sm font-semibold rounded-xl text-charcoal-900 hover:text-accent-sage-dark hover:bg-sa-bg transition-all duration-200">
                    Home
                </a>
                <a href="#about" class="px-3.5 py-1.5 text-sm font-medium rounded-xl text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-bg transition-all duration-200">
                    About
                </a>
                <a href="#features" class="px-3.5 py-1.5 text-sm font-medium rounded-xl text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-bg transition-all duration-200">
                    Features
                </a>
                <a href="#security" class="px-3.5 py-1.5 text-sm font-medium rounded-xl text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-bg transition-all duration-200">
                    Security
                </a>

                <?php if ($isLoggedIn): ?>
                    <a href="dashboard.php" class="px-3.5 py-1.5 text-sm font-semibold rounded-xl text-accent-sage-dark bg-accent-sage/15 hover:bg-accent-sage/25 border border-accent-sage/30 transition-all duration-200">
                        Vault Dashboard
                    </a>
                    <?php if ($userRole === 'admin'): ?>
                        <a href="admin/users.php" class="px-3.5 py-1.5 text-sm font-semibold rounded-xl text-accent-lavender-dark bg-accent-lavender/15 hover:bg-accent-lavender/25 border border-accent-lavender/30 transition-all duration-200">
                            Manage Users
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>

            <!-- 3. Right Action CTA (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                <?php if (!$isLoggedIn): ?>
                    <a href="index.php?page=login" class="px-4 py-2 text-sm font-medium text-charcoal-700 hover:text-charcoal-900 transition-colors">
                        Sign In
                    </a>
                    <a href="index.php?page=login" class="relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-semibold rounded-2xl group bg-gradient-to-r from-accent-sage to-accent-lavender hover:from-accent-sage-dark hover:to-accent-lavender-dark text-charcoal-900 shadow-sm hover:shadow-sa-card active:scale-95 transition-all duration-200">
                        <span class="relative px-4 py-2 transition-all ease-in duration-150 bg-sa-bg rounded-[14px] group-hover:bg-opacity-0 group-hover:text-white flex items-center gap-2">
                            <i class="ri-lock-password-line text-base text-accent-sage-dark group-hover:text-white transition-colors"></i>
                            Access Vault
                        </span>
                    </a>
                <?php else: ?>
                    <div class="flex items-center gap-3 pl-3 border-l border-sa-border">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-accent-sage/25 border border-accent-sage/40 text-accent-sage-dark font-bold text-xs flex items-center justify-center shadow-sm">
                                <?= strtoupper(substr(htmlspecialchars($userName), 0, 2)); ?>
                            </div>
                            <span class="text-xs text-charcoal-900 font-semibold hidden lg:inline-block">
                                <?= htmlspecialchars($userName); ?>
                            </span>
                        </div>
                        <!--<a href="logout.php" class="p-2 text-charcoal-500 hover:text-accent-coral-dark hover:bg-accent-coral/15 rounded-xl transition-all duration-200" title="Logout">-->
                        <!--    <i class="ri-logout-box-r-line text-lg"></i>-->
                        <!--</a>-->
                        <?php if (!empty($_SESSION['user_id'])): ?>
    <?php 
        $logoutUrl = (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) ? '../logout.php' : 'logout.php'; 
    ?>
    <a href="<?= $logoutUrl; ?>" 
       class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-charcoal-500 hover:text-accent-coral-dark hover:bg-accent-coral/15 border border-transparent hover:border-accent-coral/30 transition-all duration-200" 
       title="Lock &amp; Logout"
       aria-label="Logout">
        <i class="ri-arrow-right-up-line text-lg"></i>
    </a>
<?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 4. Mobile Hamburger Button -->
            <div class="flex items-center md:hidden">
                <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-2xl bg-sa-card text-charcoal-900 hover:bg-sa-hover border border-sa-border focus:outline-none transition-all duration-200 shadow-sm" aria-label="Toggle menu">
                    <i id="hamburger-icon" class="ri-menu-3-line text-2xl transition-transform duration-300"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- 5. Mobile Drawer Menu -->
    <div id="mobile-menu" class="fixed inset-x-0 top-[80px] bg-sa-bg/95 backdrop-blur-2xl border-b border-sa-border px-6 py-6 transform -translate-y-[150%] opacity-0 pointer-events-none transition-all duration-300 md:hidden z-40 shadow-sa-card">
        <div class="flex flex-col gap-2.5">
            <a href="index.php" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-semibold text-charcoal-900 hover:bg-sa-card flex items-center justify-between transition-colors">
                <span>Home</span>
                <i class="ri-arrow-right-s-line text-charcoal-400"></i>
            </a>
            <a href="#about" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-medium text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-card flex items-center justify-between transition-colors">
                <span>About</span>
                <i class="ri-arrow-right-s-line text-charcoal-400"></i>
            </a>
            <a href="#features" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-medium text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-card flex items-center justify-between transition-colors">
                <span>Features</span>
                <i class="ri-arrow-right-s-line text-charcoal-400"></i>
            </a>
            <a href="#security" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-medium text-charcoal-700 hover:text-charcoal-900 hover:bg-sa-card flex items-center justify-between transition-colors">
                <span>Security</span>
                <i class="ri-arrow-right-s-line text-charcoal-400"></i>
            </a>

            <?php if ($isLoggedIn): ?>
                <div class="my-2 border-t border-sa-border"></div>
                <a href="dashboard.php" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-semibold text-accent-sage-dark bg-accent-sage/15 border border-accent-sage/30 flex items-center justify-between">
                    <span>Vault Dashboard</span>
                    <i class="ri-dashboard-line"></i>
                </a>
                <?php if ($userRole === 'admin'): ?>
                    <a href="admin/users.php" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-semibold text-accent-lavender-dark bg-accent-lavender/15 border border-accent-lavender/30 flex items-center justify-between">
                        <span>User Management</span>
                        <i class="ri-admin-line"></i>
                    </a>
                <?php endif; ?>
                <a href="logout.php" class="mobile-nav-link px-4 py-3 rounded-xl text-base font-medium text-accent-coral-dark hover:bg-accent-coral/15 flex items-center justify-between">
                    <span>Sign Out</span>
                    <i class="ri-logout-box-r-line"></i>
                </a>
            <?php else: ?>
                <div class="pt-4 mt-2 border-t border-sa-border flex flex-col gap-3">
                    <a href="index.php?page=login" class="w-full text-center py-3 rounded-2xl text-sm font-bold text-charcoal-900 bg-gradient-to-r from-accent-sage to-accent-coral shadow-sm hover:shadow-sa-card active:scale-[0.98] transition-all">
                        Sign In / Enter Vault
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuIcon = document.getElementById('hamburger-icon');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    let isMenuOpen = false;

    // Toggle Mobile Navigation Drawer with GSAP
    function toggleMobileMenu() {
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            mobileMenu.classList.remove('pointer-events-none');
            mobileMenu.classList.remove('-translate-y-[150%]', 'opacity-0');
            menuIcon.classList.replace('ri-menu-3-line', 'ri-close-line');
            menuIcon.style.transform = 'rotate(90deg)';

            gsap.fromTo(mobileLinks, 
                { y: -10, opacity: 0 }, 
                { y: 0, opacity: 1, duration: 0.25, stagger: 0.04, ease: 'power2.out' }
            );
        } else {
            mobileMenu.classList.add('pointer-events-none');
            mobileMenu.classList.add('-translate-y-[150%]', 'opacity-0');
            menuIcon.classList.replace('ri-close-line', 'ri-menu-3-line');
            menuIcon.style.transform = 'rotate(0deg)';
        }
    }

    menuBtn.addEventListener('click', toggleMobileMenu);

    // Auto-close menu when clicking link anchors
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (isMenuOpen) toggleMobileMenu();
        });
    });
});
</script>