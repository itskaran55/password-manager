<?php
// Ensure session and config are loaded cleanly
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/src/Auth.php';

// Validate authenticated session and live isActive state
Auth::validateActiveSession();

$userName = $_SESSION['user_name'] ?? 'Team Member';
$userRole = $_SESSION['user_role'] ?? 'user';
$pageTitle = "Vault Dashboard | Social Amplifiers";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sa: {
                            bg: '#FBF9F5',
                            card: '#F3EFEA',
                            border: '#E6DFD5',
                            hover: '#EDE6DC',
                        },
                        accent: {
                            sage: '#8FA89B',
                            'sage-dark': '#5A7567',
                            lavender: '#9B96C7',
                            'lavender-dark': '#6C66A3',
                            coral: '#E89888',
                            'coral-dark': '#C96E5D',
                            sand: '#D8C7B5',
                        },
                        charcoal: {
                            900: '#1A1D20',
                            700: '#3D444B',
                            500: '#6C757D',
                            400: '#9EA8B3',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    boxShadow: {
                        'sa-soft': '0 10px 30px -5px rgba(61, 68, 75, 0.06)',
                        'sa-card': '0 15px 35px -5px rgba(61, 68, 75, 0.08)',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Remix Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FBF9F5; color: #1A1D20; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #D8C7B5; border-radius: 9999px; }
    </style>
</head>
<body class="bg-sa-bg min-h-screen flex flex-col justify-between selection:bg-accent-lavender/20">

    <!-- Navbar -->
    <?php include_once __DIR__ . '/includes/layout/navbar.php'; ?>

    <!-- Main Dashboard Container -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">
        
        <!-- Header Strip -->
        <div id="dash-header" class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-8 mb-8 border-b border-sa-border">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-mono uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-accent-sage/20 text-accent-sage-dark font-bold border border-accent-sage/30">
                        <?= strtoupper($userRole); ?> SESSION
                    </span>
                    <span class="text-xs text-charcoal-500 font-medium">AES-256 Activated</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight">
                    Welcome back, <?= htmlspecialchars($userName); ?>
                </h1>
            </div>

            <!-- Global Actions -->
            <div class="flex items-center gap-3">
                <?php if ($userRole === 'admin'): ?>
                    <a href="admin/users.php" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover text-xs sm:text-sm font-semibold transition-all">
                        <i class="ri-user-settings-line text-accent-lavender-dark"></i>
                        Manage Users
                    </a>
                <?php endif; ?>
                <button type="button" onclick="handleLogout()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-accent-coral/15 hover:bg-accent-coral/25 border border-accent-coral/30 text-accent-coral-dark text-xs sm:text-sm font-semibold transition-all cursor-pointer">
    <i class="ri-logout-box-r-line text-base"></i>
    <span>Lock &amp; Logout</span>
</button>
            </div>
        </div>

        <!-- Search, Filter & Metrics Bar -->
        <div id="dash-toolbar" class="grid grid-cols-1 sm:grid-cols-12 gap-4 mb-8">
            <!-- Search Bar (sm:col-span-8) -->
            <div class="sm:col-span-8 relative">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400">
                    <i class="ri-search-2-line text-lg"></i>
                </span>
                <input type="text" id="vault-search" placeholder="Search client, platform, username, or URL..."
                    class="w-full pl-11 pr-4 py-3.5 bg-sa-card rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-lavender-dark focus:ring-4 focus:ring-accent-lavender/15 transition-all font-medium shadow-sa-soft">
            </div>

            <!-- Category Filter (sm:col-span-4) -->
            <div class="sm:col-span-4">
                <select id="category-filter" class="w-full px-4 py-3.5 bg-sa-card rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium shadow-sa-soft cursor-pointer">
                    <option value="">All Categories</option>
                    <option value="General">General</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Advertising">Advertising</option>
                    <option value="Servers & Hosting">Servers & Hosting</option>
                    <option value="Development">Development</option>
                </select>
            </div>
        </div>

        <!-- Dynamic Credential Cards Grid -->
        <div id="credentials-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Populated asynchronously via JavaScript -->
        </div>

        <!-- Empty / No Results State -->
        <div id="empty-state" class="hidden text-center py-16 px-4 bg-sa-card/60 rounded-3xl border border-sa-border">
            <div class="w-12 h-12 rounded-2xl bg-sa-bg border border-sa-border text-charcoal-400 text-2xl flex items-center justify-center mx-auto mb-3">
                <i class="ri-folder-lock-line"></i>
            </div>
            <h3 class="text-base font-bold text-charcoal-900">No passwords found</h3>
            <p class="text-xs text-charcoal-500 mt-1 max-w-sm mx-auto">
                No credentials match your active filter or have been assigned to your profile by an administrator.
            </p>
        </div>

    </main>

    <!-- Toast Notification (Top Right) -->
    <div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-150%] opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-charcoal-900 text-sa-bg px-4 py-3 rounded-2xl shadow-sa-card flex items-center gap-2.5 text-xs font-semibold border border-charcoal-700">
            <i id="toast-icon" class="ri-checkbox-circle-fill text-accent-sage text-base"></i>
            <span id="toast-message">Copied to clipboard</span>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once __DIR__ . '/includes/layout/footer.php'; ?>

    <!-- Vault Client Operations Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        let allPasswords = [];
        const container = document.getElementById('credentials-container');
        const emptyState = document.getElementById('empty-state');
        const searchInput = document.getElementById('vault-search');
        const categoryFilter = document.getElementById('category-filter');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');

        function showToast(message, isError = false) {
            toastMsg.textContent = message;
            document.getElementById('toast-icon').className = isError 
                ? "ri-error-warning-fill text-accent-coral text-base" 
                : "ri-checkbox-circle-fill text-accent-sage text-base";

            toast.classList.remove('translate-y-[-150%]', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-[-150%]', 'opacity-0');
            }, 2500);
        }

        // Fetch user's assigned passwords
        async function loadVault() {
            try {
                const res = await fetch('api/password-actions.php?action=list');
                const data = await res.json();

                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }

                if (data.success) {
                    allPasswords = data.data;
                    renderPasswords(allPasswords);
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to load vault items.", true);
            }
        }

        // Render card layout
        function renderPasswords(items) {
            container.innerHTML = '';
            if (items.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            }
            emptyState.classList.add('hidden');

            items.forEach(item => {
                const card = document.createElement('div');
                card.className = "p-5 sm:p-6 rounded-3xl bg-sa-card/90 border border-sa-border shadow-sa-soft flex flex-col justify-between hover:shadow-sa-card transition-all duration-300";
                
                card.innerHTML = `
                    <div class="space-y-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-sa-bg border border-sa-border flex items-center justify-center text-accent-lavender-dark text-xl font-bold shadow-xs">
                                    <i class="ri-key-2-line"></i>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-charcoal-900">${escapeHtml(item.title)}</h3>
                                    <span class="text-[10px] font-mono uppercase bg-accent-sage/15 text-accent-sage-dark px-2 py-0.5 rounded-md font-semibold border border-accent-sage/30">
                                        ${escapeHtml(item.category || 'General')}
                                    </span>
                                </div>
                            </div>
                            ${item.website_url ? `
                                <a href="${escapeHtml(item.website_url)}" target="_blank" class="p-2 text-charcoal-400 hover:text-charcoal-900 rounded-xl hover:bg-sa-bg transition-colors" title="Visit website">
                                    <i class="ri-external-link-line text-base"></i>
                                </a>
                            ` : ''}
                        </div>

                        <!-- Username/Email Field -->
                        <div class="p-3 bg-sa-bg rounded-2xl border border-sa-border flex items-center justify-between">
                            <div class="text-left overflow-hidden">
                                <span class="text-[10px] text-charcoal-400 uppercase font-bold block">Account Login</span>
                                <span class="text-xs font-mono font-medium text-charcoal-900 truncate block">${escapeHtml(item.username_or_email)}</span>
                            </div>
                            <button onclick="copyText('${escapeJs(item.username_or_email)}', 'Login copied')" class="p-1.5 text-charcoal-500 hover:text-accent-sage-dark transition-colors" title="Copy Login">
                                <i class="ri-file-copy-line text-sm"></i>
                            </button>
                        </div>

                        <!-- Password Field -->
                        <div class="p-3 bg-sa-bg rounded-2xl border border-sa-border flex items-center justify-between">
                            <div class="text-left overflow-hidden">
                                <span class="text-[10px] text-charcoal-400 uppercase font-bold block">Encrypted Password</span>
                                <span id="pwd-display-${item.id}" class="text-xs font-mono font-medium text-charcoal-900 tracking-wider">••••••••••••</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button id="btn-reveal-${item.id}" onclick="toggleReveal(${item.id})" class="p-1.5 text-charcoal-500 hover:text-accent-lavender-dark transition-colors" title="Reveal Password">
                                    <i id="icon-reveal-${item.id}" class="ri-eye-line text-sm"></i>
                                </button>
                                <button onclick="copyDecryptedPassword(${item.id})" class="p-1.5 text-charcoal-500 hover:text-accent-sage-dark transition-colors" title="Copy Password">
                                    <i class="ri-file-copy-2-line text-sm"></i>
                                </button>
                            </div>
                        </div>

                        ${item.notes ? `
                            <p class="text-xs text-charcoal-500 italic bg-sa-bg/50 p-2.5 rounded-xl border border-sa-border/60">
                                ${escapeHtml(item.notes)}
                            </p>
                        ` : ''}
                    </div>

                    <div class="mt-4 pt-3 border-t border-sa-border/80 flex items-center justify-between text-[11px] text-charcoal-400 font-mono">
                        <span>AES-256 Protected</span>
                        <span>Read Only</span>
                    </div>
                `;
                container.appendChild(card);
            });

            gsap.from("#credentials-container > div", {
                y: 15,
                opacity: 1,
                duration: 0.4,
                stagger: 0.05,
                ease: "power2.out"
            });
        }

        // Live Filtering
        function filterData() {
            const query = searchInput.value.toLowerCase();
            const cat = categoryFilter.value;

            const filtered = allPasswords.filter(p => {
                const matchesSearch = p.title.toLowerCase().includes(query) || 
                                      p.username_or_email.toLowerCase().includes(query) ||
                                      (p.website_url && p.website_url.toLowerCase().includes(query));
                const matchesCat = cat === '' || p.category === cat;
                return matchesSearch && matchesCat;
            });
            renderPasswords(filtered);
        }

        searchInput.addEventListener('input', filterData);
        categoryFilter.addEventListener('change', filterData);

        // Copy plain text
        window.copyText = function(text, successMsg) {
            navigator.clipboard.writeText(text).then(() => showToast(successMsg));
        };

        // Decrypt and Copy
        window.copyDecryptedPassword = async function(id) {
            try {
                const formData = new FormData();
                formData.append('action', 'reveal');
                formData.append('id', id);

                const res = await fetch('api/password-actions.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    navigator.clipboard.writeText(data.decrypted_password);
                    showToast("Password copied to clipboard!");
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Decryption request failed.", true);
            }
        };

        // Reveal toggle
        window.toggleReveal = async function(id) {
            const display = document.getElementById(`pwd-display-${id}`);
            const icon = document.getElementById(`icon-reveal-${id}`);

            if (display.textContent !== '••••••••••••') {
                display.textContent = '••••••••••••';
                icon.className = 'ri-eye-line text-sm';
                return;
            }

            try {
                const formData = new FormData();
                formData.append('action', 'reveal');
                formData.append('id', id);

                const res = await fetch('api/password-actions.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    display.textContent = data.decrypted_password;
                    icon.className = 'ri-eye-off-line text-sm';
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to fetch password.", true);
            }
        };

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function escapeJs(str) {
            if (!str) return '';
            return str.replace(/'/g, "\\'").replace(/"/g, '\\"');
        }

        // Initialize Vault
        loadVault();
    });
    
    window.handleLogout = async function() {
    try {
        const formData = new FormData();
        formData.append('action', 'logout');
        
        // Call API endpoint to destroy session
        await fetch('api/auth-actions.php', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });
    } catch (e) {
        console.log("Fallback to logout.php");
    }
    // Hard redirect to logout.php to wipe everything
    window.location.replace('logout.php');
};
    </script>
</body>
</html>